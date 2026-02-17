<?php
class OrderModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->createTables(); // Create the table if not there
    }

    public function getpdo() {
        return $this->pdo;
    }

    public function createTables() {
        $sql1 = "CREATE TABLE IF NOT EXISTS orders (
            id INT AUTO_INCREMENT PRIMARY KEY,
            client_id INT NOT NULL,
            customWrap_id INT,
            wrapPackage_id INT,
            orderType VARCHAR(10),
            recipientName VARCHAR(50),
            recipientPhone VARCHAR(9),
            deliveryAddress VARCHAR(500),
            locationType VARCHAR(20),
            deliveryDate DATE,
            is_wrapped BOOL DEFAULT FALSE,
            is_delivered BOOL DEFAULT FALSE,
            giftWrapper_id INT DEFAULT NULL,
            delivery_id INT DEFAULT NULL,
            productPrice INT DEFAULT 0 NOT NULL,
            deliveryPrice INT DEFAULT 0 NOT NULL,
            delivered_at TIMESTAMP DEFAULT NULL,
            FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
        );";
        $sql2 = "CREATE TABLE IF NOT EXISTS orderItems (
            order_id INT NOT NULL,
            item_id INT NOT NULL,
            quantity INT NOT NULL,
            PRIMARY KEY (order_id, item_id),
            FOREIGN KEY (item_id) REFERENCES products(id) ON DELETE CASCADE
        );";
        $sql3 = "CREATE TABLE IF NOT EXISTS orderStatus (
            id INT AUTO_INCREMENT PRIMARY KEY,
            giftwrapper_id INT NOT NULL,
            order_id INT,
            is_wrapped BOOLEAN DEFAULT FALSE,
            is_delivered BOOLEAN DEFAULT FALSE,
            FOREIGN KEY (giftwrapper_id) REFERENCES giftwrappers(id) ON DELETE CASCADE,
            FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
        );";
        try {
            $this->pdo->exec($sql1);
            $this->pdo->exec($sql2);
            $this->pdo->exec($sql3);
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    /**
     * Get all orders that contain products from a specific vendor.
     */
    public function getOrdersForVendor($vendorId) {
        $sql = "
            SELECT 
                o.id AS order_id,
                o.client_id,
                CONCAT(c.first_name, ' ', c.last_name) AS client_name,
                c.email AS client_email,
                o.recipientName,
                o.recipientPhone,
                o.deliveryAddress,
                o.locationType,
                o.deliveryDate,
                o.is_wrapped,
                o.is_delivered,
                o.productPrice,
                o.deliveryPrice,
                o.orderType,
                SUM(oi.quantity * p.price) AS vendor_total
            FROM orders o
            JOIN orderItems oi ON oi.order_id = o.id
            JOIN products p ON p.id = oi.item_id
            JOIN clients c ON c.id = o.client_id
            WHERE p.vendor_id = ?
            GROUP BY o.id
            ORDER BY o.deliveryDate ASC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$vendorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get a single order's full details including only items belonging to the vendor.
     */
    public function getOrderDetailForVendor($orderId, $vendorId) {
        // Order header
        $sql1 = "
            SELECT 
                o.*,
                CONCAT(c.first_name, ' ', c.last_name) AS client_name,
                c.email AS client_email,
                c.phone AS client_phone
            FROM orders o
            JOIN clients c ON c.id = o.client_id
            WHERE o.id = ?
        ";
        $stmt1 = $this->pdo->prepare($sql1);
        $stmt1->execute([$orderId]);
        $order = $stmt1->fetch(PDO::FETCH_ASSOC);

        if (!$order) return null;

        // Items belonging to this vendor
        $sql2 = "
            SELECT 
                p.id AS product_id,
                p.name AS product_name,
                p.price,
                oi.quantity,
                (oi.quantity * p.price) AS subtotal
            FROM orderItems oi
            JOIN products p ON p.id = oi.item_id
            WHERE oi.order_id = ? AND p.vendor_id = ?
        ";
        $stmt2 = $this->pdo->prepare($sql2);
        $stmt2->execute([$orderId, $vendorId]);
        $items = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        $order['items'] = $items;
        $order['vendor_total'] = array_sum(array_column($items, 'subtotal'));

        return $order;
    }

    /**
     * Get summary stats for a vendor's orders.
     * Uses a subquery to first deduplicate orders, so each order is counted once
     * even if it contains multiple items from the same vendor.
     */

    public function getOrdersByClient($clientId) {
        $sql = "
            SELECT 
                o.*,
                os.is_delivered AS resolved_is_delivered,
                (
                    SELECT p.vendor_id
                    FROM orderItems oi
                    JOIN products p ON p.id = oi.item_id
                    WHERE oi.order_id = o.id
                    LIMIT 1
                ) AS vendor_id
            FROM orders o
            LEFT JOIN orderStatus os ON os.order_id = o.id
            WHERE o.client_id = ?
            ORDER BY o.id DESC
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$clientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getVendorOrderStats($vendorId) {
        $sql = "
            SELECT 
                COUNT(*) AS total_orders,
                COALESCE(SUM(vendor_total), 0) AS total_revenue,
                SUM(CASE WHEN deliveryDate < CURDATE() AND is_delivered = 0 THEN 1 ELSE 0 END) AS urgent_orders,
                SUM(CASE WHEN is_delivered = 1 THEN 1 ELSE 0 END) AS delivered_orders,
                SUM(CASE WHEN is_delivered = 0 THEN 1 ELSE 0 END) AS pending_orders
            FROM (
                SELECT 
                    o.id,
                    o.deliveryDate,
                    o.is_delivered,
                    SUM(oi.quantity * p.price) AS vendor_total
                FROM orders o
                JOIN orderItems oi ON oi.order_id = o.id
                JOIN products p ON p.id = oi.item_id
                WHERE p.vendor_id = ?
                GROUP BY o.id, o.deliveryDate, o.is_delivered
            ) AS vendor_orders
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$vendorId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function confirmOrder($data, $wrap_id) {

        if ($data['mode'] === "custom") {
            $stmt1 = $this->pdo->prepare("INSERT INTO orders (client_id, customWrap_id, wrapPackage_id, orderType, recipientName, recipientPhone, deliveryAddress, locationType, deliveryDate, deliveryPrice) VALUES (?, ?, NULL, ?, ?, ?, ?, ?, ?, ?)");
            $stmt1->execute([
                $data['client_id'],
                $wrap_id,
                $data['orderType'],
                $data['recipientName'],
                $data['recipientPhone'],
                $data['deliveryAddress'],
                $data['locationType'],
                $data['deliveryDate'],
                $data['deliveryPrice']
            ]);
        } else if ($data['mode'] === "package") {
            $stmt1 = $this->pdo->prepare("INSERT INTO orders (client_id, customWrap_id, wrapPackage_id, orderType, recipientName, recipientPhone, deliveryAddress, locationType, deliveryDate, deliveryPrice) VALUES (?, NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt1->execute([
                $data['client_id'],
                $wrap_id,
                $data['orderType'],
                $data['recipientName'],
                $data['recipientPhone'],
                $data['deliveryAddress'],
                $data['locationType'],
                $data['deliveryDate'],
                $data['deliveryPrice']
            ]);
        }
        $order_id = $this->pdo->lastInsertId();
        $price = 0;
        foreach ($data['cartItems'] as $items) {
            $price += $items['price'] * $items['quantity'];
            $stmt2 = $this->pdo->prepare("INSERT INTO orderItems (order_id, item_id, quantity) VALUES (?, ?, ?)");
            $stmt2->execute([
                $order_id,
                $items['product_id'],
                $items['quantity']
            ]);
        }

        $stmt3 = $this->pdo->prepare("UPDATE `orders` SET `productPrice`= $price WHERE `id` = $order_id");
        $stmt3->execute();
    }
}

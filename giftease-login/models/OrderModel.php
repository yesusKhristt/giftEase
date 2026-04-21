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
            in_warehouse BOOL DEFAULT FALSE,
            is_wrapped BOOL DEFAULT FALSE,
            is_delivered BOOL DEFAULT FALSE,
            giftWrapper_id INT DEFAULT NULL,
            delivery_id INT DEFAULT NULL,
            productPrice INT DEFAULT 0 NOT NULL,
            deliveryPrice INT DEFAULT 0 NOT NULL,
            delivered_at TIMESTAMP DEFAULT NULL,
            payment_method VARCHAR(50),
            clearance BOOL DEFAULT FALSE,
            FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
            FOREIGN KEY (delivery_id) REFERENCES delivery(id) ON DELETE CASCADE,
            FOREIGN KEY (giftWrapper_id) REFERENCES giftwrappers(id) ON DELETE CASCADE
        );";
        $sql2 = "CREATE TABLE IF NOT EXISTS orderItems (
            order_id INT NOT NULL,
            item_id INT NOT NULL,
            quantity INT NOT NULL,
            PRIMARY KEY (order_id, item_id),
            FOREIGN KEY (item_id) REFERENCES products(id) ON DELETE CASCADE
        );";
        $sql3 = "CREATE TABLE IF NOT EXISTS ratings (
            id INT AUTO_INCREMENT PRIMARY KEY,
            client_id INT NOT NULL,
            product_id INT NOT NULL,
            order_id INT NOT NULL,
            rating INT CHECK (rating BETWEEN 1 AND 5),
            review VARCHAR(500),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

            -- This prevents duplicate ratings
            UNIQUE (client_id, product_id, order_id)
        );";
        try {
            $this->pdo->exec($sql1);
            $this->pdo->exec($sql2);
            $this->pdo->exec($sql3);
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function alreadyRated($client_id, $product_id, $order_id) {
        $sql = "SELECT COUNT(*) FROM ratings 
        WHERE client_id = ? AND product_id = ? AND order_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$client_id, $product_id, $order_id]);

        return $stmt->fetchColumn();
    }

    public function rateProduct($client_id, $product_id, $order_id, $rating, $review) {
        $sql = "INSERT INTO ratings (client_id, product_id, order_id, rating, review)
        VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);

        try {
            $stmt->execute([$client_id, $product_id, $order_id, $rating, $review]);
        } catch (PDOException $e) {
            // catches duplicate entry if user tries to bypass frontend
            echo "You already rated this item.";
        }
    }

    public function getAllClientOrders($client_id) {
        $sql = "SELECT * 
            FROM orders 
            WHERE client_id = ? 
            ORDER BY id DESC;";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$client_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

    public function getItemsInOrder($orderID) {
        $stmt = $this->pdo->prepare("
                SELECT 
                p.name AS item_name,
                p.displayImage AS item_image,
                p.price,
                oi.quantity

            FROM orderItems oi

            JOIN products p 
                ON oi.item_id = p.id

            WHERE oi.order_id = ?;
        ");
        $stmt->execute([$orderID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getItemsInOrder3($orderID, $clientId) {
        $stmt = $this->pdo->prepare("
                SELECT 
                p.name AS item_name,
                p.displayImage AS item_image,
                v.shopName AS shopName,
                v.id AS vendor_id,
                p.price,
                p.id AS product_ID,
                oi.quantity

            FROM orderItems oi

            JOIN products p 
                ON oi.item_id = p.id
            JOIN vendors v
                ON p.vendor_id = v.id

            WHERE oi.order_id = ?;
        ");
        $stmt->execute([$orderID]);
        $items =  $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($items as &$row) {
            $alreadyRated = $this->alreadyRated($clientId, $row['product_ID'], $orderID);
            $row['alreadyRated'] = $alreadyRated;
        }
        unset($row); // important cleanup
        return $items;
    }

    public function getItemsInOrder2($orderID) {
        $stmt = $this->pdo->prepare("
                SELECT * FROM orderItems WHERE order_id = ?;
        ");
        $stmt->execute([$orderID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderByID($orderID) {
        $stmt = $this->pdo->prepare("
                SELECT * FROM orders WHERE id = ?;
        ");
        $stmt->execute([$orderID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderByID2($orderID) {
        $stmt = $this->pdo->prepare("
                SELECT 
                o.*,
                g.first_name AS giftWrapperFName,
                g.last_name AS giftWrapperLName,
                d.first_name AS deliveryFName,
                d.last_name AS deliveryLName
                FROM orders o
                JOIN delivery d 
                ON o.delivery_id = d.id
                JOIN giftWrappers g 
                ON o.giftWrapper_id = g.id
                WHERE o.id = ?;
        ");
        $stmt->execute([$orderID]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
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

    public function approveOrder($order_id) {
        $stmt3 = $this->pdo->prepare(
            "UPDATE orders SET clearance = 1 WHERE id = ?"
        );

        $stmt3->execute([$order_id]);
    }

    public function getPendingOrders() {
        $stmt = $this->pdo->prepare("SELECT o.*, COALESCE(cw.price, gwp.price, 0) AS wrapPrice, (o.productPrice + o.deliveryPrice + COALESCE(cw.price, gwp.price, 0)) AS totalPrice
            FROM orders o LEFT JOIN customWrap cw ON o.customWrap_id = cw.id LEFT JOIN giftWrappingPackages gwp ON o.wrapPackage_id = gwp.id WHERE is_wrapped = 1 AND is_delivered = 1 AND clearance = 0;");
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllOrders() {
        $stmt = $this->pdo->prepare("SELECT o.*, COALESCE(cw.price, gwp.price, 0) AS wrapPrice, (o.productPrice + o.deliveryPrice + COALESCE(cw.price, gwp.price, 0)) AS totalPrice
            FROM orders o LEFT JOIN customWrap cw ON o.customWrap_id = cw.id LEFT JOIN giftWrappingPackages gwp ON o.wrapPackage_id = gwp.id;");
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function confirmOrder($data, $client_id, $method) {

        $wrap_id = $data['wrap']['id'];

        if ($data['wrap']['mode'] === "custom") {

            $stmt1 = $this->pdo->prepare(
                "INSERT INTO orders 
            (client_id, customWrap_id, wrapPackage_id, orderType, recipientName, recipientPhone, deliveryAddress, locationType, deliveryDate, deliveryPrice, payment_method) 
            VALUES (?, ?, NULL, ?, ?, ?, ?, ?, ?, ?, ?)"
            );

            $stmt1->execute([
                $client_id,
                $wrap_id,
                $data['delivery']['orderType'],
                $data['delivery']['recipientName'],
                $data['delivery']['recipientPhone'],
                $data['delivery']['deliveryAddress'],
                $data['delivery']['locationType'],
                $data['delivery']['deliveryDate'],
                $data['delivery']['deliveryPrice'],
                $method
            ]);
        } else if ($data['wrap']['mode'] === "package") {

            $stmt1 = $this->pdo->prepare(
                "INSERT INTO orders 
            (client_id, customWrap_id, wrapPackage_id, orderType, recipientName, recipientPhone, deliveryAddress, locationType, deliveryDate, deliveryPrice, payment_method) 
            VALUES (?, NULL, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            );

            $stmt1->execute([
                $client_id,
                $wrap_id,
                $data['delivery']['orderType'],
                $data['delivery']['recipientName'],
                $data['delivery']['recipientPhone'],
                $data['delivery']['deliveryAddress'],
                $data['delivery']['locationType'],
                $data['delivery']['deliveryDate'],
                $data['delivery']['deliveryPrice'],
                $method
            ]);
        }

        $order_id = $this->pdo->lastInsertId();
        $price = 0;

        foreach ($data['cart'] as $item) {

            $price += $item['price'] * $item['quantity'];

            $stmt2 = $this->pdo->prepare(
                "INSERT INTO orderItems (order_id, item_id, quantity) VALUES (?, ?, ?)"
            );

            $stmt2->execute([
                $order_id,
                $item['id'],
                $item['quantity']
            ]);
        }

        $stmt3 = $this->pdo->prepare(
            "UPDATE orders SET productPrice = ? WHERE id = ?"
        );

        $stmt3->execute([$price, $order_id]);

        return $order_id;
    }
}

<?php
class AdminModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->createTableIfNotExists(); // Create the table if not there
    }

    public function getpdo()
    {
        return $this->pdo;
    }

    public function createTableIfNotExists()
    {
        $sql1 = "CREATE TABLE IF NOT EXISTS admins (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            status ENUM('active', 'inactive') DEFAULT 'active',
            address VARCHAR(255),
            designation VARCHAR(20),
            phone VARCHAR(10),
            image_loc VARCHAR(500) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

        try {
            $this->pdo->exec($sql1);
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function authenticate($email, $password, $type, &$error)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM admins WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password']) && $type == 'admin') {
            return $user;
        }
        $error = "Invalid Username or Password";
        return null;
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM admins WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO admins (first_name, last_name, email, password, designation, phone, image_loc, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
            $data['designation'],
            $data['phone'],
            $data['imageloc'],
            $data['address'],
        ]);
    }

    public function updateUser($data)
    {
        $stmt = $this->pdo->prepare("UPDATE admins SET first_name = ?, last_name = ?, designation = ?, phone = ?, address = ? WHERE id = ?");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['designation'],
            $data['phone'],
            $data['address'],
            $data['id']
        ]);
    }

    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare("UPDATE admins SET status = 'inactive' WHERE id = ?");
        $stmt->execute($id);
    }

    public function getAllClients()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clients");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    public function getAllVerifiedVendors()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM vendors WHERE verified = 1");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }
    public function getAllUnverifiedVendors()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM vendors v JOIN vendorVerify VV ON v.id = VV.vendor_id ORDER BY created_at DESC");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    public function getAllAdmins()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM admins");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    public function getAllVerifiedDelivery()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM delivery WHERE verified = 1");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }
    public function getAllUnverifiedDelivery()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM delivery d JOIN deliveryVerify DD ON d.id = DD.delivery_id ORDER BY created_at DESC");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    public function getAllVerifiedDeliveryman()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM deliveryman WHERE verified = 1");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }
    public function getAllUnverifiedDeliveryman()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM deliveryman d JOIN deliverymanVerify DD ON d.id = DD.deliveryman_id ORDER BY created_at DESC");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    public function getAllVerifiedGiftwrapper()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM giftwrappers WHERE verified = 1");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }
    public function getAllUnverifiedGiftwrapper()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM giftwrappers g JOIN giftWrappersVerify GG ON g.id = GG.giftWrapper_id  ORDER BY created_at DESC");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    public function getAllVendors()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM vendors ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllDelivery()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM delivery ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllDeliveryman()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM deliveryman ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllGiftWrappers()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM giftwrappers ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVendorById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM vendors WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getVendorEarnings($vendorId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT COALESCE(SUM(oi.quantity * p.price), 0)
             FROM orderItems oi
             JOIN products p ON oi.item_id = p.id
             JOIN orders o ON oi.order_id = o.id
             WHERE p.vendor_id = ?
               AND o.is_delivered = 1"
        );
        $stmt->execute([$vendorId]);
        return (float) $stmt->fetchColumn();
    }

    public function getVendorMonthlyEarnings($vendorId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT COALESCE(SUM(oi.quantity * p.price), 0)
             FROM orderItems oi
             JOIN products p ON oi.item_id = p.id
             JOIN orders o ON oi.order_id = o.id
             WHERE p.vendor_id = ?
               AND o.is_delivered = 1
               AND YEAR(o.deliveryDate) = YEAR(CURDATE())
               AND MONTH(o.deliveryDate) = MONTH(CURDATE())"
        );
        $stmt->execute([$vendorId]);
        return (float) $stmt->fetchColumn();
    }

    public function getVendorTotalSold($vendorId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT COALESCE(SUM(oi.quantity), 0)
             FROM orderItems oi
             JOIN products p ON oi.item_id = p.id
             JOIN orders o ON oi.order_id = o.id
             WHERE p.vendor_id = ?
               AND o.is_delivered = 1"
        );
        $stmt->execute([$vendorId]);
        return (int) $stmt->fetchColumn();
    }

    public function getVendorProductCount($vendorId)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM products WHERE vendor_id = ?");
        $stmt->execute([$vendorId]);
        return (int) $stmt->fetchColumn();
    }

    public function getVendorRatingStats($vendorId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT COALESCE(AVG(rating), 0) AS rating, COUNT(*) AS total
             FROM vendor_ratings
             WHERE vendor_id = ?"
        );
        $stmt->execute([$vendorId]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: ['rating' => 0, 'total' => 0];
    }

    public function getVendorProducts($vendorId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT id, name, price, displayImage, status
             FROM products
             WHERE vendor_id = ?
             ORDER BY id DESC"
        );
        $stmt->execute([$vendorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDeliveryById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM delivery WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDeliveryEarnings($deliveryId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT COALESCE(SUM(o.deliveryPrice), 0)
             FROM orders o
             WHERE o.delivery_id = ?
               AND o.is_delivered = 1"
        );
        $stmt->execute([$deliveryId]);
        return (float) $stmt->fetchColumn();
    }

    public function getDeliveryMonthlyEarnings($deliveryId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT COALESCE(SUM(o.deliveryPrice), 0)
             FROM orders o
             WHERE o.delivery_id = ?
               AND o.is_delivered = 1
               AND YEAR(o.deliveryDate) = YEAR(CURDATE())
               AND MONTH(o.deliveryDate) = MONTH(CURDATE())"
        );
        $stmt->execute([$deliveryId]);
        return (float) $stmt->fetchColumn();
    }

    public function getDeliveryCompletedCount($deliveryId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT COUNT(*)
             FROM orders o
             WHERE o.delivery_id = ?
               AND o.is_delivered = 1"
        );
        $stmt->execute([$deliveryId]);
        return (int) $stmt->fetchColumn();
    }

    public function getDeliverymanById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM deliveryman WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getGiftWrapperById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM giftwrappers WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getGiftWrapperEarnings($giftWrapperId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT COALESCE(SUM(COALESCE(cw.price, gp.price)), 0)
             FROM orders o
             LEFT JOIN customwrap cw ON o.customWrap_id = cw.id
             LEFT JOIN giftwrappackage gp ON o.wrapPackage_id = gp.id
             WHERE o.giftWrapper_id = ?
               AND o.is_wrapped = 1"
        );
        $stmt->execute([$giftWrapperId]);
        return (float) $stmt->fetchColumn();
    }

    public function getGiftWrapperMonthlyEarnings($giftWrapperId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT COALESCE(SUM(COALESCE(cw.price, gp.price)), 0)
             FROM orders o
             LEFT JOIN customwrap cw ON o.customWrap_id = cw.id
             LEFT JOIN giftwrappackage gp ON o.wrapPackage_id = gp.id
             WHERE o.giftWrapper_id = ?
               AND o.is_wrapped = 1
               AND YEAR(o.deliveryDate) = YEAR(CURDATE())
               AND MONTH(o.deliveryDate) = MONTH(CURDATE())"
        );
        $stmt->execute([$giftWrapperId]);
        return (float) $stmt->fetchColumn();
    }

    public function getGiftWrapperCompletedCount($giftWrapperId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT COUNT(*)
             FROM orders o
             WHERE o.giftWrapper_id = ?
               AND o.is_wrapped = 1"
        );
        $stmt->execute([$giftWrapperId]);
        return (int) $stmt->fetchColumn();
    }

    public function getVendorSoldItems($vendorId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT o.id AS order_id,
                    o.deliveryDate,
                    c.first_name,
                    c.last_name,
                    p.name AS product_name,
                    oi.quantity,
                    p.price
             FROM orderItems oi
             JOIN products p ON oi.item_id = p.id
             JOIN orders o ON oi.order_id = o.id
             LEFT JOIN clients c ON o.client_id = c.id
             WHERE p.vendor_id = ?
             ORDER BY o.deliveryDate DESC, o.id DESC"
        );
        $stmt->execute([$vendorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVendorSoldItemsList($vendorId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT o.id AS order_id,
                    o.deliveryDate,
                    c.first_name,
                    c.last_name,
                    p.name AS product_name,
                    oi.quantity,
                    p.price
             FROM orderItems oi
             JOIN products p ON oi.item_id = p.id
             JOIN orders o ON oi.order_id = o.id
             LEFT JOIN clients c ON o.client_id = c.id
             WHERE p.vendor_id = ?
               AND o.is_delivered = 1
             ORDER BY o.deliveryDate DESC, o.id DESC"
        );
        $stmt->execute([$vendorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDeliveryOrders($deliveryId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT o.id AS order_id,
                    o.deliveryDate,
                    o.is_delivered,
                    o.deliveryPrice,
                    c.first_name,
                    c.last_name
             FROM orders o
             LEFT JOIN clients c ON o.client_id = c.id
             WHERE o.delivery_id = ?
             ORDER BY o.deliveryDate DESC, o.id DESC"
        );
        $stmt->execute([$deliveryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDeliveryCompletedOrders($deliveryId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT o.id AS order_id,
                    o.deliveryDate,
                    o.deliveryPrice,
                    c.first_name,
                    c.last_name
             FROM orders o
             LEFT JOIN clients c ON o.client_id = c.id
             WHERE o.delivery_id = ?
               AND o.is_delivered = 1
             ORDER BY o.deliveryDate DESC, o.id DESC"
        );
        $stmt->execute([$deliveryId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDeliverymanCompletedOrders($deliverymanId)
    {
        return [];
    }

    public function getGiftWrapperOrders($giftWrapperId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT o.id AS order_id,
                    o.deliveryDate,
                    o.is_wrapped,
                    COALESCE(cw.price, gp.price, 0) AS amount,
                    c.first_name,
                    c.last_name
             FROM orders o
             LEFT JOIN customwrap cw ON o.customWrap_id = cw.id
             LEFT JOIN giftwrappackage gp ON o.wrapPackage_id = gp.id
             LEFT JOIN clients c ON o.client_id = c.id
             WHERE o.giftWrapper_id = ?
             ORDER BY o.deliveryDate DESC, o.id DESC"
        );
        $stmt->execute([$giftWrapperId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGiftWrapperCompletedOrders($giftWrapperId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT o.id AS order_id,
                    o.deliveryDate,
                    COALESCE(cw.price, gp.price, 0) AS amount,
                    c.first_name,
                    c.last_name
             FROM orders o
             LEFT JOIN customwrap cw ON o.customWrap_id = cw.id
             LEFT JOIN giftwrappackage gp ON o.wrapPackage_id = gp.id
             LEFT JOIN clients c ON o.client_id = c.id
             WHERE o.giftWrapper_id = ?
               AND o.is_wrapped = 1
             ORDER BY o.deliveryDate DESC, o.id DESC"
        );
        $stmt->execute([$giftWrapperId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderDetail($orderId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT o.*, c.first_name, c.last_name
             FROM orders o
             LEFT JOIN clients c ON o.client_id = c.id
             WHERE o.id = ?
             LIMIT 1"
        );
        $stmt->execute([$orderId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getOrderItems($orderId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT oi.quantity, p.name, p.price, v.shopName
             FROM orderItems oi
             JOIN products p ON oi.item_id = p.id
             LEFT JOIN vendors v ON p.vendor_id = v.id
             WHERE oi.order_id = ?"
        );
        $stmt->execute([$orderId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalOrders()
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM orders");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    /**
     * Get total number of products
     */
    public function getTotalProducts()
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM products");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    /**
     * Get total number of clients
     */
    public function getTotalClients()
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM clients WHERE status = 'active'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    /**
     * Get total number of vendors
     */
    public function getTotalVendors()
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM vendors WHERE status = 'active'");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    /**
     * Get total revenue from orders
     */
    public function getTotalRevenue()
    {
        $stmt = $this->pdo->prepare("SELECT COALESCE(SUM(productPrice + deliveryPrice), 0) as total FROM orders");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    /**
     * Get monthly growth percentage (comparing current month vs previous month orders)
     * Uses deliveryDate since orders table has no created_at column
     */
    public function getMonthlyGrowth()
    {
        // Current month orders
        $stmt1 = $this->pdo->prepare("SELECT COUNT(*) as total FROM orders WHERE MONTH(deliveryDate) = MONTH(CURRENT_DATE()) AND YEAR(deliveryDate) = YEAR(CURRENT_DATE())");
        $stmt1->execute();
        $currentMonth = $stmt1->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

        // Previous month orders
        $stmt2 = $this->pdo->prepare("SELECT COUNT(*) as total FROM orders WHERE MONTH(deliveryDate) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(deliveryDate) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)");
        $stmt2->execute();
        $previousMonth = $stmt2->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

        if ($previousMonth == 0) {
            return $currentMonth > 0 ? 100.0 : 0.0;
        }
        return round((($currentMonth - $previousMonth) / $previousMonth) * 100, 1);
    }

    /**
     * Get top category by number of products sold
     */
    public function getTopCategory()
    {
        $stmt = $this->pdo->prepare("
            SELECT c.name, COALESCE(SUM(oi.quantity), 0) as total_sold
            FROM categories c
            LEFT JOIN products p ON p.mainCategory = c.id
            LEFT JOIN orderItems oi ON oi.item_id = p.id
            GROUP BY c.id, c.name
            ORDER BY total_sold DESC
            LIMIT 1
        ");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['name'] ?? 'N/A';
    }

    /**
     * Get customer retention rate (returning customers / total customers * 100)
     */
    public function getCustomerRetention()
    {
        // Count customers with more than one order
        $stmt1 = $this->pdo->prepare("SELECT COUNT(DISTINCT client_id) as returning_customers FROM orders GROUP BY client_id HAVING COUNT(*) > 1");
        $stmt1->execute();
        $returningCustomers = $stmt1->rowCount();

        // Total customers who placed at least one order
        $stmt2 = $this->pdo->prepare("SELECT COUNT(DISTINCT client_id) as total FROM orders");
        $stmt2->execute();
        $totalCustomers = $stmt2->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

        if ($totalCustomers == 0) {
            return 0;
        }
        return round(($returningCustomers / $totalCustomers) * 100);
    }

    /**
     * Get orders by month for chart (last 6 months)
     * Uses deliveryDate since orders table has no created_at column
     */
    public function getOrdersByMonth()
    {
        $stmt = $this->pdo->prepare("
            SELECT 
                DATE_FORMAT(deliveryDate, '%Y-%m') as month,
                COUNT(*) as total_orders,
                COALESCE(SUM(productPrice + deliveryPrice), 0) as revenue
            FROM orders
            WHERE deliveryDate >= DATE_SUB(CURRENT_DATE(), INTERVAL 6 MONTH)
            GROUP BY DATE_FORMAT(deliveryDate, '%Y-%m')
            ORDER BY month ASC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get top selling products
     */
    public function getTopSellingProducts($limit = 5)
    {
        $limit = (int) $limit;
        $stmt = $this->pdo->prepare("
            SELECT p.name, COALESCE(SUM(oi.quantity), 0) as total_sold
            FROM products p
            LEFT JOIN orderItems oi ON oi.item_id = p.id
            GROUP BY p.id, p.name
            ORDER BY total_sold DESC
            LIMIT $limit
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get sales by category for pie chart
     */
    public function getSalesByCategory()
    {
        $stmt = $this->pdo->prepare("
            SELECT c.name, COALESCE(SUM(oi.quantity), 0) as total_sold
            FROM categories c
            LEFT JOIN products p ON p.mainCategory = c.id
            LEFT JOIN orderItems oi ON oi.item_id = p.id
            GROUP BY c.id, c.name
            ORDER BY total_sold DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

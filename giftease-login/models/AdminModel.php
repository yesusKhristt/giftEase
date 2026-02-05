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
        $stmt = $this->pdo->prepare("SELECT * FROM vendors");
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
        $stmt = $this->pdo->prepare("SELECT * FROM delivery");
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
        $stmt = $this->pdo->prepare("SELECT * FROM deliveryman");
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
        $stmt = $this->pdo->prepare("SELECT * FROM giftwrappers");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    // ========== REPORT METHODS ==========

    /**
     * Get total number of orders
     */
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
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM vendors WHERE status = 'active' AND verified = 1");
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

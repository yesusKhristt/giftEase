<?php
// ClientModel.php***

class GiftWrapperModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->createTables(); // Create the table if not there
    }

    public function getpdo()
    {
        return $this->pdo;
    }

    public function createTables()
    {
        $stmt = "CREATE TABLE IF NOT EXISTS giftWrappers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            status ENUM('active', 'inactive') DEFAULT 'active',
            address VARCHAR(255),
            years_of_experience VARCHAR(20),
            phone VARCHAR(10),
            image_loc VARCHAR(500) DEFAULT NULL,
            verified BOOL DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

        try {
            $this->pdo->exec($stmt);

        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function verifyUser($user_id)
    {
        $sql  = "UPDATE giftWrappers SET verified = 1 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }

    public function unverifyUser($user_id)
    {
        $sql  = "UPDATE giftWrappers SET verified = 0 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }

    public function authenticate($email, $password, $type, &$error)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM giftWrappers WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password']) && $type == 'giftWrapper') {
            if (!$user['verified']){
                $error = "User Not verified";
            return null;
            }
            return $user;
        }
        $error = "Invalid Username or Password";
        return null;
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM giftWrappers WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO giftWrappers (first_name, last_name, email, password, years_of_experience, phone, image_loc, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
            $data['years_of_experience'],
            $data['phone'],
            $data['imageloc'],
            $data['address'],
        ]);
    }

    public function updateUser($data)
    {
        $stmt = $this->pdo->prepare("UPDATE giftWrappers SET first_name = ?, last_name = ?, years_of_experience = ?, phone = ?, address = ? WHERE id = ?");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['years_of_experience'],
            $data['phone'],
            $data['address'],
            $data['id'],
        ]);
    }

    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare("UPDATE giftWrappers SET status = 'inactive' WHERE id = ?");
        $stmt->execute($id);
    }

    public function getAllOrders()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE is_wrapped = 0 AND is_delivered = 0 AND giftWrapper_id IS NULL");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAssignedOrders($id)
    {
        $stmt = $this->pdo->prepare("SELECT *  FROM orders WHERE is_wrapped = 0 AND is_delivered = 0 AND giftWrapper_id = ?");
        $stmt->execute([$id]);
        $order = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($order) {
            if ($order[0]['customWrap_id']) {
                $stmt1 = $this->pdo->prepare("SELECT orders.id, client_id, customWrap_id, deliveryDate, is_wrapped, giftWrapper_id, customwrap.price, clients.first_name, clients.last_name FROM orders JOIN customwrap ON orders.customWrap_id = customwrap.id JOIN clients ON orders.client_id = clients.id WHERE is_wrapped = 0 AND is_delivered = 0 AND giftWrapper_id = ?");
                $stmt1->execute([$id]);
                return $stmt1->fetchAll(PDO::FETCH_ASSOC);
            } else if ($order[0]['wrapPackage_id']) {
                $stmt1 = $this->pdo->prepare("SELECT orders.id, client_id, wrapPackage_id, deliveryDate, is_wrapped, giftWrapper_id, customwrap.price, clients.first_name, clients.last_name FROM orders JOIN giftwrappackage ON orders.customWrap_id = customwrap.id JOIN clients ON orders.client_id = clients.id WHERE is_wrapped = 0 AND is_delivered = 0 AND giftWrapper_id = ?");
                $stmt1->execute([$id]);
                return $stmt1->fetchAll(PDO::FETCH_ASSOC);
            }
        } else {
            return $order;
        }
    }

    public function acceptOrder($order_id, $giftWrapper_id)
    {
        $stmt = $this->pdo->prepare("UPDATE `orders` SET giftWrapper_id = ? WHERE `id` = ?");
        $stmt->execute([(int) $giftWrapper_id, (int) $order_id]);
    }

    public function markComplete($order_id)
    {
        $stmt = $this->pdo->prepare("UPDATE `orders` SET is_wrapped = 1 WHERE `id` = ?");
        $stmt->execute([$order_id]);
    }

    public function cancelOrder($order_id)
    {
        $stmt = $this->pdo->prepare("UPDATE `orders` SET giftWrapper_id = null WHERE `id` = ?");
        $stmt->execute([$order_id]);
    }

    // ========== ANALYTICS METHODS ==========

    /**
     * Get total orders handled by a gift wrapper
     */
    public function getTotalOrdersHandled($giftWrapperId)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM orders WHERE giftWrapper_id = ?");
        $stmt->execute([$giftWrapperId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    /**
     * Get completed (wrapped) orders count
     */
    public function getCompletedOrders($giftWrapperId)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM orders WHERE giftWrapper_id = ? AND is_wrapped = 1");
        $stmt->execute([$giftWrapperId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    /**
     * Get pending orders count
     */
    public function getPendingOrders($giftWrapperId)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as total FROM orders WHERE giftWrapper_id = ? AND is_wrapped = 0");
        $stmt->execute([$giftWrapperId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    /**
     * Get monthly growth percentage for orders handled
     */
    public function getMonthlyGrowth($giftWrapperId)
    {
        // Current month orders
        $stmt1 = $this->pdo->prepare("SELECT COUNT(*) as total FROM orders WHERE giftWrapper_id = ? AND MONTH(deliveryDate) = MONTH(CURRENT_DATE()) AND YEAR(deliveryDate) = YEAR(CURRENT_DATE())");
        $stmt1->execute([$giftWrapperId]);
        $currentMonth = $stmt1->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

        // Previous month orders
        $stmt2 = $this->pdo->prepare("SELECT COUNT(*) as total FROM orders WHERE giftWrapper_id = ? AND MONTH(deliveryDate) = MONTH(CURRENT_DATE() - INTERVAL 1 MONTH) AND YEAR(deliveryDate) = YEAR(CURRENT_DATE() - INTERVAL 1 MONTH)");
        $stmt2->execute([$giftWrapperId]);
        $previousMonth = $stmt2->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

        if ($previousMonth == 0) {
            return $currentMonth > 0 ? 100.0 : 0.0;
        }
        return round((($currentMonth - $previousMonth) / $previousMonth) * 100, 1);
    }

    /**
     * Get customer retention rate (returning customers for this wrapper)
     */
    public function getCustomerRetention($giftWrapperId)
    {
        // Count customers with more than one order with this wrapper
        $stmt1 = $this->pdo->prepare("SELECT COUNT(*) as cnt FROM (SELECT client_id FROM orders WHERE giftWrapper_id = ? GROUP BY client_id HAVING COUNT(*) > 1) as returning_clients");
        $stmt1->execute([$giftWrapperId]);
        $returningCustomers = $stmt1->fetch(PDO::FETCH_ASSOC)['cnt'] ?? 0;

        // Total unique customers for this wrapper
        $stmt2 = $this->pdo->prepare("SELECT COUNT(DISTINCT client_id) as total FROM orders WHERE giftWrapper_id = ?");
        $stmt2->execute([$giftWrapperId]);
        $totalCustomers = $stmt2->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;

        if ($totalCustomers == 0) {
            return 0;
        }
        return round(($returningCustomers / $totalCustomers) * 100);
    }

    /**
     * Get efficiency score (completed orders / total assigned orders * 100)
     */
    public function getEfficiencyScore($giftWrapperId)
    {
        $total = $this->getTotalOrdersHandled($giftWrapperId);
        $completed = $this->getCompletedOrders($giftWrapperId);
        
        if ($total == 0) {
            return 0;
        }
        return round(($completed / $total) * 100);
    }

    /**
     * Get orders by month for charts (last 6 months)
     */
    public function getOrdersByMonth($giftWrapperId)
    {
        $stmt = $this->pdo->prepare("
            SELECT 
                DATE_FORMAT(deliveryDate, '%Y-%m') as month,
                DATE_FORMAT(deliveryDate, '%M') as month_name,
                COUNT(*) as total_orders,
                SUM(CASE WHEN is_wrapped = 1 THEN 1 ELSE 0 END) as completed,
                SUM(CASE WHEN is_wrapped = 0 THEN 1 ELSE 0 END) as pending
            FROM orders
            WHERE giftWrapper_id = ? AND deliveryDate >= DATE_SUB(CURRENT_DATE(), INTERVAL 6 MONTH)
            GROUP BY DATE_FORMAT(deliveryDate, '%Y-%m'), DATE_FORMAT(deliveryDate, '%M')
            ORDER BY month ASC
        ");
        $stmt->execute([$giftWrapperId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Get orders count by hour (to find peak hours)
     */
    public function getPeakHours($giftWrapperId)
    {
        // Since we don't have time in deliveryDate, return a default
        // In production, you would query by hour if time data exists
        return "2-6 PM";
    }

    /**
     * Get average rating if available (placeholder for now)
     */
    public function getAverageRating($giftWrapperId)
    {
        // Placeholder - would need a ratings table
        return 4.8;
    }

}


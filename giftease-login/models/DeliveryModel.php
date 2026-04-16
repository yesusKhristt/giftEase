<?php
// DeliveryModel.php***

class DeliveryModel
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

    public function getAllOrders()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE is_delivered = 0 AND is_wrapped = 1 AND delivery_id IS NULL");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAssignedOrders($id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT orders.id, client_id, deliveryDate, is_delivered, delivery_id, deliveryPrice, deliveryAddress, clients.first_name, clients.last_name FROM orders JOIN clients ON orders.client_id = clients.id WHERE is_delivered = 0 AND is_wrapped = 1 AND delivery_id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function acceptOrder($orderId, $deliveryId)
    {
        $stmt = $this->pdo->prepare("UPDATE `orders` SET delivery_id = ? WHERE `id` = ?");
        $stmt->execute([$deliveryId, $orderId]);
    }
    public function verifyUser($user_id)
    {
        $sql  = "UPDATE delivery SET verified = 1 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }

    public function unverifyUser($user_id)
    {
        $sql  = "UPDATE delivery SET verified = 0 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }

    public function markComplete($orderId)
    {
        $stmt = $this->pdo->prepare("UPDATE `orders` SET is_delivered = 1, delivered_at = COALESCE(delivered_at, NOW()) WHERE `id` = ?");
        $stmt->execute([$orderId]);
    }

    public function cancelOrder($orderId)
    {
        $stmt = $this->pdo->prepare("UPDATE `orders` SET delivery_id = null WHERE `id` = ?");
        $stmt->execute([$orderId]);
    }

    public function createTableIfNotExists()
    {
        $sql1 = "CREATE TABLE IF NOT EXISTS delivery (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            status ENUM('active', 'inactive') DEFAULT 'active',
            address VARCHAR(255),
            vehiclePlate VARCHAR(20),
            vehicleType VARCHAR(50),
            phone VARCHAR(10),
            image_loc VARCHAR(500) DEFAULT NULL,
            verified BOOL DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

        $sql2 = "CREATE TABLE IF NOT EXISTS deliveryVerify (
            id INT AUTO_INCREMENT PRIMARY KEY,
            delivery_id INT NOT NULL,
            identity_doc VARCHAR(500) DEFAULT NULL,
            driving_license VARCHAR(500) DEFAULT NULL,
            vehicle_registration VARCHAR(500) DEFAULT NULL,
            vehicle_insurance VARCHAR(500) DEFAULT NULL,
            FOREIGN KEY (delivery_id) REFERENCES delivery(id) ON DELETE CASCADE
        );";

        try {
            $this->pdo->exec($sql1);
            $this->pdo->exec($sql2);
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function authenticate($email, $password, $type, &$error)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM delivery WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password']) && $type == 'delivery') {
            if (!$user['verified']) {
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
        $stmt = $this->pdo->prepare("SELECT * FROM delivery WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getDeliveryById($id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT d.*, dv.identity_doc, dv.driving_license, dv.vehicle_registration, dv.vehicle_insurance
             FROM delivery d
             LEFT JOIN deliveryVerify dv ON d.id = dv.delivery_id
             WHERE d.id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO delivery(first_name, last_name, email, password, vehicleType, vehiclePlate, phone, image_loc, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
            $data['vehicleType'] ?? null,
            $data['vehiclePlate'],
            $data['phone'],
            $data['imageloc'],
            $data['address']
        ]);
        $id =  $this->pdo->lastInsertId();
        $stmt = $this->pdo->prepare("INSERT INTO deliveryVerify (delivery_id, identity_doc, driving_license, vehicle_registration, vehicle_insurance) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $id,
            $data['identity_doc'] ?? null,
            $data['driving_license'] ?? null,
            $data['vehicle_registration'] ?? null,
            $data['vehicle_insurance'] ?? null
        ]);
    }

    public function updateUser($data)
    {
        $stmt = $this->pdo->prepare("UPDATE delivery SET first_name = ?, last_name = ?, vehiclePlate = ?, phone = ?, address = ? WHERE id = ?");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['vehiclePlate'],
            $data['phone'],
            $data['address'],
            $data['id'],
        ]);
    }

    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare("UPDATE delivery SET status = 'inactive' WHERE id = ?");
        $stmt->execute($id);
    }

    public function getAllDelivery()
    {
        $stmt = $this->getpdo()->prepare("SELECT * FROM delivery");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getDeliveryHistory($deliveryId, $filters = [])
    {
        $sql = "SELECT 
            o.id,
            o.deliveryDate,
            o.is_delivered,
            o.deliveryPrice,
            c.first_name,
            c.last_name,
            GROUP_CONCAT(p.name SEPARATOR ', ') as product_names
        FROM orders o
        JOIN clients c ON o.client_id = c.id
        LEFT JOIN orderItems oi ON o.id = oi.order_id
        LEFT JOIN products p ON oi.item_id = p.id
        WHERE o.delivery_id = ?";

        $params = [$deliveryId];

        // Add date filters
        if (!empty($filters['dateFrom'])) {
            $sql .= " AND o.deliveryDate >= ?";
            $params[] = $filters['dateFrom'];
        }

        if (!empty($filters['dateTo'])) {
            $sql .= " AND o.deliveryDate <= ?";
            $params[] = $filters['dateTo'];
        }

        // Add customer name filter
        if (!empty($filters['customer'])) {
            $sql .= " AND (c.first_name LIKE ? OR c.last_name LIKE ?)";
            $searchTerm = '%' . $filters['customer'] . '%';
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }

        $sql .= " GROUP BY o.id, o.deliveryDate, o.is_delivered, o.deliveryPrice, c.first_name, c.last_name";
        $sql .= " ORDER BY o.is_delivered DESC, COALESCE(o.delivered_at, o.deliveryDate) DESC, o.id DESC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDashboardStats($deliveryId)
    {
        $sql = "SELECT
                    COUNT(*) AS assigned_total,
                    SUM(CASE WHEN is_delivered = 0 THEN 1 ELSE 0 END) AS pending_total,
                    SUM(CASE WHEN is_delivered = 1 THEN 1 ELSE 0 END) AS delivered_total,
                    SUM(CASE WHEN is_delivered = 1
                        AND COALESCE(delivered_at, STR_TO_DATE(CONCAT(deliveryDate, ' 00:00:00'), '%Y-%m-%d %H:%i:%s')) >= CURDATE()
                        AND COALESCE(delivered_at, STR_TO_DATE(CONCAT(deliveryDate, ' 00:00:00'), '%Y-%m-%d %H:%i:%s')) < DATE_ADD(CURDATE(), INTERVAL 1 DAY)
                        THEN 1 ELSE 0 END) AS deliveries_today,
                    SUM(CASE WHEN is_delivered = 1
                        AND COALESCE(delivered_at, STR_TO_DATE(CONCAT(deliveryDate, ' 00:00:00'), '%Y-%m-%d %H:%i:%s'))
                            BETWEEN DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND DATE_ADD(CURDATE(), INTERVAL 1 DAY)
                        THEN deliveryPrice ELSE 0 END) AS weekly_earnings
                FROM orders
                WHERE delivery_id = ? AND is_wrapped = 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$deliveryId]);
        $stats = $stmt->fetch(PDO::FETCH_ASSOC);

        return [
            'assigned_total' => (int)($stats['assigned_total'] ?? 0),
            'pending_total' => (int)($stats['pending_total'] ?? 0),
            'delivered_total' => (int)($stats['delivered_total'] ?? 0),
            'deliveries_today' => (int)($stats['deliveries_today'] ?? 0),
            'weekly_earnings' => (float)($stats['weekly_earnings'] ?? 0),
        ];
    }

    public function getLastMonthAnalytics($deliveryId)
    {
        $sql = "SELECT
                    SUM(CASE WHEN is_wrapped = 1
                        AND normalized_date BETWEEN DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 1 MONTH), '%Y-%m-01')
                                                AND LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))
                        THEN 1 ELSE 0 END) AS assigned_last_month,

                    SUM(CASE WHEN is_wrapped = 1 AND is_delivered = 1
                        AND normalized_date BETWEEN DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 1 MONTH), '%Y-%m-01')
                                                AND LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))
                        THEN 1 ELSE 0 END) AS delivered_last_month,

                    SUM(CASE WHEN is_wrapped = 1 AND is_delivered = 0
                        AND normalized_date BETWEEN DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 1 MONTH), '%Y-%m-01')
                                                AND LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))
                        THEN 1 ELSE 0 END) AS pending_last_month,

                    SUM(CASE WHEN is_wrapped = 1 AND is_delivered = 1
                        AND normalized_date BETWEEN DATE_FORMAT(DATE_SUB(CURDATE(), INTERVAL 1 MONTH), '%Y-%m-01')
                                                AND LAST_DAY(DATE_SUB(CURDATE(), INTERVAL 1 MONTH))
                        THEN deliveryPrice ELSE 0 END) AS earnings_last_month
                FROM (
                    SELECT
                        is_wrapped,
                        is_delivered,
                        deliveryPrice,
                        COALESCE(
                            STR_TO_DATE(deliveryDate, '%Y-%m-%d'),
                            STR_TO_DATE(deliveryDate, '%Y-%m-%d %H:%i:%s'),
                            STR_TO_DATE(deliveryDate, '%Y-%m-%dT%H:%i'),
                            STR_TO_DATE(deliveryDate, '%m/%d/%Y'),
                            STR_TO_DATE(deliveryDate, '%d/%m/%Y'),
                            DATE(deliveryDate)
                        ) AS normalized_date
                    FROM orders
                    WHERE delivery_id = ?
                ) AS delivery_data";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$deliveryId]);
        $stats = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];

        $assigned = (int)($stats['assigned_last_month'] ?? 0);
        $delivered = (int)($stats['delivered_last_month'] ?? 0);
        $pending = (int)($stats['pending_last_month'] ?? 0);
        $earnings = (float)($stats['earnings_last_month'] ?? 0);

        $completionRate = $assigned > 0 ? round(($delivered / $assigned) * 100, 1) : 0;
        $avgPerDelivery = $delivered > 0 ? round(($earnings / $delivered), 2) : 0;

        return [
            'month_label' => date('F Y', strtotime('first day of last month')),
            'assigned_last_month' => $assigned,
            'delivered_last_month' => $delivered,
            'pending_last_month' => $pending,
            'earnings_last_month' => $earnings,
            'avg_per_delivery' => $avgPerDelivery,
            'completion_rate' => $completionRate,
        ];
    }

    public function getLastMonthTrend($deliveryId)
    {
        $sql = "SELECT
                    DATE(completed_date) AS normalized_date,
                    COUNT(*) AS delivered_count,
                    SUM(deliveryPrice) AS earnings
                FROM (
                    SELECT
                        deliveryPrice,
                        COALESCE(
                            delivered_at,
                            STR_TO_DATE(deliveryDate, '%Y-%m-%d'),
                            STR_TO_DATE(deliveryDate, '%Y-%m-%d %H:%i:%s'),
                            STR_TO_DATE(deliveryDate, '%Y-%m-%dT%H:%i'),
                            STR_TO_DATE(deliveryDate, '%m/%d/%Y'),
                            STR_TO_DATE(deliveryDate, '%d/%m/%Y'),
                            DATE(deliveryDate)
                        ) AS completed_date
                    FROM orders
                    WHERE delivery_id = ? AND is_wrapped = 1 AND is_delivered = 1
                ) AS trend_data
                WHERE completed_date >= DATE_SUB(CURDATE(), INTERVAL 29 DAY)
                  AND completed_date < DATE_ADD(CURDATE(), INTERVAL 1 DAY)
                GROUP BY DATE(completed_date)
                ORDER BY normalized_date ASC";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$deliveryId]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $byDay = [];
        foreach ($rows as $row) {
            if (empty($row['normalized_date'])) {
                continue;
            }
            $dayKey = date('Y-m-d', strtotime($row['normalized_date']));
            $byDay[$dayKey] = [
                'delivered' => (int)($row['delivered_count'] ?? 0),
                'earnings' => (float)($row['earnings'] ?? 0),
            ];
        }

        $start = new DateTime('-29 days');
        $start->setTime(0, 0, 0);
        $end = new DateTime('today');
        $end->modify('+1 day');

        $period = new DatePeriod($start, new DateInterval('P1D'), $end);

        $labels = [];
        $delivered = [];
        $earnings = [];

        foreach ($period as $date) {
            $dayKey = $date->format('Y-m-d');
            $labels[] = $date->format('M d');
            $delivered[] = $byDay[$dayKey]['delivered'] ?? 0;
            $earnings[] = round($byDay[$dayKey]['earnings'] ?? 0, 2);
        }

        return [
            'labels' => $labels,
            'delivered' => $delivered,
            'earnings' => $earnings,
        ];
    }

    public function getProfileStats($deliveryId)
    {
        $sql = "SELECT
                    COUNT(*) AS assigned_total,
                    SUM(CASE WHEN is_delivered = 1 THEN 1 ELSE 0 END) AS delivered_total,
                    SUM(CASE WHEN is_delivered = 1 THEN deliveryPrice ELSE 0 END) AS total_earnings
                FROM orders
                WHERE delivery_id = ? AND is_wrapped = 1";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$deliveryId]);
        $stats = $stmt->fetch(PDO::FETCH_ASSOC);

        $assigned = (int)($stats['assigned_total'] ?? 0);
        $delivered = (int)($stats['delivered_total'] ?? 0);
        $successRate = $assigned > 0 ? round(($delivered / $assigned) * 100, 1) : 0;

        return [
            'assigned_total' => $assigned,
            'delivered_total' => $delivered,
            'total_earnings' => (float)($stats['total_earnings'] ?? 0),
            'success_rate' => $successRate,
            'avg_rating' => null,
            'distance' => null,
        ];
    }

    private function addColumnIfNotExists($table, $column, $definition)
    {
        try {
            $stmt = $this->pdo->query("SHOW COLUMNS FROM `$table` LIKE '$column'");
            if ($stmt->rowCount() == 0) {
                $this->pdo->exec("ALTER TABLE `$table` ADD COLUMN `$column` $definition");
            }
        } catch (PDOException $e) {
            // Ignore if table not ready
        }
    }

    private function ensureOrdersDeliveredAtColumn()
    {
        try {
            $this->pdo->exec("ALTER TABLE orders ADD COLUMN delivered_at TIMESTAMP NULL DEFAULT NULL");
        } catch (PDOException $e) {
            // Ignore if the column already exists or table not available yet
        }

        try {
            $this->pdo->exec("UPDATE orders SET delivered_at = deliveryDate WHERE is_delivered = 1 AND delivered_at IS NULL");
        } catch (PDOException $e) {
            // Ignore backfill errors
        }
    }
}

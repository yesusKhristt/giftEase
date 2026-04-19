<?php
// DeliveryModel.php***

class DeliverymanModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->createTableIfNotExists(); // Create the table if not there
        $this->createPickupTaskTableIfNotExists();
    }

    public function getpdo() {
        return $this->pdo;
    }

    public function createTableIfNotExists() {
        $sql1 = "CREATE TABLE IF NOT EXISTS deliveryman (
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

        $sql2 = "CREATE TABLE IF NOT EXISTS deliverymanVerify (
            id INT AUTO_INCREMENT PRIMARY KEY,
            deliveryman_id INT NOT NULL,
            identity_doc VARCHAR(500) DEFAULT NULL,
            driving_license VARCHAR(500) DEFAULT NULL,
            vehicle_registration VARCHAR(500) DEFAULT NULL,
            vehicle_insurance VARCHAR(500) DEFAULT NULL,
            FOREIGN KEY (deliveryman_id) REFERENCES deliveryman(id) ON DELETE CASCADE
        );";

        try {
            $this->pdo->exec($sql1);
            $this->pdo->exec($sql2);
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function getProfileStats($deliverymanId) {
        $this->syncPickupTasksFromOrders();

        $stmt = $this->pdo->prepare(
            "SELECT
                COUNT(*) AS total_tasks,
                SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) AS completed_total,
                SUM(CASE WHEN status IN ('assigned', 'picked_up', 'at_outlet') THEN 1 ELSE 0 END) AS active_total,
                SUM(CASE WHEN status = 'cancelled' THEN 1 ELSE 0 END) AS cancelled_total
             FROM pickupTasks
             WHERE deliveryman_id = ?"
        );
        $stmt->execute([$deliverymanId]);
        $stats = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];

        $totalTasks = (int)($stats['total_tasks'] ?? 0);
        $completedTotal = (int)($stats['completed_total'] ?? 0);

        return [
            'total_tasks' => $totalTasks,
            'assigned_total' => $totalTasks,
            'completed_total' => $completedTotal,
            'delivered_total' => $completedTotal,
            'active_total' => (int)($stats['active_total'] ?? 0),
            'cancelled_total' => (int)($stats['cancelled_total'] ?? 0),
            'success_rate' => $totalTasks > 0 ? round(($completedTotal / $totalTasks) * 100, 1) : 0,
            'total_earnings' => 0,
            'distance' => null,
        ];
    }

    public function verifyUser($user_id) {
        $sql  = "UPDATE deliveryman SET verified = 1 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }

    public function unverifyUser($user_id) {
        $sql  = "UPDATE deliveryman SET verified = 0 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }

    public function authenticate($email, $password, $type, &$error) {
        $stmt = $this->pdo->prepare("SELECT * FROM deliveryman WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['status'] === 'active' && password_verify($password, $user['password']) && $type == 'deliveryman') {
            if (!$user['verified']) {
                $error = "User Not verified";
                return null;
            }
            if ($user && $user['status'] !== 'active') {
                $error = "Account is inactive";
                return null;
            }
            return $user;
        }
        $error = "Invalid Username or Password";

        return null;
    }

    public function updateProfilePicture($id, $profilePicPath) {
        $stmt = $this->pdo->prepare("UPDATE deliveryman SET image_loc = ? WHERE id = ?");
        return $stmt->execute([
            $profilePicPath,
            $id
        ]);
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM deliveryman WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->pdo->prepare(
            "SELECT d.*, dv.identity_doc, dv.driving_license, dv.vehicle_registration, dv.vehicle_insurance
             FROM deliveryman d
             LEFT JOIN deliverymanVerify dv ON dv.deliveryman_id = d.id
             WHERE d.id = ?
             LIMIT 1"
        );
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($data) {
        $stmt = $this->pdo->prepare("INSERT INTO deliveryman (first_name, last_name, email, password, vehicleType, vehiclePlate, phone, image_loc, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
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
        $stmt = $this->pdo->prepare("INSERT INTO deliverymanVerify (deliveryman_id, identity_doc, driving_license, vehicle_registration, vehicle_insurance) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $id,
            $data['identity_doc'] ?? null,
            $data['driving_license'] ?? null,
            $data['vehicle_registration'] ?? null,
            $data['vehicle_insurance'] ?? null
        ]);
    }

    public function updateUser($data) {
        $stmt = $this->pdo->prepare("UPDATE deliveryman SET first_name = ?, last_name = ?, vehiclePlate = ?, phone = ?, address = ? WHERE id = ?");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['vehiclePlate'],
            $data['phone'],
            $data['address'],
            $data['id'],
        ]);
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("UPDATE deliveryman SET status = 'inactive' WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function getAllDeliveryMan() {
        $stmt = $this->pdo->prepare("SELECT * FROM deliveryman");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPickupTaskTableIfNotExists() {
        $sql = "CREATE TABLE IF NOT EXISTS pickupTasks (
            id INT AUTO_INCREMENT PRIMARY KEY,
            order_id INT NOT NULL,
            vendor_id INT NOT NULL,
            deliveryman_id INT DEFAULT NULL,
            status ENUM('pending_assignment', 'assigned', 'picked_up', 'at_outlet', 'completed', 'cancelled') DEFAULT 'pending_assignment',
            assigned_at TIMESTAMP NULL DEFAULT NULL,
            picked_up_at TIMESTAMP NULL DEFAULT NULL,
            at_outlet_at TIMESTAMP NULL DEFAULT NULL,
            completed_at TIMESTAMP NULL DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            UNIQUE KEY uq_order_vendor (order_id, vendor_id),
            FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
            FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
            FOREIGN KEY (deliveryman_id) REFERENCES deliveryman(id) ON DELETE SET NULL
        );";

        try {
            $this->pdo->exec($sql);
        } catch (PDOException $e) {
            // Ignore setup failure until dependent tables are available.
        }
    }

    public function syncPickupTasksFromOrders() {
        $sql = "
            INSERT INTO pickupTasks (order_id, vendor_id)
            SELECT DISTINCT o.id, p.vendor_id
            FROM orders o
            JOIN orderItems oi ON oi.order_id = o.id
            JOIN products p ON p.id = oi.item_id
            LEFT JOIN pickupTasks pt ON pt.order_id = o.id AND pt.vendor_id = p.vendor_id
            WHERE o.is_wrapped = 0
              AND o.is_delivered = 0
              AND pt.id IS NULL
        ";

        try {
            $this->pdo->exec($sql);
        } catch (PDOException $e) {
            // Ignore sync failure if required tables are not yet ready.
        }
    }

    public function getDashboardStats($deliverymanId) {
        $this->syncPickupTasksFromOrders();

        $stmt = $this->pdo->prepare(
            "SELECT
                SUM(CASE WHEN status = 'pending_assignment' THEN 1 ELSE 0 END) AS available_total,
                SUM(CASE WHEN deliveryman_id = ? AND status IN ('assigned', 'picked_up', 'at_outlet') THEN 1 ELSE 0 END) AS my_active_total,
                SUM(CASE WHEN deliveryman_id = ? AND status = 'completed' THEN 1 ELSE 0 END) AS my_completed_total,
                SUM(CASE WHEN deliveryman_id = ? AND status = 'picked_up' THEN 1 ELSE 0 END) AS picked_up_total
             FROM pickupTasks"
        );
        $stmt->execute([$deliverymanId, $deliverymanId, $deliverymanId]);
        $stats = $stmt->fetch(PDO::FETCH_ASSOC) ?: [];

        return [
            'available_total' => (int)($stats['available_total'] ?? 0),
            'my_active_total' => (int)($stats['my_active_total'] ?? 0),
            'my_completed_total' => (int)($stats['my_completed_total'] ?? 0),
            'picked_up_total' => (int)($stats['picked_up_total'] ?? 0),
        ];
    }

    public function getAvailablePickupTasks() {
        $this->syncPickupTasksFromOrders();

        $stmt = $this->pdo->prepare(
            "SELECT
                pt.id,
                pt.order_id,
                pt.status,
                o.deliveryDate,
                c.first_name AS client_first_name,
                c.last_name AS client_last_name,
                v.shopName,
                v.address AS vendor_address,
                v.phone AS vendor_phone,
                GROUP_CONCAT(DISTINCT p.name ORDER BY p.name SEPARATOR ', ') AS products,
                SUM(oi.quantity) AS total_quantity
             FROM pickupTasks pt
             JOIN orders o ON o.id = pt.order_id
             JOIN clients c ON c.id = o.client_id
             JOIN vendors v ON v.id = pt.vendor_id
             LEFT JOIN orderItems oi ON oi.order_id = o.id
             LEFT JOIN products p ON p.id = oi.item_id AND p.vendor_id = pt.vendor_id
             WHERE pt.status = 'pending_assignment' AND pt.deliveryman_id IS NULL
             GROUP BY pt.id, pt.order_id, pt.status, o.deliveryDate, c.first_name, c.last_name, v.shopName, v.address, v.phone
             ORDER BY o.deliveryDate ASC, pt.id ASC"
        );
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMyPickupTasks($deliverymanId) {
        $this->syncPickupTasksFromOrders();

        $stmt = $this->pdo->prepare(
            "SELECT
                pt.id,
                pt.order_id,
                pt.status,
                pt.assigned_at,
                pt.picked_up_at,
                pt.at_outlet_at,
                pt.completed_at,
                o.deliveryDate,
                c.first_name AS client_first_name,
                c.last_name AS client_last_name,
                v.shopName,
                v.address AS vendor_address,
                v.phone AS vendor_phone,
                GROUP_CONCAT(DISTINCT p.name ORDER BY p.name SEPARATOR ', ') AS products,
                SUM(oi.quantity) AS total_quantity
             FROM pickupTasks pt
             JOIN orders o ON o.id = pt.order_id
             JOIN clients c ON c.id = o.client_id
             JOIN vendors v ON v.id = pt.vendor_id
             LEFT JOIN orderItems oi ON oi.order_id = o.id
             LEFT JOIN products p ON p.id = oi.item_id AND p.vendor_id = pt.vendor_id
             WHERE pt.deliveryman_id = ?
               GROUP BY pt.id, pt.order_id, pt.status, pt.assigned_at, pt.picked_up_at, pt.at_outlet_at, pt.completed_at, o.deliveryDate, c.first_name, c.last_name, v.shopName, v.address, v.phone
             ORDER BY FIELD(pt.status, 'assigned', 'picked_up', 'at_outlet', 'completed', 'cancelled'), o.deliveryDate ASC, pt.id ASC"
        );
        $stmt->execute([$deliverymanId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function acceptPickupTask($taskId, $deliverymanId) {
        $stmt = $this->pdo->prepare(
            "UPDATE pickupTasks
             SET deliveryman_id = ?, status = 'assigned', assigned_at = NOW()
             WHERE id = ? AND deliveryman_id IS NULL AND status = 'pending_assignment'"
        );
        $stmt->execute([$deliverymanId, $taskId]);
        return $stmt->rowCount() > 0;
    }

    public function updatePickupTaskStatus($taskId, $deliverymanId, $status) {
        $statusMap = [
            'picked_up' => 'picked_up_at',
            'at_outlet' => 'at_outlet_at',
            'completed' => 'completed_at',
        ];

        if (!isset($statusMap[$status])) {
            return false;
        }

        $timeColumn = $statusMap[$status];
        $stmt = $this->pdo->prepare(
            "UPDATE pickupTasks
             SET status = ?, {$timeColumn} = NOW()
             WHERE id = ? AND deliveryman_id = ?"
        );
        $stmt->execute([$status, $taskId, $deliverymanId]);
        return $stmt->rowCount() > 0;
    }

    public function cancelPickupTask($taskId, $deliverymanId) {
        $stmt = $this->pdo->prepare(
            "UPDATE pickupTasks
             SET deliveryman_id = NULL,
                 status = 'pending_assignment',
                 assigned_at = NULL,
                 picked_up_at = NULL,
                 at_outlet_at = NULL
             WHERE id = ?
               AND deliveryman_id = ?
               AND status = 'assigned'"
        );
        $stmt->execute([$taskId, $deliverymanId]);
        return $stmt->rowCount() > 0;
    }
}

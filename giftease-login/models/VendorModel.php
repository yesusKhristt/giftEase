<?php
class VendorModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->createTableIfNotExists(); // Create the table if not there
    }

    public function getpdo() {
        return $this->pdo;
    }

    public function createTableIfNotExists() {
        $sql1 = "CREATE TABLE IF NOT EXISTS vendors (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            status ENUM('active', 'inactive') DEFAULT 'active',
            address VARCHAR(255),
            shopName VARCHAR(50),
            phone VARCHAR(10),
            image_loc VARCHAR(500) DEFAULT NULL,
            rating FLOAT DEFAULT 0,
            rating_count INT DEFAULT 0,
            verified BOOL DEFAULT 0,
            accountBalance int DEFAULT 0,
            pendingBalance int DEFAULT 0,
            bankName VARCHAR(50) DEFAULT NULL,
            accountNumber VARCHAR(50) DEFAULT NULL,
            accountName VARCHAR(50) DEFAULT NULL,
            bankBranch VARCHAR(50) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";
        $sql2 = "CREATE TABLE IF NOT EXISTS vendorVerify (
            id INT AUTO_INCREMENT PRIMARY KEY,
            vendor_id INT NOT NULL,
            identity_doc VARCHAR(500) DEFAULT NULL,
            business_cert VARCHAR(500) DEFAULT NULL,
            tin_doc VARCHAR(500) DEFAULT NULL,
            address_proof VARCHAR(500) DEFAULT NULL,
            bank_details VARCHAR(500) DEFAULT NULL,
            FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE
        );";

        try {
            $this->pdo->exec($sql1);
            $this->pdo->exec($sql2);
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function getVendorsOnOrder($orderID) {
        $stmt = $this->pdo->prepare("
                SELECT 
                v.id AS vendor_id,
                p.price,
                oi.quantity

            FROM orderItems oi

            JOIN products p 
                ON oi.item_id = p.id

            JOIN vendors v 
                ON p.vendor_id = v.id

            WHERE oi.order_id = ?;
        ");
        $stmt->execute([$orderID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addToBalance($id, $price) {
        $currAccountBalance = $this->getAccountBalance($id);
        $this->setAccountBalance($id, $currAccountBalance + $price);
    }

    public function getAccountBalance($id) {
        $stmt = $this->pdo->prepare("SELECT accountBalance FROM vendors WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function getPendingBalance($id) {
        $stmt = $this->pdo->prepare("SELECT pendingBalance FROM vendors WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function setAccountBalance($id, $amount) {
        $stmt = $this->pdo->prepare("UPDATE vendors SET accountBalance = ? WHERE id = ?");
        $stmt->execute([$amount, $id]);
    }

    public function setPendingBalance($id, $amount) {
        $stmt = $this->pdo->prepare("UPDATE vendors SET pendingBalance = ? WHERE id = ?");
        $stmt->execute([$amount, $id]);
    }

    public function withdrawMoney($id, $amount) {
        $currAccountBalance = $this->getAccountBalance($id);
        $currPendingBalance = $this->getPendingBalance($id);
        $this->setAccountBalance($id, $currAccountBalance - $amount);
        $this->setPendingBalance($id, $currPendingBalance + $amount);
    }

    public function approveWithdraw($id, $amount) {
        $currPendingBalance = $this->getPendingBalance($id);
        $this->setPendingBalance($id, $currPendingBalance - $amount);
    }

    public function rejectWithdraw($id, $amount) {
        $currAccountBalance = $this->getAccountBalance($id);
        $currPendingBalance = $this->getPendingBalance($id);
        $this->setAccountBalance($id, $currAccountBalance + $amount);
        $this->setPendingBalance($id, $currPendingBalance - $amount);
    }

    public function confirmWithdrawal($id) {
        $stmt = $this->pdo->prepare("UPDATE vendors SET pendingBalance = 0 WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function verifyUser($user_id) {
        $sql  = "UPDATE vendors SET verified = 1 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }
    public function unverifyUser($user_id) {
        $sql  = "UPDATE vendors SET verified = 0 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }

    public function authenticate($email, $password, $type, &$error) {
        $stmt = $this->pdo->prepare("SELECT * FROM vendors WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password']) && $type == 'vendor') {
            if (!$user['verified']) {
                $error = "User Not verified";
                return null;
            }
            return $user;
        }
        $error = "Invalid Username or Password";
        return null;
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM vendors WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($data) {
        $stmt = $this->pdo->prepare("INSERT INTO vendors (first_name, last_name, email, password, shopName, phone, image_loc, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
            $data['shopName'],
            $data['phone'],
            $data['imageloc'],
            $data['address'],
        ]);
        $id =  $this->pdo->lastInsertId();
        $stmt = $this->pdo->prepare("INSERT INTO vendorVerify (vendor_id, identity_doc, business_cert, tin_doc, address_proof, bank_details) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $id,
            $data['identity_doc'],
            $data['business_cert'],
            $data['tin_doc'],
            $data['address_proof'],
            $data['bank_details']
        ]);
    }

    public function updateUser($data) {
        $stmt = $this->pdo->prepare("UPDATE vendors SET first_name = ?, last_name = ?, shopName = ?, phone = ?, address = ? WHERE id = ?");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['shopName'],
            $data['phone'],
            $data['address'],
            $data['id']
        ]);
    }

    public function saveBank($id, $bank_details) {
        $stmt = $this->pdo->prepare("UPDATE vendors SET bankName = ?, accountNumber = ?, accountName = ?, bankBranch = ? WHERE id = ?");
        return $stmt->execute([
            $bank_details['bank_name'],
            $bank_details['account_holder'],
            $bank_details['account_name'],
            $bank_details['branch'],
            $id
        ]);
    }

    public function getBank($id) {
        $stmt = $this->pdo->prepare("SELECT bankName, accountNumber, accountName, bankBranch FROM vendors WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("UPDATE vendors SET status = 'inactive' WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function updateProfilePicture($vendor_id, $profilePicPath) {
        $stmt = $this->pdo->prepare("UPDATE vendors SET image_loc = ? WHERE id = ?");
        return $stmt->execute([
            $profilePicPath,
            $vendor_id
        ]);
    }

    public function getUserByID($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM vendors WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function getAllOrderByVendor($vendor_id){
        $stmt = $this->pdo->prepare("
        SELECT 
        p.*, 
        oi.quantity AS quantity,
        oi.order_id AS order_id,
        CONCAT(c.first_name, ' ', c.last_name) AS client_name,
        c.email AS client_email,
        o.is_delivered AS is_delivered,
        (oi.quantity * p.price) AS vendor_total
        FROM orderItems oi
        JOIN products p ON oi.item_id = p.id
        JOIN orders o ON o.id = oi.order_id
        JOIN clients c ON c.id = o.client_id
        WHERE p.vendor_id = ?");
        $stmt->execute([$vendor_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAnalysisStats(int $vendorId, string $range = 'month'): array {
        $stats = [
            'itemsSold' => 0,
            'clientInteractions' => 0,
            'repeatClients' => 0,
            'lowStock' => 0,
        ];

        $startDate = $this->resolveStartDateForRange($range);

        try {
            $dateClause = '';
            $params = [$vendorId];
            if ($startDate !== null) {
                $dateClause = ' AND o.deliveryDate >= ?';
                $params[] = $startDate;
            }

            $stmt1 = $this->pdo->prepare(
                "SELECT COALESCE(SUM(oi.quantity), 0)
                 FROM orderItems oi
                 JOIN products p ON p.id = oi.item_id
                 JOIN orders o ON o.id = oi.order_id
                 WHERE p.vendor_id = ?
                   AND o.is_delivered = 1" . $dateClause
            );
            $stmt1->execute($params);
            $stats['itemsSold'] = (int) $stmt1->fetchColumn();

            $msgParams = [$vendorId];
            $msgDateClause = '';
            if ($startDate !== null) {
                $msgDateClause = ' AND m.created_at >= ?';
                $msgParams[] = $startDate . ' 00:00:00';
            }

            $stmt2 = $this->pdo->prepare(
                "SELECT COUNT(*)
                 FROM messeges m
                 WHERE m.vendor_id = ?" . $msgDateClause
            );
            $stmt2->execute($msgParams);
            $stats['clientInteractions'] = (int) $stmt2->fetchColumn();

            $stmt3 = $this->pdo->prepare(
                "SELECT COUNT(*)
                 FROM (
                    SELECT o.client_id
                    FROM orders o
                    JOIN orderItems oi ON oi.order_id = o.id
                    JOIN products p ON p.id = oi.item_id
                    WHERE p.vendor_id = ?
                      AND o.is_delivered = 1" . $dateClause . "
                    GROUP BY o.client_id
                    HAVING COUNT(DISTINCT o.id) >= 2
                 ) AS repeat_clients"
            );
            $stmt3->execute($params);
            $stats['repeatClients'] = (int) $stmt3->fetchColumn();

            $stmt4 = $this->pdo->prepare(
                "SELECT COUNT(*)
                 FROM products p
                 WHERE p.vendor_id = ?
                   AND p.status = 'active'
                   AND (p.totalStock - p.reservedStock) <= 5"
            );
            $stmt4->execute([$vendorId]);
            $stats['lowStock'] = (int) $stmt4->fetchColumn();
        } catch (PDOException $e) {
            return $stats;
        }

        return $stats;
    }

    public function getSalesTrend(int $vendorId, string $range = 'month'): array {
        $allowedRanges = ['week', 'month', 'year'];
        $range = in_array($range, $allowedRanges, true) ? $range : 'month';

        $startDate = $this->resolveStartDateForRange($range);
        $bucketExpr = "DATE(o.deliveryDate)";
        $labelExpr = "DATE_FORMAT(o.deliveryDate, '%d %b')";

        if ($range === 'week') {
            $labelExpr = "DATE_FORMAT(o.deliveryDate, '%a')";
        }

        if ($range === 'year') {
            $bucketExpr = "DATE_FORMAT(o.deliveryDate, '%Y-%m')";
            $labelExpr = "DATE_FORMAT(o.deliveryDate, '%b')";
        }

        $rows = [];
        try {
            $stmt = $this->pdo->prepare(
                "SELECT " . $bucketExpr . " AS bucket,
                        " . $labelExpr . " AS label,
                        COALESCE(SUM(oi.quantity), 0) AS sold_units
                 FROM orders o
                 JOIN orderItems oi ON oi.order_id = o.id
                 JOIN products p ON p.id = oi.item_id
                 WHERE p.vendor_id = ?
                   AND o.is_delivered = 1
                   AND o.deliveryDate >= ?
                 GROUP BY bucket, label
                 ORDER BY bucket ASC"
            );
            $stmt->execute([$vendorId, $startDate]);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            return [
                'labels' => [],
                'values' => [],
            ];
        }

        $labels = [];
        $values = [];

        foreach ($rows as $row) {
            $labels[] = (string) ($row['label'] ?? '');
            $values[] = (int) ($row['sold_units'] ?? 0);
        }

        return [
            'labels' => $labels,
            'values' => $values,
        ];
    }

    private function resolveStartDateForRange(string $range): ?string {
        $today = new DateTime('today');

        switch ($range) {
            case 'week':
                return $today->modify('-6 days')->format('Y-m-d');
            case 'month':
                return $today->modify('-29 days')->format('Y-m-d');
            case 'year':
                return $today->modify('first day of -11 months')->format('Y-m-d');
            default:
                return null;
        }
    }
}

<?php
class WithdrawModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->createTables(); // Create the table if not there
    }

    public function getpdo() {
        return $this->pdo;
    }

    public function createTables() {
        $vra   = 1;
        $stmt1 = "CREATE TABLE IF NOT EXISTS withdraw (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            admin_id INT DEFAULT NULL,
            vendor_id INT DEFAULT NULL,
            delivery_id INT DEFAULT NULL,
            giftWrapper_id INT DEFAULT NULL,
            amount int NOT NULL,
            status BOOL DEFAULT NULL,
            createdAT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE CASCADE,
            FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
            FOREIGN KEY (delivery_id) REFERENCES delivery(id) ON DELETE CASCADE,
            FOREIGN KEY (giftWrapper_id) REFERENCES giftwrappers(id) ON DELETE CASCADE
        );";

        try {
            $this->pdo->exec($stmt1);
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function requestWithdrawVendor($id, $amount) {
        $stmt1 = $this->pdo->prepare(
            "INSERT INTO withdraw (vendor_id, amount) VALUES (?, ?)"
        );

        $stmt1->execute([
            $id,
            $amount
        ]);
    }

    public function requestWithdrawDelivery($id, $amount) {
        $stmt1 = $this->pdo->prepare(
            "INSERT INTO withdraw (delivery_id, amount) VALUES (?, ?)"
        );

        $stmt1->execute([
            $id,
            $amount
        ]);
    }

    public function requestWithdrawGiftWrapper($id, $amount) {
        $stmt1 = $this->pdo->prepare(
            "INSERT INTO withdraw (giftWrapper_id, amount) VALUES (?, ?)"
        );

        $stmt1->execute([
            $id,
            $amount
        ]);
    }

    public function aproveWithdrawal($id, $adminId) {
        $stmt1 = $this->pdo->prepare(
            "UPDATE withdraw SET admin_id = ?, status = 1 WHERE id = ?"
        );

        $stmt1->execute([
            $adminId,
            $id,
        ]);
    }

    public function rejectWithdrawal($id, $adminId) {
        $stmt1 = $this->pdo->prepare(
            "UPDATE withdraw SET admin_id = ?, status = 0 WHERE id = ?"
        );

        $stmt1->execute([
            $adminId,
            $id,
        ]);
    }

    public function getWithdrawRequestsPending() {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM withdraw WHERE status IS NULL"
        );
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWithdrawRequestsAll() {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM withdraw"
        );
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllWithdraws() {
        $stmt = $this->pdo->prepare(
            "
            SELECT 
            w.*,
            v.first_name AS fName,
            v.last_name AS lName
            FROM withdraw w
            JOIN vendors v ON w.vendor_id = v.id 
            "
        );


        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCOUNTAllWithdraws() {
        $stmt = $this->pdo->prepare(
            "
            SELECT 
            w.*,
            v.first_name AS fName,
            v.last_name AS lName
            FROM withdraw w
            JOIN vendors v ON w.vendor_id = v.id 
            "
        );


        $stmt->execute([]);
        $var = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $users = [[
            'user' => [],
            'count' => []
        ]];

        foreach ($var as &$row1) {
            $count = 0;
            foreach ($users as &$row2) {
                if ($row1['vendor_id'] == $row2['user']) continue;
                $count++;
            }
            unset($row2);
            $row2['user'] = $row1['vendor_id'];
            $row2['count'] = $count;
        }
        unset($row1);
        return $users;
    }

    public function countVendorWithdraws() {

        $stmt = $this->pdo->prepare(
            "
                    SELECT
                        v.id AS vendor_id,
                        v.first_name AS fName,
                        v.last_name AS lName,
                        COUNT(*) AS count

                    FROM withdraw w
                    JOIN vendors v ON w.vendor_id = v.id 
                    WHERE w.vendor_id = 4;"
        );
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $sql;
    }




}

<?php
class MessegesModel {
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
        $stmt1 = "CREATE TABLE IF NOT EXISTS messeges (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            client_id INT NOT NULL,
            vendor_id INT DEFAULT NULL,
            delivery_id INT DEFAULT NULL,
            giftWrapper_id INT DEFAULT NULL,
            messege VARCHAR(255) NOT NULL,
            sent BOOL NOT NULL,
            is_read BOOL DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
            FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
            FOREIGN KEY (delivery_id) REFERENCES delivery(id) ON DELETE CASCADE,
            FOREIGN KEY (giftWrapper_id) REFERENCES giftwrappers(id) ON DELETE CASCADE
        );";

        $stmt2 = "CREATE TABLE IF NOT EXISTS attachments (
            id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
            message_id BIGINT UNSIGNED NOT NULL,
            file_loc VARCHAR(750),
            FOREIGN KEY (message_id) REFERENCES messeges(id)
        )
        ";

        try {
            $this->pdo->exec($stmt1);
            $this->pdo->exec($stmt2);
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function sendGiftWrapperMessege($staff_id, $client_id, $payload, $user) {
        // 1️⃣ Insert message
        $stmt1 = $this->pdo->prepare(
            "INSERT INTO messeges (client_id, giftWrapper_id, messege, sent) VALUES (?, ?, ?, ?)"
        );

        $stmt1->execute([
            $client_id,
            $staff_id,
            $payload['message'],
            $user
        ]);

        $messege_id = $this->pdo->lastInsertId();

        // 2️⃣ Insert attachments (if any)
        if (! empty($payload['attatchments'])) {
            $stmt2 = $this->pdo->prepare(
                "INSERT INTO attachments (message_id, file_loc)VALUES (?, ?)"
            );

            foreach ($payload['attatchments'] as $attatchment) {
                $stmt2->execute([
                    $messege_id,
                    $attatchment,
                ]);
            }
        }
    }

    public function sendDeliveryMessege($staff_id, $client_id, $payload, $user) {
        // 1️⃣ Insert message
        $stmt1 = $this->pdo->prepare(
            "INSERT INTO messeges (client_id, delivery_id, messege, sent) VALUES (?, ?, ?, ?)"
        );

        $stmt1->execute([
            $client_id,
            $staff_id,
            $payload['message'],
            $user
        ]);

        $messege_id = $this->pdo->lastInsertId();

        // 2️⃣ Insert attachments (if any)
        if (! empty($payload['attatchments'])) {
            $stmt2 = $this->pdo->prepare(
                "INSERT INTO attachments (message_id, file_loc)VALUES (?, ?)"
            );

            foreach ($payload['attatchments'] as $attatchment) {
                $stmt2->execute([
                    $messege_id,
                    $attatchment,
                ]);
            }
        }
    }

    public function sendVendorMessege($staff_id, $client_id, $payload, $user) {
        // 1️⃣ Insert message
        $stmt1 = $this->pdo->prepare(
            "INSERT INTO messeges (client_id, vendor_id, messege, sent) VALUES (?, ?, ?, ?)"
        );

        $stmt1->execute([
            $client_id,
            $staff_id,
            $payload['message'],
            $user
        ]);

        $messege_id = $this->pdo->lastInsertId();

        // 2️⃣ Insert attachments (if any)
        if (! empty($payload['attatchments'])) {
            $stmt2 = $this->pdo->prepare(
                "INSERT INTO attachments (message_id, file_loc)VALUES (?, ?)"
            );

            foreach ($payload['attatchments'] as $attatchment) {
                $stmt2->execute([
                    $messege_id,
                    $attatchment,
                ]);
            }
        }
    }

    public function getMessage($client_id) {
        $stmt = $this->pdo->prepare("SELECT v.shopName, d.first_name AS delivery, g.first_name AS giftWrapper, m.vendor_id,  m.delivery_id, m.giftWrapper_id, m.messege, m.created_at, a.file_loc, m.sent, m.is_read  FROM messeges m LEFT JOIN attachments a ON m.id = a.message_id LEFT JOIN vendors v ON v.id = m.vendor_id LEFT JOIN giftWrappers g ON g.id = m.giftWrapper_id LEFT JOIN delivery d ON d.id = m.delivery_id WHERE m.client_id = ? ORDER BY m.created_at ASC");
        $stmt->execute([$client_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMessageVendor($staff_id) {
        $stmt = $this->pdo->prepare("SELECT c.first_name AS client, m.client_id, m.messege, m.created_at, a.file_loc, m.sent, m.is_read  FROM messeges m LEFT JOIN attachments a ON m.id = a.message_id LEFT JOIN clients c ON c.id = m.client_id WHERE m.vendor_id = ? ORDER BY m.created_at ASC");
        $stmt->execute([$staff_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVendor($staff_id) {
        $stmt = $this->pdo->prepare("SELECT shopName FROM vendors WHERE id = ?");
        $stmt->execute([$staff_id]);
        return $stmt->fetchColumn();
    }

    public function getGiftWrapper($staff_id) {
        $stmt = $this->pdo->prepare("SELECT first_name FROM giftwrappers WHERE id = ?");
        $stmt->execute([$staff_id]);
        return $stmt->fetchColumn();
    }

    public function getDelivery($staff_id) {
        $stmt = $this->pdo->prepare("SELECT first_name FROM delivery WHERE id = ?");
        $stmt->execute([$staff_id]);
        return $stmt->fetchColumn();
    }

    public function markMessagesAsReadClient(string $type, int $staff_id, int $client_id): bool {
        // Map type to the correct FK column name
        $columnMap = [
            'vendor'      => 'vendor_id',
            'giftwrapper' => 'giftWrapper_id',
            'delivery'    => 'delivery_id',
        ];

        $column = $columnMap[$type] ?? null;
        if (!$column) return false;

        // Only mark messages that were SENT TO the client (sent = 1) and are unread
        $stmt = $this->pdo->prepare("
        UPDATE messeges
        SET    is_read = 1
        WHERE  {$column} = ?
        AND client_id ?
        AND sent = 0
        AND  is_read  = 0
    ");

        return $stmt->execute([$staff_id, $client_id]);
    }

    public function markMessagesAsReadStaff(string $type, int $staff_id, int $client_id): bool {
        // Map type to the correct FK column name
        $columnMap = [
            'vendor'      => 'vendor_id',
            'giftwrapper' => 'giftWrapper_id',
            'delivery'    => 'delivery_id',
        ];

        $column = $columnMap[$type] ?? null;
        if (!$column) return false;

        // Only mark messages that were SENT TO the client (sent = 1) and are unread
        $stmt = $this->pdo->prepare("
        UPDATE messeges
        SET    is_read = 1
        WHERE  {$column} = ?
        AND client_id = ?
        AND sent = 1
        AND  is_read  = 0
    ");

        return $stmt->execute([$staff_id, $client_id]);
    }
}

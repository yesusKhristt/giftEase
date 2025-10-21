<?php
// DeliveryModel.php***

class DeliveryModel
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
        // --- Delivery table (linked to users table) ---
        $deliverySql = "CREATE TABLE IF NOT EXISTS delivery (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            first_name VARCHAR(50),
            last_name VARCHAR(50),
                        phone VARCHAR(20),
            address VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        ) ENGINE=InnoDB;";



        try {
            
            $this->pdo->exec($deliverySql);

        } catch (PDOException $e) {
            die("❌ Error creating tables: " . $e->getMessage());
        }
    }

    public function addDelivery($user_id, $first_name, $last_name, $phone, $address)
    {
        $stmt = $this->pdo->prepare("INSERT INTO delivery (user_id, first_name, last_name, phone, address, created_at) VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
        return $stmt->execute([
            $user_id,
            $first_name,
            $last_name,
            $phone,
            $address
            
        ]);

    }

    public function updateDelivery($user_id, $first_name, $last_name, $phone, $address)
    {
        $stmt = $this->pdo->prepare("UPDATE delivery SET first_name = ?, last_name = ?, phone = ?, address = ? WHERE user_id = ?");
        return $stmt->execute([
            $first_name,
            $last_name,
            $phone,
            $address,
            
            $user_id
        ]);
    }

    public function deleteDelivery($user_id)
    {
        $stmt = $this->pdo->prepare("DELETE  FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $stmt = $this->pdo->prepare("DELETE FROM delivery WHERE user_id = ?");
        return $stmt->execute([$user_id]);
    }
}


?>
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

    public function createTableIfNotExists()
    {
        // --- Delivery table (linked to users table) ---
        $sql2 = "
        CREATE TABLE IF NOT EXISTS delivery (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            vehicleNumber VARCHAR(50) NOT NULL,
            phone VARCHAR(20),
            address VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );
         ";

        try {
            
            $this->pdo->exec($sql2);

        } catch (PDOException $e) {
            die("❌ Error creating tables: " . $e->getMessage());
        }
    }

      public function getDeliveryID($id){

        $stmt = $this->getpdo()->prepare("SELECT id FROM delivery WHERE user_id = ?");
        $stmt->execute([$id]);

        return $stmt->fetchColumn();
    }

    public function getAllDelivery()
    {
        $stmt = $this->getpdo()->prepare("SELECT * FROM delivery");
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function addDelivery($user_id, $vehicleNumber, $phone, $address)
{
    $stmt = $this->pdo->prepare("
        INSERT INTO delivery (user_id, phone, vehicleNumber, address, created_at)
        VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)
    ");

    return $stmt->execute([
        $user_id,
        $phone,         // corrected
        $vehicleNumber, // corrected
        $address
    ]);
}


    public function updateDelivery($user_id, $phone, $address, $vehicleNumber)
{
    $stmt = $this->pdo->prepare("
        UPDATE delivery 
        SET phone = ?, address = ?, vehicleNumber = ?
        WHERE user_id = ?
    ");

    return $stmt->execute([
        $phone,
        $address,
        $vehicleNumber,
        $user_id
    ]);
}


    public function deleteDelivery($user_id)
{
    $stmt = $this->pdo->prepare("DELETE FROM delivery WHERE user_id = ?");
    return $stmt->execute([$user_id]);
}

  
}

?>
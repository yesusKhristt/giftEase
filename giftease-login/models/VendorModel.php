<?php
class VendorModel
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
        $sql1 = "
        CREATE TABLE IF NOT EXISTS clients (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            first_Name VARCHAR(50) NOT NULL,
            last_Name VARCHAR(50) NOT NULL,
            phone VARCHAR(20),
            address VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );
         ";

        try {
            $this->pdo->exec($sql1);

        } catch (PDOException $e) {
            die("❌ Error creating tables: " . $e->getMessage());
        }
    }

    public function addVendor($user_id, $shopname, $phone, $address)
    {
        $stmt = $this->pdo->prepare("INSERT INTO vendors (user_id, shopName, phone, address, created_at) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)");
        return $stmt->execute([
            $user_id, $shopname, $phone, $address
        ]);

    }
}

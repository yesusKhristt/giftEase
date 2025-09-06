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
        CREATE TABLE IF NOT EXISTS vendors (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
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
}

<?php
class GiftWrapperServiceModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->createTables();
    }

    public function createTables()
    {
        $sql = "CREATE TABLE IF NOT EXISTS giftWrapperServices (
            id INT AUTO_INCREMENT PRIMARY KEY,
            giftWrapper_id INT NOT NULL,
            name VARCHAR(100) NOT NULL,
            description VARCHAR(1000) NOT NULL,
            price DECIMAL(10,2) DEFAULT 0,
            image_path VARCHAR(500) DEFAULT NULL,
            rating DECIMAL(3,1) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (giftWrapper_id) REFERENCES giftWrappers(id) ON DELETE CASCADE
        );";

        try {
            $this->pdo->exec($sql);
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function addService($giftWrapperId, $name, $description, $price, $imagePath)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO giftWrapperServices (giftWrapper_id, name, description, price, image_path)
             VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([
            $giftWrapperId,
            $name,
            $description,
            $price,
            $imagePath
        ]);
    }

    public function getServicesByGiftWrapper($giftWrapperId)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM giftWrapperServices WHERE giftWrapper_id = ? ORDER BY created_at DESC"
        );
        $stmt->execute([$giftWrapperId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>

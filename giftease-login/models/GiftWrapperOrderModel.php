<?php 
Class GiftWrapperOrderModel
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
        // --- Gift Wrapper Orders table ---
        $sql = "CREATE TABLE IF NOT EXISTS GiftWrapperOrders (
            id INT AUTO_INCREMENT PRIMARY KEY,
            GiftWrapper_id INT NOT NULL,
            Order_id INT NOT NULL,
            FOREIGN KEY (GiftWrapper_id) REFERENCES GiftWrappers(id) ON DELETE CASCADE,
            FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
        );";
        try {
            $this->pdo->exec($sql1);
            $this->pdo->exec($sql2);
            

        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

   
}
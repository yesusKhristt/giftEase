<?php
class CategoryModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function createTableIfNotExists()
    {
        $sql1 = "
        CREATE TABLE IF NOT EXISTS categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(20) NOT NULL,
        );
         ";

        try {
            $this->pdo->exec($sql1);
            echo "Products table created successfully.<br>";

        } catch (PDOException $e) {
            die("❌ Error creating tables: " . $e->getMessage());
        }
    }
}
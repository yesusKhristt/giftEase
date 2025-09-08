<?php
class ProductsModel
{
    private $pdo;
    private $user;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->createTableIfNotExists(); // Create the table if not there
    }

    public function createTableIfNotExists()
    {
        $sql1 = "
        CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            vendor_id INT NOT NULL,
            name VARCHAR(100) NOT NULL,
            price INT NOT NULL,
            description VARCHAR(500) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE
            FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
        );
         ";

         $sql2 = "
        CREATE TABLE IF NOT EXISTS productCategories (
            product_id INT NOT NULL,
            category_id INT NOT NULL,
            PRIMARY KEY (product_id, category_id),
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
            FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
        );
         ";

         $sql3 = "
         CREATE TABLE IF NOT EXISTS productImages (
            product_id INT NOT NULL,
            image_loc VARCHAR(100) NOT NULL,
            PRIMARY KEY (product_id, category_id),
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
        );
        ";

        try {
            $this->pdo->exec($sql1);
            echo "Products table created successfully.<br>";
            $this->pdo->exec($sql2);
            echo "productCategories table created successfully.<br>";
            $this->pdo->exec($sql3);
            echo "productImages table created successfully.<br>";

        } catch (PDOException $e) {
            die("❌ Error creating tables: " . $e->getMessage());
        }
    }

    public function addProduct($vendor_id, $name, $price, $description)
    {
        $stmt = $this->pdo->prepare("INSERT INTO products (vendor_id, name, price, description, created_at) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)");
        return $stmt->execute([
            $vendor_id,
            $name,
            $price, // already hashed
            $description
            
        ]);

    }
}
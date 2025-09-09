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
        CREATE TABLE IF NOT EXISTS categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(20) NOT NULL
        );
         ";

        //INSERT INTO products (vendor_id, name, price, description,mainCategory, subCategory, created_at) VALUES (9, 'Apex Slaughterspine', 35, 'COOLEST FICTIONAL DINASAUR EVER', 1,13, CURRENT_TIMESTAMP);
        $sql2 = "
        CREATE TABLE IF NOT EXISTS products (
            id INT AUTO_INCREMENT PRIMARY KEY,
            vendor_id INT NOT NULL,
            name VARCHAR(100) NOT NULL,
            price INT NOT NULL,
            description VARCHAR(500) NOT NULL,
            status VARCHAR(20) NOT NULL,
            mainCategory INT NOT NULL,
            subCategory INT NOT NULL,
            displayImage VARCHAR(100) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
            FOREIGN KEY (mainCategory) REFERENCES categories(id) ON DELETE CASCADE,
            FOREIGN KEY (subCategory) REFERENCES categories(id) ON DELETE CASCADE
        );
         ";

        $sql3 = "
         CREATE TABLE IF NOT EXISTS productImages (
            product_id INT NOT NULL,
            image_loc VARCHAR(100) NOT NULL,
            PRIMARY KEY (product_id, image_loc),
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
        );
        ";

        try {
            $this->pdo->exec($sql1);
            $this->pdo->exec($sql2);
            $this->pdo->exec($sql3);
        } catch (PDOException $e) {
            die("❌ Error creating tables: " . $e->getMessage());
        }
    }

    public function fetchAll($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM products WHERE vendor_id = $id");
        $stmt->execute();

        // Fetch all rows as an array of associative arrays
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function fetchProduct($productId)
    {
        $stmt1 = $this->pdo->prepare("SELECT * FROM products WHERE id = $productId");
        $stmt1->execute();
        $product1 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

        $stmt2 = $this->pdo->prepare("SELECT image_loc FROM productimages WHERE product_id = $productId");
        $stmt2->execute();
        $product2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);

        return [
            'id' => $product1[0]['id'],
            'name' => $product1[0]['name'],
            'price' => $product1[0]['price'],
            'description' => $product1[0]['description'],
            'images' => $product2
        ];

    }

    public function addProduct($vendor_id, $name, $price, $description, $profilePath)
    {
        $stmt1 = $this->pdo->prepare("INSERT INTO products (vendor_id, name, price, description, created_at) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP)");
        $stmt1->execute([
            $vendor_id,
            $name,
            $price,
            $description
        ]);
        $productID = $this->pdo->lastInsertId();
        ;
        foreach ($profilePath as $image) {
            $stmt2 = $this->pdo->prepare("INSERT INTO productImages (product_id, image_loc) VALUES (?, ?)");
            $stmt2->execute([
                $productID,
                $image
            ]);
        }
    }

    public function editProduct($product_id, $name, $price, $description, $profilePath)
    {

        $stmt1 = $this->pdo->prepare('UPDATE products SET name = ?, price = ?, description = ? WHERE id = ?;');
        $stmt1->execute([
            $name,
            $price,
            $description,
            $product_id
        ]);
        ;
        if ($profilePath) {
            $stmt2 = $this->pdo->prepare("UPDATE productImages SET image_loc = ? WHERE product_id = ?;");
            $stmt2->execute([
                $profilePath,
                $product_id

            ]);
        }
    }
}
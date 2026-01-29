<?php
// ClientModel.php***

class CartModel
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
        // --- Clients table (linked to users table) ---
        $sql1 = "CREATE TABLE IF NOT EXISTS cart (
            id INT AUTO_INCREMENT PRIMARY KEY,
            client_id INT NOT NULL,
            product_id INT NOT NULL,
            quantity INT NOT NULL,
            FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
        );";
        try {
            $this->pdo->exec($sql1);

        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function isInCart($client_id, $product_id)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM cart WHERE client_id = ? AND product_id = ?");
        $stmt->execute([$client_id, $product_id]);
        return $stmt->fetchColumn() > 0;
    }


    // public function getCartForClient($client_id)
    // {
    //     $stmt1 = $this->getpdo()->prepare("SELECT * FROM products WHERE id IN (SELECT product_id FROM cart WHERE client_id = ?)");
    //     $stmt1->execute([$client_id]);
    //     return $stmt1->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getCartForClient($client_id)
    {
        $stmt2 = $this->getpdo()->prepare("SELECT * FROM products JOIN cart ON products.id = cart.product_id WHERE products.id IN (SELECT product_id FROM cart WHERE client_id = ?)");
        $stmt2->execute([$client_id]);
        return $stmt2->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addToCart($client_id, $product_id)
    {
        $stmt = $this->pdo->prepare("INSERT INTO cart (client_id, product_id, quantity) VALUES (?, ?, 1)");
        return $stmt->execute([
            $client_id,
            $product_id
        ]);
    }


    public function increaseCartQuantity($client_id, $product_id)
    {
        $stmt1 = $this->pdo->prepare("SELECT quantity FROM cart WHERE client_id = ? AND id = ?");
        $stmt1->execute([$client_id, $product_id]);
        $currQuantity = $stmt1->fetchColumn();
        // var_dump($currQuantity);
        // var_dump($client_id);
        // var_dump($product_id);
        // exit;
        $stmt2 = $this->pdo->prepare("UPDATE cart SET quantity = ? WHERE client_id = ? AND id = ?");
        return $stmt2->execute([
            $currQuantity + 1,
            $client_id,
            $product_id
        ]);
    }

    public function decreaseCartQuantity($client_id, $product_id)
    {
        $stmt1 = $this->pdo->prepare("SELECT quantity FROM cart WHERE client_id = ? AND id = ?");
        $stmt1->execute([$client_id, $product_id]);
        $currQuantity = $stmt1->fetchColumn();
        $newItem = $currQuantity - 1;
        if ($newItem < 0)
            $newItem = 0;
        $stmt2 = $this->pdo->prepare("UPDATE cart SET quantity = ? WHERE client_id = ? AND id = ?");
        return $stmt2->execute([
            $newItem,
            $client_id,
            $product_id
        ]);
    }

    public function removeFromCart($product_id, $client_id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM cart WHERE id = ? AND client_id = ?");
        $stmt->execute([
            $product_id,
            $client_id
        ]);
    }

    public function emptyCart($client_id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM cart WHERE client_id = ?");
        $stmt->execute([
            $client_id
        ]);
    }

}


?>
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
            id CHAR(36) PRIMARY KEY DEFAULT (UUID()),
            client_id INT NOT NULL,
            product_id INT NOT NULL,
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


    public function getCartForClient($client_id)
    {
        $stmt1 = $this->getpdo()->prepare("SELECT * FROM products WHERE id IN (SELECT product_id FROM cart WHERE client_id = ?)");
        $stmt1->execute([$client_id]);
        return $stmt1->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addToCart($client_id, $product_id)
    {
        $stmt = $this->pdo->prepare("INSERT INTO cart (client_id, product_id) VALUES (?, ?)");
        return $stmt->execute([
            $client_id,
            $product_id
        ]);
    }

    public function removeFromCart($product_id, $client_id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM cart WHERE product_id = ? AND client_id = ?");
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
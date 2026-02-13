<?php
// ClientModel.php***

class WishlistModel
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
        $sql1 = "CREATE TABLE IF NOT EXISTS wishlist (
            id INT AUTO_INCREMENT PRIMARY KEY,
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

    public function isInWishlist($client_id, $product_id)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM wishlist WHERE client_id = ? AND product_id = ?");
        $stmt->execute([$client_id, $product_id]);
        return $stmt->fetchColumn() > 0;
    }


    // public function getWishlistForClient($client_id)
    // {
    //     $stmt1 = $this->getpdo()->prepare("SELECT * FROM products WHERE id IN (SELECT product_id FROM wishlist WHERE client_id = ?)");
    //     $stmt1->execute([$client_id]);
    //     return $stmt1->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getWishlistForClient($client_id)
    {
        $stmt2 = $this->getpdo()->prepare("SELECT * FROM products JOIN wishlist ON products.id = wishlist.product_id WHERE products.id IN (SELECT product_id FROM wishlist WHERE client_id = ?)");
        $stmt2->execute([$client_id]);
        return $stmt2->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addToWishlist($client_id, $product_id)
    {
        $stmt = $this->pdo->prepare("INSERT INTO wishlist (client_id, product_id) VALUES (?, ?)");
        return $stmt->execute([
            $client_id,
            $product_id
        ]);
    }

    public function removeFromWishlist($product_id, $client_id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM wishlist WHERE product_id = ? AND client_id = ?");
        $stmt->execute([
            $product_id,
            $client_id
        ]);
    }

    public function emptyWishlist($client_id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM wishlist WHERE client_id = ?");
        $stmt->execute([
            $client_id
        ]);
    }

}


?>

<?php
// ClientModel.php***

class giftwrapperorderModel
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
        $stmt = "CREATE TABLE IF NOT EXISTS giftWrappersorder (
            id INT AUTO_INCREMENT PRIMARY KEY,
            giftwrapper_id INT NOT NULL,
            order_id INT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

        try {
            $this->pdo->exec($stmt);

        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

        public function authenticate($email, $password, $type)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM giftWrappers WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password']) && $type == 'giftWrapper') {
            return $user;
        }
        return null;
    }

        /**
         * Get the gift wrapper id by email.
         * Returns int id or null if not found.
         */
        public function getGiftWrapperIdByEmail($email)
        {
            $stmt = $this->pdo->prepare("SELECT id FROM giftWrappers WHERE email = ? LIMIT 1");
            $stmt->execute([$email]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? (int)$row['id'] : null;
        }

        /**
         * Get full gift wrapper record by id.
         * Returns associative array or null if not found.
         */
        public function getGiftWrapperById($id)
        {
            $stmt = $this->pdo->prepare("SELECT * FROM giftWrappers WHERE id = ? LIMIT 1");
            $stmt->execute([$id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ? $row : null;
        }

  
?>
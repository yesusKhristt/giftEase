<?php
// ClientModel.php***

class ClientModel
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
        $sql1 = "CREATE TABLE IF NOT EXISTS clients (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            first_name VARCHAR(50),
            last_name VARCHAR(50),
            phone VARCHAR(20),
            address VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            image_loc VARCHAR(500) DEFAULT NULL,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        );";



        try {
            $this->pdo->exec($sql1);

        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function getClient($id)
    {
        $stmt = $this->getpdo()->prepare("SELECT * FROM clients WHERE user_id = ?");
        $stmt->execute([$id]);

        return $stmt->fetch();
    }

    public function addClient($user_id, $first_name, $last_name, $phone, $address)
    {
        $stmt = $this->pdo->prepare("INSERT INTO clients (user_id, first_name, last_name, phone, address, created_at) VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
        return $stmt->execute([
            $user_id,
            $first_name,
            $last_name,
            $phone,
            $address
        ]);
    }

        public function updateProfilePicture($client_id, $profilePicPath)
    {
        $stmt = $this->pdo->prepare("UPDATE clients SET image_loc = ? WHERE id = ?");
        return $stmt->execute([
            $profilePicPath,
            $client_id
        ]);
    }

    public function updateClient($user_id, $first_name, $last_name, $phone, $address)
    {
        $stmt = $this->pdo->prepare("UPDATE clients SET first_name = ?, last_name = ?, phone = ?, address = ? WHERE user_id = ?");
        return $stmt->execute([
            $first_name,
            $last_name,
            $phone,
            $address,

            $user_id
        ]);
    }

    public function deleteClient($user_id)
    {
        $stmt = $this->pdo->prepare("DELETE  FROM users WHERE id = ?");
        $stmt->execute([$user_id]);
        $stmt = $this->pdo->prepare("DELETE FROM clients WHERE user_id = ?");
        return $stmt->execute([$user_id]);
    }
}


?>
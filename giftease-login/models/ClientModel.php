<?php
// ClientModel.php

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
        $clientSql = "CREATE TABLE IF NOT EXISTS clients (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NOT NULL,
            first_name VARCHAR(50),
            last_name VARCHAR(50),
            email VARCHAR(100),
            phone VARCHAR(20),
            address VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        ) ENGINE=InnoDB;";



        try {
            $this->pdo->exec($clientSql);
           
        } catch (PDOException $e) {
            die("❌ Error creating tables: " . $e->getMessage());
        }
    }

    public function addClient($user_id, $first_name, $last_name, $phone, $address, $email)
    {
        $stmt = $this->pdo->prepare("INSERT INTO clients (user_id, first_name, last_name, phone, address, email, created_at) VALUES (?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
        return $stmt->execute([
            $user_id,
            $first_name,
            $last_name,
            $phone,
            $address,
            $email
        ]);

    }

    public function updateClient($user_id, $first_name, $last_name, $phone, $address, $email)
    {
        $stmt = $this->pdo->prepare("UPDATE clients SET first_name = ?, last_name = ?, phone = ?, address = ?, email = ? WHERE user_id = ?");
        return $stmt->execute([
            $first_name,
            $last_name,
            $phone,
            $address,
            $email,
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
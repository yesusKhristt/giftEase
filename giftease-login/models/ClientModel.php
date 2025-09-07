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
            echo "Clients table created successfully.<br>";

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
}

// --- Usage example ---
$host = 'localhost';
$db = 'giftease';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $clientModel = new ClientModel($pdo);
    $clientModel->createTables();

} catch (PDOException $e) {
    die("❌ Database connection failed: " . $e->getMessage());
}
?>
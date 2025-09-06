<?php
// ClientModel.php

class ClientModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
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
            password VARCHAR(255) NOT NULL,
            profile_image VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
        ) ENGINE=InnoDB;";

        // --- Shipping addresses table ---
        $addressSql = "CREATE TABLE IF NOT EXISTS shipping_addresses (
            id INT AUTO_INCREMENT PRIMARY KEY,
            client_id INT NOT NULL,
            address VARCHAR(255) NOT NULL,
            FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
        ) ENGINE=InnoDB;";

        // --- Payment methods table ---
        $paymentSql = "CREATE TABLE IF NOT EXISTS payment_methods (
            id INT AUTO_INCREMENT PRIMARY KEY,
            client_id INT NOT NULL,
            method VARCHAR(50) NOT NULL,
            FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
        ) ENGINE=InnoDB;";

        try {
            $this->pdo->exec($clientSql);
            echo "Clients table created successfully.<br>";

            $this->pdo->exec($addressSql);
            echo "Shipping addresses table created successfully.<br>";

            $this->pdo->exec($paymentSql);
            echo "Payment methods table created successfully.<br>";

        } catch (PDOException $e) {
            die("❌ Error creating tables: " . $e->getMessage());
        }
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

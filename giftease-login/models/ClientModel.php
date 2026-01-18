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
        $sql1 = "CREATE TABLE IF NOT EXISTS clients (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            status ENUM('active', 'inactive') DEFAULT 'active',
            phone VARCHAR(10),
            image_loc VARCHAR(500) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";
        // --- Clients table (linked to users table) ---
        $sql2 = "CREATE TABLE IF NOT EXISTS clientAdress (
            client_id INT NOT NULL,
            address VARCHAR(255),
            PRIMARY KEY (client_id, address),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            image_loc VARCHAR(500) DEFAULT NULL,
            FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
        );";

        try {
            $this->pdo->exec($sql1);
            $this->pdo->exec($sql2);

        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function authenticate($email, $password, $type)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clients WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password']) && $type == "client") {
            
            return $user;
        }
        return null;
    }

        public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clients WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO clients (first_name, last_name, email, password, phone, image_loc) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
            $data['phone'],
            $data['imageloc'],
        ]);
    }

    public function updateUser($data)
    {
        $stmt = $this->pdo->prepare("UPDATE clients SET first_name = ?, last_name = ?, phone = ?, address WHERE id = ?");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['phone'],
            $data['id']
        ]);
    }

    public function deleteUser($user_id)
    {
        $stmt = $this->pdo->prepare("UPDATE clients SET status = 'inactive' WHERE id = ?");
        $stmt->execute([$user_id]);
    }


    public function updateProfilePicture($client_id, $profilePicPath)
    {
        $stmt = $this->pdo->prepare("UPDATE clients SET image_loc = ? WHERE id = ?");
        return $stmt->execute([
            $profilePicPath,
            $client_id
        ]);
    }

    public function getAllClients()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clients");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}


?>
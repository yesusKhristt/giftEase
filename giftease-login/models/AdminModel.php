<?php
class AdminModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->createTableIfNotExists(); // Create the table if not there
    }

    public function getpdo()
    {
        return $this->pdo;
    }

    public function createTableIfNotExists()
    {
        $sql1 = "CREATE TABLE IF NOT EXISTS admins (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            status ENUM('active', 'inactive') DEFAULT 'active',
            address VARCHAR(255),
            designation VARCHAR(20),
            phone VARCHAR(10),
            image_loc VARCHAR(500) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

        try {
            $this->pdo->exec($sql1);
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function authenticate($email, $password, $type, &$error)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM admins WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password']) && $type == 'admin') {
            return $user;
        }
        $error = "Invalid Username or Password";
        return null;
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM admins WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO admins (first_name, last_name, email, password, designation, phone, image_loc, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
            $data['designation'],
            $data['phone'],
            $data['imageloc'],
            $data['address'],
        ]);
    }

    public function updateUser($data)
    {
        $stmt = $this->pdo->prepare("UPDATE admins SET first_name = ?, last_name = ?, designation = ?, phone = ?, address = ? WHERE id = ?");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['designation'],
            $data['phone'],
            $data['address'],
            $data['id']
        ]);
    }

    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare("UPDATE admins SET status = 'inactive' WHERE id = ?");
        $stmt->execute($id);
    }

    public function getAllClients()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM clients");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    public function getAllVerifiedVendors()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM vendors WHERE verified = 1");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }
    public function getAllUnverifiedVendors()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM vendors");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    public function getAllAdmins()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM admins");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    public function getAllVerifiedDelivery()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM delivery WHERE verified = 1");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }
    public function getAllUnverifiedDelivery()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM delivery");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    public function getAllVerifiedDeliveryman()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM deliveryman WHERE verified = 1");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }
    public function getAllUnverifiedDeliveryman()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM deliveryman");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }

    public function getAllVerifiedGiftwrapper()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM giftwrappers WHERE verified = 1");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }
    public function getAllUnverifiedGiftwrapper()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM giftwrappers");
        $stmt->execute([]);
        return $stmt->fetchall(PDO::FETCH_ASSOC);
    }
}

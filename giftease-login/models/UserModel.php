<?php

class UserModel
{
    private $pdo;
    private int $id;
    private string $name;
    private string $email;
    private string $passwordHash;
    private string $type; // 'client', 'vendor', etc.
    private ?string $profileImage;
    private array $orderHistory = [];

    private function createTableIfNotExists()
    {
        $sql = "
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            type ENUM('client', 'vendor', 'giftWrapper', 'deliveryman', 'admin', 'delivery') DEFAULT 'client'
        );
    ";
        $this->pdo->exec($sql);
    }

    public function getpdo()
    {
        return $this->pdo;
    }


    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->createTableIfNotExists(); // Create the table if not there
    }


    public function authenticate($email, $password, $type)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password']) && $type == $user['type']) {
            $this->id = $user['id'];
            $this->name = $user['name'];
            $this->email = $user['email'];
            $this->passwordHash = $user['password'];
            $this->type = $user['type'];
            return $user;
        }
        return null;
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO users (name, email, password, type) VALUES (?, ?, ?, ?)");
        return $stmt->execute([
            $data['name'],
            $data['email'],
            $data['password'], // already hashed
            $data['type']
        ]);

    }
}


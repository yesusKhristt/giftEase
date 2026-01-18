<?php

class DeliveryModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->createTableIfNotExists();
    }

    public function getpdo()
    {
        return $this->pdo;
    }

    private function createTableIfNotExists()
    {
        $sql = "CREATE TABLE IF NOT EXISTS delivery (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(100),
            last_name VARCHAR(100),
            email VARCHAR(100) UNIQUE,
            password VARCHAR(255),
            status ENUM('active','inactive') DEFAULT 'active',
            address VARCHAR(255),
            vehiclePlate VARCHAR(20),
            phone VARCHAR(15),
            image_loc VARCHAR(500),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";

        $this->pdo->exec($sql);
    }

    // ---------------- SIGN UP ----------------
    public function addUser($data)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO delivery 
            (first_name, last_name, email, password, vehiclePlate, phone, address)
            VALUES (?, ?, ?, ?, ?, ?, ?)"
        );

        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
            $data['vehiclePlate'],
            $data['phone'],
            $data['address']
        ]);
    }

    // ---------------- GET ALL (ADMIN) ----------------
public function getAllDelivery()
{
    $stmt = $this->pdo->prepare("SELECT * FROM delivery");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



    // ---------------- AUTH ----------------
    public function authenticate($email, $password)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM delivery WHERE email=?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return null;
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM delivery WHERE email=?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

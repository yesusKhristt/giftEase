<?php

class DeliveryModel
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

    public function getAllOrders()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE is_delivered = 0 AND is_wrapped = 1 AND delivery_id IS NULL");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAssignedOrders($id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT orders.id, client_id, deliveryDate, is_delivered, delivery_id, deliveryPrice, clients.first_name, clients.last_name FROM orders JOIN clients ON orders.client_id = clients.id WHERE is_delivered = 0 AND is_wrapped = 1 AND delivery_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function acceptOrder($order_id, $delivery_id)
    {
        $stmt = $this->pdo->prepare("UPDATE `orders` SET delivery_id = ? WHERE `id` = ?");
        $stmt->execute([$delivery_id, $order_id]);
    }
    public function verifyUser($user_id)
    {
        $sql  = "UPDATE delivery SET verified = 1 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }

    public function unverifyUser($user_id)
    {
        $sql  = "UPDATE delivery SET verified = 0 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }

    public function markComplete($order_id)
    {
        $stmt = $this->pdo->prepare("UPDATE `orders` SET is_delivered = 1 WHERE `id` = ?");
        $stmt->execute([$order_id]);
    }

    public function cancelOrder($order_id)
    {
        $stmt = $this->pdo->prepare("UPDATE `orders` SET delivery_id = null WHERE `id` = ?");
        $stmt->execute([$order_id]);
    }

    public function createTableIfNotExists()
    {
        $sql1 = "CREATE TABLE IF NOT EXISTS delivery (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            status ENUM('active', 'inactive') DEFAULT 'active',
            address VARCHAR(255),
            vehiclePlate VARCHAR(20),
            phone VARCHAR(10),
            image_loc VARCHAR(500) DEFAULT NULL,
            verified BOOL DEFAULT 0,
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
        $stmt = $this->pdo->prepare("SELECT * FROM delivery WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password']) && $type == 'delivery') {
            if (!$user['verified']){
                $error = "User Not verified";
            return null;
            }
            return $user;
        }
        $error = "Invalid Username or Password";
        return null;
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM delivery WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO delivery (first_name, last_name, email, password, vehiclePlate, phone, image_loc, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
            $data['vehiclePlate'],
            $data['phone'],
            $data['imageloc'],
            $data['address'],
        ]);
    }

    public function updateUser($data)
    {
        $stmt = $this->pdo->prepare("UPDATE delivery SET first_name = ?, last_name = ?, vehiclePlate = ?, phone = ?, address = ? WHERE id = ?");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['vehiclePlate'],
            $data['phone'],
            $data['address'],
            $data['id'],
        ]);
    }

    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare("UPDATE delivery SET status = 'inactive' WHERE id = ?");
        $stmt->execute($id);
    }

    public function getAllDelivery()
    {
        $stmt = $this->getpdo()->prepare("SELECT * FROM delivery");
        $stmt->execute();

        return $stmt->fetchAll();
    }

}

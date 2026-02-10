<?php
// DeliveryModel.php***

class DeliverymanModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->createTableIfNotExists(); // Create the table if not there
    }

    public function getpdo() {
        return $this->pdo;
    }

    public function createTableIfNotExists() {
        $sql1 = "CREATE TABLE IF NOT EXISTS deliveryman (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            status ENUM('active', 'inactive') DEFAULT 'active',
            address VARCHAR(255),
            vehiclePlate VARCHAR(20),
            vehicleType VARCHAR(50),
            phone VARCHAR(10),
            image_loc VARCHAR(500) DEFAULT NULL,
            verified BOOL DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

        $sql2 = "CREATE TABLE IF NOT EXISTS deliverymanVerify (
            id INT AUTO_INCREMENT PRIMARY KEY,
            deliveryman_id INT NOT NULL,
            identity_doc VARCHAR(500) DEFAULT NULL,
            driving_license VARCHAR(500) DEFAULT NULL,
            vehicle_registration VARCHAR(500) DEFAULT NULL,
            vehicle_insurance VARCHAR(500) DEFAULT NULL,
            FOREIGN KEY (deliveryman_id) REFERENCES deliveryman(id) ON DELETE CASCADE
        );";

        try {
            $this->pdo->exec($sql1);
            $this->pdo->exec($sql2);
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function verifyUser($user_id) {
        $sql  = "UPDATE deliveryman SET verified = 1 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }

    public function unverifyUser($user_id) {
        $sql  = "UPDATE deliveryman SET verified = 0 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }

    public function authenticate($email, $password, $type, &$error) {
        $stmt = $this->pdo->prepare("SELECT * FROM deliveryman WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password']) && $type == 'deliveryman') {
            if (!$user['verified']) {
                $error = "User Not verified";
                return null;
            }
            return $user;
        }
        $error = "Invalid Username or Password";
        return null;
    }

    public function getUserByEmail($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM deliveryman WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($data) {
        $stmt = $this->pdo->prepare("INSERT INTO deliveryman (first_name, last_name, email, password, vehicleType, vehiclePlate, phone, image_loc, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
            $data['vehicleType'] ?? null,
            $data['vehiclePlate'],
            $data['phone'],
            $data['imageloc'],
            $data['address']
        ]);
        $id =  $this->pdo->lastInsertId();
        $stmt = $this->pdo->prepare("INSERT INTO deliverymanVerify (deliveryman_id, identity_doc, driving_license, vehicle_registration, vehicle_insurance) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([
            $id,
            $data['identity_doc'] ?? null,
            $data['driving_license'] ?? null,
            $data['vehicle_registration'] ?? null,
            $data['vehicle_insurance'] ?? null
        ]);
    }

    public function updateUser($data) {
        $stmt = $this->pdo->prepare("UPDATE deliveryman SET first_name = ?, last_name = ?, vehiclePlate = ?, phone = ?, address = ? WHERE id = ?");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['vehiclePlate'],
            $data['phone'],
            $data['address'],
            $data['id'],
        ]);
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("UPDATE deliveryman SET status = 'inactive' WHERE id = ?");
        $stmt->execute($id);
    }

    public function getAllDeliveryMan() {
        $stmt = $this->pdo->prepare("SELECT * FROM deliveryman");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

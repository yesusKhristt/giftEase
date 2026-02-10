<?php
// ClientModel.php***

class GiftWrapperModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->createTables(); // Create the table if not there
    }

    public function getpdo() {
        return $this->pdo;
    }

    public function createTables() {
        $stmt1 = "CREATE TABLE IF NOT EXISTS giftWrappers (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            status ENUM('active', 'inactive') DEFAULT 'active',
            address VARCHAR(255),
            years_of_experience VARCHAR(20),
            phone VARCHAR(10),
            image_loc VARCHAR(500) DEFAULT NULL,
            verified BOOL DEFAULT 0,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

        $stmt2 = "CREATE TABLE IF NOT EXISTS giftWrappersVerify (
            id INT AUTO_INCREMENT PRIMARY KEY,
            giftWrapper_id INT NOT NULL,
            identity_doc VARCHAR(500) DEFAULT NULL,
            address_proof VARCHAR(500) DEFAULT NULL,
            portfolio VARCHAR(500) DEFAULT NULL,
            FOREIGN KEY (giftWrapper_id) REFERENCES giftWrappers(id) ON DELETE CASCADE
        );";

        try {
            $this->pdo->exec($stmt1);
            $this->pdo->exec($stmt2);
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function verifyUser($user_id) {
        $sql  = "UPDATE giftWrappers SET verified = 1 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }

    public function unverifyUser($user_id) {
        $sql  = "UPDATE giftWrappers SET verified = 0 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }

    public function authenticate($email, $password, $type, &$error) {
        $stmt = $this->pdo->prepare("SELECT * FROM giftWrappers WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password']) && $type == 'giftWrapper') {
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
        $stmt = $this->pdo->prepare("SELECT * FROM giftWrappers WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($data) {
        $stmt = $this->pdo->prepare("INSERT INTO giftWrappers (first_name, last_name, email, password, years_of_experience, phone, image_loc, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
            $data['years_of_experience'],
            $data['phone'],
            $data['imageloc'],
            $data['address']
        ]);
        $id =  $this->pdo->lastInsertId();
        $stmt = $this->pdo->prepare("INSERT INTO giftWrappersVerify (giftWrapper_id, identity_doc, address_proof, portfolio) VALUES (?, ?, ?, ?)");
        $stmt->execute([
            $id,
            $data['identity_doc'] ?? null,
            $data['address_proof'] ?? null,
            $data['portfolio'] ?? null
        ]);
    }

    public function updateUser($data) {
        $stmt = $this->pdo->prepare("UPDATE giftWrappers SET first_name = ?, last_name = ?, years_of_experience = ?, phone = ?, address = ? WHERE id = ?");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['years_of_experience'],
            $data['phone'],
            $data['address'],
            $data['id'],
        ]);
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("UPDATE giftWrappers SET status = 'inactive' WHERE id = ?");
        $stmt->execute($id);
    }

    public function getAllOrders() {
        $stmt = $this->pdo->prepare("SELECT * FROM orders WHERE is_wrapped = 0 AND is_delivered = 0 AND giftWrapper_id IS NULL");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAssignedOrders($id) {
        $stmt = $this->pdo->prepare("SELECT *  FROM orders WHERE is_wrapped = 0 AND is_delivered = 0 AND giftWrapper_id = ?");
        $stmt->execute([$id]);
        $order = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($order) {
            if ($order[0]['customWrap_id']) {
                $stmt1 = $this->pdo->prepare("SELECT orders.id, client_id, customWrap_id, deliveryDate, is_wrapped, giftWrapper_id, customwrap.price, clients.first_name, clients.last_name FROM orders JOIN customwrap ON orders.customWrap_id = customwrap.id JOIN clients ON orders.client_id = clients.id WHERE is_wrapped = 0 AND is_delivered = 0 AND giftWrapper_id = ?");
                $stmt1->execute([$id]);
                return $stmt1->fetchAll(PDO::FETCH_ASSOC);
            } else if ($order[0]['wrapPackage_id']) {
                $stmt1 = $this->pdo->prepare("SELECT orders.id, client_id, wrapPackage_id, deliveryDate, is_wrapped, giftWrapper_id, customwrap.price, clients.first_name, clients.last_name FROM orders JOIN giftwrappackage ON orders.customWrap_id = customwrap.id JOIN clients ON orders.client_id = clients.id WHERE is_wrapped = 0 AND is_delivered = 0 AND giftWrapper_id = ?");
                $stmt1->execute([$id]);
                return $stmt1->fetchAll(PDO::FETCH_ASSOC);
            }
        } else {
            return $order;
        }
    }

    public function acceptOrder($order_id, $giftWrapper_id) {
        $stmt = $this->pdo->prepare("UPDATE `orders` SET giftWrapper_id = ? WHERE `id` = ?");
        $stmt->execute([(int) $giftWrapper_id, (int) $order_id]);
    }

    public function markComplete($order_id) {
        $stmt = $this->pdo->prepare("UPDATE `orders` SET is_wrapped = 1 WHERE `id` = ?");
        $stmt->execute([$order_id]);
    }

    public function cancelOrder($order_id) {
        $stmt = $this->pdo->prepare("UPDATE `orders` SET giftWrapper_id = null WHERE `id` = ?");
        $stmt->execute([$order_id]);
    }
}

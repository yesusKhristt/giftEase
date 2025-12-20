<?php
// ClientModel.php***

class GiftWrapperModel
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
        $stmt = "CREATE TABLE IF NOT EXISTS giftWrappers (
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
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

        try {
            $this->pdo->exec($stmt);

        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

        public function authenticate($email, $password, $type)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM giftWrappers WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password']) && $type == 'giftWrapper') {
            return $user;
        }
        return null;
    }

        public function getUserByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM giftWrappers WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO giftWrappers (first_name, last_name, email, password, years_of_experience, phone, image_loc, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
            $data['years_of_experience'],
            $data['phone'],
            $data['imageloc'],
            $data['address'],
        ]);
    }

    public function updateUser($data)
    {
        $stmt = $this->pdo->prepare("UPDATE giftWrappers SET first_name = ?, last_name = ?, years_of_experience = ?, phone = ?, address = ? WHERE id = ?");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['years_of_experience'],
            $data['phone'],
            $data['address'],
            $data['id']
        ]);
    }

    public function deleteUser($id)
    {
        $stmt = $this->pdo->prepare("UPDATE giftWrappers SET status = 'inactive' WHERE id = ?");
        $stmt->execute($id);
    }

}

// 
public function createTables()
    {
        
        $sql1 = "CREATE TABLE IF NOT EXISTS orderStatus (
            id INT AUTO_INCREMENT PRIMARY KEY,
            giftwrapper_id INT NOT NULL,
            order_id INT,
            is_wrapped BOOLEAN DEFAULT FALSE,
            is_delivered BOOLEAN DEFAULT FALSE,
            FOREIGN KEY (giftwrapper_id) REFERENCES giftwrappers(id) ON DELETE CASCADE,
            FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
        );";
        
        try {
            $this->pdo->exec($sql1);
            $this->pdo->exec($sql2);

        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

     public function ($level1){
        $stmt = "SELECT * FROM orderStatus JOIN orders ON orderStatus.order_id = orders.id JOIN clients ON orders.clients_id = clients.id";

        
    }
    
   public function addGiftWrapperOrder($giftwrapper_id, $order_id)
    {
        $sql = "INSERT INTO giftwrapperorder (giftwrapper_id, order_id) VALUES (:giftwrapper_id, :order_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':giftwrapper_id', $giftwrapper_id);
        $stmt->bindParam(':order_id', $order_id);
        return $stmt->execute();
    }



?>
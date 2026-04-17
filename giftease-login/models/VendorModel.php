<?php
class VendorModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->createTableIfNotExists(); // Create the table if not there
    }

    public function getpdo() {
        return $this->pdo;
    }

    public function createTableIfNotExists() {
        $sql1 = "CREATE TABLE IF NOT EXISTS vendors (
            id INT AUTO_INCREMENT PRIMARY KEY,
            first_name VARCHAR(100) NOT NULL,
            last_name VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            status ENUM('active', 'inactive') DEFAULT 'active',
            address VARCHAR(255),
            shopName VARCHAR(50),
            phone VARCHAR(10),
            image_loc VARCHAR(500) DEFAULT NULL,
            rating FLOAT DEFAULT 0,
            rating_count INT DEFAULT 0,
            verified BOOL DEFAULT 0,
            accountBalance int DEFAULT 0,
            pendingBalance int DEFAULT 0,
            bankName VARCHAR(50) DEFAULT NULL,
            accountNumber VARCHAR(50) DEFAULT NULL,
            accountName VARCHAR(50) DEFAULT NULL,
            bankBranch VARCHAR(50) DEFAULT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";
        $sql2 = "CREATE TABLE IF NOT EXISTS vendorVerify (
            id INT AUTO_INCREMENT PRIMARY KEY,
            vendor_id INT NOT NULL,
            identity_doc VARCHAR(500) DEFAULT NULL,
            business_cert VARCHAR(500) DEFAULT NULL,
            tin_doc VARCHAR(500) DEFAULT NULL,
            address_proof VARCHAR(500) DEFAULT NULL,
            bank_details VARCHAR(500) DEFAULT NULL,
            FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE
        );";

        try {
            $this->pdo->exec($sql1);
            $this->pdo->exec($sql2);
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function getAccountBalance($id) {
        $stmt = $this->pdo->prepare("SELECT accountBalance FROM vendors WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function getPendingBalance($id) {
        $stmt = $this->pdo->prepare("SELECT pendingBalance FROM vendors WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_COLUMN);
    }

    public function setAccountBalance($id, $amount) {
        $stmt = $this->pdo->prepare("UPDATE vendors SET accountBalance = ? WHERE id = ?");
        $stmt->execute([$amount, $id]);
    }

    public function setPendingBalance($id, $amount) {
        $stmt = $this->pdo->prepare("UPDATE vendors SET pendingBalance = ? WHERE id = ?");
        $stmt->execute([$amount, $id]);
    }

    public function withdrawMoney($id, $amount){
        $currAccountBalance = $this->getAccountBalance($id);
        $currPendingBalance = $this->getPendingBalance($id);
        $this->setAccountBalance($id, $currAccountBalance - $amount);
        $this->setPendingBalance($id, $currPendingBalance + $amount);
    }

    public function approveWithdraw($id, $amount){
        $currPendingBalance = $this->getPendingBalance($id);
        $this->setPendingBalance($id, $currPendingBalance - $amount);
    }

    public function rejectWithdraw($id, $amount){
        $currAccountBalance = $this->getAccountBalance($id);
        $currPendingBalance = $this->getPendingBalance($id);
        $this->setAccountBalance($id, $currAccountBalance + $amount);
        $this->setPendingBalance($id, $currPendingBalance - $amount);
    }

    public function confirmWithdrawal($id) {
        $stmt = $this->pdo->prepare("UPDATE vendors SET pendingBalance = 0 WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function verifyUser($user_id) {
        $sql  = "UPDATE vendors SET verified = 1 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }
    public function unverifyUser($user_id) {
        $sql  = "UPDATE vendors SET verified = 0 WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$user_id]);
    }

    public function authenticate($email, $password, $type, &$error) {
        $stmt = $this->pdo->prepare("SELECT * FROM vendors WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password']) && $type == 'vendor') {
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
        $stmt = $this->pdo->prepare("SELECT * FROM vendors WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addUser($data) {
        $stmt = $this->pdo->prepare("INSERT INTO vendors (first_name, last_name, email, password, shopName, phone, image_loc, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password'],
            $data['shopName'],
            $data['phone'],
            $data['imageloc'],
            $data['address'],
        ]);
        $id =  $this->pdo->lastInsertId();
        $stmt = $this->pdo->prepare("INSERT INTO vendorVerify (vendor_id, identity_doc, business_cert, tin_doc, address_proof, bank_details) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $id,
            $data['identity_doc'],
            $data['business_cert'],
            $data['tin_doc'],
            $data['address_proof'],
            $data['bank_details']
        ]);
    }

    public function updateUser($data) {
        $stmt = $this->pdo->prepare("UPDATE vendors SET first_name = ?, last_name = ?, shopName = ?, phone = ?, address = ? WHERE id = ?");
        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['shopName'],
            $data['phone'],
            $data['address'],
            $data['id']
        ]);
    }

    public function saveBank($id, $bank_details){
        $stmt = $this->pdo->prepare("UPDATE vendors SET bankName = ?, accountNumber = ?, accountName = ?, bankBranch = ? WHERE id = ?");
        return $stmt->execute([
            $bank_details['bank_name'],
            $bank_details['account_holder'],
            $bank_details['account_name'],
            $bank_details['branch'],
            $id
        ]);
    }

    public function getBank($id){
        $stmt = $this->pdo->prepare("SELECT bankName, accountNumber, accountName, bankBranch FROM vendors WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("UPDATE vendors SET status = 'inactive' WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function updateProfilePicture($vendor_id, $profilePicPath) {
        $stmt = $this->pdo->prepare("UPDATE vendors SET image_loc = ? WHERE id = ?");
        return $stmt->execute([
            $profilePicPath,
            $vendor_id
        ]);
    }

    public function getUserByID($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM vendors WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }
}

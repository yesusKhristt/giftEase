<?php
class NotificationModel
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
        $sql1 = "CREATE TABLE IF NOT EXISTS notificationsClient (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            title VARCHAR(255),
            message VARCHAR(1023),
            is_read BOOLEAN DEFAULT 0,
            href VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

        $sql2 = "CREATE TABLE IF NOT EXISTS notificationsVendor (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            title VARCHAR(255),
            message VARCHAR(1023),
            is_read BOOLEAN DEFAULT 0,
            href VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

        $sql3 = "CREATE TABLE IF NOT EXISTS notificationsAdmin (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            title VARCHAR(255),
            message VARCHAR(1023),
            is_read BOOLEAN DEFAULT 0,
            href VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

        $sql4 = "CREATE TABLE IF NOT EXISTS notificationsDelivery (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            title VARCHAR(255),
            message VARCHAR(1023),
            is_read BOOLEAN DEFAULT 0,
            href VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

        $sql5 = "CREATE TABLE IF NOT EXISTS notificationsDeliveryman (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            title VARCHAR(255),
            message VARCHAR(1023),
            is_read BOOLEAN DEFAULT 0,
            href VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

        $sql6 = "CREATE TABLE IF NOT EXISTS notificationsGiftWrapper (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            title VARCHAR(255),
            message VARCHAR(1023),
            is_read BOOLEAN DEFAULT 0,
            href VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );";

        try {
            $this->pdo->exec($sql1);
            $this->pdo->exec($sql2);
            $this->pdo->exec($sql3);
            $this->pdo->exec($sql4);
            $this->pdo->exec($sql5);
            $this->pdo->exec($sql6);
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function notifyClient($userId, $title, $message, $href)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO notificationsClient (user_id, title, message, href) VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$userId, $title, $message, $href]);
    }

    public function notifyAdmin($userId, $title, $message, $href)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO notificationsAdmin (user_id, title, href) VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$userId, $title, $message, $href]);
    }

    public function notifyVendor($userId, $title, $message, $href)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO notificationsVendor (user_id, title, message, href) VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$userId, $title, $message, $href]);
    }

    public function notifyDelivery($userId, $title, $message, $href)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO notificationsDelivery (user_id, title, message, href) VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$userId, $title, $message, $href]);
    }

    public function notifyDeliveryman($userId, $title, $message, $href)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO notificationsDeliveryman (user_id, title, message, href) VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$userId, $title, $message, $href]);
    }

    public function notifyGiftWrapper($userId, $title, $message, $href)
    {
        $stmt = $this->pdo->prepare(
            "INSERT INTO notificationsGiftWrapper (user_id, title, message, href) VALUES (?, ?, ?, ?)"
        );
        $stmt->execute([$userId, $title, $message, $href]);
    }

    public function getClientNotifications($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM notificationsClient WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAdminNotifications($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM notificationsAdmin WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getVendorNotifications($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM notificationsVendor WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDeliveryNotifications($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM notificationsDelivery WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDeliverymanNotifications($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM notificationsDeliveryman WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getGiftWrapperNotifications($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM notificationsGiftWrapper WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function viewNotificationClient($id){
        $stmt = $this->pdo->prepare("UPDATE notificationsClient SET is_read = 1 WHERE id = ?");
        $stmt->execute([$id]);
    }
}

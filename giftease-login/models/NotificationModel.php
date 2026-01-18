<?php

class NotificationModel
{
    private $pdo;

    public function __construct(?PDO $pdo = null)
    {
        if ($pdo) {
            $this->pdo = $pdo;
        } else {
            $host = 'localhost';
            $db = 'giftease';
            $user = 'root';
            $pass = '';

            try {
                $this->pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("❌ Database connection failed: " . $e->getMessage());
            }
        }

        $this->createTableIfNotExists();
    }

    private function createTableIfNotExists()
    {
        
        $sql = "CREATE TABLE IF NOT EXISTS notifications (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT NULL,
            sender_id INT NULL,
            order_id INT NULL,
            type VARCHAR(50) DEFAULT 'info',
            message TEXT NOT NULL,
            data TEXT NULL,
            is_read TINYINT(1) DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );";

        try {
            $this->pdo->exec($sql);
        } catch (PDOException $e) {
            die("Error creating notifications table: " . $e->getMessage());
        }

        
        try {
            $this->pdo->exec("ALTER TABLE notifications ADD COLUMN IF NOT EXISTS tmp INT NULL;");
            
        } catch (PDOException $e) {
           
        }
    }

    public function createNotification($userId = null, $orderId = null, $type = 'info', $message = '', $data = null, $senderId = null)
    {
        $stmt = $this->pdo->prepare("INSERT INTO notifications (user_id, sender_id, order_id, type, message, data) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $userId,
            $senderId,
            $orderId,
            $type,
            $message,
            $data ? json_encode($data) : null
        ]);
        return $this->pdo->lastInsertId();
    }

    public function getNotifications($userId, $limit = 20)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC LIMIT ?");
        $stmt->bindValue(1, $userId, PDO::PARAM_INT);
        $stmt->bindValue(2, (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as &$r) {
            if ($r['data']) {
                $r['data'] = json_decode($r['data'], true);
            }
        }
        return $rows;
    }

    public function getUnreadCount($userId)
    {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) as cnt FROM notifications WHERE user_id = ? AND is_read = 0");
        $stmt->execute([$userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$row['cnt'];
    }

    public function markAsRead($id)
    {
        $stmt = $this->pdo->prepare("UPDATE notifications SET is_read = 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function markAllRead($userId)
    {
        $stmt = $this->pdo->prepare("UPDATE notifications SET is_read = 1 WHERE user_id = ?");
        return $stmt->execute([$userId]);
    }

    public function deleteNotification($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM notifications WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

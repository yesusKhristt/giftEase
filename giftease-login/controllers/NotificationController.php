<?php
require_once __DIR__ . '/../models/NotificationModel.php';

class NotificationController
{
    private $notifications;

    public function __construct(PDO $pdo)
    {
        $this->notifications = new NotificationModel($pdo);
    }

        public function list()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }
        $userId = $_SESSION['user']['id'];
        $data = $this->notifications->getNotifications($userId, 50);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    
    public function count()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            echo json_encode(['count' => 0]);
            return;
        }
        $userId = $_SESSION['user']['id'];
        $cnt = $this->notifications->getUnreadCount($userId);
        header('Content-Type: application/json');
        echo json_encode(['count' => $cnt]);
    }

    
    public function markRead()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }
        $id = $_POST['id'] ?? null;
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing id']);
            return;
        }
        $this->notifications->markAsRead($id);
        echo json_encode(['success' => true]);
    }

    
    public function markAllRead()
    {
        session_start();
        if (!isset($_SESSION['user'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            return;
        }
        $userId = $_SESSION['user']['id'];
        $this->notifications->markAllRead($userId);
        echo json_encode(['success' => true]);
    }

    
    public function create()
    {
        session_start();
        
        $userId = $_POST['user_id'] ?? null;
        $orderId = $_POST['order_id'] ?? null;
        $type = $_POST['type'] ?? 'info';
        $message = $_POST['message'] ?? '';
        $data = $_POST['data'] ?? null;

        if (!$userId || !$message) {
            http_response_code(400);
            echo json_encode(['error' => 'Missing user_id or message']);
            return;
        }

        $this->notifications->createNotification($userId, $orderId, $type, $message, $data);
        echo json_encode(['success' => true]);
    }
}

<?php 
require_once __DIR__ . '/../models/OrderModel.php';
require_once __DIR__ . '/../models/NotificationModel.php';

class OrderController
{
    private $orderModel;
    private $notificationModel;

    public function __construct($pdo)
    {
        $this->orderModel = new OrderModel($pdo);
        $this->notificationModel = new NotificationModel($pdo);
    
    }

    public function confirm()
    {
        session_start();
        if (!isset($_SESSION['user'])){
            die("Unauthorized access.");
        }

        if (!isset($POST['made'], $_POST['wrap_id'], $_POST['cartIteams'])) {
            die("Invalid order data.");    
        }

        $data = [
            'client_id' => $_SESSION['user']['client_id'],
            'mode' => $_POST['made'],
            'cartItems' => $_POST['cartItems']
        ];

        $wrap_id = $_POST['wrap_id'];

        $orderId = $this->orderModel->confirmOrder($data, $wrap_id);

        $adminUserId = 1;

        $message = "🛒 New order placed (Order ID: #$orderId)";

        $this->notificationModel->createNotification(
            $adminUserId,    
            $orderId,         
            'info',          
            $message,         
            ['order_id' => $orderId], 
            $_SESSION['user']['id']   
        );

        
        header("Location: /GiftEase/order-success.php");
        exit;
    }
}
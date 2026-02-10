<?php
class DeliveryController {
    private $delivery;
    private $notification;

    public function __construct($pdo) {
        require_once __DIR__ . '/../models/DeliveryModel.php';
        require_once __DIR__ . '/../models/NotificationModel.php';
        $this->notification = new NotificationModel($pdo);
        $this->delivery = new DeliveryModel($pdo);
    }

    public function dashboard() {
        if (!$this->delivery->getUserByEmail($_SESSION['user']['email'])) {
            header("Location: index.php?controller=auth&action=handleLogin&type=staff");
            exit;
        }
        global $pdo;
        $path = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Delivery($parts);
    }

    public function allOrder($parts) {
        $orders = $this->delivery->getAllOrders();
        require_once __DIR__ . '/../views/Dashboards/Delivery/allOrders.php';
    }

    public function assignedOrder($parts) {
        $myOrders = $this->delivery->getAssignedOrders($_SESSION['user']['id']);
        require_once __DIR__ . '/../views/Dashboards/Delivery/assignedOrders.php';
    }

    public function acceptOrder($parts) {
        $order_id = $parts[2];
        $this->delivery->acceptOrder($order_id, $_SESSION['user']['id']);

        $notificationTitle = "Order picked up for Delivery!";
        $notificationMessege = "Your Order was picked up by ".$_SESSION['user']['first_name'].' '.$_SESSION['user']['last_name'];
        $href = "?controller=client&action=dashboard/messeges/delivery/view/".$_SESSION['user']['id']."/direct";
        $this->notification->notifyClient($_SESSION['user']['id'], $notificationTitle, $notificationMessege, $href);
        header("Location: index.php?controller=delivery&action=dashboard/assignedOrder");
        exit;
    }

    public function markComplete($parts) {

        $this->delivery->markComplete($parts[2]);
        header("Location: index.php?controller=delivery&action=dashboard/proof");
        exit;
    }

    public function cancelOrder($parts) {

        $this->delivery->cancelOrder($parts[2]);
        header("Location: index.php?controller=delivery&action=dashboard/assignedOrder");
        exit;
    }

    public function Delivery($parts) {
        switch ($parts[1]) {
            case 'profile':
                $deliveryId = $_SESSION['user']['id'];
                $deliveryProfile = $this->delivery->getDeliveryById($deliveryId);
                $profileStats = $this->delivery->getProfileStats($deliveryId);
                require_once __DIR__ . '/../views/Dashboards/Delivery/profile.php';
                break;
            case 'history':
                $this->history();
                break;
            case 'map':
                require_once __DIR__ . '/../views/Dashboards/Delivery/map.php';
                break;
            case 'allOrder':
                $this->allOrder($parts);
                break;
            case 'assignedOrder':
                $this->assignedOrder($parts);
                break;
            case 'markComplete':
                $this->markComplete($parts);
                break;
            case 'acceptOrder':
                $this->acceptOrder($parts);
                break;
            case 'cancelOrder':
                $this->cancelOrder($parts);
                break;
            case 'proof':
                require_once __DIR__ . '/../views/Dashboards/Delivery/proof.php';
                break;
            case 'settings':
                $deliveryId = $_SESSION['user']['id'];
                $deliveryProfile = $this->delivery->getDeliveryById($deliveryId);
                require_once __DIR__ . '/../views/Dashboards/Delivery/Settings.php';
                break;
            default:
                $deliveryId = $_SESSION['user']['id'];
                $dashboardStats = $this->delivery->getDashboardStats($deliveryId);
                require_once __DIR__ . '/../views/Dashboards/Delivery/home.php';
                break;
        }
    }
    public function handleLogout() {
        $_SESSION['delivery'] = null;
        header("Location: index.php?controller=auth&action=handleLogout");
        exit;
    }
    public function editProfile() {
        // Logic to handle profile editing
        $USER_ID = $_SESSION['user']['id'];
        $stmt1 = $this->delivery->getpdo()->prepare("SELECT * FROM users WHERE id = ?");
        $stmt2 = $this->delivery->getpdo()->prepare("SELECT * FROM delivery WHERE user_id = ?");
        $stmt1->execute([$USER_ID]);
        $user1 = $stmt1->fetch();
        $stmt2->execute([$USER_ID]);
        $user2 = $stmt2->fetch();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $FIRST_NAME = $_POST['first_name'] ?? '';
            $LAST_NAME = $_POST['last_name'] ?? '';
            $PHONE = $_POST['phone'] ?? '';
            $ADDRESS = $_POST['address'] ?? '';


            $this->delivery->updateUser($USER_ID, $FIRST_NAME, $LAST_NAME, $PHONE, $ADDRESS);
            header("Location: index.php?controller=delivery&action=dashboard/account");
            exit;

                
        }
        require_once __DIR__ . '/../views/Dashboards/Delivery/edit.php';
    }
public function history() {
    $filters = [
        'dateFrom' => $_GET['dateFrom'] ?? '',
        'dateTo'   => $_GET['dateTo'] ?? '',
        'status'   => $_GET['status'] ?? 'all',
        'customer' => $_GET['customer'] ?? ''
    ];

    // Get delivery history from database
    $delivery_id = $_SESSION['user']['id'];
    $allHistory = $this->delivery->getDeliveryHistory($delivery_id, $filters);

    // Process the data for display
    $history = array_map(function($row) {
        return [
            'id' => 'ORD-' . str_pad($row['id'], 3, '0', STR_PAD_LEFT),
            'customer_name' => $row['first_name'] . ' ' . $row['last_name'],
            'product_name' => $row['product_names'] ?? 'N/A',
            'delivery_date' => $row['deliveryDate'],
            'status' => $row['is_delivered'] ? 'delivered' : 'pending',
            'earnings' => 'Rs.' . number_format($row['deliveryPrice'], 2),
            'rating' => 'N/A',
            'distance' => 'N/A'
        ];
    }, $allHistory);

    // Apply status filter if needed
    if ($filters['status'] !== 'all') {
        $history = array_filter($history, function($item) use ($filters) {
            return $item['status'] === $filters['status'];
        });
    }

    require_once __DIR__ . '/../views/Dashboards/Delivery/history.php';
}
}

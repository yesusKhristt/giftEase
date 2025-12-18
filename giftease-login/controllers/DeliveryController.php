<?php
class DeliveryController
{
    private $delivery;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/DeliveryModel.php';
        $this->delivery = new DeliveryModel($pdo);
    }

    public function dashboard()
    {
        if (!$this->delivery->getUserByEmail($_SESSION['user']['email'])) {
            header("Location: index.php?controller=auth&action=handleLogin&type=staff");
            exit;
        }
        global $pdo;
        $path = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Delivery($parts);
    }

    public function allOrder($parts)
    {
        $orders = $this->delivery->getAllOrders();
        require_once __DIR__ . '/../views/Dashboards/Delivery/allOrders.php';
    }

    public function assignedOrder($parts)
    {
        $myOrders = $this->delivery->getAssignedOrders($_SESSION['user']['id']);
        require_once __DIR__ . '/../views/Dashboards/Delivery/assignedOrders.php';
    }

    public function acceptOrder($parts)
    {

        $this->delivery->acceptOrder($parts[2], $_SESSION['user']['id']);
        header("Location: index.php?controller=delivery&action=dashboard/assignedOrder");
        exit;
    }

    public function markComplete($parts)
    {

        $this->delivery->markComplete($parts[2]);
        header("Location: index.php?controller=delivery&action=dashboard/proof");
        exit;
    }

    public function cancelOrder($parts)
    {

        $this->delivery->cancelOrder($parts[2]);
        header("Location: index.php?controller=delivery&action=dashboard/assignedOrder");
        exit;
    }

    public function Delivery($parts)
    {
        switch ($parts[1]) {
            case 'profile':
                require_once __DIR__ . '/../views/Dashboards/Delivery/profile.php';
                break;
            case 'history':
                require_once __DIR__ . '/../views/Dashboards/Delivery/history.php';
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
                require_once __DIR__ . '/../views/Dashboards/Delivery/Settings.php';
                break;
            default:
                require_once __DIR__ . '/../views/Dashboards/Delivery/home.php';
                break;
        }
    }
    public function handleLogout()
    {
        $_SESSION['delivery'] = null;
        header("Location: index.php?controller=auth&action=handleLogout");
        exit;

    }
    public function editProfile()
    {
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


            $this->delivery->updateDelivery($USER_ID, $FIRST_NAME, $LAST_NAME, $PHONE, $ADDRESS);
            header("Location: index.php?controller=delivery&action=dashboard/account");
            exit;

            // Redirect or show a success message
        }
        require_once __DIR__ . '/../views/Dashboards/Delivery/edit.php';
    }


}
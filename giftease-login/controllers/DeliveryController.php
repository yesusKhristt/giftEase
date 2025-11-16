<?php
class DeliveryController
{
    private $delivery;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/DeliveryModel.php';
        $this->delivery = new DeliveryModel($pdo);
    }





    public function checkID()
    {

        $exists = $this->delivery->getDeliveryID($_SESSION['user']['id']);

        if (!$exists) {
            $this->employeeForm($_SESSION['user']['id']);
        } else {
            header("Location: index.php?controller=delivery&action=dashboard/primary");
            exit;
        }

    }

    public function employeeForm($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $phone = $_POST['phone'] ?? '';
            $vehicleNumber = $_POST['vehiclePlate'] ?? '';
            $address = $_POST['address'] ?? '';

            $this->delivery->addDelivery($user_id, $vehicleNumber, $phone, $address);
            header("Location: index.php?controller=delivery&action=dashboard/primary");
            exit;
        }
        require_once __DIR__ . '/../views/commonElements/extendedFrom.php';
    }

   
    public function dashboard()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'delivery') {
            header("Location: index.php?controller=auth&action=handleLogin&type=staff");
            exit;
        }
        global $pdo;
        $path = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Delivery($parts);
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
            case 'notification':
                require_once __DIR__ . '/../views/Dashboards/Delivery/notification.php';
                break;
            case 'order':
                require_once __DIR__ . '/../views/Dashboards/Delivery/order.php';
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
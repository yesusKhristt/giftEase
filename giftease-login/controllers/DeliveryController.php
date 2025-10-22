<?php
class DeliveryController
{
     private $model;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/DeliveryModel.php';
        $this->model = new DeliveryModel($pdo);
    }



    public function checkID()
    {
        $user = $_SESSION['user'];
        $user_id = $user['id'];

        $stmt = $this->model->getpdo()->prepare("SELECT COUNT(*) FROM delivery WHERE user_id = ?");
        $stmt->execute([$user_id]);

        $exists = (int)$stmt->fetchColumn();
        var_dump($exists);

        if (!$exists) {
            $this->deliveryForm($user_id);
        } else {
            header("Location: index.php?controller=delivery&action=dashboard/primary");
            exit;
        }

    }

    public function deliveryForm($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $FIRST_NAME = $_POST['first_name'] ?? '';
            $LAST_NAME = $_POST['last_name'] ?? '';
            $PHONE = $_POST['phone'] ?? '';
            $ADDRESS = $_POST['address'] ?? '';
            

            $this->model->addDelivery($user_id, $FIRST_NAME, $LAST_NAME, $PHONE, $ADDRESS );
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
    public function editProfile() 
    {
        // Logic to handle profile editing
        $USER_ID = $_SESSION['user']['id'];
        $stmt1 = $this->model->getpdo()->prepare("SELECT * FROM users WHERE id = ?");
        $stmt2 = $this->model->getpdo()->prepare("SELECT * FROM delivery WHERE user_id = ?");
        $stmt1->execute([$USER_ID]);
        $user1 = $stmt1->fetch();
        $stmt2->execute([$USER_ID]);
        $user2 = $stmt2->fetch();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $FIRST_NAME = $_POST['first_name'] ?? '';
            $LAST_NAME = $_POST['last_name'] ?? '';
            $PHONE = $_POST['phone'] ?? '';
            $ADDRESS = $_POST['address'] ?? '';
            

            $this->model->updateDelivery($USER_ID, $FIRST_NAME, $LAST_NAME, $PHONE, $ADDRESS);
        header("Location: index.php?controller=delivery&action=dashboard/account");
            exit;

            // Redirect or show a success message
        }
        require_once __DIR__ . '/../views/Dashboards/Delivery/edit.php';
    }


}
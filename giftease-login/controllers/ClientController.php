<?php
class ClientController
{
    private $model;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/ClientModel.php';
        $this->model = new ClientModel($pdo);
    }



    public function checkID()
    {
        $user = $_SESSION['user'];
        $user_id = $user['id'];

        $stmt = $this->model->getpdo()->prepare("SELECT COUNT(*) FROM clients WHERE user_id = ?");
        $stmt->execute([$user_id]);

        $exists = (int)$stmt->fetchColumn();
        var_dump($exists);

        if (!$exists) {
            $this->clientForm($user_id);
        } else {
            header("Location: index.php?controller=client&action=dashboard/primary");
            exit;
        }

    }

    public function clientForm($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $FIRST_NAME = $_POST['first_name'] ?? '';
            $LAST_NAME = $_POST['last_name'] ?? '';
            $PHONE = $_POST['phone'] ?? '';
            $ADDRESS = $_POST['address'] ?? '';
            $EMAIL = $_POST['email'] ?? '';

            $this->model->addClient($user_id, $FIRST_NAME, $LAST_NAME, $PHONE, $ADDRESS, $EMAIL);
            header("Location: index.php?controller=client&action=dashboard/primary");
            exit;
        }
        require_once __DIR__ . '/../views/commonElements/extendedFrom.php';
    }
    public function dashboard()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'client') {
            header("Location: index.php?controller=auth&action=handleLogin&type=client");
            exit;
        }
        global $pdo;
        $path = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Client($parts[1]);
    }
    public function Client($parts)
    {
        switch ($parts) {
            case 'cart':
                require_once __DIR__ . '/../views/Dashboards/Client/cart.php';
                break;
            case 'wishlist':
                require_once __DIR__ . '/../views/Dashboards/Client/wishlist.php';
                break;
            case 'tracking':
                require_once __DIR__ . '/../views/Dashboards/Client/trackorder.php';
                break;
            case 'history':
                require_once __DIR__ . '/../views/Dashboards/Client/history.php';
                break;
            case 'customize':
                require_once __DIR__ . '/../views/Dashboards/Client/customize.php';
                break;
            case 'payment':
                require_once __DIR__ . '/../views/Dashboards/Client/payment.php';
                break;
            case 'account':
                require_once __DIR__ . '/../views/Dashboards/Client/account.php';
                break;
            case 'settings':
                require_once __DIR__ . '/../views/Dashboards/Client/settings.php';
                break;
            case 'viewitem':
                require_once __DIR__ . '/../views/Dashboards/Client/ViewItem.php';
                break;
        
            case 'Checkout':
                require_once __DIR__ . '/../views/Dashboards/Client/checkout.php';
                break;
            default:
                require_once __DIR__ . '/../views/Dashboards/Client/Browseitems.php';
                break;
        }
    }

    public function editProfile() 
    {
        // Logic to handle profile editing
        $USER_ID = $_SESSION['user']['id'];
        $stmt1 = $this->model->getpdo()->prepare("SELECT * FROM users WHERE id = ?");
        $stmt2 = $this->model->getpdo()->prepare("SELECT * FROM clients WHERE user_id = ?");
        $stmt1->execute([$USER_ID]);
        $user1 = $stmt1->fetch();
        $stmt2->execute([$USER_ID]);
        $user2 = $stmt2->fetch();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $FIRST_NAME = $_POST['first_name'] ?? '';
            $LAST_NAME = $_POST['last_name'] ?? '';
            $PHONE = $_POST['phone'] ?? '';
            $ADDRESS = $_POST['address'] ?? '';
            $EMAIL = $_POST['email'] ?? '';

            $this->model->updateClient($USER_ID, $FIRST_NAME, $LAST_NAME, $PHONE, $ADDRESS, $EMAIL);
        header("Location: index.php?controller=client&action=dashboard/account");
            exit;

            // Redirect or show a success message
        }
        require_once __DIR__ . '/../views/Dashboards/Client/edit.php';
    }


    public function addProduct()
    {
        require_once __DIR__ . "controllers/ProductController.php";
        $prodController = new ProductController($this->model->getpdo());
        $error = '';
        $success = '';

        $prodController->addProduct();
    }
}
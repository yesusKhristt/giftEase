<?php
class AdminController
{
    private $giftWrapping;
    private $giftWrapper;
    private $category;
    private $deliveryman;
    private $delivery;
    private $admin;
    private $vendor;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/CategoryModel.php';
        require_once __DIR__ . '/../models/GiftWrappingModel.php';
        require_once __DIR__ . '/../models/GiftWrapperModel.php';
        require_once __DIR__ . '/../models/DeliveryModel.php';
        require_once __DIR__ . '/../models/DeliverymanModel.php';
        require_once __DIR__ . '/../models/AdminModel.php';
        require_once __DIR__ . '/../models/VendorModel.php';
        $this->giftWrapping = new GiftWrappingModel($pdo);
        $this->giftWrapper = new GiftWrapperModel($pdo);
        $this->category = new CategoryModel($pdo);
        $this->deliveryman = new DeliverymanModel($pdo);
        $this->delivery = new DeliveryModel($pdo);
        $this->admin = new AdminModel($pdo);
        $this->vendor = new VendorModel($pdo);
    }


    public function dashboard()
    {
        if (!$this->admin->getUserByEmail($_SESSION['user']['email'])) {
            header("Location: index.php?controller=auth&action=handleLogin&type=staff");
            exit;
        }
        global $pdo;
        $path = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Admin($parts[1]);
    }
    public function Admin($parts)
    {
        switch ($parts[1]) {
            case 'customer':
                $this->clients($parts);
                break;
            case 'delivery':
                $this->delivery($parts);
                break;
            case 'deliveryman':
                $this->deliveryman($parts);
                break;
            case 'items':
                require_once __DIR__ . '/../views/Dashboards/Admin/items new.php';
                break;
            case 'reports':
                require_once __DIR__ . '/../views/Dashboards/Admin/reports nesw.php';
                break;
            case 'settings':
                require_once __DIR__ . '/../views/Dashboards/Admin/settings new.php';
                break;
            case 'Admin':
                require_once __DIR__ . '/../views/Dashboards/Admin/Admins.php';
                break;
            case 'profile':
                require_once __DIR__ . '/../views/Dashboards/Admin/profile.php';
                break;
            case 'vendor':
                $this->vendors($parts);
                break;
            case 'category':
                $this->addCategory($parts);
                break;
            case 'addGiftWrappingItems':
                $this->addGiftWrappingItems($parts);
                break;
            case 'editGiftWrappingItems':
                $this->editGiftWrappingItems($parts);
                break;
            case 'reports':
                $this->reports($parts);
                break;
            default:
                require_once __DIR__ . '/../views/Dashboards/Admin/front.php';
                break;
        }
    }
}
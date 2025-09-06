<?php
class VendorController
{
    private $model;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/VendorModel.php';
        $this->model = new VendorModel($pdo);
    }



    public function checkID()
    {
        $user = $_SESSION['user'];
        $user_id = $user['id'];

        $stmt = $this->model->getpdo()->prepare("SELECT COUNT(*) FROM vendors WHERE user_id = ?");
        $stmt->execute([$user_id]);

        $exists = (int)$stmt->fetchColumn();
        var_dump($exists);

        if (!$exists) {
            $this->employeeForm($user_id);
        } else {
            header("Location: index.php?controller=vendor&action=dashboard/primary");
            exit;
        }

    }

    public function employeeForm($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $phone = $_POST['phone'] ?? '';
            $shopname = $_POST['shopName'] ?? '';
            $address = $_POST['address'] ?? '';

            $this->model->addVendor($user_id, $shopname, $phone, $address);
            header("Location: index.php?controller=vendor&action=dashboard/primary");
            exit;
        }
        require_once __DIR__ . '/../views/commonElements/extendedFrom.php';
    }
    public function dashboard()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'vendor') {
            header("Location: index.php?controller=auth&action=handleLogin&type=staff");
            exit;
        }
        global $pdo;
        $path = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Vendor($parts[1]);
    }


    public function Vendor($parts)
    {
        switch ($parts) {
            case 'inventory':
                require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardInventory.php';
                break;
            case 'messages':
                require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardMesseges.php';
                break;
            case 'analysis':
                require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardAnalysis.php';
                break;
            case 'profile':
                require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardProfile.php';
                break;
            case 'history':
                require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardHistory.php';
                break;
            case 'settings':
                require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardSettings.php';
                break;
            case 'viewitem':
                require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardViewItem.php';
                break;
            case 'vieworder':
                require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardViewOrder.php';
                break;
            case 'edititem':
                require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardEditItem.php';
                break;
            default:
                require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardOrders.php';
                break;
        }
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
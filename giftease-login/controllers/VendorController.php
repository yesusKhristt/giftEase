<?php
class VendorController
{
    private $vendor;
    private $product;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/VendorModel.php';
        // require_once __DIR__ . '/../models/ProductsModel.php';
        $this->vendor = new VendorModel($pdo);
        // $this->product = new ProductsModel($pdo);
    }

    public function checkID()
    {
        $user = $_SESSION['user'];
        $user_id = $user['id'];

        $stmt = $this->vendor->getpdo()->prepare("SELECT COUNT(*) FROM vendors WHERE user_id = ?");
        $stmt->execute([$user_id]);

        $exists = (int) $stmt->fetchColumn();
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

            $this->vendor->addVendor($user_id, $shopname, $phone, $address);
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

        $this->Vendor($parts);
    }

    public function handleitems($parts)
    {
        switch ($parts[2]) {
            case 'view':
                require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardViewItem.php';
                break;
            case 'edit':
                $this->editItem($parts);
                break;
            case 'add':
                $this->addItem($parts);
                break;
        }
    }


    public function editItem($parts)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $phone = $_POST['phone'] ?? '';
            $shopname = $_POST['shopName'] ?? '';
            $address = $_POST['address'] ?? '';

            //$this->vendor->addVendor($user_id, $shopname, $phone, $address);
            header("Location: index.php?controller=vendor&action=dashboard/primary");
            exit;
        }
        require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardEditItem.php';
    }

    public function addItem($parts)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $category = $_POST['category'];
            $subcategory = $_POST['subcategory'];
            $price = $_POST['price'];
            $description = $_POST['description'];

            // Handle file upload if user selected a new image
            $profilePicPath = null;
            if (!empty($_FILES['profile_pic']['name'])) {
                $uploadDir = "resources/uploads/vendor/items"; // folder to save images
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $fileName = time() . "_" . basename($_FILES['profile_pic']['name']);
                $targetFile = $uploadDir . $fileName;

                // Move uploaded file to target folder
                if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $targetFile)) {
                    $profilePicPath = $targetFile;
                }
            }

            // Update query
            if ($profilePicPath) {
                // update including profile picture
                $this->product->addProduct();

            } else {
                $this->product->addProduct();
                // update without changing profile picture
            }

            echo "Profile updated successfully!";
        }
        require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardEditItem.php';
    }


    public function Vendor($parts)
    {
        switch ($parts[1]) {
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
            case 'item':
                $this->handleitems($parts);
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
}
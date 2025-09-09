<?php
class VendorController
{
    private $vendor;
    private $product;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/VendorModel.php';
        require_once __DIR__ . '/../models/ProductsModel.php';
        $this->vendor = new VendorModel($pdo);
        $this->product = new ProductsModel($pdo);
    }

    public function checkID()
    {

        $exists = $this->vendor->getVendorID($_SESSION['user']['id']);
        var_dump($exists);

        if (!$exists) {
            $this->employeeForm($_SESSION['user']['id']);
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
                $this->viewItem($parts);
                break;
            case 'edit':
                $this->handleItem($parts);
                break;
            case 'add':
                $this->handleItem($parts);
                break;
        }
    }

    public function viewItem($parts)
    {
        $productId = $parts[3];
        $productDetails = $this->product->fetchProduct($productId);
        require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardViewItem.php';
    }


    public function handleItem($parts)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $category = $_POST['category'];
            $subcategory = $_POST['subcategory'];
            $price = $_POST['price'];
            $description = $_POST['description'];

            // Handle file upload if user selected a new image
            $profilePicPath = []; // start with empty array

            foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                $uploadDir = "resources/uploads/vendor/products/";
                $fileName = time() . "_" . basename($_FILES['images']['name'][$key]);
                $targetFile = $uploadDir . $fileName;

                if (move_uploaded_file($tmpName, $targetFile)) {
                    // store the uploaded file path in array
                    $profilePicPath[] = $fileName;
                }
            }
            //$this->test($this->vendor->getVendorID($_SESSION['user']['id']), $title, $price, $description, $category, $subcategory, $profilePicPath);

            switch ($parts[2]) {
                case 'add':
                    $this->product->addProduct($this->vendor->getVendorID($_SESSION['user']['id']), $title, $price, $description, $category, $subcategory, $profilePicPath);
                    break;
                case 'edit':
                    $this->product->editProduct($parts[3], $title, $price, $description, $category, $subcategory, $profilePicPath);
                    break;
            }


        }
        if ($parts[2] == 'edit') {
            $productId = $parts[3];
            $productDetails = $this->product->fetchProduct($productId);
        }
        require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardEditItem.php';
    }

    public function test($user_id, $title, $price, $description, $category, $subcategory, $profilePicPath)
    {
        require_once __DIR__ . '/../views/Dashboards/Vendor/test.php';
    }

    public function showInventory($parts)
    {
        $allProducts = $this->product->fetchAll($this->vendor->getVendorID($_SESSION['user']['id']));
        require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardInventory.php';
    }


    public function Vendor($parts)
    {
        switch ($parts[1]) {
            case 'inventory':
                $this->showInventory($parts);
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
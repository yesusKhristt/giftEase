<?php
class VendorController
{
    private $vendor;
    private $product;
    private $category;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/VendorModel.php';
        require_once __DIR__ . '/../models/ProductsModel.php';
        require_once __DIR__ . '/../models/CategoryModel.php';
        $this->vendor = new VendorModel($pdo);
        $this->product = new ProductsModel($pdo);
        $this->category = new CategoryModel($pdo);
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
            case 'delete':
                $this->deleteItem($parts);
                break;

        }
    }

    public function viewItem($parts)
    {
        $productId = $parts[3];
        $productDetails = $this->product->fetchProduct($productId);
        require_once __DIR__ . '/../views/Dashboards/Vendor/ViewItem.php';
    }

    public function deleteItem($parts)
    {
        $productId = $parts[3];
        $this->product->deleteProduct($productId);
        header("Location: index.php?controller=vendor&action=dashboard/inventory");
        exit;
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
                    $productID = $this->product->addProduct($this->vendor->getVendorID($_SESSION['user']['id']), $title, $price, $description, $category, $subcategory, $profilePicPath);
                    header("Location: index.php?controller=vendor&action=dashboard/item/view/$productID");
                    exit;
                case 'edit':
                    $this->product->editProduct(
                        $parts[3],       // product ID
                        $title,
                        $price,
                        $description,
                        $category,
                        $subcategory,
                        $profilePicPath
                    );
                    header("Location: index.php?controller=vendor&action=dashboard/item/view/" . urlencode($parts[3]));
                    exit;
                case 'edit2':
                    if ($profilePicPath == null) {
                        $profilePicPath = $this->product->fetchProductPic($parts[3]);
                    }
                    require_once __DIR__ . '/../views/Dashboards/Vendor/test.php';
            }
        }
        if ($parts[2] == 'edit') {
            $productId = $parts[3];
            $productDetails = $this->product->fetchProduct($productId);
        }
        $categories = $this->category->getCategory();
        $subcategories = $this->category->getAllSubcategory();
        require_once __DIR__ . '/../views/Dashboards/Vendor/EditItem.php';
    }

    public function ajaxCategory()
    {
        $categoryId = intval($_POST['category_id'] ?? 0);

        $subcategories = $this->category->getSubcategory($categoryId);

        header('Content-Type: application/json');
        echo json_encode($subcategories);

    }

    public function test($profilePicPath)
    {
        require_once __DIR__ . '/../views/Dashboards/Vendor/test.php';
    }

    public function showInventory($parts)
    {
        $allProducts = $this->product->fetchAllfromVendor($this->vendor->getVendorID($_SESSION['user']['id']));
        require_once __DIR__ . '/../views/Dashboards/Vendor/Inventory.php';
    }

    public function manageInventory($parts)
    {
        $products = $this->product->fetchAllfromVendor($this->vendor->getVendorID($_SESSION['user']['id']));
        $stock = $parts[2] ?? 'NULL';
        if ($stock === 'Total') {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $product_id = $_POST['productId'];
                $quantity = $_POST['quantity'];
                $state = $_GET['state'];
                if ($state === 'add') {
                    $this->product->addStock($product_id, $quantity);
                } else if ($state === 'sub') {
                    $this->product->substractStock($product_id, $quantity);
                }
                header("Location: index.php?controller=vendor&action=dashboard/manageInventory");
                exit;
            }
        } else if ($stock === 'Reserved') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $product_id = $_POST['productId'];
                $quantity = $_POST['quantity'];
                $state = $_GET['state'];
                if ($state === 'add') {
                    $this->product->addReserved($product_id, $quantity);
                } else if ($state === 'sub') {
                    $this->product->substractReserved($product_id, $quantity);
                }
                header("Location: index.php?controller=vendor&action=dashboard/manageInventory");
                exit;
            }
        }
        require_once __DIR__ . '/../views/Dashboards/Vendor/manageInventory.php';
    }


    public function Vendor($parts)
    {
        switch ($parts[1]) {
            case 'inventory':
                $this->showInventory($parts);
                break;
            case 'manageInventory':
                $this->manageInventory($parts);
                break;
            case 'getCategory':
                $this->ajaxCategory();
                break;
            case 'messages':
                require_once __DIR__ . '/../views/Dashboards/Vendor/Messeges.php';
                break;
            case 'analysis':
                require_once __DIR__ . '/../views/Dashboards/Vendor/Analysis.php';
                break;
            case 'profile':
                require_once __DIR__ . '/../views/Dashboards/Vendor/Profile.php';
                break;
            case 'history':
                require_once __DIR__ . '/../views/Dashboards/Vendor/History.php';
                break;
            case 'settings':
                require_once __DIR__ . '/../views/Dashboards/Vendor/Settings.php';
                break;
            case 'item':
                $this->handleitems($parts);
                break;
            case 'vieworder':
                require_once __DIR__ . '/../views/Dashboards/Vendor/ViewOrder.php';
                break;
            case 'edititem':
                require_once __DIR__ . '/../views/Dashboards/Vendor/EditItem.php';
                break;
            default:
                require_once __DIR__ . '/../views/Dashboards/Vendor/Orders.php';
                break;
        }
    }
}
<?php
class VendorController {
    private $vendor;
    private $product;
    private $category;
    private $messeges;
    private $ratings;

    public function __construct($pdo) {
        require_once __DIR__ . '/../models/VendorModel.php';
        require_once __DIR__ . '/../models/ProductsModel.php';
        require_once __DIR__ . '/../models/CategoryModel.php';
        require_once __DIR__ . '/../models/MessegesModel.php';
        require_once __DIR__ . '/../models/RatingModel.php';
        $this->vendor   = new VendorModel($pdo);
        $this->product  = new ProductsModel($pdo);
        $this->category = new CategoryModel($pdo);
        $this->messeges = new MessegesModel($pdo);
        $this->ratings  = new RatingModel($pdo);
    }

    public function dashboard() {
        if (! $this->vendor->getUserByEmail($_SESSION['user']['email'])) {
            header("Location: index.php?controller=auth&action=handleLogin&type=staff");
            exit;
        }
        global $pdo;
        $path  = $_GET['action'];
        $path  = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Vendor($parts);
    }

    public function handleitems($parts) {
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

    public function viewItem($parts) {
        $productId      = $parts[3];
        $productDetails = $this->product->fetchProduct($productId);
        require_once __DIR__ . '/../views/Dashboards/Vendor/ViewItem.php';
    }

    public function deleteItem($parts) {
        $productId = $parts[3];
        $this->product->deleteProduct($productId);
        header("Location: index.php?controller=vendor&action=dashboard/inventory");
        exit;
    }

    public function messeges($parts) {
        $client_id = $parts[3] ?? '';

        if ($parts[2] === 'send') {
            $message = trim($_POST['message'] ?? '');

            if ($message === '' && empty($_FILES['attachments']['name'][0])) {
                echo json_encode(['success' => false, 'error' => 'Empty message']);
                exit;
            }

            $attatchmentPath = [];

            if (! empty($_FILES['attachments']['tmp_name'])) {

                $uploadDir = "resources/uploads/vendor/attatchments/";
                if (! is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                foreach ($_FILES['attachments']['tmp_name'] as $key => $tmpName) {

                    $fileName   = time() . "_" . basename($_FILES['attachments']['name'][$key]);
                    $targetFile = $uploadDir . $fileName;

                    if (move_uploaded_file($tmpName, $targetFile)) {
                        $attatchmentPath[] = $fileName;
                    }
                }
            }

            $this->messeges->sendVendorMessege(
                $client_id,
                $_SESSION['user']['id'],
                [
                    'message'      => $message,
                    'attatchments' => $attatchmentPath,
                ],
                0
            );

            echo json_encode(['success' => true]);
            exit;
        }
        if ($parts[2] === 'view') {
            $myMessages = $this->messeges->getMessageVendor($_SESSION['user']['id']);
            require_once __DIR__ . '/../views/Dashboards/Vendor/Messeges.php';
        }
    }

    public function handleItem($parts) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title       = $_POST['title'];
            $category    = $_POST['category'];
            $title       = $_POST['title'];
            $category    = $_POST['category'];
            $subcategory = $_POST['subcategory'];
            $price       = $_POST['price'];
            $price       = $_POST['price'];
            $description = $_POST['description'];
            $deliverable = $_POST['hours24'];
            $deliverable = $_POST['hours24'];

                                  // Handle file upload if user selected a new image
            $profilePicPath = []; // start with empty array

            foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                $uploadDir = "resources/uploads/vendor/products/";
                if (! is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $fileName   = time() . "_" . basename($_FILES['images']['name'][$key]);
                if (! is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $fileName   = time() . "_" . basename($_FILES['images']['name'][$key]);
                $targetFile = $uploadDir . $fileName;

                if (move_uploaded_file($tmpName, $targetFile)) {
                    // store the uploaded file path in array
                    $profilePicPath[] = $fileName;
                }
            }
            //$this->test($this->vendor->getVendorID($_SESSION['user']['id']), $title, $price, $description, $category, $subcategory, $profilePicPath);

            switch ($parts[2]) {
                case 'add':
                    $productID = $this->product->addProduct($_SESSION['user']['id'], $title, $price, $description, $category, $subcategory, $profilePicPath, $deliverable);
                    header("Location: index.php?controller=vendor&action=dashboard/item/view/$productID");
                    exit;
                    $productID = $this->product->addProduct($_SESSION['user']['id'], $title, $price, $description, $category, $subcategory, $profilePicPath, $deliverable);
                    header("Location: index.php?controller=vendor&action=dashboard/item/view/$productID");
                    exit;
                case 'edit':
                    $this->product->editProduct(
                        $parts[3], // product ID
                        $title,
                        $price,
                        $description,
                        $category,
                        $subcategory,
                        $profilePicPath,
                        $deliverable
                    );
                    header("Location: index.php?controller=vendor&action=dashboard/item/view/" . urlencode($parts[3]));
                    exit;
                case 'edit2':
                    if ($profilePicPath == null) {
                        $profilePicPath = $this->product->fetchProductPic($parts[3]);
                    }
                    require_once __DIR__ . '/../views/Dashboards/Vendor/test.php';
            }
                    $this->product->editProduct(
                        $parts[3], // product ID
                        $title,
                        $price,
                        $description,
                        $category,
                        $subcategory,
                        $profilePicPath,
                        $deliverable
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
            $productId      = $parts[3];
            $productId      = $parts[3];
            $productDetails = $this->product->fetchProduct($productId);
        }
        $categories    = $this->category->getCategory();
        $subcategories = $this->category->getAllSubcategory();
        require_once __DIR__ . '/../views/Dashboards/Vendor/EditItem.php';
        $categories    = $this->category->getCategory();
        $subcategories = $this->category->getAllSubcategory();
        require_once __DIR__ . '/../views/Dashboards/Vendor/EditItem.php';
    }

    public function ajaxCategory() {
        $categoryId = intval($_POST['category_id'] ?? 0);

        $subcategories = $this->category->getSubcategory($categoryId);

        header('Content-Type: application/json');
        echo json_encode($subcategories);
    }

    public function test($profilePicPath) {
        require_once __DIR__ . '/../views/Dashboards/Vendor/test.php';
    }

    public function showInventory($parts) {
        $allProducts = $this->product->fetchAllfromVendor($_SESSION['user']['id']);
        require_once __DIR__ . '/../views/Dashboards/Vendor/Inventory.php';
    }

    public function manageInventory($parts) {
        $products = $this->product->fetchAllfromVendor($this->vendor->getVendorID($_SESSION['user']['id']));
        $stock    = $parts[2] ?? 'NULL';
        if ($stock === 'Total') {

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $product_id = $_POST['productId'];
                $quantity   = $_POST['quantity'];
                $state      = $_GET['state'];
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
                $quantity   = $_POST['quantity'];
                $state      = $_GET['state'];
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

    public function handleLogout() {
        $_SESSION['vendor'] = null;
        header("Location: index.php?controller=auth&action=handleLogout");
        exit;
    }

    public function viewRatings() {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        // The vendor ID is already in the session
        $vendorId = $_SESSION['user']['id'];

        if (!$vendorId) {
            die("Vendor profile not found");
        }

        // DEBUG: Show vendor info
        error_log("Vendor viewing ratings - ID: $vendorId, Email: " . $_SESSION['user']['email']);

        // Get all ratings for this vendor
        $ratings = $this->ratings->getVendorRatings($vendorId, 100);
        error_log("Found " . count($ratings) . " ratings for vendor ID: $vendorId");

        // Get vendor's average rating from database
        $stmt = $this->pdo->prepare("SELECT id, shopName, avg_rating, rating_count FROM vendors WHERE id = ?");
        $stmt->execute([$vendorId]);
        $vendorStats = $stmt->fetch(PDO::FETCH_ASSOC);
        error_log("Vendor stats: " . var_export($vendorStats, true));

        require_once __DIR__ . '/views/Dashboards/Vendor/vendor_ratings.php';
    }

    public function Vendor($parts) {
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
            case 'messeges':
                $this->messeges($parts);
            case 'manageInventory':
                $this->manageInventory($parts);
                break;
            case 'getCategory':
                $this->ajaxCategory();
                break;
            case 'messeges':
                $this->messeges($parts);
                break;
            case 'analysis':
                require_once __DIR__ . '/../views/Dashboards/Vendor/Analysis.php';
                require_once __DIR__ . '/../views/Dashboards/Vendor/Analysis.php';
                break;
            case 'profile':
                require_once __DIR__ . '/../views/Dashboards/Vendor/Profile.php';
                require_once __DIR__ . '/../views/Dashboards/Vendor/Profile.php';
                break;
            case 'history':
                require_once __DIR__ . '/../views/Dashboards/Vendor/History.php';
                require_once __DIR__ . '/../views/Dashboards/Vendor/History.php';
                break;
            case 'settings':
                require_once __DIR__ . '/../views/Dashboards/Vendor/Settings.php';
                require_once __DIR__ . '/../views/Dashboards/Vendor/Settings.php';
                break;
            case 'item':
                $this->handleitems($parts);
                break;
            case 'vieworder':
                require_once __DIR__ . '/../views/Dashboards/Vendor/ViewOrder.php';
                require_once __DIR__ . '/../views/Dashboards/Vendor/ViewOrder.php';
                break;
            case 'edititem':
                require_once __DIR__ . '/../views/Dashboards/Vendor/EditItem.php';
                require_once __DIR__ . '/../views/Dashboards/Vendor/EditItem.php';
                break;
            default:
                require_once __DIR__ . '/../views/Dashboards/Vendor/Orders.php';
                require_once __DIR__ . '/../views/Dashboards/Vendor/Orders.php';
                break;
        }
    }
    public function deactivateUser() {
        $USER_ID = $_SESSION['user']['id'];
        $this->user->deactivateUser($USER_ID);
        header("Location: index.php");
        exit;
    }
}

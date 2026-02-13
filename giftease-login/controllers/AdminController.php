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

        $this->Admin($parts);
    }

    public function addCategory($parts)
    {
        $categories = $this->category->getCategory();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }
        $action = $parts[2] ?? '';
        if ($action === 'add') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $action = $parts[3] ?? '';
                if ($action === 'category') {
                    $name = $_POST['name'];
                    $this->category->addCategory($name);
                }
                if ($action === 'subcategory') {
                    $name = $_POST['name'];
                    $category = $_POST['category'];
                    $this->category->addSubcategory($name, $category);
                }
                header("Location: index.php?controller=admin&action=dashboard/category/add/category");
                exit;
            }
            require_once __DIR__ . '/../views/Dashboards/Admin/addCategory.php';
        } else if ($action === 'edit') {
            $subcategories = $this->category->getAllSubcategory();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $action = $parts[3] ?? '';
                if ($action === 'category') {
                    $subaction = $parts[4] ?? '';
                    if ($subaction === 'update') {
                        $id = $_POST['id'];
                        $name = $_POST['name'];
                        $this->category->updateCategory($id, $name);
                    } else if ($subaction === 'delete') {
                        $id = $_POST['id'];
                        $this->category->deleteCategory($id);
                    }
                }
                if ($action === 'subcategory') {
                    $subaction = $parts[4] ?? '';
                    if ($subaction === 'update') {
                        $id = $_POST['id'];
                        $name = $_POST['name'];
                        $category = $_POST['category'];
                        $this->category->updateSubcategory($id, $name, $category);
                    } else if ($subaction === 'delete') {
                        $id = $_POST['id'];
                        $this->category->deleteSubcategory($id);
                    }
                }
                header("Location: index.php?controller=admin&action=dashboard/category/edit");
                exit;
            }
            require_once __DIR__ . '/../views/Dashboards/Admin/editCategory.php';
        } else {
            require_once __DIR__ . '/../views/Dashboards/Admin/category.php';
        }
    }

    public function editGiftWrappingItems($parts)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $parts[4];
            if ($parts[2] === 'update') {
                $name = $_POST['Name'];
                $price = $_POST['Price'];
                $layer = $_POST['Layer'];

                switch ($parts[3]) {
                    case 'boxRibbon':
                        $this->giftWrapping->updateBoxRibbon($id, $name, $price, $layer);
                        break;
                    case 'boxWrap':
                        $this->giftWrapping->updateBoxWrap($id, $name, $price, $layer);
                        break;
                    case 'paperBag':
                        $this->giftWrapping->updatePaperBag($id, $name, $price, $layer);
                        break;
                    case 'paperBagRibbon':
                        $this->giftWrapping->updatePaperBagRibbon($id, $name, $price, $layer);
                        break;
                    case 'chocolates':
                        $this->giftWrapping->updateChocolates($id, $name, $price, $layer);
                        break;
                    case 'cards':
                        $this->giftWrapping->updateCard($id, $name, $price, $layer);
                        break;
                    case 'softToys':
                        $this->giftWrapping->updateSoftToy($id, $name, $price, $layer);
                        break;
                }
            } else if ($parts[2] === 'delete') {
                switch ($parts[3]) {
                    case 'boxRibbon':
                        $this->giftWrapping->deleteBoxRibbon($id);
                        break;
                    case 'boxWrap':
                        $this->giftWrapping->deleteBoxWrap($id);
                        break;
                    case 'paperBag':
                        $this->giftWrapping->deletePaperBag($id);
                        break;
                    case 'paperBagRibbon':
                        $this->giftWrapping->deletePaperBagRibbon($id);
                        break;
                    case 'chocolates':
                        $this->giftWrapping->deleteChocolates($id);
                        break;
                    case 'cards':
                        $this->giftWrapping->deleteCard($id);
                        break;
                    case 'softToys':
                        $this->giftWrapping->deleteSoftToy($id);
                        break;
                }
            }
            header("Location: index.php?controller=admin&action=dashboard/editGiftWrappingItems");
            exit;
        }

        $boxWrap = $this->giftWrapping->getBoxWrap();
        $boxRibbon = $this->giftWrapping->getBoxRibbon();
        $paperBag = $this->giftWrapping->getPaperBag();
        $paperBagRibbon = $this->giftWrapping->getPaperBagRibbon();
        $chocolates = $this->giftWrapping->getChocolates();
        $softToys = $this->giftWrapping->getSoftToys();
        $cards = $this->giftWrapping->getCards();
        require_once __DIR__ . '/../views/Dashboards/Admin/editGiftWrappingItems.php';
    }

    public function addGiftWrappingItems($parts)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['Name'];
            $price = $_POST['Price'];
            $layer = $_POST['Layer'];

            $uploadDir1 = "resources/uploads/admin/giftWrappingItems/$parts[2]/previewImage/";
            if (!is_dir($uploadDir1))
                mkdir($uploadDir1, 0777, true);


            // Get file info
            $tmpName = $_FILES['previewImage']['tmp_name'];
            $fileName = time() . "_" . basename($_FILES['previewImage']['name']);
            $targetFile = $uploadDir1 . $fileName;

            // Move file to upload folder
            if (move_uploaded_file($tmpName, $targetFile)) {
                // store the uploaded file path
                $previewImage = $targetFile;
                echo "File uploaded successfully: $previewImage";
            } else {
                echo "File upload failed.";
            }

            $uploadDir2 = "resources/uploads/admin/giftWrappingItems/$parts[2]/displayImage/";
            if (!is_dir($uploadDir2))
                mkdir($uploadDir2, 0777, true);
            // Get file info
            $tmpName = $_FILES['displayImage']['tmp_name'];
            $fileName = time() . "_" . basename($_FILES['displayImage']['name']);
            $targetFile = $uploadDir2 . $fileName;

            // Move file to upload folder
            if (move_uploaded_file($tmpName, $targetFile)) {
                // store the uploaded file path
                $displayImage = $targetFile;
                echo "File uploaded successfully: $displayImage";
            } else {
                echo "File upload failed.";
            }
            switch ($parts[2]) {
                case 'boxRibbon':
                    $this->giftWrapping->addBoxRibbon($name, $price, $previewImage, $displayImage, $layer);
                    break;
                case 'boxWrap':
                    $this->giftWrapping->addBoxWrap($name, $price, $previewImage, $displayImage, $layer);
                    break;
                case 'paperBag':
                    $this->giftWrapping->addPaperBag($name, $price, $previewImage, $displayImage, $layer);
                    break;
                case 'paperBagRibbon':
                    $this->giftWrapping->addPaperBagRibbon($name, $price, $previewImage, $displayImage, $layer);
                    break;
                case 'chocolates':
                    $this->giftWrapping->addChocolates($name, $price, $previewImage, $displayImage, $layer);
                    break;
                case 'cards':
                    $this->giftWrapping->addCard($name, $price, $previewImage, $displayImage, $layer);
                    break;
                case 'softToys':
                    $this->giftWrapping->addSoftToy($name, $price, $previewImage, $displayImage, $layer);
                    break;
            }
            header("Location: index.php?controller=admin&action=dashboard/addGiftWrappingItems/#");
            exit;
        }
        require_once __DIR__ . '/../views/Dashboards/Admin/addGiftWrappingItems.php';
    }

    public function addGiftWrappingPackages($parts)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title       = $_POST['title'];
            $description = $_POST['description'];
            $price       = $_POST['price'];

            // Handle multiple image uploads
            $imagePaths = [];

            if (!empty($_FILES['images']['tmp_name'][0])) {
                foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                    $uploadDir = "resources/uploads/admin/giftWrappingPackages/";
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $fileName   = time() . "_" . $key . "_" . basename($_FILES['images']['name'][$key]);
                    $targetFile = $uploadDir . $fileName;

                    if (move_uploaded_file($tmpName, $targetFile)) {
                        $imagePaths[] = $fileName;
                    }
                }
            }

            $this->giftWrapping->addGiftWrappingPackage($title, $description, $price, $imagePaths);
            header("Location: index.php?controller=admin&action=dashboard/addGiftWrappingPackages");
            exit;
        }
        require_once __DIR__ . '/../views/Dashboards/Admin/addGiftWrappingPackages.php';
    }

    public function editGiftWrappingPackages($parts)
    {
        $action = $parts[2] ?? '';

        if ($action === 'edit' && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $id          = $parts[3] ?? null;
            $title       = $_POST['title'];
            $description = $_POST['description'];
            $price       = $_POST['price'];

            $imagePaths = null;
            if (!empty($_FILES['images']['tmp_name'][0])) {
                $imagePaths = [];
                foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                    $uploadDir = "resources/uploads/admin/giftWrappingPackages/";
                    if (!is_dir($uploadDir)) {
                        mkdir($uploadDir, 0777, true);
                    }

                    $fileName   = time() . "_" . $key . "_" . basename($_FILES['images']['name'][$key]);
                    $targetFile = $uploadDir . $fileName;

                    if (move_uploaded_file($tmpName, $targetFile)) {
                        $imagePaths[] = $fileName;
                    }
                }
            }

            $this->giftWrapping->updateGiftWrappingPackage($id, $title, $description, $price, $imagePaths);
            header("Location: index.php?controller=admin&action=dashboard/editGiftWrappingPackages");
            exit;
        }

        if ($action === 'delete') {
            $id = $parts[3] ?? null;
            $this->giftWrapping->deleteGiftWrappingPackage($id);
            header("Location: index.php?controller=admin&action=dashboard/editGiftWrappingPackages");
            exit;
        }

        $packages = $this->giftWrapping->getGiftWrappingPackages();
        require_once __DIR__ . '/../views/Dashboards/Admin/editGiftWrappingPackages.php';
    }
    public function handleLogout()
    {
        $_SESSION['admin'] = null;
        header("Location: index.php?controller=auth&action=handleLogout");
        exit;
    }


    public function admins($parts){
        $allAdmins = $this->admin->getAllAdmins();
        require_once __DIR__ . '/../views/Dashboards/Admin/admins.php';
    }
    public function vendors($parts){
        $allVendors = $this->admin->getAllUnverifiedVendors();
        if(isset($parts[2]) && $parts[2] == 'verify'){
            $vendorId = $parts[3];
            $this->vendor->verifyUser($vendorId);
            header("Location: index.php?controller=admin&action=dashboard/vendor");
            exit;
        }
        else if(isset($parts[2]) && $parts[2] == 'unverify'){
            $this->vendor->unverifyUser($parts[3]);
            header("Location: index.php?controller=admin&action=dashboard/vendor");
            exit;
        }
        
        // Pagination and Search
        $search = $_GET['search'] ?? '';
        $currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $itemsPerPage = 4;
        
        // Filter by search query
        if (!empty($search)) {
            $allVendors = array_filter($allVendors, function($item) use ($search) {
                return stripos($item['first_name'], $search) !== false ||
                       stripos($item['last_name'], $search) !== false ||
                       stripos($item['email'], $search) !== false ||
                       stripos($item['shopName'], $search) !== false;
            });
        }
        
        // Calculate pagination
        $totalItems = count($allVendors);
        $totalPages = ceil($totalItems / $itemsPerPage);
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $itemsPerPage;
        
        // Get items for current page
        $paginatedVendors = array_slice($allVendors, $offset, $itemsPerPage);
        
        require_once __DIR__ . '/../views/Dashboards/Admin/vendors.php';
    }

    
    public function giftwrappers($parts){
        $allGiftWrappers = $this->admin->getAllUnverifiedGiftwrapper();
        if(isset($parts[2]) && $parts[2] == 'verify'){
            $this->giftWrapper->verifyUser($parts[3]);
            header("Location: index.php?controller=admin&action=dashboard/giftWrappers");
            exit;
        }
        else if(isset($parts[2]) && $parts[2] == 'unverify'){
            $this->giftWrapper->unverifyUser($parts[3]);
            header("Location: index.php?controller=admin&action=dashboard/giftWrappers");
            exit;
        }
        
        // Pagination and Search
        $search = $_GET['search'] ?? '';
        $currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $itemsPerPage = 4;
        
        // Filter by search query
        if (!empty($search)) {
            $allGiftWrappers = array_filter($allGiftWrappers, function($item) use ($search) {
                return stripos($item['first_name'], $search) !== false ||
                       stripos($item['last_name'], $search) !== false ||
                       stripos($item['email'], $search) !== false;
            });
        }
        
        // Calculate pagination
        $totalItems = count($allGiftWrappers);
        $totalPages = ceil($totalItems / $itemsPerPage);
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $itemsPerPage;
        
        // Get items for current page
        $paginatedGiftWrappers = array_slice($allGiftWrappers, $offset, $itemsPerPage);
        
        require_once __DIR__ . '/../views/Dashboards/Admin/giftWrappers.php';
    }
    public function delivery($parts){
        $allDelivery = $this->admin->getAllUnverifiedDelivery();
        if(isset($parts[2]) && $parts[2] == 'verify'){
            $this->delivery->verifyUser($parts[3]);
            header("Location: index.php?controller=admin&action=dashboard/delivery");
            exit;
        }
        else if(isset($parts[2]) && $parts[2] == 'unverify'){
            $this->delivery->unverifyUser($parts[3]);
            header("Location: index.php?controller=admin&action=dashboard/delivery");
            exit;
        }
        
        // Pagination and Search
        $search = $_GET['search'] ?? '';
        $currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $itemsPerPage = 4;
        
        // Filter by search query
        if (!empty($search)) {
            $allDelivery = array_filter($allDelivery, function($item) use ($search) {
                return stripos($item['first_name'], $search) !== false ||
                       stripos($item['last_name'], $search) !== false ||
                       stripos($item['email'], $search) !== false ||
                       stripos($item['vehiclePlate'], $search) !== false;
            });
        }
        
        // Calculate pagination
        $totalItems = count($allDelivery);
        $totalPages = ceil($totalItems / $itemsPerPage);
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $itemsPerPage;
        
        // Get items for current page
        $paginatedDelivery = array_slice($allDelivery, $offset, $itemsPerPage);
        
        require_once __DIR__ . '/../views/Dashboards/Admin/delivery.php';
    }
    public function deliveryman($parts){
        $allDeliveryman = $this->admin->getAllUnverifiedDeliveryman();
        if(isset($parts[2]) && $parts[2] == 'verify'){
            $this->deliveryman->verifyUser($parts[3]);
            header("Location: index.php?controller=admin&action=dashboard/deliveryman");
            exit;
        }
        else if(isset($parts[2]) && $parts[2] == 'unverify'){
            $this->deliveryman->unverifyUser($parts[3]);
            header("Location: index.php?controller=admin&action=dashboard/deliveryman");
            exit;
        }
        
        // Pagination and Search
        $search = $_GET['search'] ?? '';
        $currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $itemsPerPage = 4;
        
        // Filter by search query
        if (!empty($search)) {
            $allDeliveryman = array_filter($allDeliveryman, function($item) use ($search) {
                return stripos($item['first_name'], $search) !== false ||
                       stripos($item['last_name'], $search) !== false ||
                       stripos($item['email'], $search) !== false ||
                       stripos($item['vehiclePlate'], $search) !== false;
            });
        }
        
        // Calculate pagination
        $totalItems = count($allDeliveryman);
        $totalPages = ceil($totalItems / $itemsPerPage);
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $itemsPerPage;
        
        // Get items for current page
        $paginatedDeliveryman = array_slice($allDeliveryman, $offset, $itemsPerPage);
        
        require_once __DIR__ . '/../views/Dashboards/Admin/deliveryMan.php';
    }
    public function clients($parts){
        $allClients = $this->admin->getAllClients();
        require_once __DIR__ . '/../views/Dashboards/Admin/customer.php';
    }

    public function orderDetail($parts)
    {
        $orderId = $parts[2] ?? null;
        if (!$orderId) {
            header("Location: index.php?controller=admin&action=dashboard/avenue");
            exit;
        }

        $order = $this->admin->getOrderDetail($orderId);
        $items = $this->admin->getOrderItems($orderId);
        require_once __DIR__ . '/../views/Dashboards/Admin/orderDetail.php';
    }

    public function avenue($parts)
    {
        $section = $parts[2] ?? '';
        $id = $parts[3] ?? null;

        if ($section === '') {
            require_once __DIR__ . '/../views/Dashboards/Admin/avenue.php';
            return;
        }

        if ($section === 'vendor' && $id) {
            $detail = $this->admin->getVendorById($id);
            $ratingStats = $this->admin->getVendorRatingStats($id);
            if (is_array($detail)) {
                $detail['rating'] = $ratingStats['rating'] ?? 0;
                $detail['rating_count'] = $ratingStats['total'] ?? 0;
            }
            $stats = [
                'earnings' => $this->admin->getVendorEarnings($id),
                'monthlyEarnings' => $this->admin->getVendorMonthlyEarnings($id),
                'totalSold' => $this->admin->getVendorTotalSold($id),
                'productCount' => $this->admin->getVendorProductCount($id)
            ];
            $items = $this->admin->getVendorSoldItems($id);
            $pageTitle = 'Vendor Details';
            $type = 'vendor';
            require_once __DIR__ . '/../views/Dashboards/Admin/avenueDetail.php';
            return;
        }
        if ($section === 'vendorProducts' && $id) {
            $vendor = $this->admin->getVendorById($id);
            $products = $this->admin->getVendorProducts($id);
            require_once __DIR__ . '/../views/Dashboards/Admin/vendorProducts.php';
            return;
        }
        if ($section === 'vendorSoldItems' && $id) {
            $vendor = $this->admin->getVendorById($id);
            $items = $this->admin->getVendorSoldItemsList($id);
            require_once __DIR__ . '/../views/Dashboards/Admin/vendorSoldItems.php';
            return;
        }
        if ($section === 'delivery' && $id) {
            $detail = $this->admin->getDeliveryById($id);
            $stats = [
                'earnings' => $this->admin->getDeliveryEarnings($id),
                'monthlyEarnings' => $this->admin->getDeliveryMonthlyEarnings($id),
                'completed' => $this->admin->getDeliveryCompletedCount($id)
            ];
            $orders = $this->admin->getDeliveryOrders($id);
            $pageTitle = 'Delivery Details';
            $type = 'delivery';
            require_once __DIR__ . '/../views/Dashboards/Admin/avenueDetail.php';
            return;
        }
        if ($section === 'deliveryCompleted' && $id) {
            $delivery = $this->admin->getDeliveryById($id);
            $orders = $this->admin->getDeliveryCompletedOrders($id);
            require_once __DIR__ . '/../views/Dashboards/Admin/deliveryCompleted.php';
            return;
        }
        if ($section === 'deliveryman' && $id) {
            $detail = $this->admin->getDeliverymanById($id);
            $stats = [
                'earnings' => 0,
                'monthlyEarnings' => 0,
                'completed' => 0
            ];
            $pageTitle = 'Deliveryman Details';
            $type = 'deliveryman';
            require_once __DIR__ . '/../views/Dashboards/Admin/avenueDetail.php';
            return;
        }
        if ($section === 'deliverymanCompleted' && $id) {
            $deliveryman = $this->admin->getDeliverymanById($id);
            $orders = $this->admin->getDeliverymanCompletedOrders($id);
            require_once __DIR__ . '/../views/Dashboards/Admin/deliverymanCompleted.php';
            return;
        }
        if ($section === 'giftWrapper' && $id) {
            $detail = $this->admin->getGiftWrapperById($id);
            $stats = [
                'earnings' => $this->admin->getGiftWrapperEarnings($id),
                'monthlyEarnings' => $this->admin->getGiftWrapperMonthlyEarnings($id),
                'completed' => $this->admin->getGiftWrapperCompletedCount($id)
            ];
            $orders = $this->admin->getGiftWrapperOrders($id);
            $pageTitle = 'Gift Wrapper Details';
            $type = 'giftWrapper';
            require_once __DIR__ . '/../views/Dashboards/Admin/avenueDetail.php';
            return;
        }
        if ($section === 'giftWrapperCompleted' && $id) {
            $giftWrapper = $this->admin->getGiftWrapperById($id);
            $orders = $this->admin->getGiftWrapperCompletedOrders($id);
            require_once __DIR__ . '/../views/Dashboards/Admin/giftWrapperCompleted.php';
            return;
        }

        if ($section === 'vendors') {
            $items = $this->admin->getAllVendors();
            $pageTitle = 'Vendors';
            $type = 'vendor';
            require_once __DIR__ . '/../views/Dashboards/Admin/avenueList.php';
            return;
        }
        if ($section === 'delivery') {
            $items = $this->admin->getAllDelivery();
            $pageTitle = 'Delivery Partners';
            $type = 'delivery';
            require_once __DIR__ . '/../views/Dashboards/Admin/avenueList.php';
            return;
        }
        if ($section === 'deliveryman') {
            $items = $this->admin->getAllDeliveryman();
            $pageTitle = 'Deliverymen';
            $type = 'deliveryman';
            require_once __DIR__ . '/../views/Dashboards/Admin/avenueList.php';
            return;
        }
        if ($section === 'giftWrappers') {
            $items = $this->admin->getAllGiftWrappers();
            $pageTitle = 'Gift Wrappers';
            $type = 'giftWrapper';
            require_once __DIR__ . '/../views/Dashboards/Admin/avenueList.php';
            return;
        }

        require_once __DIR__ . '/../views/Dashboards/Admin/avenue.php';
    }

    public function salarySummary()
    {
        $rows = [];

        $vendors = $this->admin->getAllVendors();
        foreach ($vendors as $vendor) {
            $monthly = $this->admin->getVendorMonthlyEarnings($vendor['id']);
            if ($monthly > 0) {
                $rows[] = [
                    'role' => 'Vendor',
                    'id' => $vendor['id'],
                    'name' => trim(($vendor['first_name'] ?? '') . ' ' . ($vendor['last_name'] ?? '')),
                    'email' => $vendor['email'] ?? 'N/A',
                    'phone' => $vendor['phone'] ?? 'N/A',
                    'monthly' => $monthly,
                    'link' => "?controller=admin&action=dashboard/avenue/vendor/" . $vendor['id']
                ];
            }
        }

        $deliveries = $this->admin->getAllDelivery();
        foreach ($deliveries as $delivery) {
            $monthly = $this->admin->getDeliveryMonthlyEarnings($delivery['id']);
            if ($monthly > 0) {
                $rows[] = [
                    'role' => 'Delivery',
                    'id' => $delivery['id'],
                    'name' => trim(($delivery['first_name'] ?? '') . ' ' . ($delivery['last_name'] ?? '')),
                    'email' => $delivery['email'] ?? 'N/A',
                    'phone' => $delivery['phone'] ?? 'N/A',
                    'monthly' => $monthly,
                    'link' => "?controller=admin&action=dashboard/avenue/delivery/" . $delivery['id']
                ];
            }
        }

        $deliverymen = $this->admin->getAllDeliveryman();
        foreach ($deliverymen as $deliveryman) {
            $monthly = 0;
            if ($monthly > 0) {
                $rows[] = [
                    'role' => 'Deliveryman',
                    'id' => $deliveryman['id'],
                    'name' => trim(($deliveryman['first_name'] ?? '') . ' ' . ($deliveryman['last_name'] ?? '')),
                    'email' => $deliveryman['email'] ?? 'N/A',
                    'phone' => $deliveryman['phone'] ?? 'N/A',
                    'monthly' => $monthly,
                    'link' => "?controller=admin&action=dashboard/avenue/deliveryman/" . $deliveryman['id']
                ];
            }
        }

        $giftWrappers = $this->admin->getAllGiftWrappers();
        foreach ($giftWrappers as $giftWrapper) {
            $monthly = $this->admin->getGiftWrapperMonthlyEarnings($giftWrapper['id']);
            if ($monthly > 0) {
                $rows[] = [
                    'role' => 'Gift Wrapper',
                    'id' => $giftWrapper['id'],
                    'name' => trim(($giftWrapper['first_name'] ?? '') . ' ' . ($giftWrapper['last_name'] ?? '')),
                    'email' => $giftWrapper['email'] ?? 'N/A',
                    'phone' => $giftWrapper['phone'] ?? 'N/A',
                    'monthly' => $monthly,
                    'link' => "?controller=admin&action=dashboard/avenue/giftWrapper/" . $giftWrapper['id']
                ];
            }
        }

        usort($rows, function ($a, $b) {
            return $b['monthly'] <=> $a['monthly'];
        });

        require_once __DIR__ . '/../views/Dashboards/Admin/salary.php';
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
                $this->items($parts);
                break;
            case 'settings':
                require_once __DIR__ . '/../views/Dashboards/Admin/settings new.php';
                break;
            case 'giftWrapping':
                require_once __DIR__ . '/../views/Dashboards/Admin/giftWrapping.php';
                break;
            case 'giftWrappers':
                $this->giftwrappers($parts);
                break;
            case 'admins':
                $this->admins($parts);
                break;
            case 'order':
                $this->orderDetail($parts);
                break;
            case 'avenue':
                $this->avenue($parts);
                break;
            case 'salary':
                $this->salarySummary();
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
            case 'addGiftWrappingPackages':
                $this->addGiftWrappingPackages($parts);
                break;
            case 'editGiftWrappingPackages':
                $this->editGiftWrappingPackages($parts);
                break;
            case 'reports':
                $this->reports($parts);
                break;
            default:
                require_once __DIR__ . '/../views/Dashboards/Admin/reports nesw.php';
                break;
        }
    }

    public function items($parts){
        require_once __DIR__ . '/../models/ProductsModel.php';
        $productsModel = new ProductsModel($this->delivery->getpdo());
        
        // Get all products with vendor details
        $allProducts = $productsModel->fetchAllWithVendor();
        
        // Pagination and Search
        $search = $_GET['search'] ?? '';
        $currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
        $itemsPerPage = 4;
        
        // Filter by search query
        if (!empty($search)) {
            $allProducts = array_filter($allProducts, function($item) use ($search) {
                return stripos($item['name'], $search) !== false ||
                       stripos($item['description'], $search) !== false ||
                       stripos($item['shopName'], $search) !== false;
            });
        }
        
        // Calculate pagination
        $totalItems = count($allProducts);
        $totalPages = ceil($totalItems / $itemsPerPage);
        $currentPage = min($currentPage, $totalPages);
        $offset = ($currentPage - 1) * $itemsPerPage;
        
        // Get items for current page
        $paginatedProducts = array_slice($allProducts, $offset, $itemsPerPage);
        
        require_once __DIR__ . '/../views/Dashboards/Admin/items new.php';
    }

    public function deactivateUser()
    {
        $USER_ID = $_SESSION['user']['id'];
        $this->user->deactivateUser($USER_ID);
        header("Location: index.php");
        exit;
    }

    public function reports($parts)
    {
        // Fetch report data
        $reportData = [
            'totalOrders' => $this->admin->getTotalOrders(),
            'totalProducts' => $this->admin->getTotalProducts(),
            'totalClients' => $this->admin->getTotalClients(),
            'totalVendors' => $this->admin->getTotalVendors(),
            'totalRevenue' => $this->admin->getTotalRevenue(),
            'monthlyGrowth' => $this->admin->getMonthlyGrowth(),
            'topCategory' => $this->admin->getTopCategory(),
            'customerRetention' => $this->admin->getCustomerRetention(),
            'ordersByMonth' => $this->admin->getOrdersByMonth(),
            'topSellingProducts' => $this->admin->getTopSellingProducts(5),
            'salesByCategory' => $this->admin->getSalesByCategory()
        ];
        
        require_once __DIR__ . '/../views/Dashboards/Admin/reports nesw.php';
    }
}
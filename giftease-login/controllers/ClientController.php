<?php
class ClientController {
    private $client;
    private $products;
    private $cart;
    private $giftWrapper;
    private $messeges;
    private $orders;
    private $notification;
    private $ratings;

    public function __construct($pdo) {
        require_once __DIR__ . '/../models/ClientModel.php';
        require_once __DIR__ . '/../models/ProductsModel.php';
        require_once __DIR__ . '/../models/CartModel.php';
        require_once __DIR__ . '/../models/GiftWrappingModel.php';
        require_once __DIR__ . '/../models/OrderModel.php';
        require_once __DIR__ . '/../models/MessegesModel.php';
        require_once __DIR__ . '/../models/NotificationModel.php';
        require_once __DIR__ . '/../models/RatingModel.php';
        $this->client       = new ClientModel($pdo);
        $this->products     = new ProductsModel($pdo);
        $this->cart         = new CartModel($pdo);
        $this->giftWrapper  = new GiftWrappingModel($pdo);
        $this->orders       = new OrderModel($pdo);
        $this->messeges     = new MessegesModel($pdo);
        $this->notification = new NotificationModel($pdo);
        $this->ratings = new RatingModel($pdo);
    }

    public function dashboard() {
        if (! $this->client->getUserByEmail($_SESSION['user']['email'])) {
            header("Location: index.php?controller=auth&action=handleLogin&type=client");
            exit;
        }
        global $pdo;
        $path  = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Client($parts);
    }

    public function items($parts) {
        /* ================= PAGINATION LOGIC ================= */

        $itemsPerPage = 2;

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if ($page < 1) $page = 1;

        $offset = ($page - 1) * $itemsPerPage;

        // Fetch paginated products
        $allProducts = $this->products->fetchPaginated($itemsPerPage, $offset);

        // Count total products
        $totalItems = $this->products->countAllProducts();
        $totalPages = ceil($totalItems / $itemsPerPage);

        /* ================= CART AJAX LOGIC ================= */

        $state = $_GET['state'] ?? NULL;

        if ($state === 'cart') {
            $product_id = $parts[2];
            $client_id = $_SESSION['user']['id'];

            if ($this->cart->isInCart($client_id, $product_id)) {
                $this->cart->removeFromCart($product_id, $client_id);
                echo json_encode(['inCart' => false]);
            } else {
                $this->cart->addToCart($client_id, $product_id);
                echo json_encode(['inCart' => true]);
            }
            exit;
        } else if ($state === 'cartCheck') {
            $product_id = $parts[2];
            $client_id = $_SESSION['user']['id'];

            if ($this->cart->isInCart($client_id, $product_id)) {
                echo json_encode(['inCart' => true]);
            } else {
                echo json_encode(['inCart' => false]);
            }
            exit;
        }

        /* ================= LOAD VIEW ================= */

        require_once __DIR__ . '/../views/Dashboards/Client/Browseitems.php';
    }


    public function displayProduct($parts) {
        $productId      = $parts[2];
        $productDetails = $this->products->fetchProduct($productId);

        require_once __DIR__ . '/../views/Dashboards/Client/Viewitem.php';
    }

    // public function cart($parts)
    // {
    //     $state = $parts[3] ?? '';

    //     if ($state === 'remove') {
    //         $product_id = (int)$parts[2];
    //         $client_id = $_SESSION['client']['id'];

    //         $this->cart->removeFromCart($product_id, $client_id);

    //         header("Location: index.php?controller=client&action=dashboard/cart");
    //         exit;
    //     }
    //     $cartItems = $this->cart->getCartForClient($_SESSION['client']['id']);
    //     // var_dump($cartItems);
    //     require_once __DIR__ . '/../views/Dashboards/Client/cart.php';
    // }

    public function wrapping() {
        require_once __DIR__ . '/../views/Dashboards/Client/wrap.php';
    }

    public function messeges($parts) {
        $staff_id = $parts[4] ?? '';

        if ($parts[3] === 'send') {
            if ($parts[2] === 'vendor') {
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
                    $staff_id,
                    $_SESSION['user']['id'],
                    [
                        'message'      => $message,
                        'attatchments' => $attatchmentPath,
                    ],
                    1
                );

                echo json_encode(['success' => true]);
                exit;
            } else if ($parts[2] == 'giftwrapper') {
                $message = trim($_POST['message'] ?? '');

                if ($message === '' && empty($_FILES['attachments']['name'][0])) {
                    echo json_encode(['success' => false, 'error' => 'Empty message']);
                    exit;
                }

                $attatchmentPath = [];

                if (! empty($_FILES['attachments']['tmp_name'])) {

                    $uploadDir = "resources/uploads/giftWrapper/attatchments/";
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

                $this->messeges->sendGiftWrapperMessege(
                    $staff_id,
                    $_SESSION['user']['id'],
                    [
                        'message'      => $message,
                        'attatchments' => $attatchmentPath,
                    ],
                    1
                );

                echo json_encode(['success' => true]);
                exit;
            } else if ($parts[2] == 'delivery') {
                $message = trim($_POST['message'] ?? '');

                if ($message === '' && empty($_FILES['attachments']['name'][0])) {
                    echo json_encode(['success' => false, 'error' => 'Empty message']);
                    exit;
                }

                $attatchmentPath = [];

                if (! empty($_FILES['attachments']['tmp_name'])) {

                    $uploadDir = "resources/uploads/delivery/attatchments/";
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

                $this->messeges->sendDeliveryMessege(
                    $staff_id,
                    $_SESSION['user']['id'],
                    [
                        'message'      => $message,
                        'attatchments' => $attatchmentPath,
                    ],
                    1
                );

                echo json_encode(['success' => true]);
                exit;
            }
        }
        if ($parts[3] === 'view') {
            $direct = 0;
            $dirAccess = $parts[5] ?? '';
            if ($dirAccess === "direct") {
                $direct = 1;
                if ($parts[2] == 'delivery') {
                    $directType = 'delivery';
                    $directID = $parts[4];
                    $staffData = $this->messeges->getDelivery($directID);
                } else if ($parts[2] == 'giftWrapper') {
                    $directType = 'giftwrapper';
                    $directID = $parts[4];
                    $staffData = $this->messeges->getGiftWrapper($directID);
                } else if ($parts[2] == 'vendor') {
                    $directType = 'vendor';
                    $directID = $parts[4];
                    $staffData = $this->messeges->getVendor($directID);
                }
            }
            $myMessages = $this->messeges->getMessage($_SESSION['user']['id']);
            require_once __DIR__ . '/../views/Dashboards/Client/messeges.php';
        }
    }

    public function notifications() {
        $notifications = $this->notification->getClientNotifications($_SESSION['user']['id']);
        require_once __DIR__ . '/../views/Dashboards/Client/notification.php';
    }

    public function notificationViewed($parts) {
        $id = (int)$parts[2];
        $this->notification->viewNotificationClient($id);
        exit();
    }

    public function history() {
        $clientId = $_SESSION['user']['id'];
        $orders = $this->orders->getOrdersByClient($clientId);

        // Check which orders have been rated
        foreach ($orders as &$order) {
            // Prefer resolved delivery status (from orderStatus) when available
            if (isset($order['resolved_is_delivered'])) {
                $order['is_delivered'] = (bool) $order['resolved_is_delivered'];
            }
            $order['has_rated'] = false;
            if ($order['vendor_id']) {
                $order['has_rated'] = $this->ratings->hasRated($order['vendor_id'], $clientId, $order['id']);
            }
        }

        include __DIR__ . '/../views/Dashboards/Client/history.php';
    }

    public function rate() {
        $clientId = $_SESSION['user']['id'];
        $orders = $this->orders->getOrdersByClient($clientId);

        foreach ($orders as &$order) {
            if (isset($order['resolved_is_delivered'])) {
                $order['is_delivered'] = (bool) $order['resolved_is_delivered'];
            }
            $order['has_rated'] = false;
            if ($order['vendor_id']) {
                $order['has_rated'] = $this->ratings->hasRated($order['vendor_id'], $clientId, $order['id']);
            }
        }

        // Reuse history view but highlight Rate tab
        $activePage = 'rate';
        include __DIR__ . '/views/Dashboards/Client/history.php';
    }

    public function cart($parts) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $state      = $parts[3] ?? '';
            $product_id = $parts[2] ?? '';
            $client_id  = $_SESSION['user']['id'];

            if ($state == 'remove') {
                $this->cart->removeFromCart($product_id, $client_id);
                header("Location: index.php?controller=client&action=dashboard/cart");
                exit;
            }

            if ($state == 'inc') {
                $this->cart->increaseCartQuantity($client_id, $product_id);

                header("Location: index.php?controller=client&action=dashboard/cart");
                exit;
            }
            if ($state == 'dec') {
                $this->cart->decreaseCartQuantity($client_id, $product_id);

                header("Location: index.php?controller=client&action=dashboard/cart");
                exit;
            }
            if ($state == 'submit') {
                $$_SESSION['checkout'] = [
                    'wrap' => [],
                    'delivery' => [],
                    'payment' => [],
                    'cart' => []
                ];

                $_SESSION['checkout']['cart']['productPrice'] = $_POST['subtotal'] ?? null;

                header("Location: index.php?controller=client&action=dashboard/custom");
                exit;
            }
        }
        $cartItems = $this->cart->getCartForClient($_SESSION['user']['id']);
        require_once __DIR__ . '/../views/Dashboards/Client/cart.php';
    }

    public function custom($parts) {
        $boxWrap        = $this->giftWrapper->getBoxWrap();
        $boxRibbon      = $this->giftWrapper->getBoxRibbon();
        $paperBag       = $this->giftWrapper->getPaperBag();
        $paperBagRibbon = $this->giftWrapper->getPaperBagRibbon();
        $chocolates     = $this->giftWrapper->getChocolates();
        $softToys       = $this->giftWrapper->getSoftToys();
        $cards          = $this->giftWrapper->getCards();


        if (isset($_POST['array'])) {
            // Decode the JSON string into an associative array
            $data = json_decode($_POST['array'], true);

            $_SESSION['checkout']['wrap'] = $data;

            header("Location: index.php?controller=client&action=dashboard/checkout/custom");
            exit;
        }

        require_once __DIR__ . '/../views/Dashboards/Client/custom.php';
    }

    public function checkout($parts) {
        $mode    = $parts[2];
        var_dump($_SESSION['checkout']['wrap']);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $_SESSION['checkout']['wrap']['mode'] = $mode;
            $data['orderType'] = $_POST['orderType'] ?? null;
            $data['recipientName'] = $_POST['recipientName'] ?? null;
            $data['recipientPhone'] = $_POST['recipientPhone'] ?? null;
            $data['deliveryAddress'] = $_POST['deliveryAddress'] ?? null;
            $data['locationType'] = $_POST['locationType'] ?? null;
            $data['deliveryDate'] = $_POST['deliveryDate'] ?? null;
            $data['deliveryPrice'] = $_POST['deliveryPrice'] ?? null;

            $_SESSION['checkout']['delivery'] = $data;

            header("Location: index.php?controller=client&action=dashboard/payhere");
            exit;
        }
        $cartItems = $this->cart->getCartForClient($_SESSION['user']['id']);
        require_once __DIR__ . '/../views/Dashboards/Client/checkout.php';
    }

    public function payhere($parts) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cartItems = $this->cart->getCartForClient($_SESSION['user']['id']);
            $_SESSION['checkout']['cart'] = $cartItems;
            $wrap_id = $this->giftWrapper->addCustomWrap($_SESSION['checkout']['wrap']);

            $_SESSION['checkout']['wrap']['id'] = $wrap_id;


            $order_id = $this->orders->confirmOrder($_SESSION['checkout'], $_SESSION['user']['id']);
            $notificationTitle = "Order Placed!";
            $notificationMessege = "Your Order has been successfully Placed consisting of ";
            $href = "?controller=client&action=dashboard/tracking/" . $order_id;
            foreach ($cartItems as $row) {
                $name = $row['name'];
                $notificationMessege = $notificationMessege . $name . ' ';
            }
            $this->notification->notifyClient($_SESSION['user']['id'], $notificationTitle, $notificationMessege, $href);
            $this->cart->emptyCart($_SESSION['user']['id']);

            header("Location: index.php?controller=client&action=dashboard/tracking  ");
            exit;
        }
        require_once __DIR__ . '/../views/Dashboards/Client/payhere/payhere.php';
    }

    public function Client($parts) {
        switch ($parts[1]) {
            case 'cart':
                $this->cart($parts);
                break;
            case 'wishlist':
                require_once __DIR__ . '/../views/Dashboards/Client/wishlist.php';
                break;
            case 'tracking':
                require_once __DIR__ . '/../views/Dashboards/Client/trackorder.php';
                break;
            case 'history':
                $this->history();
                break;
            case 'rate':
                $this->rate();
                break;
            case 'messeges':
                $this->messeges($parts);
                break;
            case 'wrap':
                $this->wrapping();
                break;
            case 'payment':
                require_once __DIR__ . '/../views/Dashboards/Client/payment.php';
                break;
            case 'payhere':
                $this->payhere($parts);
                break;
            case 'account':
                require_once __DIR__ . '/../views/Dashboards/Client/settings.php';
                break;
            case 'notifications':
                $this->notifications();
                break;
            case 'viewitem':
                $this->displayproduct($parts);
                break;
            case 'checkout':
                $this->checkout($parts);
                break;
            case 'custom':
                $this->custom($parts);
                break;
            case 'updateProfilePicture':
                $this->updateProfilePicture();
                break;
            case 'notificationViewed':
                $this->notificationViewed($parts);
                break;
            default:
                $this->items($parts);
                break;
        }
    }

    public function handleLogout() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $FIRST_NAME = $_POST['first_name'] ?? '';
            $LAST_NAME  = $_POST['last_name'] ?? '';
            $PHONE      = $_POST['phone'] ?? '';
            $ADDRESS    = $_POST['address'] ?? '';

            // $this->client->updateUser($data);
            header("Location: index.php?controller=client&action=dashboard/account");
            exit;

            // Redirect or show a success message
        }
        require_once __DIR__ . '/../views/Dashboards/Client/edit.php';
    }

    public function updateProfilePicture() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle file upload if user selected a new image
            $uploadDir = "resources/uploads/client/profilePictures/";
            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Get file info
            $tmpName    = $_FILES['profilePic']['tmp_name'];
            $fileName   = time() . "_" . basename($_FILES['profilePic']['name']);
            $targetFile = $uploadDir . $fileName;

            // Move file to upload folder
            if (move_uploaded_file($tmpName, $targetFile)) {
                // store the uploaded file path
                $profilePicPath = $targetFile;
                echo "File uploaded successfully: $profilePicPath";
            } else {
                echo "File upload failed.";
            }
            $this->client->updateProfilePicture($_SESSION['user']['id'], $profilePicPath);
            header("Location: index.php?controller=client&action=dashboard/account");
            exit;

            //$this->test($this->vendor->getVendorID($_SESSION['user']['id']), $title, $price, $description, $category, $subcategory, $profilePicPath);
        }

        require_once __DIR__ . '/../views/commonElements/addImage.php';
    }
}

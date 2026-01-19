<?php
class ClientController
{
    private $client;
    private $products;
    private $cart;
    private $giftWrapper;
    private $messeges;
    private $orders;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/ClientModel.php';
        require_once __DIR__ . '/../models/ProductsModel.php';
        require_once __DIR__ . '/../models/CartModel.php';
        require_once __DIR__ . '/../models/GiftWrappingModel.php';
        require_once __DIR__ . '/../models/OrderModel.php';
        require_once __DIR__ . '/../models/MessegesModel.php';
        $this->client      = new ClientModel($pdo);
        $this->products    = new ProductsModel($pdo);
        $this->cart        = new CartModel($pdo);
        $this->giftWrapper = new GiftWrappingModel($pdo);
        $this->orders      = new OrderModel($pdo);
        $this->messeges    = new MessegesModel($pdo);
    }

    public function dashboard()
    {
        if (! $this->client->getUserByEmail($_SESSION['user']['email'])) {
            header("Location: index.php?controller=auth&action=handleLogin&type=client");
            exit;
        }
        global $pdo;
        $path  = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Client($parts);
    }

    // public function items($parts)
    // {
    //     $allProducts = $this->products->fetchAll();
    //     $state       = $_GET['state'] ?? null;

    //     if ($state === 'cart') {
    //         $product_id = $parts[2];
    //         $client_id  = $_SESSION['user']['id'];

    //         // If it's already there, remove it. Otherwise, add it.

    //         if ($this->cart->isInCart($client_id, $product_id)) {
    //             $this->cart->removeFromCart($product_id, $client_id);
    //             echo json_encode(['inCart' => false]);
    //         } else {
    //             $this->cart->addToCart($client_id, $product_id);
    //             echo json_encode(['inCart' => true]);
    //         }

    //         exit;
    //     } else if ($state === 'cartCheck') {
    //         $product_id = $parts[2];
    //         $client_id  = $_SESSION['user']['id'];

    //         // If it's already there, remove it. Otherwise, add it.

    //         if ($this->cart->isInCart($client_id, $product_id)) {
    //             echo json_encode(['inCart' => true]);
    //         } else {
    //             echo json_encode(['inCart' => false]);
    //         }

    //         exit;
    //     }

    //     require_once __DIR__ . '/../views/Dashboards/Client/Browseitems.php';
    // }

    public function items($parts)
{
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
    }
    else if ($state === 'cartCheck') {
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


    public function displayProduct($parts)
    {
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

    public function cart($parts)
    {
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

        }
        $cartItems = $this->cart->getCartForClient($_SESSION['user']['id']);
        require_once __DIR__ . '/../views/Dashboards/Client/cart.php';
    }

    public function wrapping()
    {
        require_once __DIR__ . '/../views/Dashboards/Client/wrap.php';
    }

    public function custom($parts)
    {
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

            $box          = $data['box'];
            $boxDeco      = $data['boxDeco'];
            $paperBag     = $data['paper'];
            $paperBagDeco = $data['paperDeco'];
            $card         = $data['card'];
            $chocolate    = $data['chocolate'];
            $softToy      = $data['softToy'];
            $total        = $data['totalPrice'];

            $wrap_id = $this->giftWrapper->addCustomWrap($box, $boxDeco, $paperBag, $paperBagDeco, $softToy, $chocolate, $card, $total);

            header("Location: index.php?controller=client&action=dashboard/checkout/$wrap_id/custom");
            exit;
        }

        require_once __DIR__ . '/../views/Dashboards/Client/custom.php';
    }

    public function checkout($parts)
    {
        $wrap_id = $parts[2];
        $mode    = $parts[3];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $orderType       = $_POST['orderType'] ?? null;
            $recipientName   = $_POST['recipientName'] ?? null;
            $recipientPhone  = $_POST['recipientPhone'] ?? null;
            $deliveryAddress = $_POST['deliveryAddress'] ?? null;
            $locationType    = $_POST['locationType'] ?? null;
            $deliveryDate    = $_POST['deliveryDate'] ?? null;
            $deliveryPrice   = $_POST['deliveryPrice'] ?? null;

            $cartItems = $this->cart->getCartForClient($_SESSION['user']['id']);
            $this->orders->confirmOrder([
                'mode'            => $mode,
                'orderType'       => $orderType,
                'recipientName'   => $recipientName,
                'recipientPhone'  => $recipientPhone,
                'deliveryAddress' => $deliveryAddress,
                'locationType'    => $locationType,
                'deliveryDate'    => $deliveryDate,
                'cartItems'       => $cartItems,
                'deliveryPrice'   => $deliveryPrice,
                'client_id'       => $_SESSION['user']['id'],
            ], $wrap_id);
            $this->cart->emptyCart($_SESSION['user']['id']);

            header("Location: index.php?controller=client&action=dashboard/tracking  ");
            exit;
        }
        $cartItems = $this->cart->getCartForClient($_SESSION['user']['id']);
        require_once __DIR__ . '/../views/Dashboards/Client/checkout.php';
    }

    public function messeges($parts)
    {
        $staff_id = $parts[4];

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
            } else if ($parts[2] == 'giftWrapper') {

            } else if ($parts[2] == 'delivery') {

            }
        }
        if ($parts[3] === 'view') {
            $myMessages = $this->messeges->getMessage($_SESSION['user']['id']);
            require_once __DIR__ . '/../views/Dashboards/Client/messeges.php';
        }
    }

    public function Client($parts)
    {
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
                require_once __DIR__ . '/../views/Dashboards/Client/history.php';
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
            case 'account':
                $this->account();
                break;
            case 'settings':
                require_once __DIR__ . '/../views/Dashboards/Client/settings.php';
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
            default:
                $this->items($parts);
                break;
        }
    }

    public function handleLogout()
    {

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

    public function updateProfilePicture()
    {
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

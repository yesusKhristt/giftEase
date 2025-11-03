<?php
class ClientController
{
    private $client;
    private $products;
    private $cart;
    private $giftWrapper;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/ClientModel.php';
        require_once __DIR__ . '/../models/ProductsModel.php';
        require_once __DIR__ . '/../models/cartModel.php';
        require_once __DIR__ . '/../models/giftWrappingModel.php';
        $this->client = new ClientModel($pdo);
        $this->products = new ProductsModel($pdo);
        $this->cart = new CartModel($pdo);
        $this->giftWrapper = new GiftWrapppingModel($pdo);
    }



    public function checkID()
    {
        $user = $_SESSION['user'];
        $user_id = $user['id'];

        $stmt = $this->client->getpdo()->prepare("SELECT COUNT(*) FROM clients WHERE user_id = ?");
        $stmt->execute([$user_id]);

        $exists = (int) $stmt->fetchColumn();

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
            $FIRST_NAME = $_POST['First_Name'] ?? '';
            $LAST_NAME = $_POST['Last_Name'] ?? '';
            $PHONE = $_POST['phone'] ?? '';
            $ADDRESS = $_POST['address'] ?? '';


            $this->client->addClient($user_id, $FIRST_NAME, $LAST_NAME, $PHONE, $ADDRESS);
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
        $_SESSION['client'] = $this->client->getClient($_SESSION['user']['id']);
        $path = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Client($parts);
    }

    public function items($parts)
    {
        $allProducts = $this->products->fetchAll();
        $state = $_GET['state'] ?? NULL;

        if ($state === 'cart') {
            $product_id = $parts[2];
            $client_id = $_SESSION['client']['id'];

            // If it's already there, remove it. Otherwise, add it.

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
            $client_id = $_SESSION['client']['id'];

            // If it's already there, remove it. Otherwise, add it.

            if ($this->cart->isInCart($client_id, $product_id)) {
                echo json_encode(['inCart' => true]);
            } else {
                echo json_encode(['inCart' => false]);
            }

            exit;
        }

        require_once __DIR__ . '/../views/Dashboards/Client/Browseitems.php';
    }


    public function displayProduct($parts)
    {
        $productId = $parts[2];
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
            $state = $parts[3] ?? '';
            $product_id = $parts[2] ?? '';
            $client_id = $_SESSION['client']['id'];


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
        $cartItems = $this->cart->getCartForClient($_SESSION['client']['id']);
        require_once __DIR__ . '/../views/Dashboards/Client/cart.php';
    }

    public function wrapping()
    {
        require_once __DIR__ . '/../views/Dashboards/Client/wrap.php';
    }

    public function custom($parts)
    {
        $boxWrap = $this->giftWrapper->getBoxWrap();
        $boxRibbon = $this->giftWrapper->getBoxRibbon();
        $paperBag = $this->giftWrapper->getPaperBag();
        $paperBagRibbon = $this->giftWrapper->getPaperBagRibbon();
        $chocolates = $this->giftWrapper->getChocolates();
        $softToys = $this->giftWrapper->getSoftToys();
        $cards = $this->giftWrapper->getCards();

        if (isset($_POST['array'])) {
            // Decode the JSON string into an associative array
            $data = json_decode($_POST['array'], true);

            $box = $data['box'];
            $boxDeco = $data['boxDeco'];
            $paperBag = $data['paper'];
            $paperBagDeco = $data['paperDeco'];
            $card = $data['card'];
            $chocolate = $data['chocolate'];
            $softToy = $data['softToy'];
            $total = $data['totalPrice'];

            $this->giftWrapper->addCustomWrap($box, $boxDeco, $paperBag, $paperBagDeco, $softToy, $chocolate, $card, $total);
            header("Location: index.php?controller=client&action=dashboard/primary");
            exit;

        }

        require_once __DIR__ . '/../views/Dashboards/Client/custom.php';
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
            case 'Checkout':
                require_once __DIR__ . '/../views/Dashboards/Client/checkout.php';
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
        $_SESSION['client'] = null;
        header("Location: index.php?controller=auth&action=handleLogout");
        exit;

    }

    public function editProfile()
    {
        // Logic to handle profile editing
        $USER_ID = $_SESSION['user']['id'];
        $user1 = $_SESSION['user'];
        $user2 = $_SESSION['client'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $FIRST_NAME = $_POST['first_name'] ?? '';
            $LAST_NAME = $_POST['last_name'] ?? '';
            $PHONE = $_POST['phone'] ?? '';
            $ADDRESS = $_POST['address'] ?? '';

            $this->client->updateClient($USER_ID, $FIRST_NAME, $LAST_NAME, $PHONE, $ADDRESS);
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
            if (!is_dir($uploadDir))
                mkdir($uploadDir, 0777, true);

            // Get file info
            $tmpName = $_FILES['profilePic']['tmp_name'];
            $fileName = time() . "_" . basename($_FILES['profilePic']['name']);
            $targetFile = $uploadDir . $fileName;

            // Move file to upload folder
            if (move_uploaded_file($tmpName, $targetFile)) {
                // store the uploaded file path
                $profilePicPath = $targetFile;
                echo "File uploaded successfully: $profilePicPath";
            } else {
                echo "File upload failed.";
            }
            $this->client->updateProfilePicture($_SESSION['client']['id'], $profilePicPath);
            header("Location: index.php?controller=client&action=dashboard/account");
            exit;

            //$this->test($this->vendor->getVendorID($_SESSION['user']['id']), $title, $price, $description, $category, $subcategory, $profilePicPath);
        }

        require_once __DIR__ . '/../views/commonElements/addImage.php';

    }


    public function deleteProfile()
    {
        $USER_ID = $_SESSION['user']['id'];
        $stmt1 = $this->client->getpdo()->prepare('SELECT * FROM users WHERE id = ?');
        $stmt1->execute([$USER_ID]);
        $stmt2 = $this->client->getpdo()->prepare('SELECT * FROM clients WHERE user_id = ?');
        $stmt2->execute([$USER_ID]);

        $this->client->deleteClient($USER_ID);
        header("Location: index.php");
        exit;
    }

    public function account()
    {
        $USER_ID = $_SESSION['user']['id'];
        $user1 = $_SESSION['user'];
        $user2 = $_SESSION['client'];

        $stmt3 = $this->client->getpdo()->prepare(
            "SELECT DATE_FORMAT(c.created_at, '%d %M %Y') AS join_month_year 
            FROM clients c
            WHERE c.user_id = ?"
        );
        $stmt3->execute([$USER_ID]);
        $joinData = $stmt3->fetch(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/Dashboards/Client/account.php';
    }
}
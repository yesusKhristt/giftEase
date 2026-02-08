<?php

class AuthController
{
    private $giftWrapper;
    private $deliveryman;
    private $delivery;
    private $admin;
    private $client;
    private $vendor;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/CategoryModel.php';
        require_once __DIR__ . '/../models/GiftWrapperModel.php';
        require_once __DIR__ . '/../models/DeliveryModel.php';
        require_once __DIR__ . '/../models/DeliverymanModel.php';
        require_once __DIR__ . '/../models/AdminModel.php';
        require_once __DIR__ . '/../models/ClientModel.php';
        require_once __DIR__ . '/../models/VendorModel.php';
        $this->giftWrapper = new GiftWrapperModel($pdo);
        $this->deliveryman = new DeliverymanModel($pdo);
        $this->delivery = new DeliveryModel($pdo);
        $this->admin = new AdminModel($pdo);
        $this->client = new ClientModel($pdo);
        $this->vendor = new VendorModel($pdo);
    }
    public function landing()
    {
        require_once __DIR__ . '/../views/LandingPage/landingPage.php';
    }

    public function handleLogin()
    {
        $error = '';
        $user = null;

        // Get user type from URL (default to client)
        $type = $_GET['type'] ?? 'client';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $type = $_GET['type'] ?? 'client';
            $role = $_POST['role'] ?? '';
            $error;

            switch ($role) {
                case 'client':
                    $user = $this->client->authenticate($email, $password, $role, $error);
                    break;
                case 'vendor':
                    $user = $this->vendor->authenticate($email, $password, $role, $error);
                    break;
                case 'admin':
                    $user = $this->admin->authenticate($email, $password, $role, $error);
                    break;
                case 'delivery':
                    $user = $this->delivery->authenticate($email, $password, $role, $error);
                    break;
                case 'deliveryman':
                    $user = $this->deliveryman->authenticate($email, $password, $role, $error);
                    break;
                case 'giftWrapper':
                    $user = $this->giftWrapper->authenticate($email, $password, $role, $error);
                    break;
            }
            if ($user) {
                $_SESSION['user'] = $user;

                // 🔑 Navigation happens here
                switch ($role) {
                    case 'client':
                        header("Location: index.php?controller=client&action=dashboard/primary");
                        exit;
                    case 'vendor':
                        header("Location: index.php?controller=vendor&action=dashboard/primary");
                        exit;
                    case 'admin':
                        header("Location: index.php?controller=admin&action=dashboard/primary");
                        exit;
                    case 'delivery':
                        header("Location: index.php?controller=delivery&action=dashboard/primary");
                        exit;
                    case 'deliveryman':
                        header("Location: index.php?controller=deliveryman&action=dashboard/primary");
                        exit;
                    case 'giftWrapper':
                        header("Location: index.php?controller=giftWrapper&action=dashboard/primary");
                        exit;
                }

            }
        }

        // Load different views based on user type
        require_once __DIR__ . '/../views/Login/login.php';

    }

    public function handleSignup()
    {
        $error = '';
        $success = '';

        $type = $_GET['type'] ?? 'client';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstname = $_POST['f_name'] ?? '';
            $lastname = $_POST['l_name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $role = $_POST['role'] ?? '';
            $address = $_POST['address'] ?? '';
            $phone = $_POST['phone'] ?? '';
            switch ($role) {
                case 'client':
                    if ($this->client->getUserByEmail($email)) {
                        $error = 'User already exists.';
                    } else {
                        $this->client->addUser([
                            'first_name' => $firstname,
                            'last_name' => $lastname,
                            'email' => $email,
                            'password' => $hashedPassword,
                            'imageloc' => NULL,
                            'address' => $address,
                            'phone' => $phone
                        ]);
                    }
                    break;
                case 'vendor':
                    $shopName = $_POST['shopName'] ?? '';
                    if ($this->vendor->getUserByEmail($email)) {
                        $error = 'User already exists.';
                    } else {
                        $this->vendor->addUser([
                            'first_name' => $firstname,
                            'last_name' => $lastname,
                            'email' => $email,
                            'password' => $hashedPassword,
                            'imageloc' => NULL,
                            'address' => $address,
                            'phone' => $phone,
                            'shopName' => $shopName
                        ]);
                    }
                    break;

                case 'giftWrapper':
                    $years = $_POST['years'] ?? '';
                    if ($this->giftWrapper->getUserByEmail($email)) {
                        $error = 'User already exists.';
                    } else {
                        $this->giftWrapper->addUser([
                            'first_name' => $firstname,
                            'last_name' => $lastname,
                            'email' => $email,
                            'password' => $hashedPassword,
                            'imageloc' => NULL,
                            'address' => $address,
                            'phone' => $phone,
                            'years_of_experience' => $years
                        ]);
                    }
                    break;

                case 'delivery':
                    $vehiclePlate = $_POST['vehiclePlate'] ?? '';
                    if ($this->delivery->getUserByEmail($email)) {
                        $error = 'User already exists.';
                    } else {
                        $this->delivery->addUser([
                            'first_name' => $firstname,
                            'last_name' => $lastname,
                            'email' => $email,
                            'password' => $hashedPassword,
                            'imageloc' => NULL,
                            'address' => $address,
                            'phone' => $phone,
                            'vehiclePlate' => $vehiclePlate
                        ]);
                    }
                    break;
                case 'deliveryman':
                    $vehiclePlate = $_POST['vehiclePlate'] ?? '';
                    if ($this->deliveryman->getUserByEmail($email)) {
                        $error = 'User already exists.';
                    } else {
                        $this->deliveryman->addUser([
                            'first_name' => $firstname,
                            'last_name' => $lastname,
                            'email' => $email,
                            'password' => $hashedPassword,
                            'imageloc' => NULL,
                            'address' => $address,
                            'phone' => $phone,
                            'vehiclePlate' => $vehiclePlate
                        ]);
                    }
                    break;

                case 'admin':
                    $designation = $_POST['designation'] ?? '';
                    if ($this->admin->getUserByEmail($email)) {
                        $error = 'User already exists.';
                    } else {
                        $this->admin->addUser([
                            'first_name' => $firstname,
                            'last_name' => $lastname,
                            'email' => $email,
                            'password' => $hashedPassword,
                            'imageloc' => NULL,
                            'address' => $address,
                            'phone' => $phone,
                            'designation' => $designation
                        ]);
                    }
                    break;
            }
            $success = '✅ Account created. Please log in.';
            header("Location: index.php?action=handleLogin&type=$type");
            exit;
        }
        require_once __DIR__ . '/../views/Signup/signup.php';

    }

    public function handleLogout()
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }

        session_destroy();

        header('Location: index.php?controller=auth&action=landing');
        exit;
    }
}
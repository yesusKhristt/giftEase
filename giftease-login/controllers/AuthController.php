<?php

require_once __DIR__ . '/../models/UserModel.php';
//HELLO
class AuthController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
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
            $user = $this->model->authenticate($email, $password, $type);
            if ($user) {
                header("Location: index.php?action=dashboard&type=$type&level=primary");
                header("Location: index.php?action=dashboard&type=$type&level=primary");
                exit;
            } else {
                $error = '❌ Invalid email or password.';
            }
        }

        // Load different views based on user type
        switch ($type) {
            case 'client':
                require_once __DIR__ . '/../views/Login/loginClient.php';
                break;
            default:
                require_once __DIR__ . '/../views/Login/loginStaff.php';
                break;
        }
        switch ($type) {
            case 'client':
                require_once __DIR__ . '/../views/Login/loginClient.php';
                break;
            default:
                require_once __DIR__ . '/../views/Login/loginStaff.php';
                break;
        }
    }

    public function handleSignup()
    {
        $error = '';
        $success = '';

        $type = $_GET['type'] ?? 'client';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';


            if ($this->model->getUserByEmail($email)) {
                $error = 'User already exists.';
                $error = 'User already exists.';
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $this->model->addUser([
                    'name' => $name,
                    'email' => $email,
                    'password' => $hashedPassword,
                    'type' => $type
                ]);
                $success = '✅ Account created. Please log in.';
                header("Location: index.php?action=login&type=$type###");
                exit;
            }
        }
        switch ($type) {
            case 'client':
                require_once __DIR__ . '/../views/Signup/signupClient.php';
                break;
            default:
                require_once __DIR__ . '/../views/Signup/signupStaff.php';
                break;
        }
        switch ($type) {
            case 'client':
                require_once __DIR__ . '/../views/Signup/signupClient.php';
                break;
            default:
                require_once __DIR__ . '/../views/Signup/signupStaff.php';
                break;
        }
    }

    public function monitorDashboards()
    {
        $type = $_GET['type'] ?? 'client';
        $level1 = $_GET['level'] ?? 'primary';
        switch ($type) {
            case 'vendor':
                $this->Vendor($level1);
                break;
            case 'delivery':
                $this->Delivery($level1);
                break;
            case 'deliveryman':
                $this->Deliveryman($level1);
                break;
            case 'giftWrapper':
                $this->GiftWrapper($level1);
                break;
            case 'admin':
                $this->Admin($level1);
                break;
            case 'client':
                $this->Client($level1);
                break;
        }
    }

    public function Vendor($level1)
    {
        switch ($level1) {
            case 'inventory':
                require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardInventory.php';
                break;
            case 'messages':
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
    public function Delivery($level1)
    {
        switch ($level1) {
            case 'profile':
                require_once __DIR__ . '/../views/Dashboards/Delivery/profile.php';
                break;
            case 'history':
                require_once __DIR__ . '/../views/Dashboards/Delivery/history.php';
                break;
            case 'map':
                require_once __DIR__ . '/../views/Dashboards/Delivery/map.php';
                break;
            case 'notification':
                require_once __DIR__ . '/../views/Dashboards/Delivery/notification.php';
                break;
            case 'order':
                require_once __DIR__ . '/../views/Dashboards/Delivery/order.php';
                break;
            case 'proof':
                require_once __DIR__ . '/../views/Dashboards/Delivery/proof.php';
                break;
            case 'settings':
                require_once __DIR__ . '/../views/Dashboards/Delivery/Settings.php';
            case 'profile':
                require_once __DIR__ . '/../views/Dashboards/Delivery/profile.php';
                break;
            case 'history':
                require_once __DIR__ . '/../views/Dashboards/Delivery/history.php';
                break;
            case 'map':
                require_once __DIR__ . '/../views/Dashboards/Delivery/map.php';
                break;
            case 'notification':
                require_once __DIR__ . '/../views/Dashboards/Delivery/notification.php';
                break;
            case 'order':
                require_once __DIR__ . '/../views/Dashboards/Delivery/order.php';
                break;
            case 'proof':
                require_once __DIR__ . '/../views/Dashboards/Delivery/proof.php';
                break;
            case 'settings':
                require_once __DIR__ . '/../views/Dashboards/Delivery/Settings.php';
                break;
            default:
                require_once __DIR__ . '/../views/Dashboards/Delivery/home.php';
            default:
                require_once __DIR__ . '/../views/Dashboards/Delivery/home.php';
                break;
        }
    }

    public function Deliveryman($level1)
    {
        switch ($level1) {
            case 'primary':
                require_once __DIR__ . '/../views/Dashboards/Deliveryman/deliverymanDashboard.php';
                require_once __DIR__ . '/../views/Dashboards/Deliveryman/deliverymanDashboard.php';
                break;
            case 'analysis':
                require_once __DIR__ . '/../views/Dashboards/Deliveryman/deliverymanDashboard.php';
                break;
            default:
                require_once __DIR__ . '/../views/Dashboards/Deliveryman/deliverymanDashboard.php';
                require_once __DIR__ . '/../views/Dashboards/Deliveryman/deliverymanDashboard.php';
                break;
            default:
                require_once __DIR__ . '/../views/Dashboards/Deliveryman/deliverymanDashboard.php';
                break;
        }
    }

    public function GiftWrapper($level1)
    {
        switch ($level1) {
            case 'analytics':
                require_once __DIR__ . '/../views/Dashboards/GiftWrapper/analitic.php';
                break;
            case 'earnings':
                require_once __DIR__ . '/../views/Dashboards/GiftWrapper/earning.php';
                break;
            case 'order':
                require_once __DIR__ . '/../views/Dashboards/GiftWrapper/order.php';
                break;
            case 'portfolio':
                require_once __DIR__ . '/../views/Dashboards/GiftWrapper/portfolio.php';
                break;
            case 'profile':
                require_once __DIR__ . '/../views/Dashboards/GiftWrapper/profile.php';
                break;
            case 'settings':
                require_once __DIR__ . '/../views/Dashboards/GiftWrapper/setting.php';
                break;
            case 'service':
                require_once __DIR__ . '/../views/Dashboards/GiftWrapper/service.php';
                break;
            default:
                require_once __DIR__ . '/../views/Dashboards/GiftWrapper/overview.php';
                break;
        }
    }

    public function Admin($level1)
    {
        switch ($level1) {
            case 'customer':
                require_once __DIR__ . '/../views/Dashboards/Admin/customer.php';
                break;
            case 'delivery':
                require_once __DIR__ . '/../views/Dashboards/Admin/deliver.php';
                break;
            case 'items':
                require_once __DIR__ . '/../views/Dashboards/Admin/items new.php';
                break;
            case 'reports':
                require_once __DIR__ . '/../views/Dashboards/Admin/reports nesw.php';
                break;
            case 'settings':
                require_once __DIR__ . '/../views/Dashboards/Admin/settings new.php';
                break;
            case 'vendor':
                require_once __DIR__ . '/../views/Dashboards/Admin/vendors.php';
                break;
            case 'profile':
                require_once __DIR__ . '/../views/Dashboards/Admin/profile.php';
                break;
            default:
                require_once __DIR__ . '/../views/Dashboards/Admin/front.php';
                break;
        }
    }

    public function Client($level1)
    {
        switch ($level1) {
            case 'cart':
                require_once __DIR__ . '/../views/Dashboards/Client/cart.php';
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
            case 'customize':
                require_once __DIR__ . '/../views/Dashboards/Client/customize.php';
                break;
            case 'payment':
                require_once __DIR__ . '/../views/Dashboards/Client/payment.php';
                break;
            case 'account':
                require_once __DIR__ . '/../views/Dashboards/Client/account.php';
                break;
            case 'settings':
                require_once __DIR__ . '/../views/Dashboards/Client/settings.php';
                break;
            case 'viewitem':
                require_once __DIR__ . '/../views/Dashboards/Client/ViewItem.php';
                break;
            default:
                require_once __DIR__ . '/../views/Dashboards/Client/Browseitems.php';
            default:
                require_once __DIR__ . '/../views/Dashboards/Client/Browseitems.php';
                break;
        }
    }

}






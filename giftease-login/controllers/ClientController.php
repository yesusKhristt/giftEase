<?php
class ClientController
{
    public function dashboard()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'client') {
            header("Location: index.php?controller=auth&action=handleLogin&type=client");
            exit;
        }
        global $pdo;
        $path = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Client($parts[1]);
    }
    public function Client($parts)
    {
        switch ($parts) {
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
                break;
        }
    }
}
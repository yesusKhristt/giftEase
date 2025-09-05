<?php
class AdminController
{
    public function dashboard()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'admin') {
            header("Location: index.php?controller=auth&action=handleLogin&type=staff");
            exit;
        }
        global $pdo;
        $path = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Admin($parts[1]);
    }
    public function Admin($parts)
    {
        switch ($parts) {
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
            case 'Admin':
                require_once __DIR__ . '/../views/Dashboards/Admin/Admins.php';
                break;
            case 'profile':
                require_once __DIR__ . '/../views/Dashboards/Admin/profile.php';
                break;
            case 'vendor':
                require_once __DIR__ . '/../views/Dashboards/Admin/vendors.php';
                break;
            default:
                require_once __DIR__ . '/../views/Dashboards/Admin/front.php';
                break;
        }
    }
}
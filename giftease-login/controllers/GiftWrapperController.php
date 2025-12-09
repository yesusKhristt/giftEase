<?php
class giftWrapperController
{
    private $giftwrapper;
        public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/GiftWrapperModel.php';
        $this->giftwrapper = new GiftWrapperModel($pdo); //bruh
    }
    public function dashboard()
    {
        if (!$this->giftwrapper->getUserByEmail($_SESSION['user']['email'])) {
            header("Location: index.php?controller=auth&action=handleLogin&type=staff");
            exit;
        }
        global $pdo;
        $path = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->GiftWrapper($parts[1]);
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

    public function handleLogout()
    {
        $_SESSION['giftWrapper'] = null;
        header("Location: index.php?controller=auth&action=handleLogout");
        exit;

    }

            public function deactivateUser()
    {
        $USER_ID = $_SESSION['user']['id'];
        $this->user->deactivateUser($USER_ID);
        header("Location: index.php");
        exit;
    }
}
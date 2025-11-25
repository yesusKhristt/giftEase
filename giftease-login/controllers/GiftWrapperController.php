<?php
class giftWrapperController
{

    private $giftwrapper;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/GiftwrappingModel.php';
        $this->giftwrapper = new GiftWrapppingModel($pdo);
    }

    public function checkID()
    {

        $exists = $this->giftwrapper->getGiftWrapperID($_SESSION['user']['id']);

        if (!$exists) {
            $this->employeeForm($_SESSION['user']['id']);
        } else {
            header("Location: index.php?controller=giftWrapper&action=dashboard/primary");
            exit;
        }

    }

    public function employeeForm($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $phone = $_POST['phone'] ?? '';
            $address = $_POST['address'] ?? '';

            $this->giftwrapper->addGiftWrapper($user_id, $phone, $address);
            header("Location: index.php?controller=giftWrapper&action=dashboard/primary");
            exit;
        }
        require_once __DIR__ . '/../views/commonElements/extendedFrom.php';
    }


    public function dashboard()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'giftWrapper') {
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
}
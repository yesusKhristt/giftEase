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

        $this->GiftWrapper($parts);
    }

    public function allOrder($parts)
    {
        $orders = $this->giftwrapper->getAllOrders();
        require_once __DIR__ . '/../views/Dashboards/GiftWrapper/allOrders.php';
    }

    public function assignedOrder($parts)
    {
        $myOrders = $this->giftwrapper->getAssignedOrders($_SESSION['user']['id']) ?? '';
        require_once __DIR__ . '/../views/Dashboards/GiftWrapper/assignedOrders.php';
    }

    public function acceptOrder($parts)
    {

        $this->giftwrapper->acceptOrder($parts[2], $_SESSION['user']['id']);
        header("Location: index.php?controller=giftWrapper&action=dashboard/assignedOrder");
        exit;
    }

    public function markComplete($parts)
    {

        $this->giftwrapper->markComplete($parts[2]);
        header("Location: index.php?controller=giftWrapper&action=dashboard/assignedOrder");
        exit;
    }

    public function cancelOrder($parts)
    {

        $this->giftwrapper->cancelOrder($parts[2]);
        header("Location: index.php?controller=giftWrapper&action=dashboard/assignedOrder");
        exit;
    }

    public function GiftWrapper($level1)
    {
        switch ($level1[1]) {
            case 'analytics':
                require_once __DIR__ . '/../views/Dashboards/GiftWrapper/analitic.php';
                break;
            case 'allOrder':
                $this->allOrder($level1);
                break;
            case 'assignedOrder':
                $this->assignedOrder($level1);
                break;
            case 'markComplete':
                $this->markComplete($level1);
                break;
            case 'acceptOrder':
                $this->acceptOrder($level1);
                break;
            case 'cancelOrder':
                $this->cancelOrder($level1);
                break;
            case 'earnings':
                require_once __DIR__ . '/../views/Dashboards/GiftWrapper/earning.php';
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
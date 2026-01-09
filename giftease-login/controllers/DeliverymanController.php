<?php
class DeliverymanController
{
    private $deliveryman;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/DeliverymanModel.php';
        $this->deliveryman = new DeliverymanModel($pdo);
    }
    public function dashboard()
    {
        if (!$this->deliveryman->getUserByEmail($_SESSION['user']['email'])) {
            header("Location: index.php?controller=auth&action=handleLogin&type=staff");
            exit;
        }
        global $pdo;
        $path = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Deliveryman($parts[1]);
    }
    public function Deliveryman($level1)
    {
        switch ($level1) {
            case 'primary':
                require_once __DIR__ . '/../views/Dashboards/Deliveryman/deliverymanDashboard.php';
                break;
            case 'analysis':
                require_once __DIR__ . '/../views/Dashboards/Deliveryman/deliverymanDashboard.php';
                break;
            default:
                require_once __DIR__ . '/../views/Dashboards/Deliveryman/deliverymanDashboard.php';
                break;
        }
    }

    public function handleLogout()
    {
        $_SESSION['deliveryman'] = null;
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
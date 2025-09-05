<?php
class VendorController
{
    public function dashboard()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'deliveryman') {
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
}
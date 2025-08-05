<?php
require_once 'controllers/AuthController.php';

$auth = new AuthController();

$action = $_GET['action'] ?? 'login';

switch ($action) {
    case 'signup':
        $auth->handleSignup();
        break;
    case 'login':
        $auth->handleLogin();
        break;
    case 'dashboard':
        $type = $_GET['type'] ?? 'client';
        switch ($type) {
            case 'vendor':
                require_once __DIR__ . '/views/Dashboards/vendorDashboard.php';
                break;
            case 'delivery':
                require_once __DIR__ . '/views/Dashboards/deliveryDashboard.php';
            case 'deliveryman':
                require_once __DIR__ . '/views/Dashboards/deliverymanDashboard.php';
                break;
            case 'giftWrapper':
                require_once __DIR__ . '/views/Dashboards/giftWrapperDashboard.php';
                break;
            case 'admin':
                require_once __DIR__ . '/views/Dashboards/adminDashboard.php';
                break;
            default:
                require_once __DIR__ . '/views/Dashboards/clientDashboard.php';
                break;
        }
        break;

}

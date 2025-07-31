<?php
require_once 'controllers/AuthController.php';
//poop
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
            case 'staff':
                require_once __DIR__ . '/views/Dashboards/staffDashboard.php';
                break;
            default:
                require_once __DIR__ . '/views/Dashboards/clientDashboard.php';
                break;
        }
        break;
}
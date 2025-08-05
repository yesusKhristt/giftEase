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
        $auth->monitorDashboards();
        break;

}

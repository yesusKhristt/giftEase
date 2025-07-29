<?php
require_once 'controllers/AuthController.php';

$auth = new AuthController();

$action = $_GET['action'] ?? 'signup';

switch ($action) {
    case 'signup':
        $auth->handleSignup();
        break;
    default:
        $auth->handleLogin();
        break;
}
<?php

require_once __DIR__ . '/../models/UserModel.php';

class AuthController {
    private $model;

    public function __construct() {
        $this->model = new UserModel(__DIR__ . '/../data/users.json');
    }

    public function handleLogin() {
        $error = '';
        $user = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $user = $this->model->authenticate($email, $password);

            if ($user) {
                require_once __DIR__ . '/../views/dashboard.php';
                return;
            } else {
                $error = '❌ Invalid email or password.';
            }
        }

        require_once __DIR__ . '/../views/login.php';
    }
}

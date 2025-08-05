<?php

require_once __DIR__ . '/../models/UserModel.php';

class AuthController
{
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function handleLogin()
    {
        $error = '';
        $user = null;

        // Get user type from URL (default to client)
        $type = $_GET['type'] ?? 'client';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $type = $_GET['type'] ?? 'client';
            $user = $this->model->authenticate($email, $password, $type);
            /*
            if ($user) {
                switch ($type) {
                    case 'staff':
                        require_once __DIR__ . '/../views/Dashboards/staffDashboard.php';
                        break;
                    case 'vendor':
                        require_once __DIR__ . '/../views/Dashboards/vendorDashboard.php';
                        break;
                    default:
                        require_once __DIR__ . '/../views/Dashboards/clientDashboard.php';
                        break;
                }
                return;
            } else {
                $error = '❌ Invalid email or password.';
            }
            */
            if ($user) {
                header("Location: index.php?action=dashboard&type=$type");
                exit;
            } else {
                $error = '❌ Invalid email or password.';
            }
        }

        // Load different views based on user type
        switch ($type) {
            case 'staff':
                require_once __DIR__ . '/../views/Login/loginStaff.php';
                break;
            case 'vendor':
                require_once __DIR__ . '/../views/Login/loginVendor.php';
                break;
            case 'delivery':
                require_once __DIR__ . '/../views/Login/loginDelivery.php';
            default:
                require_once __DIR__ . '/../views/Login/loginClient.php';
                break;
        }
    }

    public function handleSignup()
    {
        $error = '';
        $success = '';

        $type = $_GET['type'] ?? 'client';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($this->model->getUserByEmail($email)) {
                $error = '❌ User already exists.';
            } else {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $this->model->addUser([
                    'name' => $name,
                    'email' => $email,
                    'password' => $hashedPassword,
                    'type' => $type
                ]);
                $success = '✅ Account created. Please log in.';
                header("Location: index.php?action=login&type=$type");
                exit;
            }

        }

        switch ($type) {
            case 'staff':
                require_once __DIR__ . '/../views/Signup/signupStaff.php';
                break;
            case 'vendor':
                require_once __DIR__ . '/../views/Signup/signupVendor.php';
                break;
            case 'delivery':
                require_once __DIR__ . '/../views/Signup/signupDelivery.php';
            default:
                require_once __DIR__ . '/../views/Signup/signupClient.php';
                break;
        }
    }

}






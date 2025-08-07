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
            if ($user) {
                header("Location: index.php?action=dashboard&type=$type");
                exit;
            } else {
                $error = '❌ Invalid email or password.';
            }
        }

        // Load different views based on user type
        require_once __DIR__ . '/../views/Login/login.php';
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
                header("Location: index.php?action=login&type=$type###");
                exit;
            }
        }

        require_once __DIR__ . '/../views/Signup/signup.php';
    }

    public function monitorDashboards()
    {
        $type = $_GET['type'] ?? 'client';
        $level1 = $_GET['level'] ?? 'primary';
        switch ($type) {
            case 'vendor':
                $this->Vendor($level1);
                break;
            case 'delivery':
                $this->Delivery($level1);
                break;
            case 'deliveryman':
                $this->Deliveryman($level1);
                break;
            case 'giftWrapper':
                $this->GiftWrapper($level1);
                break;
            case 'admin':
                $this->Admin($level1);
                break;
            case 'client':
                $this->Client($level1);
                break;
        }
    }

    public function Vendor($level1)
    {
        switch ($level1) {
            case 'primary':
                require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardOrders.php';
                break;
            case 'inventory':
                require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardInventory.php';
                break;
            case 'messeges':
                require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardMesseges.php';
                break;
            case 'analysis':
                require_once __DIR__ . '/../views/Dashboards/Vendor/vendorDashboardAnalysis.php';
                break;
        }
    }
    public function Delivery($level1)
    {
        switch ($level1) {
            case 'primary':
                require_once __DIR__ . '/../views/Dashboards/deliveryDashboard.php';
                break;
            case 'analysis':
                require_once __DIR__ . '/../views/Dashboards/deliveryDashboard.php';
                break;
        }
    }

    public function Deliveryman($level1)
    {
        switch ($level1) {
            case 'primary':
                require_once __DIR__ . '/../views/Dashboards/deliverymanDashboard.php';
                break;
            case 'analysis':
                require_once __DIR__ . '/../views/Dashboards/deliverymanDashboard.php';
                break;
        }
    }

    public function GiftWrapper($level1)
    {
        switch ($level1) {
            case 'primary':
                require_once __DIR__ . '/../views/Dashboards/giftWrapperDashboard.php';
                break;
            case 'analysis':
                require_once __DIR__ . '/../views/Dashboards/giftWrapperDashboard.php';
                break;
        }
    }

    public function Admin($level1)
    {
        switch ($level1) {
            case 'primary':
                require_once __DIR__ . '/../views/Dashboards/adminDashboard.php';
                break;
            case 'analysis':
                require_once __DIR__ . '/../views/Dashboards/adminDashboard.php';
                break;
        }
    }

    public function Client($level1)
    {
        switch ($level1) {
            case 'primary':
                require_once __DIR__ . '/../views/Dashboards/clientDashboard.php';
                break;
            case 'analysis':
                require_once __DIR__ . '/../views/Dashboards/clientDashboard.php';
                break;
        }
    }

}






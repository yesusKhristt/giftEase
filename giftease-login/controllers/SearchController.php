<?php

class SearchController
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function search()
    {
        $data = json_decode(file_get_contents("php://input"), true);

        $keyword = trim($data['keyword'] ?? '');
        $page    = $data['page'] ?? '';

        if ($keyword === '') {
            echo '';
            return;
        }

        // 🔐 Detect role
        if (isset($_SESSION['admin'])) {
            $role = 'admin';
        } elseif (isset($_SESSION['delivery'])) {
            $role = 'delivery';
        } elseif (isset($_SESSION['user'])) {
            $role = 'user';
        } elseif (isset($_SESSION['vendor'])) {
            $role = 'vendor';
        } else {
            http_response_code(401);
            echo 'Unauthorized';
            return;
        }

        // 🔎 Role-based search
        switch ($role) {

            case 'admin':
                require_once BASE_PATH . '/models/AdminSearchModel.php';
                $model = new AdminSearchModel($this->pdo);
                $results = $model->search($keyword, $page);
                break;

            case 'delivery':
                require_once BASE_PATH . '/models/DeliverySearchModel.php';
                $model = new DeliverySearchModel($this->pdo);
                $results = $model->search($keyword, $page);
                break;

            default:
                echo 'Unauthorized';
                return;
        }

        include BASE_PATH . '/views/search/results.php';
    }
}

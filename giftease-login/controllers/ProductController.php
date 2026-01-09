<?php
class ProductController
{
    private $model;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/ProdyctsModel.php';
        require_once __DIR__ . '/../models/UserModel.php';
        $this->user = new UserModel($pdo);
        $this->model = new ProductsModel($pdo);
    }
    


    public function addProduct()
    {
        $error = '';
        $success = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $V_ID = $_POST['v_id'] ?? '';
            $name = $_POST['p_name'] ?? '';
            $price = $_POST['price'] ?? '';
            $description = $_POST['description'] ?? '';

            $this->model->addProduct([
                'vendor_id' => $V_ID,
                'name' => $name,
                'price' => $price,
                'description' => $description
            ]);
            $success = '✅ Account created. Please log in.';
            //header("Location: index.php?action=login&type=$type###");
            exit;
        }

        require_once __DIR__ . '/../views/Signup/signupClient.php'; //add item goes here
    }
}
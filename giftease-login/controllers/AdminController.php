<?php
class AdminController
{
    private $giftWrapping;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/GiftWrappingModel.php';
        $this->giftWrapping = new GiftWrapppingModel($pdo);
    }
    public function dashboard()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['type'] !== 'admin') {
            header("Location: index.php?controller=auth&action=handleLogin&type=staff");
            exit;
        }
        global $pdo;
        $path = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Admin($parts);
    }

    public function addGiftWrappingItems($parts)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['Name'];
            $price = $_POST['Price'];
            $layer = $_POST['Layer'];

            $uploadDir1 = "resources/uploads/admin/giftWrappingItems/$parts[2]/previewImage/";
            if (!is_dir($uploadDir1))
                mkdir($uploadDir1, 0777, true);


            // Get file info
            $tmpName = $_FILES['previewImage']['tmp_name'];
            $fileName = time() . "_" . basename($_FILES['previewImage']['name']);
            $targetFile = $uploadDir1 . $fileName;

            // Move file to upload folder
            if (move_uploaded_file($tmpName, $targetFile)) {
                // store the uploaded file path
                $previewImage = $targetFile;
                echo "File uploaded successfully: $previewImage";
            } else {
                echo "File upload failed.";
            }

            $uploadDir2 = "resources/uploads/admin/giftWrappingItems/$parts[2]/displayImage/";
            if (!is_dir($uploadDir2))
                mkdir($uploadDir2, 0777, true);
            // Get file info
            $tmpName = $_FILES['displayImage']['tmp_name'];
            $fileName = time() . "_" . basename($_FILES['displayImage']['name']);
            $targetFile = $uploadDir2 . $fileName;

            // Move file to upload folder
            if (move_uploaded_file($tmpName, $targetFile)) {
                // store the uploaded file path
                $displayImage = $targetFile;
                echo "File uploaded successfully: $displayImage";
            } else {
                echo "File upload failed.";
            }
            switch ($parts[2]) {
                case 'boxRibbon':
                    $this->giftWrapping->addBoxRibbon($name, $price, $previewImage, $displayImage, $layer);
                    break;
                case 'boxWrap':
                    $this->giftWrapping->addBoxWrap($name, $price, $previewImage, $displayImage, $layer);
                    break;
                case 'paperBag':
                    $this->giftWrapping->addPaperBag($name, $price, $previewImage, $displayImage, $layer);
                    break;
                case 'paperBagRibbon':
                    $this->giftWrapping->addPaperBagRibbon($name, $price, $previewImage, $displayImage, $layer);
                    break;
                case 'chocolates':
                    $this->giftWrapping->addChocolates($name, $price, $previewImage, $displayImage, $layer);
                    break;
                case 'cards':
                    $this->giftWrapping->addCard($name, $price, $previewImage, $displayImage, $layer);
                    break;
                case 'softToys':
                    $this->giftWrapping->addSoftToy($name, $price, $previewImage, $displayImage, $layer);
                    break;
            }
            header("Location: index.php?controller=admin&action=dashboard/addGiftWrappingItems/#");
            exit;
        }
        require_once __DIR__ . '/../views/Dashboards/Admin/addGiftWrappingItems.php';
    }
    public function Admin($parts)
    {
        switch ($parts[1]) {
            case 'customer':
                require_once __DIR__ . '/../views/Dashboards/Admin/customer.php';
                break;
            case 'delivery':
                require_once __DIR__ . '/../views/Dashboards/Admin/deliver.php';
                break;
            case 'items':
                require_once __DIR__ . '/../views/Dashboards/Admin/items new.php';
                break;
            case 'reports':
                require_once __DIR__ . '/../views/Dashboards/Admin/reports nesw.php';
                break;
            case 'settings':
                require_once __DIR__ . '/../views/Dashboards/Admin/settings new.php';
                break;
            case 'giftWrapping':
                require_once __DIR__ . '/../views/Dashboards/Admin/giftWrapping.php';
                break;
            case 'Admin':
                require_once __DIR__ . '/../views/Dashboards/Admin/Admins.php';
                break;
            case 'profile':
                require_once __DIR__ . '/../views/Dashboards/Admin/profile.php';
                break;
            case 'vendor':
                require_once __DIR__ . '/../views/Dashboards/Admin/vendors.php';
                break;
            case 'addGiftWrappingItems':
                $this->addGiftWrappingItems($parts);
                break;
            default:
                require_once __DIR__ . '/../views/Dashboards/Admin/front.php';
                break;
        }
    }
}
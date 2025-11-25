<?php

class AdminController
{
    private $giftWrapping;
    private $category;

    private $vendor;
    
    private $delivery;

    private $giftwrappers;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/CategoryModel.php';
        require_once __DIR__ . '/../models/GiftWrappingModel.php';
        require_once __DIR__ . '/../models/VendorModel.php';
        require_once __DIR__ . '/../models/DeliveryModel.php';
        $this->giftWrapping = new GiftWrapppingModel($pdo);
        $this->category = new CategoryModel($pdo);
        $this->vendor = new VendorModel($pdo);
        $this->delivery = new DeliveryModel($pdo);
        
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

    public function addCategory($parts)
    {
        $categories = $this->category->getCategory();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        }
        $action = $parts[2] ?? '';
        if ($action === 'add') {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $action = $parts[3] ?? '';
                if ($action === 'category') {
                    $name = $_POST['name'];
                    $this->category->addCategory($name);
                }
                if ($action === 'subcategory') {
                    $name = $_POST['name'];
                    $category = $_POST['category'];
                    $this->category->addSubcategory($name, $category);
                }
                header("Location: index.php?controller=admin&action=dashboard/category/add/category");
                exit;
            }
            require_once __DIR__ . '/../views/Dashboards/Admin/addCategory.php';
        } else if ($action === 'edit') {
            $subcategories = $this->category->getAllSubcategory();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $action = $parts[3] ?? '';
                if ($action === 'category') {
                    $subaction = $parts[4] ?? '';
                    if ($subaction === 'update') {
                        $id = $_POST['id'];
                        $name = $_POST['name'];
                        $this->category->updateCategory($id, $name);
                    } else if ($subaction === 'delete') {
                        $id = $_POST['id'];
                        $this->category->deleteCategory($id);
                    }
                }
                if ($action === 'subcategory') {
                    $subaction = $parts[4] ?? '';
                    if ($subaction === 'update') {
                        $id = $_POST['id'];
                        $name = $_POST['name'];
                        $category = $_POST['category'];
                        $this->category->updateSubcategory($id, $name, $category);
                    } else if ($subaction === 'delete') {
                        $id = $_POST['id'];
                        $this->category->deleteSubcategory($id);
                    }
                }
                header("Location: index.php?controller=admin&action=dashboard/category/edit");
                exit;
            }
            require_once __DIR__ . '/../views/Dashboards/Admin/editCategory.php';
        } else {
            require_once __DIR__ . '/../views/Dashboards/Admin/category.php';
        }
    }

    public function editGiftWrappingItems($parts)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $parts[4];
            if ($parts[2] === 'update') {
                $name = $_POST['Name'];
                $price = $_POST['Price'];
                $layer = $_POST['Layer'];

                switch ($parts[3]) {
                    case 'boxRibbon':
                        $this->giftWrapping->updateBoxRibbon($id, $name, $price, $layer);
                        break;
                    case 'boxWrap':
                        $this->giftWrapping->updateBoxWrap($id, $name, $price, $layer);
                        break;
                    case 'paperBag':
                        $this->giftWrapping->updatePaperBag($id, $name, $price, $layer);
                        break;
                    case 'paperBagRibbon':
                        $this->giftWrapping->updatePaperBagRibbon($id, $name, $price, $layer);
                        break;
                    case 'chocolates':
                        $this->giftWrapping->updateChocolates($id, $name, $price, $layer);
                        break;
                    case 'cards':
                        $this->giftWrapping->updateCard($id, $name, $price, $layer);
                        break;
                    case 'softToys':
                        $this->giftWrapping->updateSoftToy($id, $name, $price, $layer);
                        break;
                }
            } else if ($parts[2] === 'delete') {
                switch ($parts[3]) {
                    case 'boxRibbon':
                        $this->giftWrapping->deleteBoxRibbon($id);
                        break;
                    case 'boxWrap':
                        $this->giftWrapping->deleteBoxWrap($id);
                        break;
                    case 'paperBag':
                        $this->giftWrapping->deletePaperBag($id);
                        break;
                    case 'paperBagRibbon':
                        $this->giftWrapping->deletePaperBagRibbon($id);
                        break;
                    case 'chocolates':
                        $this->giftWrapping->deleteChocolates($id);
                        break;
                    case 'cards':
                        $this->giftWrapping->deleteCard($id);
                        break;
                    case 'softToys':
                        $this->giftWrapping->deleteSoftToy($id);
                        break;
                }
            }
            header("Location: index.php?controller=admin&action=dashboard/editGiftWrappingItems");
            exit;
        }

        $boxWrap = $this->giftWrapping->getBoxWrap();
        $boxRibbon = $this->giftWrapping->getBoxRibbon();
        $paperBag = $this->giftWrapping->getPaperBag();
        $paperBagRibbon = $this->giftWrapping->getPaperBagRibbon();
        $chocolates = $this->giftWrapping->getChocolates();
        $softToys = $this->giftWrapping->getSoftToys();
        $cards = $this->giftWrapping->getCards();
        require_once __DIR__ . '/../views/Dashboards/Admin/editGiftWrappingItems.php';
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
    public function handleLogout()
    {
        $_SESSION['admin'] = null;
        header("Location: index.php?controller=auth&action=handleLogout");
        exit;
    }

    public function showVendors()
    {
        $allVendors = $this->vendor->getAllVendors();
        require_once __DIR__ . '/../views/Dashboards/Admin/vendors.php';
    }

    public function showDelivery()
{
    $allDelivery = $this->delivery->getAllDelivery();
    require_once __DIR__ . '/../views/Dashboards/Admin/deliver.php';
}

public function showGiftWrappers()
    {
        $allVendors = $this->giftwrappers->getAllGiftWrappers();
        require_once __DIR__ . '/../views/Dashboards/Admin/giftWrapping.php';
    }

    public function Admin($parts)
    {
        switch ($parts[1]) {
            case 'customer':
                require_once __DIR__ . '/../views/Dashboards/Admin/customer.php';
                break;
            case 'delivery':
                $this->showDelivery();
                break;

            case 'items':
                require_once __DIR__ . '/../views/Dashboards/Admin/items new.php';
                break;
            case 'settings':
                require_once __DIR__ . '/../views/Dashboards/Admin/settings new.php';
                break;
            case 'giftWrapping':
                $this->showGiftWrappers();
                break;
            case 'Admin':
                require_once __DIR__ . '/../views/Dashboards/Admin/Admins.php';
                break;
            case 'profile':
                require_once __DIR__ . '/../views/Dashboards/Admin/profile.php';
                break;
            case 'vendor':
                $this->showVendors($parts);
                break;
            
            case 'category':
                $this->addCategory($parts);
                break;
            case 'addGiftWrappingItems':
                $this->addGiftWrappingItems($parts);
                break;
            case 'editGiftWrappingItems':
                $this->editGiftWrappingItems($parts);
                break;
            
            default:
                require_once __DIR__ . '/../views/Dashboards/Admin/reports nesw.php';
                break;
        }
    }
}
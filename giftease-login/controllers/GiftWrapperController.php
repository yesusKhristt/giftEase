<?php
class giftWrapperController {
    private $giftwrapper;
    private $notification;
    private $giftWrapping;
    private $giftWrapperService;
    private $messeges;
    private $withdraw;

    public function __construct($pdo) {
        require_once __DIR__ . '/../models/GiftWrapperModel.php';
        require_once __DIR__ . '/../models/NotificationModel.php';
        require_once __DIR__ . '/../models/GiftWrappingModel.php';
        require_once __DIR__ . '/../models/GiftWrapperServiceModel.php';
        require_once __DIR__ . '/../models/MessegesModel.php';
        require_once __DIR__ . '/../models/WithdrawModel.php';
        $this->giftwrapper = new GiftWrapperModel($pdo); //bruh
        $this->notification = new NotificationModel($pdo);
        $this->giftWrapping = new GiftWrappingModel($pdo);
        $this->giftWrapperService = new GiftWrapperServiceModel($pdo);
        $this->messeges = new MessegesModel($pdo);
        $this->withdraw    = new WithdrawModel($pdo);
    }
    public function dashboard() {
        if (!$this->giftwrapper->getUserByEmail($_SESSION['user']['email'])) {
            header("Location: index.php?controller=auth&action=handleLogin&type=staff");
            exit;
        }
        global $pdo;
        $path = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->GiftWrapper($parts);
    }

    public function allOrder($parts) {
        $orders = $this->giftwrapper->getAllOrders();
        require_once __DIR__ . '/../views/Dashboards/GiftWrapper/allOrders.php';
    }

    public function assignedOrder($parts) {
        $myOrders = $this->giftwrapper->getAssignedOrders($_SESSION['user']['id']) ?? '';
        require_once __DIR__ . '/../views/Dashboards/GiftWrapper/assignedOrders.php';
    }

    public function acceptOrder($parts) {
        $order_id = $parts[2];
        $this->giftwrapper->acceptOrder($order_id, $_SESSION['user']['id']);

        $notificationTitle = "Order processing for Wrapping!";
        $notificationMessege = "Your Order will be wrapped by " . $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'];
        $href = "?controller=client&action=dashboard/messeges/giftWrapper/view/" . $_SESSION['user']['id'] . "/direct";
        $name = $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];
        $notificationMessege = $notificationMessege . $name;
        $this->notification->notifyClient($_SESSION['user']['id'], $notificationTitle, $notificationMessege, $href);

        $notificationTitle = "You have a new wrap Order!";
        $notificationMessege = "You've assigned yourself the wrapping of order " . $order_id;
        $href = "?controller=giftWrapper&action=dashboard/assignedOrder";
        $this->notification->notifyGiftWrapper($_SESSION['user']['id'], $notificationTitle, $notificationMessege, $href);

        header("Location: index.php?controller=giftWrapper&action=dashboard/assignedOrder");
        exit;
    }

    public function markComplete($parts) {
        $client_id = $parts[3];
        $notificationTitle = "Wrapping Complete!";
        $notificationMessege = "Your Order has been successfully wrapped";
        $href = "?controller=client&action=dashboard/notifications";
        $this->notification->notifyClient($client_id, $notificationTitle, $notificationMessege, $href);

        $this->giftwrapper->markComplete($parts[2]);
        header("Location: index.php?controller=giftWrapper&action=dashboard/assignedOrder");
        exit;
    }

    public function cancelOrder($parts) {
        $order_id = $parts[2];
        $client_id = $parts[3];
        $this->giftwrapper->cancelOrder($order_id);

        $notificationTitle = "You cancelled a wrapping order!";
        $notificationMessege = "You've cancelled the wrapping of order " . $order_id;
        $href = "?controller=giftWrapper&action=dashboard/notification";
        $this->notification->notifyGiftWrapper($_SESSION['user']['id'], $notificationTitle, $notificationMessege, $href);

        $notificationTitle = "Wrapping Cancelled!";
        $notificationMessege = "Your wrapping has been cancelled, please be patient";
        $href = "?controller=client&action=dashboard/notifications";
        $this->notification->notifyClient($client_id, $notificationTitle, $notificationMessege, $href);

        header("Location: index.php?controller=giftWrapper&action=dashboard/assignedOrder");
        exit;
    }


    public function service($parts) {
        $giftWrapperId = $_SESSION['user']['id'] ?? null;
        if (!$giftWrapperId) {
            header("Location: index.php?controller=auth&action=handleLogin&type=staff");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $price = $_POST['price'] ?? 0;
            $imagePath = null;

            if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../resources/uploads/giftWrapper/services/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $originalName = basename($_FILES['image']['name']);
                $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                $safeName = uniqid('service_', true) . ($extension ? '.' . $extension : '');
                $targetPath = $uploadDir . $safeName;

                if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
                    $imagePath = 'resources/uploads/giftWrapper/services/' . $safeName;
                }
            }

            if ($name !== '' && $description !== '') {
                $priceValue = is_numeric($price) ? (float) $price : 0;
                $this->giftWrapperService->addService($giftWrapperId, $name, $description, $priceValue, $imagePath);
            }

            header("Location: index.php?controller=giftWrapper&action=dashboard/service");
            exit;
        }

        $services = $this->giftWrapperService->getServicesByGiftWrapper($giftWrapperId);
        require_once __DIR__ . '/../views/Dashboards/GiftWrapper/service.php';
    }

    public function history($parts) {
        $giftWrapperId = $_SESSION['user']['id'] ?? null;
        $dateFrom = $_GET['dateFrom'] ?? '';
        $dateTo = $_GET['dateTo'] ?? '';
        $status = $_GET['status'] ?? 'all';
        $customer = $_GET['customer'] ?? '';
        $filters = [
            'dateFrom' => $dateFrom,
            'dateTo' => $dateTo,
            'status' => $status,
            'customer' => $customer
        ];
        $history = $giftWrapperId ? $this->giftwrapper->getWrappingHistory($giftWrapperId, $filters) : [];
        require_once __DIR__ . '/../views/Dashboards/GiftWrapper/history.php';
    }

    public function profile($parts) {
        $giftWrapperId = $_SESSION['user']['id'] ?? null;
        $profile = $this->giftwrapper->getUserByEmail($_SESSION['user']['email']);
        $totalAssignedOrdersCount = $giftWrapperId ? $this->giftwrapper->getTotalAssignedOrdersCount($giftWrapperId) : 0;
        $completedOrdersCount = $giftWrapperId ? $this->giftwrapper->getCompletedOrdersCount($giftWrapperId) : 0;
        $totalWrappedCount = $giftWrapperId ? $this->giftwrapper->getTotalWrappedCount($giftWrapperId) : 0;
        $totalWrappingRevenue = $giftWrapperId ? $this->giftwrapper->getTotalWrappingRevenue($giftWrapperId) : 0;
        $successRate = $totalAssignedOrdersCount > 0 ? ($completedOrdersCount / $totalAssignedOrdersCount) * 100 : 0;
        $avgRating = null;
        require_once __DIR__ . '/../views/Dashboards/GiftWrapper/profile.php';
    }

    public function overview($parts) {
        $giftWrapperId = $_SESSION['user']['id'] ?? null;
        $allOrdersCount = $this->giftwrapper->getAllOrdersCount();
        $totalAssignedOrdersCount = $giftWrapperId ? $this->giftwrapper->getTotalAssignedOrdersCount($giftWrapperId) : 0;
        $pendingOrdersCount = $giftWrapperId ? $this->giftwrapper->getPendingOrdersCount($giftWrapperId) : 0;
        $completedOrdersCount = $giftWrapperId ? $this->giftwrapper->getCompletedOrdersCount($giftWrapperId) : 0;
        $weeklyRevenue = $giftWrapperId ? $this->giftwrapper->getWeeklyWrappingRevenue($giftWrapperId) : 0;
        $weeklyOrderCount = $giftWrapperId ? $this->giftwrapper->getWeeklyWrappingOrderCount($giftWrapperId) : 0;
        $avgWeeklyPerOrder = $weeklyOrderCount > 0 ? ($weeklyRevenue / $weeklyOrderCount) : 0;
        require_once __DIR__ . '/../views/Dashboards/GiftWrapper/overview.php';
    }

    public function GiftWrapper($level1) {
        switch ($level1[1]) {
            case 'analytics':
                require_once __DIR__ . '/../views/Dashboards/GiftWrapper/analitic.php';
                break;
            case 'allOrder':
                $this->allOrder($level1);
                break;
            case 'assignedOrder':
                $this->assignedOrder($level1);
                break;
            case 'markComplete':
                $this->markComplete($level1);
                break;
            case 'acceptOrder':
                $this->acceptOrder($level1);
                break;
            case 'cancelOrder':
                $this->cancelOrder($level1);
                break;
            case 'messeges':
                $this->messeges($level1);
                break;
            case 'earnings':
                header("Location: index.php?controller=giftWrapper&action=dashboard/history");
                break;
            case 'history':
                $this->history($level1);
                break;
            case 'portfolio':
                require_once __DIR__ . '/../views/Dashboards/GiftWrapper/portfolio.php';
                break;
            case 'profile':
                $this->profile($level1);
                break;
            case 'wallet':
                $this->Finance($level1);
                break;
            case 'notifications':
                $this->notifications();
                break;
            case 'notificationViewed':
                $this->notificationViewed($level1);
                break;
            case 'service':
                $this->service($level1);
                break;
            case 'editProfile':
                $this->editProfile($level1);
                break;
            case 'updateProfilePicture':
                $this->updateProfilePicture($level1);
                break;
            default:
                $this->overview($level1);
                break;
        }
    }

    public function notifications() {
        $notifications = $this->notification->getGiftWrapperNotifications($_SESSION['user']['id']);
        require_once __DIR__ . '/../views/Dashboards/GiftWrapper/notification.php';
    }

    public function notificationViewed($parts) {
        $id = (int)$parts[2];
        $this->notification->viewNotificationGiftWrapper($id);
        exit();
    }

    public function Finance($parts) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($parts[2] == 'withdraw') {
                $amount = $_POST['amount'];
                $this->giftwrapper->withdrawMoney($_SESSION['user']['id'], $amount);
                $this->withdraw->requestWithdrawGiftWrapper($_SESSION['user']['id'], $amount);
            }
            if ($parts[2] == 'updateBank') {
                $bank_details = [
                    "bank_name" => $_POST['bank_name'],
                    "account_holder" => $_POST['account_number'],
                    "account_name" => $_POST['account_holder'],
                    "branch" => $_POST['branch']
                ];
                $this->giftwrapper->saveBank($_SESSION['user']['id'], $bank_details);
            }
        }
        $money = $this->giftwrapper->getAccountBalance($_SESSION['user']['id']);
        $pendingMoney = $this->giftwrapper->getPendingBalance($_SESSION['user']['id']);
        $bank = $this->giftwrapper->getBank($_SESSION['user']['id']);
        require_once __DIR__ . '/../views/Dashboards/GiftWrapper/wallet.php';
    }

    public function updateProfilePicture() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle file upload if user selected a new image
            $uploadDir = "resources/uploads/giftWrapper/profilePictures/";
            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Get file info
            $tmpName    = $_FILES['profilePic']['tmp_name'];
            $fileName   = time() . "_" . basename($_FILES['profilePic']['name']);
            $targetFile = $uploadDir . $fileName;

            // Move file to upload folder
            if (move_uploaded_file($tmpName, $targetFile)) {
                // store the uploaded file path
                $profilePicPath = $targetFile;
                echo "File uploaded successfully: $profilePicPath";
            } else {
                echo "File upload failed.";
            }
            $this->giftwrapper->updateProfilePicture($_SESSION['user']['id'], $profilePicPath);
            $_SESSION['user'] = $this->giftwrapper->getUserByID($_SESSION['user']['id']);
            header("Location: index.php?controller=giftwrapper&action=dashboard/profile");
            exit;

            //$this->test($this->vendor->getVendorID($_SESSION['user']['id']), $title, $price, $description, $category, $subcategory, $profilePicPath);
        }

        require_once __DIR__ . '/../views/Dashboards/GiftWrapper/addImage.php';
    }

    public function editProfile($parts) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'first_name' => $_POST['first_name'] ?? '',
                'last_name'  => $_POST['last_name'] ?? '',
                'phone'      => $_POST['phone'] ?? '',
                'years_of_experience'   => $_POST['year'] ?? '',
                'address'   => $_POST['address'] ?? '',

                'id' => $_SESSION['user']['id']
            ];

            $this->giftwrapper->updateUser($data);
            $_SESSION['user'] = $this->giftwrapper->getUserByID($_SESSION['user']['id']);
            header("Location: index.php?controller=giftWrapper&action=dashboard/profile");
            exit;

            // Redirect or show a success message
        }
        require_once __DIR__ . '/../views/Dashboards/GiftWrapper/edit.php';
    }

    public function messeges($parts) {
        $client_id = $parts[3] ?? '';

        if ($parts[2] === 'send') {
            $message = trim($_POST['message'] ?? '');

            if ($message === '' && empty($_FILES['attachments']['name'][0])) {
                echo json_encode(['success' => false, 'error' => 'Empty message']);
                exit;
            }

            $attatchmentPath = [];

            if (! empty($_FILES['attachments']['tmp_name'])) {

                $uploadDir = "resources/uploads/giftWrapper/attatchments/";
                if (! is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                foreach ($_FILES['attachments']['tmp_name'] as $key => $tmpName) {

                    $fileName   = time() . "_" . basename($_FILES['attachments']['name'][$key]);
                    $targetFile = $uploadDir . $fileName;

                    if (move_uploaded_file($tmpName, $targetFile)) {
                        $attatchmentPath[] = $fileName;
                    }
                }
            }

            $this->messeges->sendGiftWrapperMessege(
                $client_id,
                $_SESSION['user']['id'],
                [
                    'message'      => $message,
                    'attatchments' => $attatchmentPath,
                ],
                0
            );

            echo json_encode(['success' => true]);
            exit;
        }
        if ($parts[2] == "markRead") {
            $id = (int) $parts[3];
            if ($id <= 0) {
                echo json_encode(['success' => false, 'error' => 'Invalid ID']);
                return;
            }

            $result = $this->messeges->markMessagesAsReadStaff('giftwrapper', $_SESSION['user']['id'], $id);

            header('Content-Type: application/json');
            echo json_encode(['success' => $result]);
        }

        if ($parts[2] === 'view') {
            $myMessages = $this->messeges->getMessageGiftWrapper($_SESSION['user']['id']);
            require_once __DIR__ . '/../views/Dashboards/GiftWrapper/Messeges.php';
        }
    }

    public function handleLogout() {
        $_SESSION['giftWrapper'] = null;
        header("Location: index.php?controller=auth&action=handleLogout");
        exit;
    }

    public function deactivateUser() {
        $USER_ID = $_SESSION['user']['id'];
        $this->giftwrapper->deleteUser($USER_ID);
        header("Location: index.php");
        exit;
    }
}

<?php
class DeliveryController {
    private $delivery;
    private $notification;

    private $messeges;
    private $withdraw;


    public function __construct($pdo) {
        require_once __DIR__ . '/../models/DeliveryModel.php';
        require_once __DIR__ . '/../models/NotificationModel.php';
        require_once __DIR__ . '/../models/MessegesModel.php';
        require_once __DIR__ . '/../models/WithdrawModel.php';
        $this->notification = new NotificationModel($pdo);
        $this->delivery = new DeliveryModel($pdo);
        $this->messeges = new MessegesModel($pdo);
        $this->withdraw = new WithdrawModel($pdo);
    }

    public function dashboard() {
        if (!$this->delivery->getUserByEmail($_SESSION['user']['email'])) {
            header("Location: index.php?controller=auth&action=handleLogin&type=staff");
            exit;
        }
        global $pdo;
        $path = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Delivery($parts);
    }

    public function allOrder($parts) {
        $orders = $this->delivery->getAllOrders() ?? [];
        require_once __DIR__ . '/../views/Dashboards/Delivery/allOrders.php';
    }

    public function assignedOrder($parts) {
        $myOrders = $this->delivery->getAssignedOrders($_SESSION['user']['id']);
        require_once __DIR__ . '/../views/Dashboards/Delivery/assignedOrders.php';
    }

    public function acceptOrder($parts) {
        $order_id = $parts[2];
        $this->delivery->acceptOrder($order_id, $_SESSION['user']['id']);

        $notificationTitle = "Order picked up for Delivery!";
        $notificationMessege = "Your Order was picked up by " . $_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'];
        $href = "?controller=client&action=dashboard/messeges/delivery/view/" . $_SESSION['user']['id'] . "/direct";
        $this->notification->notifyClient($_SESSION['user']['id'], $notificationTitle, $notificationMessege, $href);

        $notificationTitle = "You have a new delivery!";
        $notificationMessege = "You've assigned yourself the delivery of order " . $order_id;
        $href = "?controller=delivery&action=dashboard/assignedOrder";
        $this->notification->notifyDelivery($_SESSION['user']['id'], $notificationTitle, $notificationMessege, $href);

        header("Location: index.php?controller=delivery&action=dashboard/assignedOrder");
        exit;
    }

    public function markComplete($parts) {
        $client_id = $parts[3];
        $notificationTitle = "Delivery Complete!";
        $notificationMessege = "Your Order has been successfully delivered";
        $href = "?controller=client&action=dashboard/notifications";
        $this->notification->notifyClient($client_id, $notificationTitle, $notificationMessege, $href);

        $this->delivery->markComplete($parts[2]);
        header("Location: index.php?controller=delivery&action=dashboard/assignedOrder");
        exit;
    }

    public function cancelOrder($parts) {
        $order_id = $parts[2];
        $client_id = $parts[3];
        $this->delivery->cancelOrder($order_id);

        $notificationTitle = "You cancelled a delivery!";
        $notificationMessege = "You've cancelled your delivery of order " . $order_id;
        $href = "?controller=delivery&action=dashboard/notification";
        $this->notification->notifyDelivery($_SESSION['user']['id'], $notificationTitle, $notificationMessege, $href);

        $notificationTitle = "Delivery Cancelled!";
        $notificationMessege = "Your delivery has been cancelled, please be patient";
        $href = "?controller=client&action=dashboard/notifications";
        $this->notification->notifyClient($client_id, $notificationTitle, $notificationMessege, $href);

        header("Location: index.php?controller=delivery&action=dashboard/assignedOrder");
        exit;
    }

    public function Delivery($parts) {
        switch ($parts[1]) {
            case 'profile':
                $deliveryId = $_SESSION['user']['id'];
                $deliveryProfile = $this->delivery->getDeliveryById($deliveryId);
                $profileStats = $this->delivery->getProfileStats($deliveryId);
                require_once __DIR__ . '/../views/Dashboards/Delivery/profile.php';
                break;
            case 'history':
                $this->history();
                break;
            case 'map':
                require_once __DIR__ . '/../views/Dashboards/Delivery/map.php';
                break;
            case 'allOrder':
                $this->allOrder($parts);
                break;
            case 'assignedOrder':
                $this->assignedOrder($parts);
                break;
            case 'markComplete':
                $this->markComplete($parts);
                break;
            case 'acceptOrder':
                $this->acceptOrder($parts);
                break;
            case 'cancelOrder':
                $this->cancelOrder($parts);
                break;
            case 'messeges':
                $this->messeges($parts);
                break;
            case 'wallet':
                $this->Finance($parts);
                break;
            case 'notifications':
                $this->notifications();
                break;
            case 'notificationViewed':
                $this->notificationViewed($parts);
                break;
            case 'home':
                $deliveryId = $_SESSION['user']['id'];
                $dashboardStats = $this->delivery->getDashboardStats($deliveryId);
                $lastMonthAnalytics = $this->delivery->getLastMonthAnalytics($deliveryId);
                $lastMonthTrend = $this->delivery->getLastMonthTrend($deliveryId);
                require_once __DIR__ . '/../views/Dashboards/Delivery/home.php';
                break;
            case 'updateProfilePicture':
                $this->updateProfilePicture();
                break;
            case 'editProfile':
                $this->editProfile();
                break;
            default:
                $this->allOrder($parts);
                break;
        }
    }



    public function notifications() {
        $notifications = $this->notification->getDeliveryNotifications($_SESSION['user']['id']);
        require_once __DIR__ . '/../views/Dashboards/Delivery/notification.php';
    }

    public function notificationViewed($parts) {
        $id = (int)$parts[2];
        $this->notification->viewNotificationDelivery($id);
        exit();
    }

    public function Finance($parts) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($parts[2] == 'withdraw') {
                $amount = $_POST['amount'];
                $this->delivery->withdrawMoney($_SESSION['user']['id'], $amount);
                $this->withdraw->requestWithdrawDelivery($_SESSION['user']['id'], $amount);
            }
            if ($parts[2] == 'updateBank') {
                $bank_details = [
                    "bank_name" => $_POST['bank_name'],
                    "account_holder" => $_POST['account_number'],
                    "account_name" => $_POST['account_holder'],
                    "branch" => $_POST['branch']
                ];
                $this->delivery->saveBank($_SESSION['user']['id'], $bank_details);
            }
        }
        $money = $this->delivery->getAccountBalance($_SESSION['user']['id']);
        $pendingMoney = $this->delivery->getPendingBalance($_SESSION['user']['id']);
        $bank = $this->delivery->getBank($_SESSION['user']['id']);
        require_once __DIR__ . '/../views/Dashboards/Delivery/wallet.php';
    }

    public function handleLogout() {
        session_unset();
        session_destroy();
        header("Location: index.php?controller=auth&action=landing");
        exit;
    }

    public function updateProfilePicture() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle file upload if user selected a new image
            $uploadDir = "resources/uploads/delivery/profilePictures/";
            if (! is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $profilePicPath = null;

            // Get file info
            $tmpName    = $_FILES['profilePic']['tmp_name'];
            $fileName   = time() . "_" . basename($_FILES['profilePic']['name']);
            $targetFile = $uploadDir . $fileName;

            // Move file to upload folder
            if (move_uploaded_file($tmpName, $targetFile)) {
                // store the uploaded file path
                $profilePicPath = $targetFile;
            }

            if ($profilePicPath !== null) {
                $this->delivery->updateProfilePicture($_SESSION['user']['id'], $profilePicPath);
                $_SESSION['user'] = $this->delivery->getUserByEmail($_SESSION['user']['email']);
            }

            header("Location: index.php?controller=delivery&action=dashboard/profile");
            exit;

            //$this->test($this->vendor->getVendorID($_SESSION['user']['id']), $title, $price, $description, $category, $subcategory, $profilePicPath);
        }

        require_once __DIR__ . '/../views/Dashboards/Delivery/addImage.php';
    }
    public function editProfile() {
        // Logic to handle profile editing

        $USER_ID = $_SESSION['user']['id'];
        $stmt = $this->delivery->getpdo()->prepare("SELECT * FROM delivery WHERE id = ?");
        $stmt->execute([$USER_ID]);
        $deliveryUser = $stmt->fetch();
        $user1 = $deliveryUser;
        $user2 = $deliveryUser;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $FIRST_NAME = $_POST['first_name'] ?? '';
            $LAST_NAME = $_POST['last_name'] ?? '';
            $PHONE = $_POST['phone'] ?? '';
            $ADDRESS = $_POST['address'] ?? '';
            $VEHICLE_PLATE = $_POST['vehiclePlate'] ?? '';

            $this->delivery->updateUser([
                'id' => $USER_ID,
                'first_name' => $FIRST_NAME,
                'last_name' => $LAST_NAME,
                'phone' => $PHONE,
                'address' => $ADDRESS,
                'vehiclePlate' => $VEHICLE_PLATE,
            ]);
            header("Location: index.php?controller=delivery&action=dashboard/account");
            exit;
        }
        require_once __DIR__ . '/../views/Dashboards/Delivery/edit.php';
    }
    public function history() {
        $filters = [
            'dateFrom' => $_GET['dateFrom'] ?? '',
            'dateTo'   => $_GET['dateTo'] ?? '',
            'status'   => $_GET['status'] ?? 'all',
            'customer' => $_GET['customer'] ?? ''
        ];

        // Get delivery history from database
        $deliveryId = $_SESSION['user']['id'];
        $allHistory = $this->delivery->getDeliveryHistory($deliveryId, $filters);

        // Process the data for display
        $history = array_map(function ($row) {
            return [
                'id' => 'ORD-' . str_pad($row['id'], 3, '0', STR_PAD_LEFT),
                'customer_name' => $row['first_name'] . ' ' . $row['last_name'],
                'product_name' => $row['product_names'] ?? 'N/A',
                'delivery_date' => $row['deliveryDate'],
                'status' => $row['is_delivered'] ? 'delivered' : 'pending',
                'earnings' => 'Rs.' . number_format($row['deliveryPrice'], 2),
                'distance' => 'N/A'
            ];
        }, $allHistory);

        // Apply status filter if needed
        if ($filters['status'] !== 'all') {
            $history = array_filter($history, function ($item) use ($filters) {
                return $item['status'] === $filters['status'];
            });
        }

        require_once __DIR__ . '/../views/Dashboards/Delivery/history.php';
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

                $uploadDir = "resources/uploads/delivery/attatchments/";
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

            $this->messeges->sendDeliveryMessege(
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
            $id = $parts[3];

            $id = (int) $id;
            if ($id <= 0) {
                echo json_encode(['success' => false, 'error' => 'Invalid ID']);
                return;
            }

            $result = $this->messeges->markMessagesAsReadStaff('delivery', $_SESSION['user']['id'], $id);

            header('Content-Type: application/json');
            echo json_encode(['success' => $result]);
        }
        if ($parts[2] === 'view') {
            $myMessages = $this->messeges->getMessageDelivery($_SESSION['user']['id']);
            require_once __DIR__ . '/../views/Dashboards/Delivery/Messeges.php';
        }
    }
}

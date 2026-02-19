<?php
class DeliveryController {
    private $delivery;
    private $notification;
    private $messeges;

    public function __construct($pdo) {
        require_once __DIR__ . '/../models/DeliveryModel.php';
        require_once __DIR__ . '/../models/NotificationModel.php';
        require_once __DIR__ . '/../models/MessegesModel.php';
        $this->notification = new NotificationModel($pdo);
        $this->delivery = new DeliveryModel($pdo);
        $this->messeges = new MessegesModel($pdo);
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
        $orders = $this->delivery->getAllOrders();
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
        header("Location: index.php?controller=delivery&action=dashboard/assignedOrder");
        exit;
    }

    public function markComplete($parts) {

        $this->delivery->markComplete($parts[2]);
        header("Location: index.php?controller=delivery&action=dashboard/proof");
        exit;
    }

    public function cancelOrder($parts) {

        $this->delivery->cancelOrder($parts[2]);
        header("Location: index.php?controller=delivery&action=dashboard/assignedOrder");
        exit;
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

    public function Delivery($parts) {
        switch ($parts[1]) {
            case 'profile':
                $this->profile($parts);
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
            case 'proof':
                require_once __DIR__ . '/../views/Dashboards/Delivery/proof.php';
                break;
            case 'settings':
                $this->settings();
                break;
            case 'updateProfilePicture':
                $this->updateProfilePicture();
                break;
            case 'editProfile':
                $this->editProfile();
                break;
            default:
                $this->home();
                break;
        }
    }
    public function home() {
        $deliveryId = $_SESSION['user']['id'];
        $dashboardStats = $this->delivery->getDashboardStats($deliveryId);
        require_once __DIR__ . '/../views/Dashboards/Delivery/home.php';
    }

    public function settings() {
        $deliveryId = $_SESSION['user']['id'];
        $deliveryProfile = $this->delivery->getDeliveryById($deliveryId);
        require_once __DIR__ . '/../views/Dashboards/Delivery/Settings.php';
    }

    public function profile() {
        $deliveryId = $_SESSION['user']['id'];
        $deliveryProfile = $this->delivery->getDeliveryById($deliveryId);
        $profileStats = $this->delivery->getProfileStats($deliveryId);
        require_once __DIR__ . '/../views/Dashboards/Delivery/profile.php';
    }

    public function updateProfilePicture() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Handle file upload if user selected a new image
            $uploadDir = "resources/uploads/delivery/profilePictures/";
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
            $this->delivery->updateProfilePicture($_SESSION['user']['id'], $profilePicPath);
            $_SESSION['user'] = $this->delivery->getUserByID($_SESSION['user']['id']);
            header("Location: index.php?controller=delivery&action=dashboard/profile");
            exit;

            //$this->test($this->vendor->getVendorID($_SESSION['user']['id']), $title, $price, $description, $category, $subcategory, $profilePicPath);
        }

        require_once __DIR__ . '/../views/Dashboards/Delivery/addImage.php';
    }


    public function handleLogout() {
        $_SESSION['delivery'] = null;
        header("Location: index.php?controller=auth&action=handleLogout");
        exit;
    }

    public function editProfile() {


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'first_name' => $_POST['first_name'] ?? '',
                'last_name'  => $_POST['last_name'] ?? '',
                'phone'      => $_POST['phone'] ?? '',
                'id' => $_SESSION['user']['id']
            ];

            $this->delivery->updateUser($data);
            $_SESSION['user'] = $this->delivery->getUserByID($_SESSION['user']['id']);
            header("Location: index.php?controller=delivery&action=dashboard/profile");
            exit;

            // Redirect or show a success message
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
        $delivery_id = $_SESSION['user']['id'];
        $allHistory = $this->delivery->getDeliveryHistory($delivery_id, $filters);

        // Process the data for display
        $history = array_map(function ($row) {
            return [
                'id' => 'ORD-' . str_pad($row['id'], 3, '0', STR_PAD_LEFT),
                'customer_name' => $row['first_name'] . ' ' . $row['last_name'],
                'product_name' => $row['product_names'] ?? 'N/A',
                'delivery_date' => $row['deliveryDate'],
                'status' => $row['is_delivered'] ? 'delivered' : 'pending',
                'earnings' => 'Rs.' . number_format($row['deliveryPrice'], 2),
                'rating' => 'N/A',
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
}

<?php
class DeliverymanController
{
    private $deliveryman;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/DeliverymanModel.php';
        $this->deliveryman = new DeliverymanModel($pdo);
    }
    public function dashboard()
    {
        $currentUser = $this->deliveryman->getUserByEmail($_SESSION['user']['email']);
        if (!$currentUser || ($currentUser['status'] ?? 'active') !== 'active') {
            header("Location: index.php?controller=auth&action=handleLogin&type=staff");
            exit;
        }

        $path = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Delivery($parts);
    }

    public function Delivery($parts)
    {
        switch ($parts[1]) {
            case 'profile':
                $deliverymanId = $_SESSION['user']['id'];
                $deliverymanProfile = $this->deliveryman->getUserById($deliverymanId);
                $profileStats = $this->deliveryman->getProfileStats($deliverymanId);
                require_once __DIR__ . '/../views/Dashboards/Deliveryman/profile.php';
                break;
            case 'editProfile':
                $this->editProfile($parts);
                break;
            case 'updateProfilePicture':
                $this->updateProfilePicture();
                break;
            case 'deleteProfile':
                $this->deactivateUser();
                break;
            case 'acceptTask':
                $this->acceptTask($parts);
                break;
            case 'markPickedUp':
                $this->markPickedUp($parts);
                break;
            case 'markAtOutlet':
                $this->markAtOutlet($parts);
                break;
            case 'markCompleted':
                $this->markCompleted($parts);
                break;
            case 'cancelTask':
                $this->cancelTask($parts);
                break;
            case 'map':
                require_once __DIR__ . '/../views/Dashboards/Deliveryman/map.php';
                break;
            case 'primary':
            case 'analysis':
            case 'home':
                $deliverymanId = $_SESSION['user']['id'];
                $dashboardStats = $this->deliveryman->getDashboardStats($deliverymanId);
                require_once __DIR__ . '/../views/Dashboards/Deliveryman/deliverymanDashboard.php';
                break;
            case 'available':
                $availableTasks = $this->deliveryman->getAvailablePickupTasks();
                require_once __DIR__ . '/../views/Dashboards/Deliveryman/availableTasks.php';
                break;
            case 'myTasks':
                $myTasks = $this->deliveryman->getMyPickupTasks($_SESSION['user']['id']);
                require_once __DIR__ . '/../views/Dashboards/Deliveryman/myTasks.php';
                break;
            case 'history':
                $allTasks = $this->deliveryman->getMyPickupTasks($_SESSION['user']['id']);
                $dateFrom = trim((string)($_GET['dateFrom'] ?? ''));
                $dateTo = trim((string)($_GET['dateTo'] ?? ''));
                $status = trim((string)($_GET['status'] ?? 'all'));
                $customer = trim((string)($_GET['customer'] ?? ''));

                $historyTasks = array_values(array_filter($allTasks, function ($task) use ($dateFrom, $dateTo, $status, $customer) {
                    if (!in_array($task['status'], ['completed', 'cancelled'], true)) {
                        return false;
                    }

                    if ($status !== 'all' && $task['status'] !== $status) {
                        return false;
                    }

                    $taskDate = isset($task['deliveryDate']) ? substr((string)$task['deliveryDate'], 0, 10) : '';
                    if ($dateFrom !== '' && $taskDate !== '' && $taskDate < $dateFrom) {
                        return false;
                    }
                    if ($dateTo !== '' && $taskDate !== '' && $taskDate > $dateTo) {
                        return false;
                    }

                    if ($customer !== '') {
                        $shopName = strtolower((string)($task['shopName'] ?? ''));
                        if (strpos($shopName, strtolower($customer)) === false) {
                            return false;
                        }
                    }

                    return true;
                }));
                require_once __DIR__ . '/../views/Dashboards/Deliveryman/history.php';
                break;
            default:
                header("Location: index.php?controller=deliveryman&action=dashboard/home");
                exit;
                break;
        }
    }
    public function editProfile($parts) {
        $userId = $_SESSION['user']['id'];
        $deliverymanProfile = $this->deliveryman->getUserById($userId);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'first_name' => $_POST['first_name'] ?? '',
                'last_name' => $_POST['last_name'] ?? '',
                'phone' => $_POST['phone'] ?? '',
                'address' => $_POST['address'] ?? '',
                'vehicleType' => $_POST['vehicleType'] ?? '',
                'vehiclePlate' => $_POST['vehiclePlate'] ?? '',
                'id' => $userId,
            ];

            $this->deliveryman->updateUser($data);
            $_SESSION['user'] = $this->deliveryman->getUserById($userId);
            header("Location: index.php?controller=deliveryman&action=dashboard/profile");
            exit;
        }

        require_once __DIR__ . '/../views/Dashboards/Deliveryman/edit.php';
    }

    public function updateProfilePicture() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $uploadDir = 'resources/uploads/deliveryman/profilePictures/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $profilePicPath = null;
            if (!empty($_FILES['profilePic']) && ($_FILES['profilePic']['error'] ?? UPLOAD_ERR_NO_FILE) === UPLOAD_ERR_OK) {
                $tmpName = $_FILES['profilePic']['tmp_name'];
                $fileName = time() . '_' . basename($_FILES['profilePic']['name']);
                $targetFile = $uploadDir . $fileName;

                if (move_uploaded_file($tmpName, $targetFile)) {
                    $profilePicPath = $targetFile;
                }
            }

            if ($profilePicPath !== null) {
                $this->deliveryman->updateProfilePicture($_SESSION['user']['id'], $profilePicPath);
                $_SESSION['user'] = $this->deliveryman->getUserById($_SESSION['user']['id']);
            }

            header('Location: index.php?controller=deliveryman&action=dashboard/profile');
            exit;
        }

        require_once __DIR__ . '/../views/Dashboards/Deliveryman/addImage.php';
    }

    public function acceptTask($parts)
    {
        $taskId = isset($parts[2]) ? (int)$parts[2] : 0;
        if ($taskId > 0) {
            $this->deliveryman->acceptPickupTask($taskId, $_SESSION['user']['id']);
        }
        header("Location: index.php?controller=deliveryman&action=dashboard/available");
        exit;
    }

    public function markPickedUp($parts)
    {
        $taskId = isset($parts[2]) ? (int)$parts[2] : 0;
        if ($taskId > 0) {
            $this->deliveryman->updatePickupTaskStatus($taskId, $_SESSION['user']['id'], 'picked_up');
        }
        header("Location: index.php?controller=deliveryman&action=dashboard/myTasks");
        exit;
    }

    public function markAtOutlet($parts)
    {
        $taskId = isset($parts[2]) ? (int)$parts[2] : 0;
        if ($taskId > 0) {
            $this->deliveryman->updatePickupTaskStatus($taskId, $_SESSION['user']['id'], 'at_outlet');
        }
        header("Location: index.php?controller=deliveryman&action=dashboard/myTasks");
        exit;
    }

    public function markCompleted($parts)
    {
        $taskId = isset($parts[2]) ? (int)$parts[2] : 0;
        if ($taskId > 0) {
            $this->deliveryman->updatePickupTaskStatus($taskId, $_SESSION['user']['id'], 'completed');
        }
        header("Location: index.php?controller=deliveryman&action=dashboard/myTasks");
        exit;
    }

    public function cancelTask($parts)
    {
        $taskId = isset($parts[2]) ? (int)$parts[2] : 0;
        if ($taskId > 0) {
            $this->deliveryman->cancelPickupTask($taskId, $_SESSION['user']['id']);
        }
        header("Location: index.php?controller=deliveryman&action=dashboard/myTasks");
        exit;
    }

    public function handleLogout()
    {
        session_unset();
        session_destroy();
        header("Location: index.php?controller=auth&action=landing");
        exit;

    }
    public function deactivateUser()
    {
        $USER_ID = $_SESSION['user']['id'];
        $this->deliveryman->deleteUser($USER_ID);
        session_unset();
        session_destroy();
        header("Location: index.php?controller=auth&action=landing");
        exit;
    }
}
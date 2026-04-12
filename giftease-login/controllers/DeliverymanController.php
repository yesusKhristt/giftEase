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
        if (!$this->deliveryman->getUserByEmail($_SESSION['user']['email'])) {
            header("Location: index.php?controller=auth&action=handleLogin&type=staff");
            exit;
        }

        $path = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Deliveryman($parts);
    }

    public function Deliveryman($parts)
    {
        $level1 = $parts[1] ?? 'home';

        switch ($level1) {
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
        $_SESSION['deliveryman'] = null;
        header("Location: index.php?controller=auth&action=handleLogout");
        exit;

    }

            public function deactivateUser()
    {
        $USER_ID = $_SESSION['user']['id'];
        $this->deliveryman->deleteUser($USER_ID);
        header("Location: index.php");
        exit;
    }
}
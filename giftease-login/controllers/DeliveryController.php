<?php
class DeliveryController
{
    private $delivery;

    public function __construct($pdo)
    {
        require_once __DIR__ . '/../models/DeliveryModel.php';
        $this->delivery = new DeliveryModel($pdo);
    }

    public function dashboard()
    {
        if (!$this->delivery->getUserByEmail($_SESSION['user']['email'])) {
            header("Location: index.php?controller=auth&action=handleLogin&type=staff");
            exit;
        }
        global $pdo;
        $path = $_GET['action'];
        $parts = explode('/', trim($path, '/'));

        $this->Delivery($parts);
    }
    public function Delivery($parts)
    {
        switch ($parts[1]) {
            case 'profile':
                require_once __DIR__ . '/../views/Dashboards/Delivery/profile.php';
                break;
            case 'history':
                $this->history();
                break;
            case 'map':
                require_once __DIR__ . '/../views/Dashboards/Delivery/map.php';
                break;
            case 'notification':
                require_once __DIR__ . '/../views/Dashboards/Delivery/notification.php';
                break;
            case 'order':
                require_once __DIR__ . '/../views/Dashboards/Delivery/order.php';
                break;
            case 'proof':
                require_once __DIR__ . '/../views/Dashboards/Delivery/proof.php';
                break;
            case 'settings':
                require_once __DIR__ . '/../views/Dashboards/Delivery/Settings.php';
                break;
            default:
                require_once __DIR__ . '/../views/Dashboards/Delivery/home.php';
                break;
        }
    }
    public function handleLogout()
    {
        $_SESSION['delivery'] = null;
        header("Location: index.php?controller=auth&action=handleLogout");
        exit;

    }
    public function editProfile()
    {
        // Logic to handle profile editing
        $USER_ID = $_SESSION['user']['id'];
        $stmt1 = $this->delivery->getpdo()->prepare("SELECT * FROM users WHERE id = ?");
        $stmt2 = $this->delivery->getpdo()->prepare("SELECT * FROM delivery WHERE user_id = ?");
        $stmt1->execute([$USER_ID]);
        $user1 = $stmt1->fetch();
        $stmt2->execute([$USER_ID]);
        $user2 = $stmt2->fetch();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $FIRST_NAME = $_POST['first_name'] ?? '';
            $LAST_NAME = $_POST['last_name'] ?? '';
            $PHONE = $_POST['phone'] ?? '';
            $ADDRESS = $_POST['address'] ?? '';


            $this->delivery->updateDelivery($USER_ID, $FIRST_NAME, $LAST_NAME, $PHONE, $ADDRESS);
            header("Location: index.php?controller=delivery&action=dashboard/account");
            exit;

            // Redirect or show a success message
        }
        require_once __DIR__ . '/../views/Dashboards/Delivery/edit.php';
    }

   

      public function history() {
    require_once __DIR__ . '/../models/DeliveryModel.php';

    // 1. Read filter values from GET
    $filters = [
        'dateFrom' => $_GET['dateFrom'] ?? '',
        'dateTo'   => $_GET['dateTo'] ?? '',
        'status'   => $_GET['status'] ?? 'all',
        'customer' => $_GET['customer'] ?? ''
    ];

    // 2. Hard-coded delivery history (temporary until DB ready)
    $allHistory = [
        [
            'id' => 'DEL-001',
            'customer_name' => 'Saneth Tharushika',
            'product_name' => 'Premium Rose Bouquet',
            'delivery_date' => '2024-01-15',
            'status' => 'delivered',
            'earnings' => 'Rs.150.00',
            'rating' => '5.0',
            'distance' => '5.2 km'
        ],
        [
            'id' => 'DEL-002',
            'customer_name' => 'Thenuka Ransinghne',
            'product_name' => 'Chocolate Collection',
            'delivery_date' => '2024-01-14',
            'status' => 'delivered',
            'earnings' => 'Rs.1250.00',
            'rating' => '5.0',
            'distance' => '7.8 km'
        ],
        [
            'id' => 'DEL-003',
            'customer_name' => 'Mahinda Rajapaksha',
            'product_name' => 'Birthday Cake & Balloons',
            'delivery_date' => '2024-01-13',
            'status' => 'delivered',
            'earnings' => 'Rs.180.00',
            'rating' => '4.0',
            'distance' => '4.25 km'
        ],
        [
            'id' => 'DEL-004',
            'customer_name' => 'Kumar Sangakkara',
            'product_name' => 'Fruit Basket',
            'delivery_date' => '2024-01-12',
            'status' => 'cancelled',
            'earnings' => 'RS.200.00',
            'rating' => '5.0',
            'distance' => '6.0 km'
        ],
        [
            'id' => 'DEL-005',
            'customer_name' => 'Angelo Mathews',
            'product_name' => 'Gourmet Hamper',
            'delivery_date' => '2024-01-11',
            'status' => 'returned',
            'earnings' => 'Rs.1500.00',
            'rating' => '3.5',
            'distance' => '8.5 km'
        ],
        [
            'id' => 'DEL-006',
            'customer_name' => 'Dilshan Munaweera',
            'product_name' => 'Spa Gift Set',
            'delivery_date' => '2024-01-10',
            'status' => 'delivered',
            'earnings' => 'Rs.2000.00',
            'rating' => '5.0',
            'distance' => '3.75 km'
        ],
        [
            'id' => 'DEL-007',
            'customer_name' => 'Mahela Jayawardena',
            'product_name' => 'Wine & Cheese Basket',
            'delivery_date' => '2024-01-09',
            'status' => 'delivered',
            'earnings' => 'Rs.220.00',
            'rating' => '4.5',
            'distance' => '9.0 km'
        ],
        [
            'id' => 'DEL-008',
            'customer_name' => 'Aravinda de Silva',
            'product_name' => 'Customized Mug',
            'delivery_date' => '2024-01-08',
            'status' => 'cancelled',
            'earnings' => 'Rs.500.00',
            'rating' => '0.0',
            'distance' => '2.5 km'
        ]
       
    ];

    // 3. Apply filters in PHP
    $history = array_filter($allHistory, function($item) use ($filters) {
        if (!empty($filters['dateFrom']) && $item['delivery_date'] < $filters['dateFrom']) return false;
        if (!empty($filters['dateTo'])   && $item['delivery_date'] > $filters['dateTo'])   return false;
        if ($filters['status'] !== 'all' && $item['status'] !== $filters['status']) return false;
        if (!empty($filters['customer']) && stripos($item['customer_name'], $filters['customer']) === false) return false;
        return true;
    });

    // 4. Send filtered data to view
    require_once __DIR__ . '/../views/Dashboards/Delivery/history.php';
}
}
<?php

class VendorRatingController
{
    private VendorRatingModel $model;
    private OrderModel $orderModel;

    public function __construct(PDO $pdo)
    {
        require_once BASE_PATH . '/models/VendorRatingModel.php';
        require_once BASE_PATH . '/models/OrderModel.php';

        $this->model = new VendorRatingModel($pdo);
        $this->orderModel = new OrderModel($pdo);
    }

 
    public function form()
    {
        if (!isset($_SESSION['user'])) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        $orderId    = $_GET['order_id'] ?? null;
        $vendorId   = $_GET['vendor_id'] ?? null;
        $customerId = $_SESSION['user']['id'];

        if (!$orderId || !$vendorId) {
            die("Missing order or vendor information");
        }

       
        $order = $this->orderModel->getOrderDetails($orderId);

       
        if (!$order || $order['client_id'] != $customerId) {
            die("Unauthorized order access");
        }

       
        if (!$order['is_delivered']) {
            die("You can only rate after delivery");
        }

      
        if ($this->model->hasRated($vendorId, $customerId, $orderId)) {
            die("You already rated this vendor for this order");
        }

        include BASE_PATH . '/views/Dashboards/Client/rate.php';
    }

 
    public function submit()
    {
        if (!isset($_SESSION['user'])) {
            die("Unauthorized");
        }

        $vendorId   = $_POST['vendor_id'] ?? null;
        $orderId    = $_POST['order_id'] ?? null;
        $rating     = $_POST['rating'] ?? null;
        $review     = $_POST['review'] ?? null;
        $customerId = $_SESSION['user']['id'];

        // DEBUG: Log what we received
        error_log("Rating submission debug:");
        error_log("Vendor ID: " . var_export($vendorId, true));
        error_log("Order ID: " . var_export($orderId, true));
        error_log("Rating: " . var_export($rating, true));
        error_log("Customer ID: " . var_export($customerId, true));

        if (!$vendorId || !$orderId || !$rating) {
            $_SESSION['error'] = "Missing required fields (vendor: $vendorId, order: $orderId, rating: $rating)";
            error_log("Missing fields error: " . $_SESSION['error']);
            header("Location: index.php?controller=client&action=history");
            exit;
        }

        // Validate vendor_id is numeric
        if (!is_numeric($vendorId)) {
            $_SESSION['error'] = "Invalid vendor ID: $vendorId";
            error_log("Invalid vendor ID: $vendorId");
            header("Location: index.php?controller=client&action=history");
            exit;
        }

        if ($rating < 1 || $rating > 5) {
            $_SESSION['error'] = "Rating must be between 1 and 5";
            header("Location: index.php?controller=client&action=history");
            exit;
        }

        
        $order = $this->orderModel->getOrderDetails($orderId);
        error_log("Order details: " . var_export($order, true));

        if (!$order || $order['client_id'] != $customerId) {
            $_SESSION['error'] = "Unauthorized order";
            header("Location: index.php?controller=client&action=history");
            exit;
        }

        if (!$order['is_delivered']) {
            $_SESSION['error'] = "Order not delivered yet";
            header("Location: index.php?controller=client&action=history");
            exit;
        }

        if ($this->model->hasRated($vendorId, $customerId, $orderId)) {
            $_SESSION['error'] = "Already rated";
            header("Location: index.php?controller=client&action=history");
            exit;
        }

        error_log("Adding rating: vendor=$vendorId, customer=$customerId, order=$orderId, rating=$rating");
        $this->model->addRating($vendorId, $customerId, $orderId, $rating, $review);
        error_log("Rating added successfully");

        $_SESSION['success'] = "Thank you for your rating!";
        header("Location: index.php?controller=client&action=history");
        exit;
    }

    
    public function viewVendorRatings()
    {
        $vendorId = $_GET['vendor_id'] ?? null;

        if (!$vendorId) {
            die("Vendor ID is required");
        }

        $ratings = $this->model->getVendorRatings($vendorId, 20);
        include BASE_PATH . '/views/Dashboards/vendor_ratings.php';
    }
}
?>
<?php
// Extension methods for OrderModel - Add these to OrderModel.php manually or include this file
class OrderModelExtension
{
    private $pdo;

    public function getOrdersByClient($clientId)
    {
        $stmt = $this->pdo->prepare("
            SELECT o.*, 
                   GROUP_CONCAT(p.name SEPARATOR ', ') as product_names,
                   v.id as vendor_id,
                   v.shopName as vendor_shop_name,
                   v.first_name as vendor_first_name,
                   v.last_name as vendor_last_name
            FROM orders o
            LEFT JOIN orderItems oi ON o.id = oi.order_id
            LEFT JOIN products p ON oi.item_id = p.id
            LEFT JOIN vendors v ON p.vendor_id = v.id
            WHERE o.client_id = ?
            GROUP BY o.id
            ORDER BY o.deliveryDate DESC
        ");
        $stmt->execute([$clientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOrderDetails($orderId)
    {
        $stmt = $this->pdo->prepare("
            SELECT o.*, 
                   v.id as vendor_id,
                   v.shopName as vendor_shop_name
            FROM orders o
            LEFT JOIN orderItems oi ON o.id = oi.order_id
            LEFT JOIN products p ON oi.item_id = p.id
            LEFT JOIN vendors v ON p.vendor_id = v.id
            WHERE o.id = ?
            LIMIT 1
        ");
        $stmt->execute([$orderId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
?>

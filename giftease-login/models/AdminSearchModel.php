<?php
class AdminSearchModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function search($keyword, $page)
    {
        $kw = "%$keyword%";

        switch ($page) {
            case 'reports':
                // Search in orders/reports
                $stmt = $this->pdo->prepare("
                    SELECT id, orderDate, status, totalAmount
                    FROM orders
                    WHERE status LIKE ?
                       OR id LIKE ?
                    ORDER BY orderDate DESC
                ");
                $stmt->execute([$kw, $kw]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            case 'customer':
                // Search in users table for customers
                $stmt = $this->pdo->prepare("
                    SELECT id, firstName, lastName, email, phone
                    FROM users
                    WHERE firstName LIKE ?
                       OR lastName LIKE ?
                       OR email LIKE ?
                       OR phone LIKE ?
                ");
                $stmt->execute([$kw, $kw, $kw, $kw]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            case 'delivery':
                // Search in delivery table
                $stmt = $this->pdo->prepare("
                    SELECT id, phone, vehiclePlate, address
                    FROM delivery
                    WHERE phone LIKE ?
                       OR vehiclePlate LIKE ?
                       OR address LIKE ?
                ");
                $stmt->execute([$kw, $kw, $kw]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            case 'vendor':
                // Search in vendors
                $stmt = $this->pdo->prepare("
                    SELECT id, shopName, email, phone
                    FROM vendor
                    WHERE shopName LIKE ?
                       OR email LIKE ?
                       OR phone LIKE ?
                ");
                $stmt->execute([$kw, $kw, $kw]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            case 'items':
                // Search in products
                $stmt = $this->pdo->prepare("
                    SELECT id, productName, price, category
                    FROM products
                    WHERE productName LIKE ?
                       OR category LIKE ?
                ");
                $stmt->execute([$kw, $kw]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            case 'giftWrapping':
                // Search in gift wrapping items
                $stmt = $this->pdo->prepare("
                    SELECT id, name, price, type
                    FROM giftWrappingItems
                    WHERE name LIKE ?
                       OR type LIKE ?
                ");
                $stmt->execute([$kw, $kw]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            case 'category':
                // Search in categories
                $stmt = $this->pdo->prepare("
                    SELECT id, name, description
                    FROM category
                    WHERE name LIKE ?
                       OR description LIKE ?
                ");
                $stmt->execute([$kw, $kw]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);

            default:
                return [];
        }
    }
}

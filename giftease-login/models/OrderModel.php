<?php
class OrderModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->createTables(); // Create the table if not there
    }

    public function getpdo()
    {
        return $this->pdo;
    }

    public function createTables()
    {
        // --- Clients table (linked to users table) ---
        $sql1 = "CREATE TABLE IF NOT EXISTS orders (
            id INT AUTO_INCREMENT PRIMARY KEY,
            client_id INT NOT NULL,
            customWrap_id INT,
            wrapPackage_id INT,
            FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
        );";
        $sql2 = "CREATE TABLE IF NOT EXISTS orderItems (
            order_id INT NOT NULL,
            item_id INT NOT NULL,
            quantity INT NOT NULL,
            PRIMARY KEY (order_id, item_id),
            FOREIGN KEY (item_id) REFERENCES products(id) ON DELETE CASCADE
        );";
        $sql3 = "CREATE TABLE IF NOT EXISTS notifications (
            id INT AUTO_INCREMENT PRIMARY KEY,
            order_id INT NOT NULL,
            message VARCHAR(255) NOT NULL,
            is_read TINYINT(1) DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE
        );";

        try {
            $this->pdo->exec($sql1);
            $this->pdo->exec($sql2);
            $this->pdo->exec($sql3);


        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function confirmOrder($data, $wrap_id)
    {
        if ($data['mode'] === "custom") {
            $stmt1 = $this->pdo->prepare("INSERT INTO orders (client_id, customWrap_id, wrapPackage_id) VALUES (?, ?, NULL)");
            $stmt1->execute([
                $data['client_id'],
                $wrap_id
            ]);
        } else if ($data['mode'] === "package") {
            $stmt1 = $this->pdo->prepare("INSERT INTO orders (client_id, customWrap_id, wrapPackage_id) VALUES (?, NULL, ?)");
            $stmt1->execute([
                $data['client_id'],
                $wrap_id
            ]);
        }
        $order_id = $this->pdo->lastInsertId();
        $message = "New order received (Order ID: $order_id)";
        $stmtNotify = $this->pdo->prepare(
            "INSERT INTO notifications (order_id, message) VALUES (?, ?)"
        );
        $stmtNotify->execute([$order_id, $message]);

        foreach ($data['cartItems'] as $items) {
            $stmt2 = $this->pdo->prepare("INSERT INTO orderItems (order_id, item_id, quantity) VALUES (?, ?, ?)");
            $stmt2->execute([
                $order_id,
                $items['product_id'],
                $items['quantity']
            ]);
        }
        return $order_id;
    }
}
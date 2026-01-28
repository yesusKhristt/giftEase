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
        $sql1 = "CREATE TABLE IF NOT EXISTS orders (
            id INT AUTO_INCREMENT PRIMARY KEY,
            client_id INT NOT NULL,
            customWrap_id INT,
            wrapPackage_id INT,
            orderType VARCHAR(10),
            recipientName VARCHAR(50),
            recipientPhone VARCHAR(9),
            deliveryAddress VARCHAR(500),
            locationType VARCHAR(20),
            deliveryDate DATE,
            is_wrapped BOOL DEFAULT FALSE,
            is_delivered BOOL DEFAULT FALSE,
            giftWrapper_id INT DEFAULT NULL,
            delivery_id INT DEFAULT NULL,
            productPrice INT DEFAULT 0 NOT NULL,
            deliveryPrice INT DEFAULT 0 NOT NULL,
            FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE
        );";
        $sql2 = "CREATE TABLE IF NOT EXISTS orderItems (
            order_id INT NOT NULL,
            item_id INT NOT NULL,
            quantity INT NOT NULL,
            PRIMARY KEY (order_id, item_id),
            FOREIGN KEY (item_id) REFERENCES products(id) ON DELETE CASCADE
        );";
        $sql3 = "CREATE TABLE IF NOT EXISTS orderStatus (
            id INT AUTO_INCREMENT PRIMARY KEY,
            giftwrapper_id INT NOT NULL,
            order_id INT,
            is_wrapped BOOLEAN DEFAULT FALSE,
            is_delivered BOOLEAN DEFAULT FALSE,
            FOREIGN KEY (giftwrapper_id) REFERENCES giftwrappers(id) ON DELETE CASCADE,
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
            $stmt1 = $this->pdo->prepare("INSERT INTO orders (client_id, customWrap_id, wrapPackage_id, orderType, recipientName, recipientPhone, deliveryAddress, locationType, deliveryDate, deliveryPrice) VALUES (?, ?, NULL, ?, ?, ?, ?, ?, ?, ?)");
            $stmt1->execute([
                $data['client_id'],
                $wrap_id,
                $data['orderType'],
                $data['recipientName'],
                $data['recipientPhone'],
                $data['deliveryAddress'],
                $data['locationType'],
                $data['deliveryDate'],
                $data['deliveryPrice']
            ]);
        } else if ($data['mode'] === "package") {
            $stmt1 = $this->pdo->prepare("INSERT INTO orders (client_id, customWrap_id, wrapPackage_id, orderType, recipientName, recipientPhone, deliveryAddress, locationType, deliveryDate, deliveryPrice) VALUES (?, NULL, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt1->execute([
                $data['client_id'],
                $wrap_id,
                $data['orderType'],
                $data['recipientName'],
                $data['recipientPhone'],
                $data['deliveryAddress'],
                $data['locationType'],
                $data['deliveryDate'],
                $data['deliveryPrice']
            ]);
        }
        $order_id = $this->pdo->lastInsertId();
        $price = 0;
        foreach ($data['cartItems'] as $items) {
            $price += $items['price'] * $items['quantity'];
            $stmt2 = $this->pdo->prepare("INSERT INTO orderItems (order_id, item_id, quantity) VALUES (?, ?, ?)");
            $stmt2->execute([
                $order_id,
                $items['product_id'],
                $items['quantity']
            ]);
        }

        $stmt3 = $this->pdo->prepare("UPDATE `orders` SET `productPrice`= $price WHERE `id` = $order_id");
        $stmt3->execute();

        return $order_id;

    }
}
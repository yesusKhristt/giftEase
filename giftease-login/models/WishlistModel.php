<?php
// ClientModel.php***

class WishlistModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->createTables(); // Create the table if not there
    }

    public function getpdo() {
        return $this->pdo;
    }

    public function createTables() {
        // --- Clients table (linked to users table) ---
        $sql1 = "CREATE TABLE IF NOT EXISTS wishlist (
            id INT AUTO_INCREMENT PRIMARY KEY,
            client_id INT NOT NULL,
            product_id INT NOT NULL,
            FOREIGN KEY (client_id) REFERENCES clients(id) ON DELETE CASCADE,
            FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
        );";
        try {
            $this->pdo->exec($sql1);
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function isInWishlist($client_id, $product_id) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM wishlist WHERE client_id = ? AND product_id = ?");
        $stmt->execute([$client_id, $product_id]);
        return $stmt->fetchColumn() > 0;
    }


    // public function getWishlistForClient($client_id)
    // {
    //     $stmt1 = $this->getpdo()->prepare("SELECT * FROM products WHERE id IN (SELECT product_id FROM wishlist WHERE client_id = ?)");
    //     $stmt1->execute([$client_id]);
    //     return $stmt1->fetchAll(PDO::FETCH_ASSOC);
    // }

    public function getWishlistForClient($client_id) {
        $stmt2 = $this->getpdo()->prepare("SELECT * FROM products JOIN wishlist ON products.id = wishlist.product_id WHERE products.id IN (SELECT product_id FROM wishlist WHERE client_id = ?)");
        $stmt2->execute([$client_id]);
        return $stmt2->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addToWishlist($client_id, $product_id) {
        $stmt = $this->pdo->prepare("INSERT INTO wishlist (client_id, product_id) VALUES (?, ?)");
        return $stmt->execute([
            $client_id,
            $product_id
        ]);
    }

    public function removeFromWishlist($product_id, $client_id) {
        $stmt = $this->pdo->prepare("DELETE FROM wishlist WHERE product_id = ? AND client_id = ?");
        $stmt->execute([
            $product_id,
            $client_id
        ]);
    }

    public function emptyWishlist($client_id) {
        $stmt = $this->pdo->prepare("DELETE FROM wishlist WHERE client_id = ?");
        $stmt->execute([
            $client_id
        ]);
    }








    public function tagifvalueGreaterThan100000() {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<td>" . $row['amount'] . "</td>";
            if ($row['amount'] > 100000) {
                echo "<td><span style='color:green'>High Value</span></td>";
            }
        }
    }

    public function phoneNum() {
        $phone = $_POST['phone'];

        if (!preg_match('/^07[0-9]{8}$/', $phone)) {
            echo "Invalid phone number.";
        } else {
            // save to db
        }
    }

    public function notFuture() {
        $date = $_POST['date'];
        $today = new DateTime();
        $inputDate = new DateTime($date);

        if ($inputDate > $today) {
            echo "Date cannot be in the future.";
        } else {
            // save to db
        }
    }

    public function notPast() {
        $date = $_POST['date'];
        $today = new DateTime();
        $inputDate = new DateTime($date);

        if ($inputDate < $today) {
            echo "Date cannot be in the past.";
        } else {
            // save to db
        }
    }

    public function onlyImage() {
        $file = $_FILES['upload'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($file['type'], $allowedTypes)) {
            echo "Only image files are allowed.";
        } else {
            move_uploaded_file($file['tmp_name'], 'uploads/' . $file['name']);
        }
    }

    public function onlyPDF() {
        $file = $_FILES['upload'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if ($ext !== 'pdf') {
            echo "Only PDF files are allowed.";
        } else {
            move_uploaded_file($file['tmp_name'], 'uploads/' . $file['name']);
        }
    }

    public function chasis() {
        $chassis = $_POST['chassis'];

        if (!preg_match('/^[A-Za-z][0-9]+[A-Za-z]$/', $chassis)) {
            echo "Invalid chassis number format.";
        } else {
            // save to db
        }
    }

    public function NIC() {
        $nic = $_POST['nic'];

        $oldNIC = '/^[0-9]{9}[VvXx]$/';   // 9 digits + V or X
        $newNIC = '/^[0-9]{12}$/';          // 12 digits

        if (!preg_match($oldNIC, $nic) && !preg_match($newNIC, $nic)) {
            echo "Invalid NIC format.";
        } else {
            // save to db
        }
    }

    public function partialDistrict() {
        $search = $_POST['search'];

        $stmt = $pdo->prepare("SELECT * FROM farmers WHERE district LIKE ?");
        $stmt->execute(['%' . $search . '%']);
        $stmt->execute([$search . '%']);
        $stmt->execute(['%' . $search]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($results as $row) {
            echo "<tr><td>" . $row['name'] . "</td><td>" . $row['district'] . "</td></tr>";
        }
    }

    public function calMonths() {
        // In PHP
        $start = new DateTime($_POST['start_date']);
        $end   = new DateTime($_POST['end_date']);
        $diff  = $start->diff($end);
        $months = ($diff->y * 12) + $diff->m;
        echo "Duration: " . $months . " months";
    }

    public function showHighest() {
        $stmt = $pdo->query("SELECT MAX(salary) AS highest FROM employees");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        echo "<div class='card'>Highest Value: " . $row['highest'] . "</div>";
    }

    public function pinAnnouncement() {
        // Fetch — pinned and not expired come first
        $stmt = $pdo->query("
    SELECT * FROM announcements
    ORDER BY 
        (pinned = 1 AND pin_expires_at > NOW()) DESC,
        created_at DESC
");

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $isPinned = $row['pinned'] && strtotime($row['pin_expires_at']) > time();
            echo "<div>";
            if ($isPinned) echo "<span>📌 Pinned</span>";
            echo $row['message'];
            echo "</div>";
        }
    }

    public function limitTextAreaDropDown() {
        // PHP side — validate the limit was respected
        $type = $_POST['type'];
        $text = $_POST['description'];

        if ($type === 'offered' && strlen($text) > 200) {
            echo "Text too long for this option.";
        } else {
            // save to db
        }
    }

    public function countryCode() {
        $code = $_POST['country_code'];   // e.g. +94
        $number = $_POST['phone_number']; // 9 digits

        if (!preg_match('/^[0-9]{9}$/', $number)) {
            echo "Phone number must be exactly 9 digits.";
        } else {
            $fullPhone = $code . $number;
            // save $fullPhone to db
        }
    }

    public function ORDER_BY_LIMIT(): string {

        $sql = <<<'SQL'
                    SELECT
                        p.post_id,
                        p.user_id,
                        p.created_at
                    FROM posts p
                    ORDER BY p.created_at DESC
                    LIMIT 10;
                    SQL;

        return $sql;
    }

    public function COUNT_ROWS(): string {

        $sql = <<<'SQL'
                    SELECT
                        COUNT(*) AS TotalActiveUsers
                    FROM users u
                    WHERE u.is_active = 1;
                    SQL;

        return $sql;
    }
}

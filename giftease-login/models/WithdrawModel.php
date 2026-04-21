<?php
class WithdrawModel {
    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
        $this->createTables(); // Create the table if not there
    }

    public function getpdo() {
        return $this->pdo;
    }

    public function createTables() {
        $vra   = 1;
        $stmt1 = "CREATE TABLE IF NOT EXISTS withdraw (
            id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            admin_id INT DEFAULT NULL,
            vendor_id INT DEFAULT NULL,
            delivery_id INT DEFAULT NULL,
            giftWrapper_id INT DEFAULT NULL,
            amount int NOT NULL,
            status BOOL DEFAULT NULL,
            createdAT TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY (admin_id) REFERENCES admins(id) ON DELETE CASCADE,
            FOREIGN KEY (vendor_id) REFERENCES vendors(id) ON DELETE CASCADE,
            FOREIGN KEY (delivery_id) REFERENCES delivery(id) ON DELETE CASCADE,
            FOREIGN KEY (giftWrapper_id) REFERENCES giftwrappers(id) ON DELETE CASCADE
        );";

        try {
            $this->pdo->exec($stmt1);
        } catch (PDOException $e) {
            die("Error creating tables: " . $e->getMessage());
        }
    }

    public function requestWithdrawVendor($id, $amount) {
        $stmt1 = $this->pdo->prepare(
            "INSERT INTO withdraw (vendor_id, amount) VALUES (?, ?)"
        );

        $stmt1->execute([
            $id,
            $amount
        ]);
    }

    public function requestWithdrawDelivery($id, $amount) {
        $stmt1 = $this->pdo->prepare(
            "INSERT INTO withdraw (delivery_id, amount) VALUES (?, ?)"
        );

        $stmt1->execute([
            $id,
            $amount
        ]);
    }

    public function requestWithdrawGiftWrapper($id, $amount) {
        $stmt1 = $this->pdo->prepare(
            "INSERT INTO withdraw (giftWrapper_id, amount) VALUES (?, ?)"
        );

        $stmt1->execute([
            $id,
            $amount
        ]);
    }

    public function aproveWithdrawal($id, $adminId) {
        $stmt1 = $this->pdo->prepare(
            "UPDATE withdraw SET admin_id = ?, status = 1 WHERE id = ?"
        );

        $stmt1->execute([
            $adminId,
            $id,
        ]);
    }

    public function rejectWithdrawal($id, $adminId) {
        $stmt1 = $this->pdo->prepare(
            "UPDATE withdraw SET admin_id = ?, status = 0 WHERE id = ?"
        );

        $stmt1->execute([
            $adminId,
            $id,
        ]);
    }

    public function getWithdrawRequestsPending() {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM withdraw WHERE status IS NULL"
        );
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getWithdrawRequestsAll() {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM withdraw"
        );
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
}

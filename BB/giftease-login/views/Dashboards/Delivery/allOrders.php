<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'allOrder';
        include 'views\commonElements/leftSidebarSaneth.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">All Orders</h1>
                <p class="subtitle">Orders currently placed by clients.</p>
            </div>
            <div class="filter-tabs">
                <button class="btn2" onclick="markAllRead()">Mark All Read</button>
                <button class="btn1" onclick="clearNotifications()">Clear All</button>
            </div>
            <?php foreach ($orders as $row): ?>
                <div class="notification-item unread" data-notification-id="1">
                    <div class="notification-icon notification-info">
                        <i class="fas fa-info"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-title">New Order Assigned</div>
                        <div class="notification-text">You have been assigned order DEL-<?= htmlspecialchars($row['id']) ?>
                            for
                            delivery today.</div>
                        <div>Location : <?= htmlspecialchars($row['deliveryAddress']) ?></div>
                        <div>Gift Wrapping Fee : <?= htmlspecialchars($row['deliveryPrice']) ?></div>
                        <div>Delivery Date : <?= htmlspecialchars($row['deliveryDate']) ?></div>
                        <?php
                        if ($row['delivery_id'] === $_SESSION['user']['id']) {
                            echo "<div class='subtitle'>Assssigned</div>";
                        } else {
                            echo "<div class='notification-actions'>
            <a class='btn1' href='?controller=delivery&action=dashboard/acceptOrder/{$row['id']}'>Accept</a></div>";
                        }
                        ?>

                    </div>
                <?php endforeach ?>
                <div class="notification-time">1 minutes ago</div>
                <button class="notification-dismiss" onclick="dismissNotification(1)">&times;</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <button class="btn1" onclick="acceptOrder('DEL-006')">Accept</button>
    <button class="btn2" onclick="markAllRead()">Mark All Read</button>
    <button class="btn1" onclick="clearNotifications()">Clear All</button>
</body>

</html>
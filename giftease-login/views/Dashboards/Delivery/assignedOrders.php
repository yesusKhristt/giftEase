<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="profile" href="profile.php" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dkmvuFiYMuEv20&libraries=geometry,places"
        async defer></script>
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'assignedOrder';
        include 'views\commonElements/leftSidebarSaneth.php';
        ?>

        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Assigned Orders</h2>
                    <p class="subtitle">Monitor your orders</p>
            </div>
            <div class="card">
                <div class="title">All Orders</div>
                <?php foreach ($myOrders as $row): ?>
                    <div class="card">
                        <div class="title">DEL-<?= htmlspecialchars($row['id']) ?></div>
                        <div class="subtitle">Client:
                            <?= htmlspecialchars($row['first_name']) ?> <?= htmlspecialchars($row['last_name']) ?>
                        </div>
                        <div style="margin-bottom: 16px;">
                            <div style="font-size: 0.9rem; color: #666; margin-bottom: 8px;">

                                Due: <?= htmlspecialchars($row['deliveryDate']) ?><br>

                                Fee: Rs <?= htmlspecialchars($row['deliveryPrice']) ?>
                            </div>
                        </div>

                        <div class="progress-section">
                            <div class="progress-header">
                            </div>

                            <div class="summary-grid">
                                <a class='btn1'
                                    href="?controller=delivery&action=dashboard/cancelOrder/<?= $row['id'] ?>">
                                    Cancel Order
                                </a>

                                <a class='btn2'
                                    href="?controller=delivery&action=dashboard/markComplete/<?= $row['id'] ?>">
                                    <i class="fas fa-check"></i>
                                    Mark Complete
                                </a>
                            </div>

                        </div>
                    </div>

                <?php endforeach ?>
            </div>
        </div>
    </div>
</body>

</html>
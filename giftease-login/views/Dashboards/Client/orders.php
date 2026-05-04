<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Orders - GiftEase</title>
    <link rel="stylesheet" href="public/client.css" />
    <link rel="stylesheet" href="public/sideTopBar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'orders';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>

        <div class="main-content">

            <div class="page-header">
                <h1 class="title">My Orders</h1>
                <p class="subtitle">View and track all your GiftEase orders</p>
            </div>

            <?php if (empty($myOrders)): ?>
                <div class="card" style="text-align:center; padding: 60px 20px;">
                    <i class="fas fa-box-open" style="font-size:3rem; color:#d03c2e; margin-bottom:16px; display:block;"></i>
                    <h3 class="title">No orders yet</h3>
                    <p class="subtitle">Browse our store and place your first order!</p>
                    <a href="?controller=client&action=dashboard/items" class="btn1" style="width:fit-content; margin: 20px auto 0;">
                        <i class="fas fa-gift"></i> Browse Items
                    </a>
                </div>

            <?php else: ?>
                <div class="card">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Recipient</th>
                                <th>Delivery Date</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($myOrders as $order):
                                if ($order['is_delivered']) {
                                    $sc = 'green';
                                    $st = 'Delivered';
                                } elseif ($order['is_wrapped']) {
                                    $sc = 'blue';
                                    $st = 'Wrapped';
                                } elseif ($order['in_warehouse']) {
                                    $sc = 'blue';
                                    $st = 'In Warehouse';
                                } elseif (strtotime($order['deliveryDate']) < time()) {
                                    $sc = 'red';
                                    $st = 'Overdue';
                                } else {
                                    $sc = 'blue';
                                    $st = 'With Vendor';
                                }
                            ?>
                                <tr>
                                    <td><strong>#<?= htmlspecialchars($order['id']) ?></strong></td>
                                    <td><?= htmlspecialchars($order['recipientName'] ?? 'N/A') ?></td>
                                    <td>
                                        <i class="fas fa-calendar-alt" style="color:#d03c2e; margin-right:6px;"></i>
                                        <?= htmlspecialchars($order['deliveryDate'] ?? 'N/A') ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($order['payment_method'] === 'cash') {
                                            echo 'cash';
                                        } else {
                                            echo 'card';
                                        }
                                        ?> </td>
                                    <td><span class="badge <?= $sc ?>"><?= $st ?></span></td>
                                    <td>
                                        <div style="display:flex; gap:6px;">
                                            <a href="?controller=client&action=dashboard/orderItems/<?= $order['id'] ?>"
                                                class="btn1" style="padding:6px 12px; font-size:12px;">
                                                <i class="fas fa-eye"></i> View
                                            </a>
                                            <a href="?controller=client&action=dashboard/tracking/<?= $order['id'] ?>"
                                                class="btn2" style="padding:6px 12px; font-size:12px;">
                                                <i class="fas fa-map-marker-alt"></i> Track
                                            </a>
                                            <?php
                                            if ($order['is_delivered']):
                                                ?>
                                                <a href="?controller=client&action=dashboard/rate/<?= $order['id'] ?>"
                                                class="btn1" style="padding:6px 12px; font-size:12px;">
                                                <i class="fas fa-check"></i> Rate
                                            </a>
                                                <?php
                                                endif?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

        </div>
    </div>
</body>

</html>
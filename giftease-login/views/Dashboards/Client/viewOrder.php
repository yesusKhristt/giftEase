<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order #<?= htmlspecialchars($order['id']) ?> - GiftEase</title>
    <link rel="stylesheet" href="public/client.css" />
    <link rel="stylesheet" href="public/sideTopBar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'orders';
        include 'views/commonElements/leftSidebar.php';
        ?>

        <div class="main-content">

            <?php if (empty($order)): ?>
                <div class="page-header">
                    <h1 class="title">Order Not Found</h1>
                    <p class="subtitle">This order doesn't exist or doesn't belong to you.</p>
                </div>
                <a href="?controller=client&action=dashboard/orders" class="btn1" style="width:fit-content;">
                    <i class="fas fa-arrow-left"></i> Back to Orders
                </a>

            <?php else:
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

                <div class="page-header">
                    <h1 class="title">View Order</h1>
                    <p class="subtitle">
                        For <?= htmlspecialchars($order['recipientName'] ?? 'N/A') ?>
                        <span class="badge <?= $sc ?>"><?= $st ?></span>
                    </p>
                </div>

                <!-- Order details -->
                <div class="summary-grid">
                    <div class="card">
                        <p class="subtitle">Recipient</p>
                        <p style="margin-top:8px;"><?= htmlspecialchars($order['recipientName'] ?? 'N/A') ?></p>
                        <p style="font-size:13px; color:#999;"><?= htmlspecialchars($order['recipientPhone'] ?? '') ?></p>
                    </div>
                    <div class="card">
                        <p class="subtitle">Delivery Address</p>
                        <p style="margin-top:8px;"><?= htmlspecialchars($order['deliveryAddress'] ?? 'N/A') ?></p>
                        <p style="font-size:13px; color:#999;"><?= htmlspecialchars($order['locationType'] ?? '') ?></p>
                    </div>
                    <div class="card">
                        <p class="subtitle">Delivery Date</p>
                        <p style="margin-top:8px;">
                            <i class="fas fa-calendar-alt" style="color:#d03c2e; margin-right:6px;"></i>
                            <?= htmlspecialchars($order['deliveryDate'] ?? 'N/A') ?>
                        </p>
                        <p style="font-size:13px; color:#999; margin-top:8px;">
                            Payment: <?= htmlspecialchars($order['payment_method'] ?? 'N/A') ?>
                        </p>
                    </div>
                </div>

                <!-- Items table -->
                <div class="card">
                    <h4>Items in This Order</h4>
                    <?php if (empty($orderItems)): ?>
                        <p class="subtitle">No items found for this order.</p>
                    <?php else: ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">Item</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orderItems as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['item_name']) ?></td>
                                        <td>
                                            <div class="product-cell">
                                                <img src="resources/uploads/vendor/products/<?= htmlspecialchars($item['item_image']) ?>" class="product-thumbnail">
                                            </div>
                                        <td><?= (int)$item['quantity'] ?></td>
                                        <td><?= (int)$item['quantity'] * (int)$item['price']?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>

                <div style="display:flex; gap:12px;">
                    <a href="?controller=client&action=dashboard/orders" class="btn1" style="width:fit-content;">
                        <i class="fas fa-arrow-left"></i> Back to Orders
                    </a>
                    <a href="?controller=client&action=dashboard/tracking/<?= $order['id'] ?>"
                        class="btn2" style="width:fit-content;">
                        <i class="fas fa-map-marker-alt"></i> Track Order
                    </a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>View Order - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'orders';
        include 'views/commonElements/leftSidebar.php';
        ?>
        <div class="main-content">
            <?php if ($orderDetail): ?>
            <div class="page-header">
                <h1 class="title">View Order</h1>
                <p class="subtitle">Order #<?= htmlspecialchars($orderDetail['id']) ?></p>
            </div>

            <div class="order-info">
                <p><strong>Customer:</strong> <?= htmlspecialchars($orderDetail['client_name']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($orderDetail['client_email']) ?></p>
                <p><strong>Phone:</strong> <?= htmlspecialchars($orderDetail['client_phone'] ?? 'N/A') ?></p>
                <p><strong>Recipient:</strong> <?= htmlspecialchars($orderDetail['recipientName'] ?? 'N/A') ?></p>
                <p><strong>Delivery Address:</strong> <?= htmlspecialchars($orderDetail['deliveryAddress'] ?? 'N/A') ?></p>
                <p><strong>Delivery Date:</strong> <?= htmlspecialchars($orderDetail['deliveryDate'] ?? 'N/A') ?></p>
                <p><strong>Order Type:</strong> <?= htmlspecialchars($orderDetail['orderType'] ?? 'N/A') ?></p>
                <?php
                    $isDelivered = $orderDetail['is_delivered'];
                    $isWrapped   = $orderDetail['is_wrapped'];
                    if ($isDelivered) {
                        $statusClass = 'green'; $statusText = 'Delivered';
                    } elseif ($isWrapped) {
                        $statusClass = 'blue'; $statusText = 'Wrapped - Awaiting Delivery';
                    } elseif (strtotime($orderDetail['deliveryDate']) < time()) {
                        $statusClass = 'red'; $statusText = 'Overdue';
                    } else {
                        $statusClass = 'blue'; $statusText = 'Processing';
                    }
                ?>
                <p><strong>Status:</strong> <span class="badge <?= $statusClass ?>"><?= $statusText ?></span></p>
            </div>

            <h3>Your Items in This Order</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orderDetail['items'] as $item): ?>
                    <tr>
                        <td><?= htmlspecialchars($item['product_name']) ?></td>
                        <td><?= (int)$item['quantity'] ?></td>
                        <td>Rs. <?= number_format($item['price'], 2) ?></td>
                        <td>Rs. <?= number_format($item['subtotal'], 2) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><strong>Your Total</strong></td>
                        <td><strong>Rs. <?= number_format($orderDetail['vendor_total'], 2) ?></strong></td>
                    </tr>
                </tfoot>
            </table>

            <div style="margin-top: 20px;">
                <a href="?controller=vendor&action=dashboard/orders" class="btn1">
                    <i class="fas fa-arrow-left"></i> Back to Orders
                </a>
            </div>

            <?php else: ?>
            <div class="page-header">
                <h1 class="title">Order Not Found</h1>
                <p class="subtitle">This order does not exist or does not contain your products.</p>
            </div>
            <a href="?controller=vendor&action=dashboard/orders" class="btn1">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
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
                    <?php if ($orderDetail): ?>

                        <?php
                        $isDelivered = $orderDetail['is_delivered'];
                        $isWrapped   = $orderDetail['is_wrapped'];
                        if ($isDelivered) {
                            $statusClass = 'green';
                            $statusText = 'Delivered';
                        } elseif ($isWrapped) {
                            $statusClass = 'blue';
                            $statusText = 'Wrapped – Awaiting Delivery';
                        } elseif (strtotime($orderDetail['deliveryDate']) < time()) {
                            $statusClass = 'red';
                            $statusText = 'Overdue';
                        } else {
                            $statusClass = 'blue';
                            $statusText = 'Processing';
                        }
                        ?>
                        <h1 class="title">View Order</h1>
                        <p class="subtitle">
                            Order #<?= htmlspecialchars($orderDetail['id']) ?>
                            Placed by <?= htmlspecialchars($orderDetail['client_name']) ?>
                            &nbsp;·&nbsp;
                            <span class="badge <?= $statusClass ?>"><?= $statusText ?></span>
                        </p>


                </div>

                <!-- Customer + Delivery Info -->
                <div class="summary-grid">

                    <div class="card">
                        <h4>Customer</h4>
                        <p><?= htmlspecialchars($orderDetail['client_name']) ?></p>
                        <p class="subtitle"><?= htmlspecialchars($orderDetail['client_email']) ?></p>
                        <p class="subtitle"><?= htmlspecialchars($orderDetail['client_phone'] ?? 'N/A') ?></p>
                    </div>

                    <div class="card">
                        <h4>Order Info</h4>
                        <p class="subtitle">Type</p>
                        <p><?= htmlspecialchars($orderDetail['orderType'] ?? 'N/A') ?></p>
                        <p class="subtitle" style="margin-top: 12px;">Status</p>
                        <span class="badge <?= $statusClass ?>"><?= $statusText ?></span>
                    </div>

                </div>

                <!-- Items Table -->
                <div style="padding:50px">
                    <h4 style="padding: 10px">Your Items in This Order</h4>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
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
                </div>

                <a href="?controller=vendor&action=dashboard/orders" class="btn1" style="width: fit-content;">
                    <i class="fas fa-arrow-left"></i> Back to Orders
                </a>

            <?php else: ?>

                <div class="page-header">
                    <h1 class="title">Order Not Found</h1>
                    <p class="subtitle">This order doesn't exist or doesn't contain your products.</p>
                </div>

                <a href="?controller=vendor&action=dashboard/orders" class="btn1" style="width: fit-content;">
                    <i class="fas fa-arrow-left"></i> Back to Orders
                </a>

            <?php endif; ?>

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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Orders - Admin</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <?php
    $activePage = 'orders';
    include 'views/commonElements/leftSidebarChathu.php';
    ?>

    <div class="main-content">

        <div class="page-header">
            <h1 class="title">Order Management</h1>
            <p class="subtitle">Monitor and approve all client orders</p>
        </div>

        <!-- ══════════════════════════════════
                 SUMMARY CARDS
            ══════════════════════════════════ -->
        <div class="summary-grid">
            <div class="cardColour">
                <p class="subtitle">Pending Clearance</p>
                <p class="title"><?= count($pendingOrders) ?></p>
            </div>
            <div class="card">
                <p class="subtitle">Total Orders</p>
                <p class="title"><?= count($allOrders) ?></p>
            </div>
            <div class="card">
                <p class="subtitle">Cleared Orders</p>
                <p class="title"><?= count($allOrders) - count($pendingOrders) ?></p>
            </div>
        </div>


        <!-- ══════════════════════════════════
                 TABLE 1 — PENDING CLEARANCE
            ══════════════════════════════════ -->
        <div class="card">
            <h4><i class="fas fa-hourglass-half" style="color:#d03c2e; margin-right:8px;"></i>Pending Clearance</h4>

            <?php if (empty($pendingOrders)): ?>
                <p class="subtitle" style="text-align:center; padding: 30px 0;">
                    <i class="fas fa-check-circle" style="font-size:2rem; display:block; margin-bottom:10px;"></i>
                    No orders awaiting clearance
                </p>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Client</th>
                            <th>Delivery Date</th>
                            <th>Wrap Type</th>
                            <th>Payment</th>
                            <th>Product</th>
                            <th>Wrap</th>
                            <th>Delivery</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pendingOrders as $order): ?>
                            <?php
                            if ($order['is_delivered']) {
                                $statusClass = 'green';
                                $statusText = 'Delivered';
                            } elseif ($order['is_wrapped']) {
                                $statusClass = 'blue';
                                $statusText = 'Wrapped';
                            } elseif (strtotime($order['deliveryDate']) < time()) {
                                $statusClass = 'red';
                                $statusText = 'Overdue';
                            } else {
                                $statusClass = 'blue';
                                $statusText = 'Processing';
                            }

                            $wrapType = isset($order['customWrap_id']) && $order['customWrap_id']
                                ? 'Custom'
                                : (isset($order['wrapPackage_id']) && $order['wrapPackage_id'] ? 'Package' : '—');
                            ?>
                            <tr>
                                <td><strong>#<?= htmlspecialchars($order['id']) ?></strong></td>
                                <td><?= htmlspecialchars($order['client_name'] ?? $order['client_id']) ?></td>
                                <td><?= htmlspecialchars($order['deliveryDate'] ?? 'N/A') ?></td>
                                <td><?= $wrapType ?></td>
                                <td>
                                    <?php
                                    if ($order['payment_method'] === 'cash') {
                                        echo 'cash';
                                    } else {
                                        echo 'card';
                                    }
                                    ?>
                                </td>
                                <td>Rs. <?= number_format($order['productPrice'], 2) ?></td>
                                <td>Rs. <?= number_format($order['wrapPrice'], 2) ?></td>
                                <td>Rs. <?= number_format($order['deliveryPrice'], 2) ?></td>
                                <td><strong>Rs. <?= number_format($order['totalPrice'], 2) ?></strong></td>
                                <td><span class="badge <?= $statusClass ?>"><?= $statusText ?></span></td>
                                <td>
                                    <div style="display:flex; gap:6px;">
                                        <form method="POST" action="?controller=admin&action=dashboard/orders/approve">
                                            <input type="hidden" name="order_id" value="<?= htmlspecialchars($order['id']) ?>">
                                            <input type="hidden" name="delivery_id" value="<?= htmlspecialchars($order['delivery_id']) ?>">
                                            <input type="hidden" name="giftWrapper_id" value="<?= htmlspecialchars($order['giftWrapper_id']) ?>">
                                            <input type="hidden" name="deliveryPrice" value="<?= htmlspecialchars($order['deliveryPrice'], 2) ?>">
                                            <input type="hidden" name="wrappingPrice" value="<?= htmlspecialchars($order['wrapPrice']) ?>">
                                            <button type="submit" class="btn2" style="width: fit-content;">
                                                <i class="fas fa-check"></i> Approve
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>


        <!-- ══════════════════════════════════
                 TABLE 2 — ALL ORDERS
            ══════════════════════════════════ -->
        <div class="card">
            <h4><i class="fas fa-list" style="color:#d03c2e; margin-right:8px;"></i>All Orders</h4>

            <?php if (empty($allOrders)): ?>
                <p class="subtitle" style="text-align:center; padding: 30px 0;">No orders found.</p>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Client</th>
                            <th>Recipient</th>
                            <th>Delivery Date</th>
                            <th>Wrap Type</th>
                            <th>Payment</th>
                            <th>Total</th>
                            <th>Clearance</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allOrders as $order): ?>
                            <?php
                            if ($order['is_delivered']) {
                                $statusClass = 'green';
                                $statusText = 'Delivered';
                            } elseif ($order['is_wrapped']) {
                                $statusClass = 'blue';
                                $statusText = 'Wrapped';
                            } elseif (strtotime($order['deliveryDate']) < time()) {
                                $statusClass = 'red';
                                $statusText = 'Overdue';
                            } else {
                                $statusClass = 'blue';
                                $statusText = 'Processing';
                            }

                            $wrapType = isset($order['customWrap_id']) && $order['customWrap_id']
                                ? 'Custom'
                                : (isset($order['wrapPackage_id']) && $order['wrapPackage_id'] ? 'Package' : '—');
                            ?>
                            <tr>
                                <td><strong>#<?= htmlspecialchars($order['id']) ?></strong></td>
                                <td><?= htmlspecialchars($order['client_name'] ?? $order['client_id']) ?></td>
                                <td>
                                    <?= htmlspecialchars($order['recipientName'] ?? 'N/A') ?>
                                    <?php if (!empty($order['recipientPhone'])): ?>
                                        <br><span style="font-size:12px; color:#999;"><?= htmlspecialchars($order['recipientPhone']) ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?= htmlspecialchars($order['deliveryDate'] ?? 'N/A') ?></td>
                                <td><?= $wrapType ?></td>
                                <td>
                                    <?php
                                    if ($order['payment_method'] === 'cash') {
                                        echo 'cash';
                                    } else {
                                        echo 'card';
                                    }
                                    ?>
                                </td>
                                <td><strong>Rs. <?= number_format($order['totalPrice'], 2) ?></strong></td>
                                <td>
                                    <?php if ($order['clearance']): ?>
                                        <span class="badge green">Cleared</span>
                                    <?php else: ?>
                                        <span class="badge red">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td><span class="badge <?= $statusClass ?>"><?= $statusText ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>

    </div><!-- /main-content -->

</body>

</html>
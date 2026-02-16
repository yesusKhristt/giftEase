<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="icon" type="image/png" href="resources/1.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .btn-rate {
            background: #ff9800;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
        }
        .btn-rate:hover {
            background: #e68900;
        }
        .rated-badge {
            background: #4CAF50;
            color: white;
            padding: 5px 10px;
            border-radius: 3px;
            font-size: 12px;
        }
        .status-delivered {
            background: #4CAF50;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .status-pending {
            background: #ff9800;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php
        
        if (! isset($activePage)) {
            $activePage = 'history';
        }
        include 'views/commonElements/leftSidebarDilma.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Order History</h1>
                <p class="subtitle">View your past orders</p>
            </div>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($_SESSION['success']) ?>
                    <?php unset($_SESSION['success']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="alert alert-error">
                    <?= htmlspecialchars($_SESSION['error']) ?>
                    <?php unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <div class="filter-tabs">
                <div class="btn1">
                    <label>Date Range:</label>
                    <div class="date-range-picker">
                        <input type="date" id="dateFrom" class="form-input" />
                        <span>to</span>
                        <input type="date" id="dateTo" class="form-input" />
                    </div>
                </div>
                <div class="btn1">
                    <label>Status:</label>
                    <select id="statusFilter" class="form-select">
                        <option value="all">All Status</option>
                        <option value="delivered">Delivered</option>
                        <option value="pending">Pending</option>
                    </select>
                </div>

                <button class="btn1" onclick="exportHistory()">
                    <i class="fas fa-download"></i> Export
                </button>
                <button class="btn1" onclick="resetFilters()">
                    <i class="fas fa-undo"></i> Reset
                </button>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Products</th>
                        <th>Vendor</th>
                        <th>Delivery Date</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="historyTableBody">
                    <?php if (!empty($orders)): ?>
                        <?php foreach ($orders as $order): ?>
                            <tr>
                                <td>#<?= htmlspecialchars($order['id']) ?></td>
                                <td>
                                    <div class="product-cell">
                                        <div>
                                            <div class="product-name"><?= htmlspecialchars($order['product_names'] ?? 'N/A') ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($order['vendor_shop_name']): ?>
                                        <?= htmlspecialchars($order['vendor_shop_name']) ?>
                                    <?php else: ?>
                                        N/A
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <div class="date-cell">
                                        <div class="delivery-date"><?= date('M d, Y', strtotime($order['deliveryDate'])) ?></div>
                                    </div>
                                </td>
                                <td>
                                    <?php if ($order['is_delivered']): ?>
                                        <span class="order-status status-delivered">Delivered</span>
                                    <?php else: ?>
                                        <span class="order-status status-pending">Pending</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    LKR <?= number_format($order['productPrice'] + $order['deliveryPrice'], 2) ?>
                                </td>
                                <td>
                                    <?php if ($order['is_delivered'] && $order['vendor_id']): ?>
                                     <?php if ($order['has_rated']): ?>
                                     <span class="rated-badge"><i class="fas fa-check"></i> Rated</span>
                                    <?php else: ?>
                                     <a href="index.php?controller=Rating&action=form&vendor_id=<?= $order['vendor_id'] ?>&order_id=<?= $order['id'] ?>" class="btn-rate">
                                     <i class="fas fa-star"></i> Rate Vendor
                                      </a>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 30px;">
                                No orders found
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>

    <script>
        function exportHistory() {
            alert('Export functionality coming soon!');
        }

        function resetFilters() {
            document.getElementById('dateFrom').value = '';
            document.getElementById('dateTo').value = '';
            document.getElementById('statusFilter').value = 'all';
        }
    </script>
</body>

</html>

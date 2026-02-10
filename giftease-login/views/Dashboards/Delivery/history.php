<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Delivery Partner Dashboard - GiftEase</title>
<link rel="stylesheet" href="public/style.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
</head>
<body>
<div class="container">

<?php
$activePage = 'history';
include 'views/commonElements/leftSidebarSaneth.php';

// Refill form values
$dateFrom = $_GET['dateFrom'] ?? '';
$dateTo   = $_GET['dateTo'] ?? '';
$status   = $_GET['status'] ?? 'all';
$customer = $_GET['customer'] ?? '';
?>

<div class="main-content">

<div class="page-header">
    <h1 class="title">Delivery History</h1>
    <p class="subtitle">View your complete delivery history</p>
</div>

<!-- FILTER FORM -->
<form method="GET" action="index.php">
    <input type="hidden" name="controller" value="delivery">
    <input type="hidden" name="action" value="history">

    <div class="filter-tabs">
        <div class="filter-group">
            <label>Date From</label>
            <input type="date" name="dateFrom" value="<?= htmlspecialchars($dateFrom) ?>">
        </div>

        <div class="filter-group">
            <label>Date To</label>
            <input type="date" name="dateTo" value="<?= htmlspecialchars($dateTo) ?>">
        </div>

        <div class="filter-group">
            <label>Status</label>
            <select name="status">
                <option value="all" <?= $status === 'all' ? 'selected' : '' ?>>All Status</option>
                <option value="delivered" <?= $status === 'delivered' ? 'selected' : '' ?>>Delivered</option>
                <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
            </select>
        </div>

        <div class="filter-group">
            <label>Customer Name</label>
            <input type="text" name="customer" placeholder="Search customer..." value="<?= htmlspecialchars($customer) ?>">
        </div>

        <div class="filter-actions">
            <button type="submit" class="btn1"><i class="fas fa-search"></i> Filter</button>
            <a href="index.php?controller=delivery&action=history" class="btn1"><i class="fas fa-undo"></i> Reset</a>
        </div>
    </div>
</form>

<!-- RESULTS INFO -->
<div style="margin: 15px 0; color: #666;">
    Showing <?= count($history) ?> records
</div>

<!-- TABLE -->
<table class="table">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer</th>
            <th>Product</th>
            <th>Delivery Date</th>
            <th>Status</th>
            <th>Earnings</th>
            <th>Rating</th>
            <th>Distance</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($history)): ?>
            <tr>
                <td colspan="8" style="text-align:center; padding:30px; color:#999;">
                    No records found matching your filters.
                </td>
            </tr>
        <?php else: ?>
            <?php foreach ($history as $row): ?>
                <tr>
                    <td>#<?= htmlspecialchars($row['id']) ?></td>
                    <td><?= htmlspecialchars($row['customer_name']) ?></td>
                    <td><?= htmlspecialchars($row['product_name']) ?></td>
                    <td><?= date('M d, Y', strtotime($row['delivery_date'])) ?></td>
                    <td><?= ucfirst($row['status']) ?></td>
                    <td><?= htmlspecialchars($row['earnings']) ?></td>
                    <td><?= htmlspecialchars($row['rating']) ?></td>
                    <td><?= htmlspecialchars($row['distance']) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

</div>
</div>


</body>
</html>

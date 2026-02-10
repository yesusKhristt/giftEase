<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Details - GiftEase</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  <div class="container">
    <?php
    $activePage = 'avenue';
    include 'views/commonElements/leftSidebarChathu.php';

    $order = $order ?? [];
    $items = $items ?? [];
    $customerName = trim(($order['first_name'] ?? '') . ' ' . ($order['last_name'] ?? ''));
    $dateLabel = !empty($order['deliveryDate']) ? date('M d, Y', strtotime($order['deliveryDate'])) : 'N/A';
    ?>

    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Order Details</h1>
        <p class="subtitle">Order #<?= htmlspecialchars($order['id'] ?? 'N/A') ?></p>
      </div>

      <div class="summary-grid">
        <div class="card">
          <div class="title"><?= htmlspecialchars($customerName !== '' ? $customerName : 'N/A') ?></div>
          <div class="subtitle">Customer</div>
        </div>
        <div class="card">
          <div class="title"><?= htmlspecialchars($dateLabel) ?></div>
          <div class="subtitle">Delivery Date</div>
        </div>
        <div class="card">
          <div class="title"><?= htmlspecialchars($order['orderType'] ?? 'N/A') ?></div>
          <div class="subtitle">Order Type</div>
        </div>
      </div>

      <div class="card">
        <h4>Items</h4>
        <table class="table">
          <thead>
            <tr>
              <th>Product</th>
              <th>Vendor</th>
              <th>Quantity</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($items)) : ?>
              <tr>
                <td colspan="4" style="text-align:center; padding:30px; color:#999;">No items found.</td>
              </tr>
            <?php else : ?>
              <?php foreach ($items as $row) : ?>
                <tr>
                  <td><?= htmlspecialchars($row['name'] ?? 'N/A') ?></td>
                  <td><?= htmlspecialchars($row['shopName'] ?? 'N/A') ?></td>
                  <td><?= htmlspecialchars($row['quantity'] ?? 0) ?></td>
                  <td>Rs<?= htmlspecialchars(number_format((float) ($row['price'] ?? 0), 2)) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <div class="button-section">
        <a href="?controller=admin&action=dashboard/avenue" class="btn1"><i class="fas fa-arrow-left"></i>Back</a>
      </div>
    </div>
  </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vendor Sold Items - GiftEase</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  
    <?php
    $activePage = 'avenue';
    include 'views/commonElements/leftSidebarChathu.php';

    $vendor = $vendor ?? [];
    $items = $items ?? [];
    $vendorName = trim(($vendor['first_name'] ?? '') . ' ' . ($vendor['last_name'] ?? ''));
    ?>

    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Sold Items</h1>
        <p class="subtitle"><?= htmlspecialchars($vendorName !== '' ? $vendorName : 'Vendor') ?> - Delivered items</p>
      </div>

      <div class="card">
        <table class="table">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Customer</th>
              <th>Product</th>
              <th>Qty</th>
              <th>Price</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($items)) : ?>
              <tr>
                <td colspan="6" style="text-align:center; padding:30px; color:#999;">No sold items found.</td>
              </tr>
            <?php else : ?>
              <?php foreach ($items as $row) : ?>
                <?php
                  $customerName = trim(($row['first_name'] ?? '') . ' ' . ($row['last_name'] ?? ''));
                  $dateLabel = !empty($row['deliveryDate']) ? date('M d, Y', strtotime($row['deliveryDate'])) : 'N/A';
                ?>
                <tr>
                  <td>#<?= htmlspecialchars($row['order_id']) ?></td>
                  <td><?= htmlspecialchars($customerName !== '' ? $customerName : 'N/A') ?></td>
                  <td><?= htmlspecialchars($row['product_name'] ?? 'N/A') ?></td>
                  <td><?= htmlspecialchars($row['quantity'] ?? 0) ?></td>
                  <td>Rs<?= htmlspecialchars(number_format((float) ($row['price'] ?? 0), 2)) ?></td>
                  <td><?= htmlspecialchars($dateLabel) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <div class="button-section">
        <a href="?controller=admin&action=dashboard/avenue/vendor/<?= htmlspecialchars($vendor['id'] ?? '') ?>" class="btn1"><i class="fas fa-arrow-left"></i>Back to Vendor</a>
      </div>
    </div>
  
</body>

</html>

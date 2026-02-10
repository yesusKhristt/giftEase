<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delivery Completed Orders - GiftEase</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  <div class="container">
    <?php
    $activePage = 'avenue';
    include 'views/commonElements/leftSidebarChathu.php';

    $delivery = $delivery ?? [];
    $orders = $orders ?? [];
    $deliveryName = trim(($delivery['first_name'] ?? '') . ' ' . ($delivery['last_name'] ?? ''));
    ?>

    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Completed Orders</h1>
        <p class="subtitle"><?= htmlspecialchars($deliveryName !== '' ? $deliveryName : 'Delivery') ?> - Delivered orders</p>
      </div>

      <div class="card">
        <table class="table">
          <thead>
            <tr>
              <th>Order ID</th>
              <th>Customer</th>
              <th>Date</th>
              <th>Delivery Fee</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($orders)) : ?>
              <tr>
                <td colspan="4" style="text-align:center; padding:30px; color:#999;">No completed orders found.</td>
              </tr>
            <?php else : ?>
              <?php foreach ($orders as $row) : ?>
                <?php
                  $customerName = trim(($row['first_name'] ?? '') . ' ' . ($row['last_name'] ?? ''));
                  $dateLabel = !empty($row['deliveryDate']) ? date('M d, Y', strtotime($row['deliveryDate'])) : 'N/A';
                ?>
                <tr>
                  <td>
                    <a href="?controller=admin&action=dashboard/order/<?= htmlspecialchars($row['order_id']) ?>">
                      #<?= htmlspecialchars($row['order_id']) ?>
                    </a>
                  </td>
                  <td><?= htmlspecialchars($customerName !== '' ? $customerName : 'N/A') ?></td>
                  <td><?= htmlspecialchars($dateLabel) ?></td>
                  <td>Rs<?= htmlspecialchars(number_format((float) ($row['deliveryPrice'] ?? 0), 2)) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

      <div class="button-section">
        <a href="?controller=admin&action=dashboard/avenue/delivery/<?= htmlspecialchars($delivery['id'] ?? '') ?>" class="btn1"><i class="fas fa-arrow-left"></i>Back to Delivery</a>
      </div>
    </div>
  </div>
</body>

</html>

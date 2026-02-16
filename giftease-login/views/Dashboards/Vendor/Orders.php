<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Vendor Orders</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="icon" type="image/png" href="resources/1.png">
  <link rel="icon" href="resources/icon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
  <div class="container">
    <?php
    $activePage = 'orders';
    include 'views/commonElements/leftSidebar.php';
    ?>
    <div class="main-content">

      <div class="page-header">
        <h1 class="title">Orders Dashboard</h1>
        <p class="subtitle">Manage and track your current orders</p>
      </div>
      <div class="card">
        <h4>Current Orders</h4>
        <table class="table">
          <thead>
            <tr>
              <th style="width: 80px;">Action</th>
              <th>Client</th>
              <th>Cost</th>
              <th>Delivery Date</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($orders)): ?>
              <?php foreach ($orders as $order): ?>
                <?php
                  $isDelivered = $order['is_delivered'];
                  $isUrgent = (!$isDelivered && strtotime($order['deliveryDate']) < time());
                  if ($isDelivered) {
                      $badgeClass = 'green';
                      $badgeText = 'Delivered';
                  } elseif ($isUrgent) {
                      $badgeClass = 'red';
                      $badgeText = 'Urgent';
                  } else {
                      $badgeClass = 'blue';
                      $badgeText = 'On-Track';
                  }
                ?>
                <tr>
                  <td>
                    <a class="view-btn" href="?controller=vendor&action=dashboard/vieworder/<?= htmlspecialchars($order['order_id']) ?>">
                      <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                      </svg>
                    </a>
                  </td>
                  <td><?= htmlspecialchars($order['client_name']) ?></td>
                  <td>Rs. <?= number_format($order['vendor_total'], 2) ?></td>
                  <td><?= htmlspecialchars($order['deliveryDate'] ?? 'N/A') ?></td>
                  <td><span class="badge <?= $badgeClass ?>"><?= $badgeText ?></span></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" style="text-align:center; padding:20px;">No orders yet.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class="summary-grid">
        <div class="card">
          <p class="subtitle">Total Orders</p><br>
          <p class="title"><?= (int)($orderStats['total_orders'] ?? 0) ?></p>
        </div>

        <div class="card">
          <p class="subtitle">Total Revenue</p><br>
          <p class="title">Rs. <?= number_format($orderStats['total_revenue'] ?? 0, 2) ?></p>
        </div>

        <div class="card">
          <p class="subtitle">Urgent Orders</p><br>
          <p class="title"><?= (int)($orderStats['urgent_orders'] ?? 0) ?></p>
        </div>
      </div>
    </div>
  </div>
  <!-- <script>
    // Add hover effect to stars
    document.querySelectorAll('.star').forEach(star => {
      star.addEventListener('mouseenter', function () {
        this.style.transform = 'scale(1.2) rotate(15deg)';
      });

      star.addEventListener('mouseleave', function () {
        this.style.transform = 'scale(1) rotate(0deg)';
      });
    });

    // Profile picture click effect
    document.querySelector('.profile-picture').addEventListener('click', function () {
      this.style.transform = 'scale(1.1) rotate(360deg)';
      setTimeout(() => {
        this.style.transform = 'scale(1) rotate(0deg)';
      }, 500);
    });

    // Add click handlers for navigation
    document.querySelectorAll('.nav-item').forEach(item => {
      item.addEventListener('click', function (e) {
        // Remove active class from all items
        document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
        // Add active class to clicked item
        this.classList.add('active');
      });
    });

    // Add click handlers for view buttons
    document.querySelectorAll('.view-btn').forEach(btn => {
      btn.addEventListener('click', function () {
        alert('View order details - This would open a modal or navigate to order details page');
      });
    });
  </script> -->
</body>

</html>
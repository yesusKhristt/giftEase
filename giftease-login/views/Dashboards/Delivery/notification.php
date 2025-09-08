<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Delivery Partner Dashboard - GiftEase</title>
  <link rel="stylesheet" href="public/style.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  <div class="container">
    <?php
    $activePage = 'notification';
    include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarSaneth.php';
    ?>
    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Notifications</h1>
        <p class="subtitle">Stay updated with important alerts and messages.</p>
      </div>
      <div class ="filter-tabs">
        <button class="btn1" onclick="markAllRead()">Mark All Read</button>
        <button class="btn1" onclick="clearNotifications()">Clear All</button>
      </div>

      <div class="notification-item unread" data-notification-id="1">
        <div class="notification-icon notification-info">
          <i class="fas fa-info"></i>
        </div>
        <div class="notification-content">
          <div class="notification-title">New Order Assigned</div>
          <div class="notification-text">You have been assigned order DEL-004 for delivery today. Priority: High</div>
          <div class="notification-actions">
            <button class="btn2" onclick="acceptOrder('DEL-004')">Accept</button>
            <button class="btn2" onclick="viewOrderDetails('DEL-004')">View Details</button>
          </div>
        </div>
        <div class="notification-time">5 minutes ago</div>
        <button class="notification-dismiss" onclick="dismissNotification(1)">&times;</button>
      </div>

      <div class="notification-item">
        <div class="notification-icon notification-success">
          <i class="fas fa-check"></i>
        </div>
        <div class="notification-content">
          <div class="notification-title">Delivery Completed</div>
          <div class="notification-text">Order DEL-001 has been successfully delivered and confirmed.</div>
        </div>
        <div class="notification-time">2 hours ago</div>
        <button class="notification-dismiss" onclick="dismissNotification(2)">&times;</button>
      </div>

      <div class="notification-item">
        <div class="notification-icon notification-warning">
          <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="notification-content">
          <div class="notification-title">Route Update</div>
          <div class="notification-text">Traffic detected on your route. Consider alternative path to DEL-002.</div>
          <div class="notification-actions">
            <button class="btn2" onclick="showRoute('DEL-002')">View Route</button>
            <button class="btn2" onclick="optimizeRoute()">Optimize</button>
          </div>
        </div>
        <div class="notification-time">1 hour ago</div>
        <button class="notification-dismiss" onclick="dismissNotification(3)">&times;</button>
      </div>

      <div class="notification-item">
        <div class="notification-icon notification-info">
          <i class="fas fa-star"></i>
        </div>
        <div class="notification-content">
          <div class="notification-title">Customer Rating</div>
          <div class="notification-text">You received a 5-star rating from Sarah Johnson for order DEL-098.</div>
        </div>
        <div class="notification-time">Yesterday</div>
        <button class="notification-dismiss" onclick="dismissNotification(4)">&times;</button>
      </div>
    </div>
  </div>
  <script src="main.js"></script>
</body>

</html>
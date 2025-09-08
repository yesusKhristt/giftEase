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
    $activePage = 'order';
    include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarSaneth.php';
    ?>
    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Assigned Orders</h1>
        <p class="subtitle">Manage your current delivery assignments and update their status.</p>
      </div>
      <div class="orders-grid">
        <div class="order-card">
          <div class="order-header">
            <span class="order-id">Order #DEL-001</span>
            <span class="order-status status-pending">Pending</span>
          </div>
          <div class="order-details">
            <div class="detail-item">
              <i class="fas fa-gift"></i>
              <span>Premium Rose Bouquet</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-user"></i>
              <span>Sarah Johnson</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-map-marker-alt"></i>
              <span>123 Main St, Downtown</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-clock"></i>
              <span>Deliver by 3:00 PM</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-phone"></i>
              <span>+1 (555) 123-4567</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-dollar-sign"></i>
              <span>Delivery Fee: $15</span>
            </div>
          </div>
          <div class="order-actions">
            <button class="btn btn-primary btn-small" onclick="startDelivery('DEL-001')">Start Delivery</button>
            <button class="btn btn-outline btn-small" onclick="viewOrderDetails('DEL-001')">View Details</button>
            <button class="btn btn-ghost btn-small" onclick="contactCustomer('DEL-001')">Contact Customer</button>
          </div>
        </div>

        <div class="order-card">
          <div class="order-header">
            <span class="order-id">Order #DEL-002</span>
            <span class="order-status status-in-transit">In Transit</span>
          </div>
          <div class="order-details">
            <div class="detail-item">
              <i class="fas fa-gift"></i>
              <span>Chocolate Collection</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-user"></i>
              <span>Mike Chen</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-map-marker-alt"></i>
              <span>456 Oak Ave, Uptown</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-clock"></i>
              <span>Deliver by 5:00 PM</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-phone"></i>
              <span>+1 (555) 987-6543</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-dollar-sign"></i>
              <span>Delivery Fee: $12</span>
            </div>
          </div>
          <div class="order-actions">
            <button class="btn btn-primary btn-small" onclick="markDelivered('DEL-002')">Mark Delivered</button>
            <button class="btn btn-outline btn-small" onclick="viewOrderDetails('DEL-002')">View Details</button>
            <button class="btn btn-ghost btn-small" onclick="reportIssue('DEL-002')">Report Issue</button>
          </div>
        </div>

        <div class="order-card">
          <div class="order-header">
            <span class="order-id">Order #DEL-003</span>
            <span class="order-status status-pending">Pending</span>
          </div>
          <div class="order-details">
            <div class="detail-item">
              <i class="fas fa-gift"></i>
              <span>Birthday Cake & Balloons</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-user"></i>
              <span>Emma Wilson</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-map-marker-alt"></i>
              <span>789 Pine St, Midtown</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-clock"></i>
              <span>Deliver by 7:00 PM</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-phone"></i>
              <span>+1 (555) 456-7890</span>
            </div>
            <div class="detail-item">
              <i class="fas fa-dollar-sign"></i>
              <span>Delivery Fee: $18</span>
            </div>
          </div>
          <div class="order-actions">
            <button class="btn btn-primary btn-small" onclick="startDelivery('DEL-003')">Start Delivery</button>
            <button class="btn btn-outline btn-small" onclick="viewOrderDetails('DEL-003')">View Details</button>
            <button class="btn btn-ghost btn-small" onclick="contactCustomer('DEL-003')">Contact Customer</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
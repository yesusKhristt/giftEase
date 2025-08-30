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
    include 'views\commonElements/leftSidebarSaneth.php';
    ?>
    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Assigned Orders</h1>
        <p class="subtitle">Manage your current delivery assignments and update their status.</p>
      </div>
      
      <!-- <div class="card"> -->
      
        <div class="card">
          <div class="order-header">
            <h4 class="order-id">Order #DEL-001</h4>
            <h4 class="order-status status-pending">Pending</h4>
          </div>
          <div class="cardColour">
          <div class="order-details">
            <div class="detail-item">
              <i class="fas fa-gift"></i>
              <h4>Premium Rose Bouquet</h4>
            </div>
            <div class="detail-item">
              <i class="fas fa-user"></i>
              <h4>Saneth Tharushika</h4>
            </div>
            <div class="detail-item">
              <i class="fas fa-map-marker-alt"></i>
              <h4>123 Main St, Colombo</h4>
            </div>
            <div class="detail-item">
              <i class="fas fa-clock"></i>
              <h4>Deliver by 3:00 PM</h4>
            </div>
            <div class="detail-item">
              <i class="fas fa-phone"></i>
              <h4>+94 761694206</h4>
            </div>
            <div class="detail-item">
              <i class="fas fa-dollar-sign"></i>
              <h4>Delivery Fee: $15</h4>
            </div>
          </div>
          </div>
          <div class="order-actions">
            <button class="btn1" onclick="startDelivery('DEL-001')">Start Delivery</button>
            <button class="btn1" onclick="viewOrderDetails('DEL-001')">View Details</button>
            <button class="btn1" onclick="contactCustomer('DEL-001')">Contact Customer</button>
          </div>
        </div>

        <div class="card">
          <div class="order-header">
            <h4 class="order-id">Order #DEL-002</h4>
            <h4 class="order-status status-in-transit">In Transit</h4>
          </div>
          <div class="cardColour">
          <div class="order-details">
            <div class="detail-item">
              <i class="fas fa-gift"></i>
              <!-- <h4>Chocolate Collection</h4> -->
               <h4>Chocolate Collection</h4>
            </div>
            <div class="detail-item">
              <i class="fas fa-user"></i>
              <h4>Thenuka Ranasighne</h4>
            </div>
            <div class="detail-item">
              <i class="fas fa-map-marker-alt"></i>
              <h4>456 Main Street Colombo</h4>
            </div>
            <div class="detail-item">
              <i class="fas fa-clock"></i>
              <h4>Deliver by 5:00 PM</h4>
            </div>
            <div class="detail-item">
              <i class="fas fa-phone"></i>
              <h4>+94 761234567</h4>
            </div>
            <div class="detail-item">
              <i class="fas fa-dollar-sign"></i>
              <h4>Delivery Fee: $12</h4>
            </div>
          </div>
          </div>
          <div class="order-actions">
            <button class="btn1" onclick="markDelivered('DEL-002')">Mark Delivered</button>
            <button class="btn1" onclick="viewOrderDetails('DEL-002')">View Details</button>
            <button class="btn1" onclick="reportIssue('DEL-002')">Report Issue</button>
          </div>
        </div>

        <div class="card">
          <div class="order-header">
            <h4 class="order-id">Order #DEL-003</h4>
            <h4 class="order-status status-pending">Pending</h4>
          </div>
          <div class="cardColour">
          <div class="order-details">
            <div class="detail-item">
              <i class="fas fa-gift"></i>
              <h4>Birthday Cake & Balloons</h4>
            </div>
            <div class="detail-item">
              <i class="fas fa-user"></i>
              <h4>Mahinda Rajapaksha</h4>
            </div>
            <div class="detail-item">
              <i class="fas fa-map-marker-alt"></i>
              <h4>789 Main Street Colombo</h4>
            </div>
            <div class="detail-item">
              <i class="fas fa-clock"></i>
              <h4>Deliver by 7:00 PM</h4>
            </div>
            <div class="detail-item">
              <i class="fas fa-phone"></i>
              <h4>+94 771234567</h4>
            </div>
            <div class="detail-item">
              <i class="fas fa-dollar-sign"></i>
              <h4>Delivery Fee: $18</h4>
            </div>
          </div>
          </div>
          <div class="order-actions">
            <button class="btn1" onclick="startDelivery('DEL-003')">Start Delivery</button>
            <button class="btn1" onclick="viewOrderDetails('DEL-003')">View Details</button>
            <button class="btn1" onclick="contactCustomer('DEL-003')">Contact Customer</button>
          </div>
      
      </div>
      </div>
    </div>
  </div>
</body>

</html>
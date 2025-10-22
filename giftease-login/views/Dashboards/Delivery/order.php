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

      <div class="card">
        <div class="order-header">
          <h4 class="order-id">Order #DEL-001</h4>
          <!-- <h4 class="order-status status-pending">Pending</h4> -->
        </div>
        <!-- <div class="summary-grid"> -->
        <div class="cardColour">
          <div class="summary-grid">
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
            </div>
            <div class="order-details">
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
        </div>
        <div class="order-actions">
          <div class="summary-grid">
            <!-- <button class="btn1" onclick="viewOrderDetails('DEL-001')">View Details</button> -->
            <button class="btn1" onclick="startDelivery('DEL-001')">Start Delivery</button>
            <!-- <button class="btn1" onclick="contactCustomer('DEL-001')">Contact Customer</button> -->
            <button class="btn1" onclick="markDelivered('DEL-001')">Mark Delivered</button>
            <!-- <button class="btn1" onclick="reportIssue('DEL-001')">Report Issue</button> -->
          </div>
        </div>
      </div>

      <div class="card">
        <div class="order-header">
          <h4 class="order-id">Order #DEL-002</h4>
          <!-- <h4 class="order-status status-in-transit">In Transit</h4> -->
        </div>
        <div class="cardColour">
          <div class="summary-grid">
            <div class="order-details">
              <div class="detail-item">
                <i class="fas fa-gift"></i>
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
            </div>
            <div class="order-details">
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
        </div>

        <div class="order-actions">
          <div class="summary-grid">
            <!-- <button class="btn1" onclick="viewOrderDetails('DEL-002')">View Details</button> -->
            <button class="btn1" onclick="startDelivery('DEL-002')">Start Delivery</button>
            <!-- <button class="btn1" onclick="contactCustomer('DEL-002')">Contact Customer</button> -->
            <button class="btn1" onclick="markDelivered('DEL-002')">Mark Delivered</button>
            <!-- <button class="btn1" onclick="reportIssue('DEL-002')">Report Issue</button> -->
          </div>
        </div>
      </div>

      <div class="card">
        <div class="order-header">
          <h4 class="order-id">Order #DEL-003</h4>
          <!-- <h4 class="order-status status-pending">Pending</h4> -->
        </div>
        <div class="cardColour">
          <div class="summary-grid">
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
            </div>
            <div class="order-details">
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
        </div>

        <div class="order-actions">
          <div class="summary-grid">
            <!-- <button class="btn1" onclick="viewOrderDetails('DEL-003')">View Details</button> -->
            <button class="btn1" onclick="startDelivery('DEL-003')">Start Delivery</button>
            <!-- <button class="btn1" onclick="contactCustomer('DEL-003')">Contact Customer</button> -->
            <button class="btn1" onclick="markDelivered('DEL-003')">Mark Delivered</button>
            <!-- <button class="btn1" onclick="reportIssue('DEL-003')">Report Issue</button> -->
          </div>
        </div>
      </div>

      <div class="card">
        <div class="order-header">
          <h4 class="order-id">Order #DEL-004</h4>
          <!-- <h4 class="order-status status-pending">Pending</h4> -->
        </div>
        <div class="cardColour">
          <div class="summary-grid">
            <div class="order-details">
              <div class="detail-item">
                <i class="fas fa-gift"></i>
                <h4>Shoes Pack</h4>
              </div>
              <div class="detail-item">
                <i class="fas fa-user"></i>
                <h4>Jeshani Shavindya</h4>
              </div>
              <div class="detail-item">
                <i class="fas fa-map-marker-alt"></i>
                <h4>543 Main Street Colombo</h4>
              </div>
            </div>
            <div class="order-details">
              <div class="detail-item">
                <i class="fas fa-clock"></i>
                <h4>Deliver by 3:00 PM</h4>
              </div>
              <div class="detail-item">
                <i class="fas fa-phone"></i>
                <h4>+94 728976548</h4>
              </div>
              <div class="detail-item">
                <i class="fas fa-dollar-sign"></i>
                <h4>Delivery Fee: $23.5</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="order-actions">
          <div class="summary-grid">
            <!-- <button class="btn1" onclick="viewOrderDetails('DEL-004')">View Details</button> -->
            <button class="btn1" onclick="startDelivery('DEL-004')">Start Delivery</button>
            <!-- <button class="btn1" onclick="contactCustomer('DEL-004')">Contact Customer</button> -->
            <button class="btn1" onclick="markDelivered('DEL-004')">Mark Delivered</button>
            <!-- <button class="btn1" onclick="reportIssue('DEL-004')">Report Issue</button> -->
          </div>
        </div>
      </div>

      <div class="card">
        <div class="order-header">
          <h4 class="order-id">Order #DEL-005</h4>
          <!-- <h4 class="order-status status-pending">Pending</h4> -->
        </div>
        <div class="cardColour">
          <div class="summary-grid">
            <div class="order-details">
              <div class="detail-item">
                <i class="fas fa-gift"></i>
                <h4>Phone Box</h4>
              </div>
              <div class="detail-item">
                <i class="fas fa-user"></i>
                <h4>Dilma Jayathissa</h4>
              </div>
              <div class="detail-item">
                <i class="fas fa-map-marker-alt"></i>
                <h4>546/3 Main Street Colombo</h4>
              </div>
            </div>
            <div class="order-details">
              <div class="detail-item">
                <i class="fas fa-clock"></i>
                <h4>Deliver by 4:30 PM</h4>
              </div>
              <div class="detail-item">
                <i class="fas fa-phone"></i>
                <h4>+94 772256780</h4>
              </div>
              <div class="detail-item">
                <i class="fas fa-dollar-sign"></i>
                <h4>Delivery Fee: $123.5</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="order-actions">
          <div class="summary-grid">
            <!-- <button class="btn1" onclick="viewOrderDetails('DEL-005')">View Details</button> -->
            <button class="btn1" onclick="startDelivery('DEL-005')">Start Delivery</button>
            <!-- <button class="btn1" onclick="contactCustomer('DEL-005')">Contact Customer</button> -->
            <button class="btn1" onclick="markDelivered('DEL-005')">Mark Delivered</button>
            <!-- <button class="btn1" onclick="reportIssue('DEL-005')">Report Issue</button> -->
          </div>
        </div>
      </div>

      <div class="card">
        <div class="order-header">
          <h4 class="order-id">Order #DEL-006</h4>
          <!-- <h4 class="order-status status-pending">Pending</h4> -->
        </div>
        <div class="cardColour">
          <div class="summary-grid">
            <div class="order-details">
              <div class="detail-item">
                <i class="fas fa-gift"></i>
                <h4>Lap Top</h4>
              </div>
              <div class="detail-item">
                <i class="fas fa-user"></i>
                <h4>Chathu</h4>
              </div>
              <div class="detail-item">
                <i class="fas fa-map-marker-alt"></i>
                <h4>No.120/4 Main Street Colombo</h4>
              </div>
            </div>
            <div class="order-details">
              <div class="detail-item">
                <i class="fas fa-clock"></i>
                <h4>Deliver by 3:30 PM</h4>
              </div>
              <div class="detail-item">
                <i class="fas fa-phone"></i>
                <h4>+94 728976548</h4>
              </div>
              <div class="detail-item">
                <i class="fas fa-dollar-sign"></i>
                <h4>Delivery Fee: $223.5</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="order-actions">
          <div class="summary-grid">
            <!-- <button class="btn1" onclick="viewOrderDetails('DEL-005')">View Details</button> -->
            <button class="btn1" onclick="startDelivery('DEL-005')">Start Delivery</button>
            <!-- <button class="btn1" onclick="contactCustomer('DEL-005')">Contact Customer</button> -->
            <button class="btn1" onclick="markDelivered('DEL-005')">Mark Delivered</button>
            <!-- <button class="btn1" onclick="reportIssue('DEL-005')">Report Issue</button> -->
          </div>
        </div>
      </div>

    </div>
  </div>
</body>

</html>
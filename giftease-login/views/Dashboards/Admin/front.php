<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Vendor Analysis</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  <div class="container">
    <?php
    $activePage = 'front';
    include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarChathu.php';
    ?>
    <div class="main-content">
     <div class="page-header">
                <h1 class="title">Account</h1>
                <p class="subtitle">Manage your Personal Information</p>
            </div>

      <!-- <section id="dashboard" class="page active">
        <h2>Dashboard Overview</h2>

        <div class="cards">
          <div class="card blue">
            <div class="card-icon">🛒</div>
            <div class="card-meta">
              <strong>Total Orders</strong>
              <p id="totalOrders">120</p>
            </div>
          </div>
          <div class="card red">
            <div class="card-icon">✂️</div>
            <div class="card-meta">
              <strong>Pending</strong>
              <p>Wrapping</p>
            </div>
          </div>
          <div class="card yellow">
            <div class="card-icon">👔</div>
            <div class="card-meta">
              <strong>Total Vendors</strong>
              <p id="totalVendors">0</p>
            </div>
          </div>
        </div> -->

        <div class="quick-grid">
          <a class="quick ellipse items">📦 <span>Items</span></a>
          <a class="quick ellipse vendors">👔 <span>Vendors</span></a>
          <a class="quick ellipse customers">👥 <span>Customers</span></a>
          <a class="quick ellipse deliveries">🚚 <span>Deliveries</span></a>
        </div>

        <div class="panel">
          <div class="panel-header">
            <h3>Recent Vendors</h3>
            <button class="btn primary btn-sm">View All</button>
          </div>
          <div id="recentVendorsList" class="recent-list"></div>
        </div>
      </section>
    </div>
  </div>
</body>

</html>
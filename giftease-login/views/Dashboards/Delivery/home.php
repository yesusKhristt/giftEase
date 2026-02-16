<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Delivery Partner Dashboard - GiftEase</title>
  <link rel="stylesheet" href="public/style.css" />
  <link rel="icon" type="image/png" href="resources/1.png">
  <link rel="profile" href="profile.php" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dkmvuFiYMuEv20&libraries=geometry,places"
    async defer></script>
</head>

<body>

  <div class="container">
    <?php
    $activePage = 'home';
    include 'views\commonElements/leftSidebarSaneth.php';
    ?>
    <!-- <div id="home" class="tab-content active"> -->
    <!-- Home page -->
    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Welcome Back, Saneth!</h1>
        <p class="subtitle">Ready to make some deliveries today</p>
      </div>


      <div class="card">
        <h3>Today's Overview</h3>
        <div class="summary-grid">
          <div class="cardColour">
            <div class="title" id="weeklyEarnings">Rs. <?php echo htmlspecialchars(number_format($dashboardStats['weekly_earnings'] ?? 0, 2)); ?></div>
            <div class="subtitle">This Week's Earnings</div>
          </div>
          <div class="cardColour">
            <div class="title"><?php echo htmlspecialchars($dashboardStats['assigned_total'] ?? 0); ?></div>
            <div class="subtitle">Total Orders Assigned</div>
          </div>
          <div class="cardColour">
            <div class="title"><?php echo htmlspecialchars($dashboardStats['delivered_total'] ?? 0); ?></div>
            <div class="subtitle">Total Delivered</div>
          </div>
          <div class="cardColour">
            <div class="title"><?php echo htmlspecialchars($dashboardStats['pending_total'] ?? 0); ?></div>
            <div class="subtitle">Pending Deliveries</div>
          </div>
        </div>
      </div>

    </div>
  </div>
  
  
</body>

</html>
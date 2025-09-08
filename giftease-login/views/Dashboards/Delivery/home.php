<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Delivery Partner Dashboard - GiftEase</title>
  <link rel="stylesheet" href="public/style.css" />
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
    include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarSaneth.php';
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
            <div class="title">3</div>
            <div class="subtitle">Orders Assigned</div>
          </div>
          <div class="cardColour">
            <div class="title">1</div>
            <div class="subtitle">Delivered Today</div>
          </div>
          <div class="cardColour">
            <div class="title">2</div>
            <div class="subtitle">Pending Deliveries</div>
          </div>
          <div class="cardColour">
            <div class="title">95%</div>
            <div class="subtitle">Success Rate</div>
          </div>
        </div>
      </div>


      <div class="summary-grid">
        <div class="card" onclick="showEarningsBreakdown()">
          <div class="title" id="todaysDeliveries">8</div>
          <div class="subtitle">Today's Deliveries</div>
          <div class="stat-trend">+2 from yesterday</div>
        </div>
        <div class="card" onclick="showEarningsBreakdown()">
          <div class="title" id="todaysEarnings">$127</div>
          <div class="subtitle">Today's Earnings</div>
          <div class="stat-trend">+$23 from yesterday</div>
        </div>
        <div class="card" onclick="showRatingDetails()">
          <div class="title" id="currentRating">4.9</div>
          <div class="subtitle">Rating</div>
          <div class="stat-trend">⭐⭐⭐⭐⭐</div>
        </div>
        <div class="card" onclick="showDistanceDetails()">
          <div class="title" id="distanceCovered">45km</div>
          <div class="subtitle">Distance Covered</div>
          <div class="stat-trend">3 routes completed</div>
        </div>
      </div>
    </div>
  </div>
  <!-- <div id="profile" class="tab-content"> -->
  <script src="main.js"></script>
</body>

</html>
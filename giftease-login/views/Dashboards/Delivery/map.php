<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Delivery Partner Dashboard - GiftEase</title>
  <link rel="stylesheet" href="public/style.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="profile" href="profile.php" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dkmvuFiYMuEv20&libraries=geometry,places"
    async defer></script>
</head>

<body>
  <div class="container">
    <?php
    $activePage = 'map';
    include 'views/commonElements/leftSidebarSaneth.php';
    ?>
    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Route Map</h1>
        <p class="subtitle">View your optimized delivery route and track your progress in real-time.</p>
      </div>
      <iframe src="https://maps.google.com/maps?q=Colombo&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="400"
        frameborder="0" style="border:0; margin:0; padding:0;" allowfullscreen class="card">
      </iframe>

      <div class="filter-tabs">
        <button class="btn1" onclick="optimizeRoute()">
          <i class="fas fa-route"></i> Optimize Route
        </button>
        <button class="btn1" onclick="getCurrentLocation()">
          <i class="fas fa-crosshairs"></i> My Location
        </button>
        <button class="btn1" onclick="refreshMap()">
          <i class="fas fa-sync"></i> Refresh
        </button>
      </div>
      <div class="card">
        <label>View:</label>
        <select class="form-select" onchange="changeMapView(this.value)">
          <option value="roadmap">Road</option>
          <option value="satellite">Satellite</option>
          <option value="hybrid">Hybrid</option>
          <option value="terrain">Terrain</option>
        </select>
      </div>
      <div class="card">
        <button class="btn1" onclick="shareLocation()">
          <i class="fas fa-share"></i> Share Location
        </button>
      </div>


      <div class="summary-grid">
        <div class="card">
          <div class="legend-color legend-start"></div>
          <span>Your Location</span>
        </div>
        <div class="card">
          <div class="legend-color legend-stop"></div>
          <span>Delivery Stop</span>
        </div>
        <div class="card">
          <div class="legend-color legend-current"></div>
          <span>In Progress</span>
        </div>
        <div class="card">
          <div class="legend-color legend-route"></div>
          <span>Optimized Route</span>
        </div>
      </div>

      <div class="summary-grid">
        <div class="cardColour">
          <h4>Route Summary</h4>
          <div class="info-item">
            <span class="info-label">Total Distance:</span>
            <span class="info-value">24.5 km</span>
          </div>
          <div class="info-item">
            <span class="info-label">Estimated Time:</span>
            <span class="info-value">1h 45m</span>
          </div>
          <div class="info-item">
            <span class="info-label">Stops:</span>
            <span class="info-value">3 deliveries</span>
          </div>
          <div class="info-item">
            <span class="info-label">Fuel Cost:</span>
            <span class="info-value">$8.50</span>
          </div>
        </div>

        <div class="cardColour">
          <h4>Next Delivery</h4>
          <div class="info-item">
            <span class="info-label">Order:</span>
            <span class="info-value">DEL-001</span>
          </div>
          <div class="info-item">
            <span class="info-label">Customer:</span>
            <span class="info-value">Sarah Johnson</span>
          </div>
          <div class="info-item">
            <span class="info-label">Address:</span>
            <span class="info-value">123 Main St</span>
          </div>
          <div class="info-item">
            <span class="info-label">ETA:</span>
            <span class="info-value">15 minutes</span>
          </div>
        </div>
      </div>
    </div>

    <script src="main.js"></script>
</body>

</html>
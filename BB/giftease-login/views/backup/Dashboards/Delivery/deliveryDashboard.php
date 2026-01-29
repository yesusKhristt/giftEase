<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Delivery Partner Dashboard - GiftEase</title>
  <link rel="stylesheet" href="public/Saneth/style.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dkmvuFiYMuEv20&libraries=geometry,places" async defer></script>
</head>
<body>

  <div class="dashboard-layout">  
    <aside class="left_sidebar">
            <div class="profile-section">
        <div class="profile-picture">
          <i class="fas fa-user"></i>
        </div>
        <div class="username">Saneth Tharushika</div>
        <div class="rating">
          <div class="svg-cute-star">
            <?php
            function render_stars(float $rating): string
            {
              $output = '';
              $totalStars = 5;

              for ($i = 1; $i <= $totalStars; $i++) {
                if ($rating >= $i) {
                  $output .= '<span class="star filled">★</span>';
                } else {
                  $fraction = $rating - ($i - 1);
                  if ($fraction > 0) {
                    $percent = (1 - $fraction) * 100;
                    // Output partial star with inline style for clip-path percentage
                    $output .= '<span class="star partial" style="--empty-percent: ' . $percent . '%;">★</span>';
                  } else {
                    $output .= '<span class="star">★</span>';
                  }
                }
              }
              return $output;
            }

            $rating = 3.3;
            echo render_stars($rating);
            echo "<div class='rating-text'>$rating Rating</div>"
              ?>

          </div>
        </div>
      </div>

      <!-- <div class="sidebar-header">
        <i class="fas fa-gift logo-icon"></i>
        <span class = "brand-name"> Delivery</span>
      </div> -->
      <ul class="nav-section">
        <li><a href="#" class="nav-item active" data-tab="home"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="#" class="nav-item " data-tab="profile"><i class="fas fa-user"></i> Profile</a></li>
        <li><a href="#" class="nav-item " data-tab="assigned-orders"><i class="fas fa-box"></i> Assigned Orders</a></li>
        <li><a href="#" class="nav-item " data-tab="route-map"><i class="fas fa-map"></i> Route Map</a></li>
        <li><a href="#" class="nav-item " data-tab="upload-proof"><i class="fas fa-camera"></i> Upload Proof</a></li>
        <li><a href="#" class="nav-item " data-tab="history"><i class="fas fa-history"></i> History</a></li>
        <li><a href="#" class="nav-item " data-tab="notifications"><i class="fas fa-bell"></i> Notifications</a></li>
        <li><a href="#" class="nav-item " data-tab="settings"><i class="fas fa-cog"></i> Settings</a></li>
      </ul>
      <div class="button-section">
        <a href="#logout" class="btn">
          <i class="fas fa-sign-out-alt"></i>
          Log Out
        </a>
      </div>
    </aside>
    

  
    <main class="dashboard-main">
          <header class="browse-header">
        <div class="topbar-container" style="display: flex; align-items: center; padding: 10px 20px;">
          <!-- Logo -->
          <div><span class="gift">
              gift<b style="color:#000000">Ease</b>
            </span>
          </div>


          <!-- Search Bar -->
          <div class="search-bar">
            <input type="text" class="search-input" placeholder="Search..." />
          </div>

          <!-- Right Side Links/Buttons -->
          <nav class="topbar-actions" style="display: flex; gap: 16px;">
            <a href="#">Login</a>
            <a href="#">Sign Up</a>
            <a href="#" class="settings-btn">
              <i class="fas fa-cog"></i>
            </a>
          </nav>
        </div>
</header> 
      <!-- <div id="home" class="tab-content active"> -->
      <div class="main-content">
        <div id="home" class="tab-content active">
        <div class="welcome-section">
        <h1>Welcome Back, Saneth!</h1>
        <p>Ready to make some deliveries today.</p>

            <div class="quick-summary">
              <h3>Today's Overview</h3>
              <div class="summary-grid">
                <div class="summary-item">
                  <div class="summary-number">3</div>
                  <div class="summary-label">Orders Assigned</div>
                </div>
                <div class="summary-item">
                  <div class="summary-number">1</div>
                  <div class="summary-label">Delivered Today</div>
                </div>
                <div class="summary-item">
                  <div class="summary-number">2</div>
                  <div class="summary-label">Pending Deliveries</div>
                </div>
                <div class="summary-item">
                  <div class="summary-number">95%</div>
                  <div class="summary-label">Success Rate</div>
                </div>
              </div>
            </div>
          </div>

          <div class="stats-grid">
            <div class="stat-card" onclick="showEarningsBreakdown()">
              <div class="stat-number" id="todaysDeliveries">8</div>
              <div class="stat-label">Today's Deliveries</div>
              <div class="stat-trend">+2 from yesterday</div>
            </div>
            <div class="stat-card" onclick="showEarningsBreakdown()">
              <div class="stat-number" id="todaysEarnings">$127</div>
              <div class="stat-label">Today's Earnings</div>
              <div class="stat-trend">+$23 from yesterday</div>
            </div>
            <div class="stat-card" onclick="showRatingDetails()">
              <div class="stat-number" id="currentRating">4.9</div>
              <div class="stat-label">Rating</div>
              <div class="stat-trend">⭐⭐⭐⭐⭐</div>
            </div>
            <div class="stat-card" onclick="showDistanceDetails()">
              <div class="stat-number" id="distanceCovered">45km</div>
              <div class="stat-label">Distance Covered</div>
              <div class="stat-trend">3 routes completed</div>
            </div>
          </div>
        </div>
      </div>

      <div id="profile" class="tab-content">
        <div class="main-content">
          <div class="profile-section">
            <div class="profile-header">
              <div class="profile-avatar">
                <i class="fas fa-user"></i>
              </div>
              <div class="profile-info">
                <h2>Alex Rodriguez</h2>
                <p>Senior Delivery Partner • Member since Jan 2023</p>
                <p><i class="fas fa-star"></i> 4.9 Rating • <i class="fas fa-truck"></i> Motorcycle</p>
              </div>
            </div>

            <div class="profile-stats">
              <div class="profile-stat">
                <div class="profile-stat-number">1,247</div>
                <div class="profile-stat-label">Total Deliveries</div>
              </div>
              <div class="profile-stat">
                <div class="profile-stat-number">$18,650</div>
                <div class="profile-stat-label">Total Earnings</div>
              </div>
              <div class="profile-stat">
                <div class="profile-stat-number">98.5%</div>
                <div class="profile-stat-label">Success Rate</div>
              </div>
              <div class="profile-stat">
                <div class="profile-stat-number">4.9</div>
                <div class="profile-stat-label">Avg Rating</div>
              </div>
              <div class="profile-stat">
                <div class="profile-stat-number">2,340km</div>
                <div class="profile-stat-label">Distance Traveled</div>
              </div>
            </div>
          </div>

          <div class="settings-section">
            <h3>Personal Information</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
              <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-input" value="Alex Rodriguez" readonly />
              </div>
              <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input" value="alex.rodriguez@gifteasy.com" readonly />
              </div>
              <div class="form-group">
                <label class="form-label">Phone</label>
                <input type="tel" class="form-input" value="+1 (555) 123-4567" />
              </div>
              <div class="form-group">
                <label class="form-label">Emergency Contact</label>
                <input type="tel" class="form-input" value="+1 (555) 987-6543" />
              </div>
            </div>
          </div>

          <div class="settings-section">
            <h3>Vehicle Information</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
              <div class="form-group">
                <label class="form-label">Vehicle Type</label>
                <select class="form-select">
                  <option selected>Motorcycle</option>
                  <option>Car</option>
                  <option>Van</option>
                  <option>Bicycle</option>
                </select>
              </div>
              <div class="form-group">
                <label class="form-label">License Plate</label>
                <input type="text" class="form-input" value="ABC-1234" />
              </div>
              <div class="form-group">
                <label class="form-label">Insurance Number</label>
                <input type="text" class="form-input" value="INS-789456" />
              </div>
              <div class="form-group">
                <label class="form-label">License Expiry</label>
                <input type="date" class="form-input" value="2025-12-31" />
              </div>
            </div>
          </div>

          <div class="settings-section">
            <h3>Performance Metrics</h3>
            <div class="performance-summary">
              <div class="metric-card">
                <div class="metric-value">28</div>
                <div class="metric-label">This Month</div>
                <div class="metric-change positive">+15% vs last month</div>
              </div>
              <div class="metric-card">
                <div class="metric-value">$420</div>
                <div class="metric-label">Monthly Earnings</div>
                <div class="metric-change positive">+8% vs last month</div>
              </div>
              <div class="metric-card">
                <div class="metric-value">22min</div>
                <div class="metric-label">Avg Delivery Time</div>
                <div class="metric-change positive">-3min vs last month</div>
              </div>
              <div class="metric-card">
                <div class="metric-value">156</div>
                <div class="metric-label">Customer Reviews</div>
                <div class="metric-change positive">+12 this month</div>
              </div>
            </div>
          </div>

          <div style="display: flex; gap: 15px;">
            <button class="btn btn-primary" onclick="updateProfile()">Update Profile</button>
            <button class="btn btn-outline" onclick="changePassword()">Change Password</button>
          </div>
        </div>
      </div>

      <div id="assigned-orders" class="tab-content">
        <div class="main-content">
          <h1>Assigned Orders</h1>
          <p>Manage your current delivery assignments and update their status.</p>

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

      <div id="route-map" class="tab-content">
        <div class="main-content">
          <h1>Route Map</h1>
          <p>View your optimized delivery route and track your progress in real-time.</p>
          <iframe src="https://maps.google.com/maps?q=Colombo&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen></iframe>

          <div class="map-controls">
            <div class="map-control-group">
              <button class="btn btn-primary" onclick="optimizeRoute()">
                <i class="fas fa-route"></i> Optimize Route
              </button>
              <button class="btn btn-outline" onclick="getCurrentLocation()">
                <i class="fas fa-crosshairs"></i> My Location
              </button>
              <button class="btn btn-outline" onclick="refreshMap()">
                <i class="fas fa-sync"></i> Refresh
              </button>
            </div>
            <div class="map-control-group">
              <label>View:</label>
              <select class="form-select" onchange="changeMapView(this.value)">
                <option value="roadmap">Road</option>
                <option value="satellite">Satellite</option>
                <option value="hybrid">Hybrid</option>
                <option value="terrain">Terrain</option>
              </select>
            </div>
            <div class="map-control-group">
              <button class="btn btn-ghost" onclick="shareLocation()">
                <i class="fas fa-share-alt"></i> Share Location
              </button>
            </div>
          </div>

          <div class="route-legend">
            <div class="legend-item">
              <div class="legend-color legend-start"></div>
              <span>Your Location</span>
            </div>
            <div class="legend-item">
              <div class="legend-color legend-stop"></div>
              <span>Delivery Stop</span>
            </div>
            <div class="legend-item">
              <div class="legend-color legend-current"></div>
              <span>In Progress</span>
            </div>
            <div class="legend-item">
              <div class="legend-color legend-route"></div>
              <span>Optimized Route</span>
            </div>
          </div>
           
          <div class="map-info-panel">
            <div class="info-card">
              <h3>Route Summary</h3>
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

            <div class="info-card">
              <h3>Next Delivery</h3>
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
      </div>

      <div id="upload-proof" class="tab-content">
        <div class="main-content">
          <h1>Upload Proof</h1>
          <p>Upload delivery confirmation photos and documents for completed deliveries.</p>

          <div class="upload-area" id="uploadArea" onclick="document.getElementById('fileInput').click()">
            <i class="fas fa-cloud-upload-alt" style="font-size: 3rem; color: #3498db; margin-bottom: 15px;"></i>
            <h3>Drop files here or click to upload</h3>
            <p>Supported formats: JPG, PNG, PDF (Max 10MB)</p>
            <input type="file" id="fileInput" multiple accept="image/*,.pdf" style="display: none;" onchange="handleFileUpload(event)" />
          </div>

          <div class="proof-gallery" id="proofGallery">
            <div class="proof-item">
              <div class="proof-image">
                <i class="fas fa-image" style="font-size: 2rem;"></i>
              </div>
              <div class="proof-info">
                <div style="font-weight: 600; margin-bottom: 5px;">DEL-001 Delivery</div>
                <div style="font-size: 0.9rem; color: #666; margin-bottom: 10px;">Uploaded: 2 hours ago</div>
                <button class="btn btn-outline btn-small" onclick="viewProof('DEL-001')">View</button>
              </div>
            </div>

            <div class="proof-item">
              <div class="proof-image">
                <i class="fas fa-file-pdf" style="font-size: 2rem; color: #e74c3c;"></i>
              </div>
              <div class="proof-info">
                <div style="font-weight: 600; margin-bottom: 5px;">DEL-002 Receipt</div>
                <div style="font-size: 0.9rem; color: #666; margin-bottom: 10px;">Uploaded: 1 hour ago</div>
                <button class="btn btn-outline btn-small" onclick="viewProof('DEL-002')">View</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div id="history" class="tab-content">
        <div class="main-content">
          <h1>Delivery History</h1>
          <p>View your complete delivery history.</p>
          <div class="history-filters">
            <div class="filter-group">
              <label>Date Range:</label>
              <div class="date-range-picker">
                <input type="date" id="dateFrom" class="form-input" />
                <span>to</span>
                <input type="date" id="dateTo" class="form-input" />
              </div>
            </div>
            <div class="filter-group">
              <label>Status:</label>
              <select id="statusFilter" class="form-select">
                <option value="all">All Status</option>
                <option value="delivered">Delivered</option>
                <option value="cancelled">Cancelled</option>
                <option value="returned">Returned</option>
              </select>
            </div>
            <div class="filter-group">
              <label>Customer:</label>
              <input type="text" id="customerSearch" class="form-input" placeholder="Search customer..." />
            </div>
            <div class="filter-group">
              <button class="btn btn-outline" onclick="exportHistory()">
                <i class="fas fa-download"></i> Export
              </button>
              <button class="btn btn-ghost" onclick="resetFilters()">
                <i class="fas fa-undo"></i> Reset
              </button>
            </div>
          </div>

          <table class="history-table">
            <thead>
              <tr>
                <th>Order ID</th>
                <th>Customer</th>
                <th>Product</th>
                <th>Delivery Date</th>
                <th>Status</th>
                <th>Earnings</th>
                <th>Rating</th>
                <th>Distance</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody id="historyTableBody">
              <tr>
                <td>DEL-098</td>
                <td>
                  <div class="customer-cell">
                    <div class="customer-avatar-small">JS</div>
                    <div>
                      <div class="customer-name">John Smith</div>
                      <div class="customer-phone">+1 (555) 123-4567</div>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="product-cell">
                    <img src="/placeholder.svg?height=40&width=40" alt="Product" class="product-thumbnail" />
                    <div>
                      <div class="product-name">Flower Bouquet</div>
                      <div class="product-category">Flowers</div>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="date-cell">
                    <div class="delivery-date">Jan 15, 2024</div>
                    <div class="delivery-time">2:30 PM</div>
                  </div>
                </td>
                <td><span class="order-status status-delivered">Delivered</span></td>
                <td class="earnings-cell">$15.00</td>
                <td>
                  <div class="rating-cell">
                    <div class="stars">⭐⭐⭐⭐⭐</div>
                    <div class="rating-score">5.0</div>
                  </div>
                </td>
                <td>5.2 km</td>
                <td>
                  <div class="action-buttons">
                    <button class="btn btn-ghost btn-small" onclick="viewHistoryDetails('DEL-098')" title="View Details">
                      <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-ghost btn-small" onclick="downloadReceipt('DEL-098')" title="Download Receipt">
                      <i class="fas fa-download"></i>
                    </button>
                    <button class="btn btn-ghost btn-small" onclick="repeatOrder('DEL-098')" title="Repeat Order">
                      <i class="fas fa-redo"></i>
                    </button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>DEL-097</td>
                <td>
                  <div class="customer-cell">
                    <div class="customer-avatar-small">LB</div>
                    <div>
                      <div class="customer-name">Lisa Brown</div>
                      <div class="customer-phone">+1 (555) 234-5678</div>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="product-cell">
                    <img src="/placeholder.svg?height=40&width=40" alt="Product" class="product-thumbnail" />
                    <div>
                      <div class="product-name">Gift Basket</div>
                      <div class="product-category">Gifts</div>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="date-cell">
                    <div class="delivery-date">Jan 14, 2024</div>
                    <div class="delivery-time">4:15 PM</div>
                  </div>
                </td>
                <td><span class="order-status status-delivered">Delivered</span></td>
                <td class="earnings-cell">$18.00</td>
                <td>
                  <div class="rating-cell">
                    <div class="stars">⭐⭐⭐⭐⭐</div>
                    <div class="rating-score">5.0</div>
                  </div>
                </td>
                <td>7.8 km</td>
                <td>
                  <div class="action-buttons">
                    <button class="btn btn-ghost btn-small" onclick="viewHistoryDetails('DEL-097')" title="View Details">
                      <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-ghost btn-small" onclick="downloadReceipt('DEL-097')" title="Download Receipt">
                      <i class="fas fa-download"></i>
                    </button>
                    <button class="btn btn-ghost btn-small" onclick="repeatOrder('DEL-097')" title="Repeat Order">
                      <i class="fas fa-redo"></i>
                    </button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>DEL-096</td>
                <td>
                  <div class="customer-cell">
                    <div class="customer-avatar-small">DW</div>
                    <div>
                      <div class="customer-name">David Wilson</div>
                      <div class="customer-phone">+1 (555) 345-6789</div>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="product-cell">
                    <img src="/placeholder.svg?height=40&width=40" alt="Product" class="product-thumbnail" />
                    <div>
                      <div class="product-name">Chocolate Box</div>
                      <div class="product-category">Sweets</div>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="date-cell">
                    <div class="delivery-date">Jan 13, 2024</div>
                    <div class="delivery-time">1:45 PM</div>
                  </div>
                </td>
                <td><span class="order-status status-delivered">Delivered</span></td>
                <td class="earnings-cell">$12.00</td>
                <td>
                  <div class="rating-cell">
                    <div class="stars">⭐⭐⭐⭐</div>
                    <div class="rating-score">4.0</div>
                  </div>
                </td>
                <td>3.5 km</td>
                <td>
                  <div class="action-buttons">
                    <button class="btn btn-ghost btn-small" onclick="viewHistoryDetails('DEL-096')" title="View Details">
                      <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn btn-ghost btn-small" onclick="downloadReceipt('DEL-096')" title="Download Receipt">
                      <i class="fas fa-download"></i>
                    </button>
                    <button class="btn btn-ghost btn-small" onclick="repeatOrder('DEL-096')" title="Repeat Order">
                      <i class="fas fa-redo"></i>
                    </button>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <div id="notifications" class="tab-content">
        <div class="main-content">
          <h1>Notifications</h1>
          <p>Stay updated with important alerts and messages.</p>

          <div style="display: flex; gap: 15px; margin-bottom: 20px;">
            <button class="btn btn-primary" onclick="markAllRead()">Mark All Read</button>
            <button class="btn btn-outline" onclick="clearNotifications()">Clear All</button>
          </div>

          <div class="notification-item unread" data-notification-id="1">
            <div class="notification-icon notification-info">
              <i class="fas fa-info"></i>
            </div>
            <div class="notification-content">
              <div class="notification-title">New Order Assigned</div>
              <div class="notification-text">You have been assigned order DEL-004 for delivery today. Priority: High</div>
              <div class="notification-actions">
                <button class="btn btn-small btn-primary" onclick="acceptOrder('DEL-004')">Accept</button>
                <button class="btn btn-small btn-outline" onclick="viewOrderDetails('DEL-004')">View Details</button>
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
                <button class="btn btn-small btn-primary" onclick="showRoute('DEL-002')">View Route</button>
                <button class="btn btn-small btn-outline" onclick="optimizeRoute()">Optimize</button>
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

      <div id="settings" class="tab-content">
        <div class="main-content">
          <h1>Settings</h1>
          <p>Manage your account preferences and delivery settings.</p>

          <div class="settings-section">
            <h3>Profile Information</h3>
            <div class="form-group">
              <label class="form-label">Full Name</label>
              <input type="text" class="form-input" value="Alex Rodriguez" placeholder="Enter your full name" />
            </div>
            <div class="form-group">
              <label class="form-label">Phone Number</label>
              <input type="tel" class="form-input" value="+1 (555) 123-4567" placeholder="Enter your phone number" />
            </div>
            <div class="form-group">
              <label class="form-label">Email Address</label>
              <input type="email" class="form-input" value="alex.rodriguez@gifteasy.com" placeholder="Enter your email" />
            </div>
            <div class="form-group">
              <label class="form-label">Vehicle Type</label>
              <select class="form-select">
                <option selected>Motorcycle</option>
                <option>Car</option>
                <option>Van</option>
                <option>Bicycle</option>
              </select>
            </div>
          </div>

          <div class="settings-section">
            <h3>Availability Settings</h3>
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
              <span>Available for deliveries</span>
              <div class="toggle-switch active" onclick="toggleAvailability(this)">
                <div class="toggle-slider"></div>
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Working Hours</label>
              <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <input type="time" class="form-input" value="09:00" />
                <input type="time" class="form-input" value="18:00" />
              </div>
            </div>
            <div class="form-group">
              <label class="form-label">Maximum Deliveries Per Day</label>
              <input type="number" class="form-input" value="15" min="1" max="50" />
            </div>
          </div>

          <div class="settings-section">
            <h3>Notification Preferences</h3>
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
              <span>New order notifications</span>
              <div class="toggle-switch active" onclick="toggleNotification(this)">
                <div class="toggle-slider"></div>
              </div>
            </div>
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
              <span>Route update alerts</span>
              <div class="toggle-switch active" onclick="toggleNotification(this)">
                <div class="toggle-slider"></div>
              </div>
            </div>
            <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 15px;">
              <span>Customer rating notifications</span>
              <div class="toggle-switch" onclick="toggleNotification(this)">
                <div class="toggle-slider"></div>
              </div>
            </div>
          </div>

          <div class="settings-section">
            <h3>Payment Information</h3>
            <div class="form-group">
              <label class="form-label">Bank Account Number</label>
              <input type="text" class="form-input" value="****-****-****-1234" placeholder="Enter account number" />
            </div>
            <div class="form-group">
              <label class="form-label">Routing Number</label>
              <input type="text" class="form-input" value="021000021" placeholder="Enter routing number" />
            </div>
            <div class="form-group">
              <label class="form-label">Payment Schedule</label>
              <select class="form-select">
                <option>Weekly</option>
                <option>Bi-weekly</option>
                <option>Monthly</option>
              </select>
            </div>
          </div>

          <div style="display: flex; gap: 15px;">
            <button class="btn btn-primary" onclick="saveSettings()">Save Changes</button>
            <button class="btn btn-outline" onclick="resetSettings()">Reset</button>
          </div>
        </div>
      </div>
    </main>
  </div>
   
  <div id="orderDetailsModal" class="modal">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Order Details</h2>
        <span class="close" onclick="closeModal('orderDetailsModal')">&times;</span>
      </div>
      <div class="modal-body">
        <div class="order-detail-grid">
          <div class="detail-section">
            <h3>Order Information</h3>
            <div class="detail-row">
              <span class="label">Order ID:</span>
              <span class="value" id="modalOrderId">DEL-001</span>
            </div>
            <div class="detail-row">
              <span class="label">Order Date:</span>
              <span class="value">January 15, 2024</span>
            </div>
            <div class="detail-row">
              <span class="label">Priority:</span>
              <span class="value" style="color: #e74c3c; font-weight: bold;">High Priority</span>
            </div>
            <div class="detail-row">
              <span class="label">Status:</span>
              <span class="value"><span class="order-status status-pending">Pending</span></span>
            </div>
          </div>

          <div class="detail-section">
            <h3>Product Details</h3>
            <div class="product-item">
              <img src="/placeholder.svg?height=80&width=80" alt="Product" />
              <div class="product-info">
                <h4>Premium Rose Bouquet</h4>
                <p>Beautiful red roses with premium wrapping</p>
                <div class="product-specs">
                  <span>Quantity: 1</span>
                  <span>Weight: 2.5 kg</span>
                  <span>Fragile: Yes</span>
                </div>
              </div>
            </div>
          </div>

          <div class="detail-section">
            <h3>Customer Information</h3>
            <div class="customer-info">
              <div class="customer-avatar">
                <i class="fas fa-user"></i>
              </div>
              <div class="customer-details">
                <h4>Sarah Johnson</h4>
                <p><i class="fas fa-phone"></i> +1 (555) 123-4567</p>
                <p><i class="fas fa-envelope"></i> sarah.johnson@email.com</p>
                <p><i class="fas fa-star"></i> Customer Rating: 4.8/5</p>
              </div>
            </div>
          </div>

          <div class="detail-section">
            <h3>Delivery Address</h3>
            <div class="address-info">
              <p><strong>123 Main Street</strong></p>
              <p>Apartment 4B</p>
              <p>Downtown, NY 10001</p>
              <p><strong>Delivery Instructions:</strong></p>
              <div class="delivery-notes">Please ring the doorbell twice. Leave at door if no answer. Call before delivery.</div>
            </div>
            <button class="btn btn-outline" onclick="openMaps()" style="margin-top: 15px;">
              <i class="fas fa-map-marker-alt"></i> Open in Maps
            </button>
          </div>

          <div class="detail-section">
            <h3>Payment & Earnings</h3>
            <div class="payment-info">
              <div class="payment-row">
                <span>Product Total:</span>
                <span>$89.99</span>
              </div>
              <div class="payment-row">
                <span>Delivery Fee:</span>
                <span>$15.00</span>
              </div>
              <div class="payment-row">
                <span>Your Earnings:</span>
                <span>$15.00</span>
              </div>
              <div class="payment-row total">
                <span>Customer Total:</span>
                <span>$104.99</span>
              </div>
            </div>
          </div>

          <div class="detail-section">
            <h3>Delivery Timeline</h3>
            <div class="timeline">
              <div class="timeline-item completed">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                  <h5>Order Placed</h5>
                  <p>Jan 15, 2024 - 10:30 AM</p>
                </div>
              </div>
              <div class="timeline-item completed">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                  <h5>Order Confirmed</h5>
                  <p>Jan 15, 2024 - 10:45 AM</p>
                </div>
              </div>
              <div class="timeline-item active">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                  <h5>Assigned to Delivery</h5>
                  <p>Jan 15, 2024 - 2:15 PM</p>
                </div>
              </div>
              <div class="timeline-item">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                  <h5>Out for Delivery</h5>
                  <p>Pending</p>
                </div>
              </div>
              <div class="timeline-item">
                <div class="timeline-marker"></div>
                <div class="timeline-content">
                  <h5>Delivered</h5>
                  <p>Pending</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" onclick="startDeliveryFromModal()">
          <i class="fas fa-truck"></i> Start Delivery
        </button>
        <button class="btn btn-outline" onclick="contactCustomerFromModal()">
          <i class="fas fa-phone"></i> Contact Customer
        </button>
        <button class="btn btn-ghost" onclick="closeModal('orderDetailsModal')">Close</button>
      </div>
    </div>
  </div>

  <script src="main.js"></script>
</body>
</html>

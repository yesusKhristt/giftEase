
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Delivery Partner Dashboard - GiftEase</title>
  <link rel="stylesheet" href="style.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dkmvuFiYMuEv20&libraries=geometry,places" async defer></script> -->
</head>
<body>
  
  <div class="dashboard-layout">
           <!-- <aside class="left_sidebar">saneth</aside>  -->
          <!-- <div id="profile" class="tab-content"> -->
     <!-- <div id="profile" class="tab-content"> -->
      <main class="dashboard-main">
        <div class="main-content">
          <div class="profile-section">
            <div class="profile-header">
              <div class="profile-avatar">
                <i class="fas fa-user"></i>
              </div>
              <div class="profile-info">
                <h2>Saneth Tharushika</h2>
                <p>Senior Delivery Partner • Member since Jan 2023</p>
                <p><i class="fas fa-star"></i> 4.9 Rating • <i class="fas fa-motorcycle"></i> Motorcycle</p>
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
                <input type="text" class="form-input" value="Saneth Tharushika" readonly />
              </div>
              <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input" value="sanethsiriwardhana@gmail.com" readonly />
              </div>
              <div class="form-group">
                <label class="form-label">Phone</label>
                <input type="tel" class="form-input" value="+94 761694206" />
              </div>
              <div class="form-group">
                <label class="form-label">Emergency Contact</label>
                <input type="tel" class="form-input" value="+94 761694206" />
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
                <input type="text" class="form-input" value="MM-7270" />
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
      </main>
      <!-- </div> -->
  </div>
    <script src="main.js"></script>
    </body>
</html>  
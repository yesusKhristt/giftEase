<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Delivery Partner Dashboard - GiftEase</title>
  <link rel="stylesheet" href="public/style.css" />
  <link rel="icon" type="image/png" href="resources/1.png">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

  <div class="container">
    <?php
    $activePage = 'profile';
    include 'views\commonElements/leftSidebar.php';
    ?>
    <div class="main-content">
      <div class="cardColour">

        <div class="profile-section">
          <i class="profile-picture"></i>
          <div class="">
            <h4>Thenuka Ranasinghe</h4>
            <p>Vendor • Member since Jan 2025</p>
            <p><i class="fas fa-star"></i> 4.9 Rating • 

          </div>
        </div>

        <div class="summary-grid">
          <div class="card">
            <div class="title">1,247</div>
            <div class="subtitle">Total Items Sold</div>
          </div>
          <div class="card">
            <div class="title">$18,650</div>
            <div class="subtitle">Total Earnings</div>
          </div>
          <div class="card">
            <div class="title">98.5%</div>
            <div class="subtitle">Success Rate</div>
          </div>
          <div class="card">
            <div class="title">4.9</div>
            <div class="subtitle">Avg Rating</div>
          </div>
        </div>
      </div>

      <div class="card">
        <h4>Personal Information</h4>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
          <div class="form-group">
            <label class="subtitle">Full Name</label>
            <input type="text" class="form-input" value="Saneth Tharushika" readonly />
          </div>
          <div class="form-group">
            <label class="subtitle">Email</label>
            <input type="email" class="form-input" value="sanethsiriwardhana@gmail.com" readonly />
          </div>
          <div class="form-group">
            <label class="subtitle">Phone</label>
            <input type="tel" class="form-input" value="+94 761694206" />
          </div>
          <div class="form-group">
            <label class="subtitle">Emergency Contact</label>
            <input type="tel" class="form-input" value="+94 761694206" />
          </div>
        </div>
      </div>

      <div class="card">
        <h4>Vehicle Information</h4>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
          <div class="form-group">
            <label class="subtitle">Vehicle Type</label>
            <select class="">
              <option selected>Motorcycle</option>
              <option>Car</option>
              <option>Van</option>
              <option>Bicycle</option>
            </select>
          </div>
          <div class="form-group">
            <label class="subtitle">License Plate</label>
            <input type="text" class="form-input" value="MM-7270" />
          </div>
          <div class="form-group">
            <label class="subtitle">Insurance Number</label>
            <input type="text" class="form-input" value="INS-789456" />
          </div>
          <div class="form-group">
            <label class="subtitle">License Expiry</label>
            <input type="date" class="form-input" value="2025-12-31" />
          </div>
        </div>
      </div>

      <div class="card">
        <h4>Performance Metrics</h4>
        <div class="summary-grid">
          <div class="cardColour">
            <div class="title">28</div>
            <div class="subtitle">This Month</div>
            <div>+15% vs last month</div>
          </div>
          <div class="cardColour">
            <div class="title">$420</div>
            <div class="subtitle">Monthly Earnings</div>
            <div>+8% vs last month</div>
          </div>
          <div class="cardColour">
            <div class="title">22min</div>
            <div class="subtitle">Avg Delivery Time</div>
            <div>-3min vs last month</div>
          </div>
          <div class="cardColour">
            <div class="title">156</div>
            <div class="subtitle">Customer Reviews</div>
            <div>+12 this month</div>
          </div>
        </div>
      </div>

      <div style="display: flex; gap: 15px;">
        <button class="btn1" onclick="updateProfile()">Update Profile</button>
        <button class="btn1" onclick="changePassword()">Change Password</button>
      </div>
    </div>
  </div>
  <script src="main.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Delivery Partner Dashboard - GiftEase</title>
  <link rel="stylesheet" href="public/delivery.css" />
  <link rel="stylesheet" href="public/sideTopBar.css" />
  <link rel="icon" type="image/png" href="resources/1.png">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  <div class="container">
    <?php
    $activePage = 'settings';
    include 'views\commonElements/leftSidebarSaneth.php';


    ?>
    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Settings</h1>
        <p class="subtitle">Manage your account preferences and delivery settings.</p>
      </div>

      <div class="settings-section">
        <h3>Profile Information</h3>
        <div class="form-group">
          <label class="form-label">Full Name</label>
          <input type="text" class="form-input" value="<?php echo htmlspecialchars(($deliveryProfile['first_name'] ?? '') . ' ' . ($deliveryProfile['last_name'] ?? '')); ?>" placeholder="Enter your full name" readonly />
        </div>
        <div class="form-group">
          <label class="form-label">Phone Number</label>
          <input type="tel" class="form-input" value="<?php echo htmlspecialchars($deliveryProfile['phone'] ?? ''); ?>" placeholder="Enter your phone number" readonly />
        </div>
        <div class="form-group">
          <label class="form-label">Email Address</label>
          <input type="email" class="form-input" value="<?php echo htmlspecialchars($deliveryProfile['email'] ?? ''); ?>" placeholder="Enter your email" readonly />
        </div>

        <div class="settings-section">
          <h3>Submitted Documentation</h3>
          <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="doc-item">
              <span class="doc-label">Identity (NIC/Passport)</span>
              <?php if (!empty($deliveryProfile['identity_doc'])): ?>
                <a href="<?php echo htmlspecialchars($deliveryProfile['identity_doc']); ?>" class="doc-link" target="_blank">
                  <i class="fas fa-download"></i> View
                </a>
              <?php else: ?>
                <span class="doc-missing">Not Uploaded</span>
              <?php endif; ?>
            </div>

            <div class="doc-item">
              <span class="doc-label">Driving License</span>
              <?php if (!empty($deliveryProfile['driving_license'])): ?>
                <a href="<?php echo htmlspecialchars($deliveryProfile['driving_license']); ?>" class="doc-link" target="_blank">
                  <i class="fas fa-download"></i> View
                </a>
              <?php else: ?>
                <span class="doc-missing">Not Uploaded</span>
              <?php endif; ?>
            </div>

            <div class="doc-item">
              <span class="doc-label">Vehicle Registration</span>
              <?php if (!empty($deliveryProfile['vehicle_registration'])): ?>
                <a href="<?php echo htmlspecialchars($deliveryProfile['vehicle_registration']); ?>" class="doc-link" target="_blank">
                  <i class="fas fa-download"></i> View
                </a>
              <?php else: ?>
                <span class="doc-missing">Not Uploaded</span>
              <?php endif; ?>
            </div>

            <div class="doc-item">
              <span class="doc-label">Vehicle Insurance</span>
              <?php if (!empty($deliveryProfile['vehicle_insurance'])): ?>
                <a href="<?php echo htmlspecialchars($deliveryProfile['vehicle_insurance']); ?>" class="doc-link" target="_blank">
                  <i class="fas fa-download"></i> View
                </a>
              <?php else: ?>
                <span class="doc-missing">Not Uploaded</span>
              <?php endif; ?>
            </div>

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

      </div>
    </div>
  </div>

  <script src="main.js"></script>
  <script>
    function toggleDoc(id) {
      var el = document.getElementById(id);
      if (!el) return;
      el.style.display = el.style.display === 'none' ? 'block' : 'none';
    }
  </script>
</body>

</html>
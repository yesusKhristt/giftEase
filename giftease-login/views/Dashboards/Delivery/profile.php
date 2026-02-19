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
    $activePage = 'profile';
    include 'views\commonElements/leftSidebarSaneth.php';
    ?>
    <div class="main-content">
      <div class="cardColour">

        <div class="profile-section">
          
            <a href="?controller=delivery&action=dashboard/updateProfilePicture">
                        <img src="<?php echo htmlspecialchars($deliveryProfile['image_loc']) ?>" class="profile-picture" alt="+">
                    </a>
          
          <div class="">
            <h4><?php echo htmlspecialchars(($deliveryProfile['first_name'] ?? '') . ' ' . ($deliveryProfile['last_name'] ?? '')); ?></h4>
            <p>Delivery Partner • Member since <?php echo htmlspecialchars(!empty($deliveryProfile['created_at']) ? date('M Y', strtotime($deliveryProfile['created_at'])) : 'N/A'); ?></p>
            <p><i class="fas fa-star"></i> <?php echo htmlspecialchars($profileStats['avg_rating'] ?? 'N/A'); ?> Rating • <i class="fas fa-motorcycle"></i> <?php echo htmlspecialchars($deliveryProfile['vehicleType'] ?? 'N/A'); ?></p>

          </div>
        </div>

        <div class="summary-grid">
          <div class="card">
            <div class="title"><?php echo htmlspecialchars($profileStats['delivered_total'] ?? 0); ?></div>
            <div class="subtitle">Total Deliveries</div>
          </div>
          <div class="card">
            <div class="title">Rs. <?php echo htmlspecialchars(number_format($profileStats['total_earnings'] ?? 0, 2)); ?></div>
            <div class="subtitle">Total Earnings</div>
          </div>
          <div class="card">
            <div class="title"><?php echo htmlspecialchars($profileStats['success_rate'] ?? 0); ?>%</div>
            <div class="subtitle">Success Rate</div>
          </div>
          <div class="card">
            <div class="title"><?php echo htmlspecialchars($profileStats['avg_rating'] ?? 'N/A'); ?></div>
            <div class="subtitle">Avg Rating</div>
          </div>
          <div class="card">
            <div class="title"><?php echo htmlspecialchars($profileStats['distance'] ?? 'N/A'); ?></div>
            <div class="subtitle">Distance Traveled</div>
          </div>
        </div>
      </div>

      <div class="card">
        <h4>Personal Information</h4>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
          <div class="form-group">
            <label class="subtitle">Full Name</label>
            <input type="text" class="form-input" value="<?php echo htmlspecialchars(($deliveryProfile['first_name'] ?? '') . ' ' . ($deliveryProfile['last_name'] ?? '')); ?>" readonly />
          </div>
          <div class="form-group">
            <label class="subtitle">Email</label>
            <input type="email" class="form-input" value="<?php echo htmlspecialchars($deliveryProfile['email'] ?? ''); ?>" readonly />
          </div>
          <div class="form-group">
            <label class="subtitle">Phone</label>
            <input type="tel" class="form-input" value="<?php echo htmlspecialchars($deliveryProfile['phone'] ?? ''); ?>" readonly />
          </div>
          <div class="form-group">
            <label class="subtitle">Address</label>
            <input type="text" class="form-input" value="<?php echo htmlspecialchars($deliveryProfile['address'] ?? ''); ?>" readonly />
          </div>
        </div>
      </div>

      <div class="card">
        <h4>Vehicle Information</h4>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
          <div class="form-group">
            <label class="subtitle">Vehicle Type</label>
            <input type="text" class="form-input" value="<?php echo htmlspecialchars($deliveryProfile['vehicleType'] ?? 'N/A'); ?>" readonly />
          </div>
          <div class="form-group">
            <label class="subtitle">License Plate</label>
            <input type="text" class="form-input" value="<?php echo htmlspecialchars($deliveryProfile['vehiclePlate'] ?? ''); ?>" readonly />
          </div>
          <div class="form-group">
            <label class="subtitle">Insurance</label>
            <?php if (!empty($deliveryProfile['vehicle_insurance'])): ?>
              <button type="button" class="btn1" style="width: 100%; padding: 10px 14px; font-size: 14px;" onclick="toggleDoc('insuranceDoc')">View Insurance</button>
              <div id="insuranceDoc" style="display: none; margin-top: 10px;">
                <img src="<?php echo htmlspecialchars($deliveryProfile['vehicle_insurance']); ?>" alt="Vehicle Insurance" style="max-width: 100%; height: auto; border-radius: 8px;" />
              </div>
            <?php else: ?>
              <input type="text" class="form-input" value="N/A" readonly />
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label class="subtitle">License</label>
            <?php if (!empty($deliveryProfile['driving_license'])): ?>
              <button type="button" class="btn1" style="width: 100%; padding: 10px 14px; font-size: 14px;" onclick="toggleDoc('licenseDoc')">View License</button>
              <div id="licenseDoc" style="display: none; margin-top: 10px;">
                <img src="<?php echo htmlspecialchars($deliveryProfile['driving_license']); ?>" alt="Driving License" style="max-width: 100%; height: auto; border-radius: 8px;" />
              </div>
            <?php else: ?>
              <input type="text" class="form-input" value="N/A" readonly />
            <?php endif; ?>
          </div>
        </div>
      </div>

       <div style="display: flex; gap: 15px;">
                <a href="?controller=delivery&action=editProfile/primary" class="btn1" onclick="updateProfile()">Update
                    Profile</a>
                <a href="?controller=delivery&action=deleteProfile" class="btn1" onclick="deleteProfile()">Delete
                    Profile</a>
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
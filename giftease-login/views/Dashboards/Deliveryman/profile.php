<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Delivery Partner Dashboard - GiftEase</title>
  <link rel="stylesheet" href="public/deliverystyle.css">
  <link rel="stylesheet" href="public/sideTopBar.css" />
  <link rel="icon" type="image/png" href="resources/1.png">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

  <div class="container">
    <?php
    $activePage = 'profile';
    include 'views/commonElements/leftSidebarDeliveryman.php';

    $fullName = trim((string)(($deliverymanProfile['first_name'] ?? '') . ' ' . ($deliverymanProfile['last_name'] ?? '')));
    $avatarText = strtoupper(substr($fullName !== '' ? $fullName : 'DM', 0, 2));
    $profileImage = trim((string)($deliverymanProfile['image_loc'] ?? ''));
    $isVerified = !empty($deliverymanProfile['verified']);
    ?>
    <div class="main-content">
      <div class="cardColour">

        <div class="profile-section">
          <a href="?controller=deliveryman&action=dashboard/updateProfilePicture">
            <?php if ($profileImage !== ''): ?>
              <img src="<?php echo htmlspecialchars($profileImage); ?>" class="profile-picture" alt="Deliveryman profile picture" style="object-fit: cover;">
            <?php else: ?>
              <div class="profile-picture" style="display:flex;align-items:center;justify-content:center;font-weight:700;">
                <?php echo htmlspecialchars($avatarText); ?>
              </div>
            <?php endif; ?>
          </a>
          <div class="">
            <h4><?php echo htmlspecialchars($fullName !== '' ? $fullName : 'Deliveryman'); ?></h4>
            <p>Member since <?php echo htmlspecialchars(!empty($deliverymanProfile['created_at']) ? date('M Y', strtotime($deliverymanProfile['created_at'])) : 'N/A'); ?></p>
            <p><i class="fas fa-motorcycle"></i> <?php echo htmlspecialchars($deliverymanProfile['vehicleType'] ?? 'N/A'); ?></p>
            <p><?php echo $isVerified ? 'Verified account' : 'Pending verification'; ?></p>

          </div>
        </div>

        <div class="summary-grid">
          <div class="card">
            <div class="title"><?php echo htmlspecialchars($profileStats['completed_total'] ?? 0); ?></div>
            <div class="subtitle">Completed Tasks</div>
          </div>
          <div class="card">
            <div class="title"><?php echo htmlspecialchars($profileStats['active_total'] ?? 0); ?></div>
            <div class="subtitle">Active Tasks</div>
          </div>
          <div class="card">
            <div class="title"><?php echo htmlspecialchars($profileStats['total_tasks'] ?? 0); ?></div>
            <div class="subtitle">All Tasks</div>
          </div>
          <div class="card">
            <div class="title"><?php echo htmlspecialchars($profileStats['success_rate'] ?? 0); ?>%</div>
            <div class="subtitle">Success Rate</div>
          </div>
        </div>
      </div>

      <div class="card">
        <h4>Personal Information</h4>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
          <div class="form-group">
            <label class="subtitle">Full Name</label>
            <input type="text" class="form-input" value="<?php echo htmlspecialchars($fullName); ?>" readonly />
          </div>
          <div class="form-group">
            <label class="subtitle">Email</label>
            <input type="email" class="form-input" value="<?php echo htmlspecialchars($deliverymanProfile['email'] ?? ''); ?>" readonly />
          </div>
          <div class="form-group">
            <label class="subtitle">Phone</label>
            <input type="tel" class="form-input" value="<?php echo htmlspecialchars($deliverymanProfile['phone'] ?? ''); ?>" readonly />
          </div>
          <div class="form-group">
            <label class="subtitle">Address</label>
            <input type="text" class="form-input" value="<?php echo htmlspecialchars($deliverymanProfile['address'] ?? ''); ?>" readonly />
          </div>
        </div>
      </div>

      <div class="card">
        <h4>Vehicle Information</h4>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
          <div class="form-group">
            <label class="subtitle">Vehicle Type</label>
            <input type="text" class="form-input" value="<?php echo htmlspecialchars($deliverymanProfile['vehicleType'] ?? 'N/A'); ?>" readonly />
          </div>
          <div class="form-group">
            <label class="subtitle">License Plate</label>
            <input type="text" class="form-input" value="<?php echo htmlspecialchars($deliverymanProfile['vehiclePlate'] ?? ''); ?>" readonly />
          </div>
          <div class="form-group">
            <div class="doc-item">
              <span class="doc-label">Vehicle Insurance</span>
              <?php if (!empty($deliverymanProfile['vehicle_insurance'])): ?>
                <a href="<?php echo htmlspecialchars($deliverymanProfile['vehicle_insurance']); ?>" class="doc-link" target="_blank">
                  <i class="fas fa-download"></i> View
                </a>
              <?php else: ?>
                <span class="doc-missing">Not Uploaded</span>
              <?php endif; ?>
            </div>
          </div>
          <div class="form-group">
            <div class="doc-item">
              <span class="doc-label">Driving License</span>
              <?php if (!empty($deliverymanProfile['driving_license'])): ?>
                <a href="<?php echo htmlspecialchars($deliverymanProfile['driving_license']); ?>" class="doc-link" target="_blank">
                  <i class="fas fa-download"></i> View
                </a>
              <?php else: ?>
                <span class="doc-missing">Not Uploaded</span>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>


      <div style="display: flex; gap: 15px;">
        <a href="?controller=deliveryman&action=dashboard/editProfile" class="btn1">Edit Profile</a>
        <a href="?controller=deliveryman&action=dashboard/deleteProfile" class="btn1" style="background: #b91c1c;" onclick="return confirm('Deactivate this deliveryman profile?');">Deactivate Profile</a>
      </div>
    </div>
  </div>
</body>

</html>
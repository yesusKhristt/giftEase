<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" type="image/png" href="resources/1.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Delivery Partner Dashboard - GiftEase</title>
  <link rel="stylesheet" href="public/backup/style.css">
  <link rel="stylesheet" href="public/sideTopBar.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>


  <?php
  $activePage = 'profile';
  include 'views/commonElements/leftSidebarChathu.php';

  $adminProfile = $adminProfile ?? [];
  $profileStats = $profileStats ?? [];
  $fullName = trim((string)(($adminProfile['first_name'] ?? '') . ' ' . ($adminProfile['last_name'] ?? '')));
  $displayName = $fullName !== '' ? $fullName : 'Admin';
  $profileImage = trim((string)($adminProfile['image_loc'] ?? ''));
  $createdAt = !empty($adminProfile['created_at']) ? date('M Y', strtotime((string)$adminProfile['created_at'])) : 'N/A';
  ?>
  <div class="main-content">
    <div class="page-header">
      <h1 class="title">Admin Profile</h1>
      <p class="subtitle">Manage your personal account information</p>
    </div>

    <div class="cardColour">

      <div class="profile-section">
        <a href="?controller=admin&action=dashboard/updateProfilePicture">
          <?php if ($profileImage !== ''): ?>
            <img src="<?php echo htmlspecialchars($profileImage); ?>" class="profile-picture" alt="Admin profile picture" style="object-fit: cover;">
          <?php else: ?>
            <div class="profile-picture" style="display:flex;align-items:center;justify-content:center;font-weight:700;">
              <?php echo htmlspecialchars(strtoupper(substr($displayName, 0, 2))); ?>
            </div>
          <?php endif; ?>
        </a>
        <div class="">
          <h4><?php echo htmlspecialchars($displayName); ?></h4>
          <p><?php echo htmlspecialchars($adminProfile['designation'] ?? 'Administrator'); ?> • Member since <?php echo htmlspecialchars($createdAt); ?></p>

        </div>
      </div>

      <div class="summary-grid">
        <div class="card">
          <div class="title"><?php echo htmlspecialchars((string)($profileStats['total_admins'] ?? 0)); ?></div>
          <div class="subtitle">Admins</div>
        </div>
        <div class="card">
          <div class="title"><?php echo htmlspecialchars((string)($profileStats['total_vendors'] ?? 0)); ?></div>
          <div class="subtitle">Vendors</div>
        </div>
        <div class="card">
          <div class="title"><?php echo htmlspecialchars((string)($profileStats['total_delivery'] ?? 0)); ?></div>
          <div class="subtitle">Delivery Partners</div>
        </div>
        <div class="card">
          <div class="title"><?php echo htmlspecialchars((string)($profileStats['total_deliveryman'] ?? 0)); ?></div>
          <div class="subtitle">Deliverymen</div>
        </div>
      </div>
    </div>

    <div class="card">
      <h4>Personal Information</h4>
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <div class="form-group">
          <label class="subtitle">Full Name</label>
          <input type="text" class="form-input" value="<?php echo htmlspecialchars($displayName); ?>" readonly />
        </div>
        <div class="form-group">
          <label class="subtitle">Email</label>
          <input type="email" class="form-input" value="<?php echo htmlspecialchars($adminProfile['email'] ?? ''); ?>" readonly />
        </div>
        <div class="form-group">
          <label class="subtitle">Phone</label>
          <input type="tel" class="form-input" value="<?php echo htmlspecialchars($adminProfile['phone'] ?? ''); ?>" readonly />
        </div>
        <div class="form-group">
          <label class="subtitle">Designation</label>
          <input type="text" class="form-input" value="<?php echo htmlspecialchars($adminProfile['designation'] ?? ''); ?>" readonly />
        </div>
      </div>
    </div>

    <div class="card">
      <h4>Work Information</h4>
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        <div class="form-group">
          <label class="subtitle">Address</label>
          <input type="text" class="form-input" value="<?php echo htmlspecialchars($adminProfile['address'] ?? ''); ?>" readonly />
        </div>
        <div class="form-group">
          <label class="subtitle">Status</label>
          <input type="text" class="form-input" value="<?php echo htmlspecialchars($adminProfile['status'] ?? 'active'); ?>" readonly />
        </div>
        <div class="form-group">
          <label class="subtitle">Gift Wrappers</label>
          <input type="text" class="form-input" value="<?php echo htmlspecialchars((string)($profileStats['total_gift_wrappers'] ?? 0)); ?>" readonly />
        </div>
        <div class="form-group">
          <label class="subtitle">Clients</label>
          <input type="text" class="form-input" value="<?php echo htmlspecialchars((string)($profileStats['total_clients'] ?? 0)); ?>" readonly />
        </div>
      </div>
    </div>

    <div style="display: flex; gap: 15px;">
      <a href="?controller=admin&action=dashboard/editProfile" class="btn1">Update Profile</a>
      
    </div>
  </div>

  <script src="public/main.js"></script>
</body>

</html>
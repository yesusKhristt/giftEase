<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wrapping Partner Dashboard - GiftEase</title>
  <link rel="stylesheet" href="public/style.css" />
  <link rel="profile" href="profile.php" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
</head>

<body>

  <div class="container">
    <?php
    $activePage = 'profile';
    include 'views\commonElements/leftSidebarJeshani.php';

    $profile = $profile ?? [];
    $fullName = trim(($profile['first_name'] ?? '') . ' ' . ($profile['last_name'] ?? ''));
    $displayName = $fullName !== '' ? $fullName : 'Gift Wrapper';
    $email = $profile['email'] ?? '';
    $phone = $profile['phone'] ?? '';
    $address = $profile['address'] ?? '';
    $years = $profile['years_of_experience'] ?? '';
    $totalWrappedCount = $totalWrappedCount ?? 0;
    $totalWrappingRevenue = $totalWrappingRevenue ?? 0;
    $successRate = $successRate ?? 0;
    $avgRating = $avgRating ?? null;
    ?>
   
    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Profile Overview</h1>
        <p class="subtitle">Manage your personal and vehicle information</p>
      </div>
      <div class="cardColour">

        <div class="profile-section">
          <i class="profile-picture"></i>
          <div class="">
            <h4><?= htmlspecialchars($displayName) ?></h4>
            <p>Professional Gift Wrapping Service</p>
            <p><i class="fas fa-star"></i>
              <?= htmlspecialchars($avgRating !== null ? number_format((float) $avgRating, 1) : 'N/A') ?> Rating •
              <i class="fas fa-gift"></i> <?= htmlspecialchars($years !== '' ? $years . ' years experience' : 'Professional Gift Wrapper') ?>
            </p>

          </div>
        </div>

        <div class="summary-grid">
          <div class="card">
            <div class="title"><?= htmlspecialchars($totalWrappedCount) ?></div>
            <div class="subtitle">Total Gift Wrappings</div>
          </div>
          <div class="card">
            <div class="title">Rs<?= htmlspecialchars(number_format((float) $totalWrappingRevenue, 2)) ?></div>
            <div class="subtitle">Total Earnings</div>
          </div>
          <div class="card">
            <div class="title"><?= htmlspecialchars(number_format((float) $successRate, 1)) ?>%</div>
            <div class="subtitle">Success Rate</div>
          </div>
          <div class="card">
            <div class="title"><?= htmlspecialchars($avgRating !== null ? number_format((float) $avgRating, 1) : 'N/A') ?></div>
            <div class="subtitle">Avg Rating</div>
          </div>
        </div>
      </div>

      <div class="card">
        <h4>Business Information</h4>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
          <div class="form-group">
            <label class="subtitle">Business Name</label>
            <input type="text" class="form-input" value="<?= htmlspecialchars($displayName) ?>" readonly />
          </div>
          <div class="form-group">
            <label class="subtitle">Email Address</label>
            <input type="email" class="form-input" value="<?= htmlspecialchars($email) ?>" readonly />
          </div>
          <div class="form-group">
            <label class="subtitle">Phone Number</label>
            <input type="tel" class="form-input" value="<?= htmlspecialchars($phone) ?>" readonly />
          </div>
          <div class="form-group">
            <label class="subtitle">Business Address</label>
            <input type="address" class="form-input" value="<?= htmlspecialchars($address) ?>" readonly />
          </div>
        </div>
      </div>
      <div style="display: flex; gap: 15px;">
        <button class="btn1" onclick="updateProfile()">Update Profile</button>
        <button class="btn1" onclick="changePassword()">Change Password</button>
      </div>

    </div>
  </div>
  </div>

  <script src="script.js"></script>
</body>

</html>
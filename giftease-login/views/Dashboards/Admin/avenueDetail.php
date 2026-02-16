<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Avenue - GiftEase</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="icon" type="image/png" href="resources/1.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  <div class="container">
    <?php
    $activePage = 'avenue';
    include 'views/commonElements/leftSidebarChathu.php';

    $detail = $detail ?? [];
    $stats = $stats ?? [];
    $fullName = trim(($detail['first_name'] ?? '') . ' ' . ($detail['last_name'] ?? ''));
    $memberSince = !empty($detail['created_at']) ? date('M d, Y', strtotime($detail['created_at'])) : 'N/A';
    $verifiedLabel = ((int) ($detail['verified'] ?? 0)) === 1 ? 'Verified' : 'Not Verified';
    $statusLabel = $detail['status'] ?? 'inactive';
    ?>

    <div class="main-content">
      <div class="page-header">
        <div class="detail-header">
          <div>
            <h1 class="title"><?= htmlspecialchars($pageTitle ?? 'Details') ?></h1>
            <p class="subtitle">Full registration and earnings details</p>
          </div>
          <div class="detail-badges">
            <span class="status-pill <?= $statusLabel === 'active' ? 'status-active' : 'status-inactive' ?>">
              <?= htmlspecialchars(ucfirst($statusLabel)) ?>
            </span>
            <span class="status-pill <?= $verifiedLabel === 'Verified' ? 'status-active' : 'status-inactive' ?>">
              <?= htmlspecialchars($verifiedLabel) ?>
            </span>
          </div>
        </div>
      </div>

      <div class="summary-grid">
        <div class="card">
          <div class="title"><?= htmlspecialchars($fullName !== '' ? $fullName : 'N/A') ?></div>
          <div class="subtitle">Name</div>
        </div>
        <div class="card">
          <div class="title wrap-text"><?= htmlspecialchars($detail['email'] ?? 'N/A') ?></div>
          <div class="subtitle">Email</div>
        </div>
        <div class="card">
          <div class="title"><?= htmlspecialchars($detail['phone'] ?? 'N/A') ?></div>
          <div class="subtitle">Phone</div>
        </div>
        <div class="card">
          <div class="title"><?= htmlspecialchars($memberSince) ?></div>
          <div class="subtitle">Registered On</div>
        </div>
      </div>

      <div class="card">
        <h4>Profile Information</h4>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
          <div class="form-group">
            <label class="subtitle">Address</label>
            <input type="text" class="form-input" value="<?= htmlspecialchars($detail['address'] ?? 'N/A') ?>" readonly />
          </div>
          <?php if ($type === 'vendor') : ?>
            <div class="form-group">
              <label class="subtitle">Shop Name</label>
              <input type="text" class="form-input" value="<?= htmlspecialchars($detail['shopName'] ?? 'N/A') ?>" readonly />
            </div>
          <?php endif; ?>
          <?php if ($type === 'delivery' || $type === 'deliveryman') : ?>
            <div class="form-group">
              <label class="subtitle">Vehicle Type</label>
              <input type="text" class="form-input" value="<?= htmlspecialchars($detail['vehicleType'] ?? 'N/A') ?>" readonly />
            </div>
            <div class="form-group">
              <label class="subtitle">Vehicle Plate</label>
              <input type="text" class="form-input" value="<?= htmlspecialchars($detail['vehiclePlate'] ?? 'N/A') ?>" readonly />
            </div>
          <?php endif; ?>
          <?php if ($type === 'giftWrapper') : ?>
            <div class="form-group">
              <label class="subtitle">Years of Experience</label>
              <input type="text" class="form-input" value="<?= htmlspecialchars($detail['years_of_experience'] ?? 'N/A') ?>" readonly />
            </div>
          <?php endif; ?>
        </div>
      </div>

      <div class="card">
        <h4>Performance Summary</h4>
        <div class="summary-grid">
          <div class="card">
            <div class="title">Rs<?= htmlspecialchars(number_format((float) ($stats['earnings'] ?? 0), 2)) ?></div>
            <div class="subtitle">Total Earnings</div>
          </div>
          <div class="card">
            <div class="title">Rs<?= htmlspecialchars(number_format((float) ($stats['monthlyEarnings'] ?? 0), 2)) ?></div>
            <div class="subtitle">Monthly Salary (Current Month)</div>
          </div>
          <?php if ($type === 'vendor') : ?>
            <a class="card" href="?controller=admin&action=dashboard/avenue/vendorSoldItems/<?= htmlspecialchars($detail['id'] ?? '') ?>">
              <div class="title"><?= htmlspecialchars($stats['totalSold'] ?? 0) ?></div>
              <div class="subtitle">Items Sold (click to view)</div>
            </a>
            <a class="card" href="?controller=admin&action=dashboard/avenue/vendorProducts/<?= htmlspecialchars($detail['id'] ?? '') ?>">
              <div class="title"><?= htmlspecialchars($stats['productCount'] ?? 0) ?></div>
              <div class="subtitle">Total Products (click to view)</div>
            </a>
            <div class="card">
              <div class="title"><?= htmlspecialchars(number_format((float) ($detail['rating'] ?? 0), 1)) ?></div>
              <div class="subtitle">Rating (<?= htmlspecialchars($detail['rating_count'] ?? 0) ?>)</div>
            </div>
          <?php else : ?>
            <?php if ($type === 'delivery') : ?>
              <a class="card" href="?controller=admin&action=dashboard/avenue/deliveryCompleted/<?= htmlspecialchars($detail['id'] ?? '') ?>">
                <div class="title"><?= htmlspecialchars($stats['completed'] ?? 0) ?></div>
                <div class="subtitle">Completed Orders (click to view)</div>
              </a>
            <?php elseif ($type === 'giftWrapper') : ?>
              <a class="card" href="?controller=admin&action=dashboard/avenue/giftWrapperCompleted/<?= htmlspecialchars($detail['id'] ?? '') ?>">
                <div class="title"><?= htmlspecialchars($stats['completed'] ?? 0) ?></div>
                <div class="subtitle">Completed Orders (click to view)</div>
              </a>
            <?php elseif ($type === 'deliveryman') : ?>
              <a class="card" href="?controller=admin&action=dashboard/avenue/deliverymanCompleted/<?= htmlspecialchars($detail['id'] ?? '') ?>">
                <div class="title"><?= htmlspecialchars($stats['completed'] ?? 0) ?></div>
                <div class="subtitle">Completed Orders (click to view)</div>
              </a>
            <?php else : ?>
              <div class="card">
                <div class="title"><?= htmlspecialchars($stats['completed'] ?? 0) ?></div>
                <div class="subtitle">Completed Orders</div>
              </div>
            <?php endif; ?>
          <?php endif; ?>
        
      </div>

      <div class="button-section">
        <a href="?controller=admin&action=dashboard/avenue" class="btn1"><i class="fas fa-arrow-left"></i>Back to Avenue</a>
      </div>
    </div>
  </div>

</body>

</html>

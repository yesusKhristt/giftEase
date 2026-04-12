<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Delivery Partner Dashboard - GiftEase</title>
  <link rel="stylesheet" href="public/deliverystyle.css" />
  <link rel="icon" type="image/png" href="resources/1.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="profile" href="profile.php" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dkmvuFiYMuEv20&libraries=geometry,places"
    async defer></script>
</head>

<body>
  <?php
  $destination = trim($_GET['destination'] ?? '');
  $orderRef = trim((string) ($_GET['order'] ?? ''));
  $embeddedMapSrc = $destination !== ''
    ? 'https://maps.google.com/maps?output=embed&daddr=' . rawurlencode($destination)
    : 'https://maps.google.com/maps?q=Colombo&t=&z=13&ie=UTF8&iwloc=&output=embed';
  $navigationUrl = $destination !== ''
    ? 'https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode($destination) . '&travelmode=driving&dir_action=navigate'
    : '';
  ?>
  <div class="container">
    <?php
    $activePage = 'map';
    include 'views\commonElements/leftSidebarSaneth.php';
    ?>
    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Route Map</h1>
        <p class="subtitle">View your optimized delivery route and track your progress in real-time.</p>
      </div>

      <?php if ($destination !== ''): ?>
        <div class="card">
          <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 16px; flex-wrap: wrap; margin-bottom: 16px;">
            <div>
              <div class="subtitle">Order: DEL-<?= htmlspecialchars($orderRef) ?></div>
              <div style="font-size: 0.9rem; color: #666; margin-top: 4px;">
                Destination: <?= htmlspecialchars($destination) ?>
              </div>
            </div>

            <a class="btn1" style="display: inline-flex; width: auto; margin: 0; white-space: nowrap;" target="_blank" rel="noopener noreferrer" href="<?= htmlspecialchars($navigationUrl) ?>">
              <i class="fas fa-route"></i>
              Start Navigation
            </a>
          </div>

          <iframe src="<?= htmlspecialchars($embeddedMapSrc) ?>" width="100%" height="400"
            frameborder="0" style="border:0; margin:0; padding:0;" allowfullscreen>
          </iframe>
        </div>
      <?php else: ?>
        <div class="card">
          <iframe src="<?= htmlspecialchars($embeddedMapSrc) ?>" width="100%" height="400"
            frameborder="0" style="border:0; margin:0; padding:0;" allowfullscreen>
          </iframe>
        </div>
      <?php endif; ?>
        <script src="main.js"></script>
</body>
</html>
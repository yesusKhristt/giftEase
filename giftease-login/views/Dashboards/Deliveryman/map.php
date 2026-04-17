<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Shop Location Map - GiftEase</title>
  <link rel="stylesheet" href="public/deliverystyle.css">
  <link rel="stylesheet" href="public/sideTopBar.css" />
  <link rel="icon" type="image/png" href="resources/1.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dkmvuFiYMuEv20&libraries=geometry,places"
    async defer></script>
</head>

<body>
  <?php
  $shopLocation = trim($_GET['destination'] ?? '');
  $taskRef = trim((string) ($_GET['task'] ?? ''));
  $embeddedMapSrc = $shopLocation !== ''
    ? 'https://maps.google.com/maps?output=embed&q=' . rawurlencode($shopLocation)
    : 'https://maps.google.com/maps?q=Colombo&t=&z=13&ie=UTF8&iwloc=&output=embed';
  $navigationUrl = $shopLocation !== ''
    ? 'https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode($shopLocation) . '&travelmode=driving&dir_action=navigate'
    : '';
  ?>
  <div class="container">
    <?php
    $activePage = 'map';
    include 'views/commonElements/leftSidebarDeliveryman.php';
    ?>
    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Shop Location Map</h1>
        <p class="subtitle">Navigate to the shop for pickup</p>
      </div>

      <?php if ($shopLocation !== ''): ?>
        <div class="card">
          <div style="display: flex; justify-content: space-between; align-items: flex-start; gap: 16px; flex-wrap: wrap; margin-bottom: 16px;">
            <div>
              <div class="subtitle">Task: PK-<?= htmlspecialchars($taskRef) ?></div>
              <div style="font-size: 0.9rem; color: #666; margin-top: 4px;">
                Location: <?= htmlspecialchars($shopLocation) ?>
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
          <p style="text-align: center; color: #888;">No shop location provided</p>
          <iframe src="<?= htmlspecialchars($embeddedMapSrc) ?>" width="100%" height="400"
            frameborder="0" style="border:0; margin:0; padding:0;" allowfullscreen>
          </iframe>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <script src="main.js"></script>
</body>

</html>
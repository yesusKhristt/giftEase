<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Delivery Man Dashboard - GiftEase</title>
  <link rel="stylesheet" href="public/deliverystyle.css">
  <link rel="icon" type="image/png" href="resources/1.png">
</head>
<body>
  <div class="container">
    <?php
      $activePage = 'home';
      include 'views/commonElements/leftSidebarDeliveryman.php';
    ?>

    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Delivery Man Home</h1>
        <p class="subtitle">Pickup operations from shops to outlet</p>
      </div>

      <div class="summary-grid" style="margin-bottom: 16px;">
        <div class="card">
          <div class="subtitle">Available Tasks</div>
          <div class="title"><?= (int)($dashboardStats['available_total'] ?? 0) ?></div>
        </div>
        <div class="card">
          <div class="subtitle">My Active Tasks</div>
          <div class="title"><?= (int)($dashboardStats['my_active_total'] ?? 0) ?></div>
        </div>
        <div class="card">
          <div class="subtitle">Picked Up</div>
          <div class="title"><?= (int)($dashboardStats['picked_up_total'] ?? 0) ?></div>
        </div>
        <div class="card">
          <div class="subtitle">Completed</div>
          <div class="title"><?= (int)($dashboardStats['my_completed_total'] ?? 0) ?></div>
        </div>
      </div>

      <div class="card">
        <h4 style="margin-bottom: 10px;">Quick Navigation</h4>
        <div class="summary-grid">
          <a class="btn1" href="?controller=deliveryman&action=dashboard/available">Go To Available Tasks</a>
          <a class="btn1" href="?controller=deliveryman&action=dashboard/myTasks">Go To My Tasks</a>
          <a class="btn1" href="?controller=deliveryman&action=dashboard/history">Go To History</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>


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
    ?>

    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Avenue</h1>
        <p class="subtitle">Select a stakeholder to view earnings and details</p>
      </div>

      <div class="summary-grid">
        <a class="card" href="?controller=admin&action=dashboard/avenue/vendors">
          <h4>Vendors</h4>
          <div class="subtitle">All registered vendors</div>
        </a>
        <a class="card" href="?controller=admin&action=dashboard/avenue/delivery">
          <h4>Deliveries</h4>
          <div class="subtitle">All delivery partners</div>
        </a>
        <a class="card" href="?controller=admin&action=dashboard/avenue/deliveryman">
          <h4>Deliverymen</h4>
          <div class="subtitle">All deliverymen</div>
        </a>
        <a class="card" href="?controller=admin&action=dashboard/avenue/giftWrappers">
          <h4>Gift Wrappers</h4>
          <div class="subtitle">All gift wrappers</div>
        </a>
        <a class="card" href="?controller=admin&action=dashboard/salary">
          <h4>Monthly Salary</h4>
          <div class="subtitle">All stakeholders with salary</div>
        </a>
      </div>
    </div>
  </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Delivery Partner Dashboard - GiftEase</title>
  <link rel="stylesheet" href="public/style.css" />
  <link rel="profile" href="profile.php" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dkmvuFiYMuEv20&libraries=geometry,places"
    async defer></script>
</head>

<body>

  <div class="container">
    <?php
    $activePage = 'assignedOrder';
    include 'views\commonElements/leftSidebarJeshani.php';
    ?>

    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Order Details</h1>
        <p class="subtitle">Monitor your orders</p>
      </div> 
       
        <div class="card">
            <div class="title">WRP-<?= htmlspecialchars($customwrap['id'] ?? '') ?></div> 
            <?php if (!empty($customwrap['boxName'])): ?>
        <div class="subtitle">
            Box: <?= htmlspecialchars($customwrap['boxName']) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($customwrap['bagName'])): ?>
        <div class="subtitle">
            Bag: <?= htmlspecialchars($customwrap['bagName']) ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($customwrap['cardName'])): ?>
        <div class="subtitle">
             Card: <?= htmlspecialchars($customwrap['cardName']) ?>
            </div>
    <?php endif; ?>

    <?php if (!empty($customwrap['softToyName'])): ?>
        <div class="subtitle">  
                Soft Toy: <?= htmlspecialchars($customwrap['softToyName']) ?>
            </div>
    <?php endif; ?>

    <?php if (!empty($customwrap['chocolateName'])): ?>
        <div class="subtitle">  
                    Chocolate: <?= htmlspecialchars($customwrap['chocolateName']) ?>
            </div>
    <?php endif; ?>

    <?php if (!empty($customwrap['boxDecoName'])) ?>
        <div class="subtitle">
                Box Deco: <?= htmlspecialchars($customwrap['boxDecoName']) ?>
        </div>
   <?php endif; ?>

    <?php if (!empty($customwrap['bagDecoName'])): ?>
        <div class="subtitle">  
                   Bag Deco: <?= htmlspecialchars($customwrap['bagDecoName']) ?><br>
            </div>
    <?php endif; ?>

              </div>
            </div>
          </div>

</body>

</html>
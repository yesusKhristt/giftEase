<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vendor Products - GiftEase</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  
    <?php
    $activePage = 'avenue';
    include 'views/commonElements/leftSidebarChathu.php';

    $vendor = $vendor ?? [];
    $products = $products ?? [];
    $vendorName = trim(($vendor['first_name'] ?? '') . ' ' . ($vendor['last_name'] ?? ''));
    ?>

    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Vendor Products</h1>
        <p class="subtitle"><?= htmlspecialchars($vendorName !== '' ? $vendorName : 'Vendor') ?> - Product List</p>
      </div>

      <div class="card">
        <div class="inventory-grid">
          <?php if (empty($products)) : ?>
            <div class="inventory-item">
              <div class="item-content">
                <h3 class="item-name">No products found</h3>
                <p class="subtitle">This vendor has no products yet.</p>
              </div>
            </div>
          <?php else : ?>
            <?php foreach ($products as $product) : ?>
              <?php
                $rawImage = $product['displayImage'] ?? '';
                $imagePath = str_replace('\\', '/', $rawImage);
                $resourcesPos = strpos($imagePath, 'resources/');
                if ($resourcesPos !== false) {
                  $imagePath = substr($imagePath, $resourcesPos);
                }
                $imagePath = ltrim($imagePath, '/');
                if ($imagePath !== '' && strpos($imagePath, '/') === false) {
                  $imagePath = 'resources/uploads/vendor/products/' . $imagePath;
                }
                if ($imagePath === '') {
                  $imagePath = 'resources/cards.jpg';
                }
              ?>
              <div class="inventory-item">
                <img src="<?= htmlspecialchars($imagePath) ?>" class="item-image" alt="Product image">
                <div class="item-content">
                  <div class="item-header">
                    <div>
                      <h3 class="item-name"><?= htmlspecialchars($product['name'] ?? 'Product') ?></h3>
                      <p class="subtitle">Status: <?= htmlspecialchars($product['status'] ?? 'N/A') ?></p>
                    </div>
                  </div>
                  <div class="item-details">
                    <div class="detail-item">
                      <span class="detail-label">Price</span>
                      <span class="detail-value">Rs<?= htmlspecialchars(number_format((float) ($product['price'] ?? 0), 2)) ?></span>
                    </div>
                    <div class="detail-item">
                      <span class="detail-label">Product ID</span>
                      <span class="detail-value">#<?= htmlspecialchars($product['id'] ?? '') ?></span>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>

      <div class="button-section">
        <a href="?controller=admin&action=dashboard/avenue/vendor/<?= htmlspecialchars($vendor['id'] ?? '') ?>" class="btn1"><i class="fas fa-arrow-left"></i>Back to Vendor</a>
      </div>
    </div>
  
</body>

</html>

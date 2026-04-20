<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="icon" type="image/png" href="resources/1.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Item Details - GiftEase</title>
  <link rel="stylesheet" href="public/backup/style.css">
  <link rel="stylesheet" href="public/sideTopBar.css" />
  <link rel="icon" type="image/png" href="resources/1.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <style>
    .image-scroll {
      display: flex;
      overflow-x: auto;
      gap: 12px;
      scroll-behavior: smooth;
      width: 100%;
      padding-bottom: 8px;
    }

    .image-item {
      flex: 0 0 auto;
      width: 320px;
      height: 240px;
      border-radius: 10px;
      overflow: hidden;
      background: #f5f5f5;
    }

    .image-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .detail-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 16px;
      margin-top: 20px;
    }

    .detail-box {
      padding: 16px;
      border: 1px solid #eee;
      border-radius: 12px;
      background: #fff;
    }

    .detail-label {
      display: block;
      font-size: 12px;
      color: #777;
      margin-bottom: 6px;
      text-transform: uppercase;
      letter-spacing: 0.04em;
    }
  </style>
</head>

<body>
  <?php
  $activePage = 'items';
  include 'views/commonElements/leftSidebarChathu.php';

  $product = $productDetails ?? [];
  $images = $product['images'] ?? [];
  $imageBase = 'resources/uploads/vendor/products/';
  ?>

  <div class="main-content">
    <div class="page-header">
      <h1 class="title"><?php echo htmlspecialchars($product['name'] ?? 'Item Details'); ?></h1>
      <p class="subtitle">Product ID #<?php echo htmlspecialchars($product['id'] ?? 'N/A'); ?></p>
    </div>

    <div class="card">
      <div class="image-scroll">
        <?php if (empty($images)) : ?>
          <div class="image-item" style="display:flex;align-items:center;justify-content:center;color:#999;">
            No images available
          </div>
        <?php else : ?>
          <?php foreach ($images as $image) : ?>
            <?php
            $fileName = $image['image_loc'] ?? '';
            $imagePath = $imageBase . $fileName;
            ?>
            <div class="image-item">
              <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($product['name'] ?? 'Product image'); ?>">
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>

      <div class="detail-grid">
        <div class="detail-box">
          <span class="detail-label">Price</span>
          <div class="title">Rs.<?php echo htmlspecialchars(number_format((float) ($product['price'] ?? 0), 2)); ?></div>
        </div>
        <div class="detail-box">
          <span class="detail-label">Shop</span>
          <div class="title"><?php echo htmlspecialchars($product['shop'] ?? 'N/A'); ?></div>
        </div>
        <div class="detail-box">
          <span class="detail-label">Phone</span>
          <div class="title"><?php echo htmlspecialchars($product['phone'] ?? 'N/A'); ?></div>
        </div>
        <div class="detail-box">
          <span class="detail-label">Vendor Rating</span>
          <div class="title"><?php echo htmlspecialchars((string) ($product['vendorRating'] ?? 0)); ?></div>
        </div>
        <div class="detail-box">
          <span class="detail-label">Stock</span>
          <div class="title"><?php echo htmlspecialchars((string) ($product['totalStock'] ?? 0)); ?></div>
        </div>
        <div class="detail-box">
          <span class="detail-label">Reserved Stock</span>
          <div class="title"><?php echo htmlspecialchars((string) ($product['reservedStock'] ?? 0)); ?></div>
        </div>
        <div class="detail-box">
          <span class="detail-label">Category</span>
          <div class="title"><?php echo htmlspecialchars((string) ($product['category'] ?? 'N/A')); ?></div>
        </div>
        <div class="detail-box">
          <span class="detail-label">Subcategory</span>
          <div class="title"><?php echo htmlspecialchars((string) ($product['subcategory'] ?? 'N/A')); ?></div>
        </div>
        <div class="detail-box">
          <span class="detail-label">Sold</span>
          <div class="title"><?php echo htmlspecialchars((string) ($product['sold'] ?? 0)); ?></div>
        </div>
        <div class="detail-box">
          <span class="detail-label">Clicks</span>
          <div class="title"><?php echo htmlspecialchars((string) ($product['clicks'] ?? 0)); ?></div>
        </div>
        <div class="detail-box">
          <span class="detail-label">Impressions</span>
          <div class="title"><?php echo htmlspecialchars((string) ($product['impressions'] ?? 0)); ?></div>
        </div>
        <div class="detail-box">
          <span class="detail-label">Status</span>
          <div class="title"><?php echo htmlspecialchars(ucfirst($product['status'] ?? 'N/A')); ?></div>
        </div>
      </div>

      <div class="card" style="margin-top: 20px;">
        <h4>Description</h4>
        <p style="white-space: pre-wrap; margin: 0; color: #555; line-height: 1.7;">
          <?php echo htmlspecialchars($product['description'] ?? 'No description available.'); ?>
        </p>
      </div>

      <div style="margin-top: 20px;">
        <a class="btn1" href="?controller=admin&action=dashboard/items"><i class="fas fa-arrow-left"></i> Back to Items</a>
      </div>
    </div>
  </div>
</body>

</html>
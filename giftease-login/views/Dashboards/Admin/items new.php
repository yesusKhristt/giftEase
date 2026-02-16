<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Products</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="icon" type="image/png" href="resources/1.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  <div class="container">
    <?php
    $activePage = 'items';
    include 'views/commonElements/leftSidebarChathu.php';
    ?>
    <div class="main-content">
      <section id="items" class="page active" aria-labelledby="items-title">
        <div class="page-header">
          <h1 class="title">Products</h1>
          <p class="subtitle">All products in system</p>
        </div>

        <!-- Search Bar -->
        <div style="margin: 20px 0; display: flex; gap: 10px; align-items: center;">
            <form id="searchForm" method="GET" style="display: flex; gap: 10px; flex: 1;">
                <input type="hidden" name="controller" value="admin">
                <input type="hidden" name="action" value="dashboard/items">
                <input type="text" id="searchInput" name="search" placeholder="Search by product name or description..." value="<?php echo htmlspecialchars($search); ?>" style="flex: 1; padding: 10px; border: 1px solid #ddd; border-radius: 5px;">
                <button type="submit" style="padding: 10px 20px; background-color: #e91e63; color: white; border: none; border-radius: 5px; cursor: pointer; display: none;"><i class="fas fa-search"></i> Search</button>
                <?php if (!empty($search)): ?>
                    <a href="?controller=admin&action=dashboard/items" style="padding: 10px 15px; background-color: #999; color: white; border: none; border-radius: 5px; text-decoration: none; cursor: pointer;"><i class="fas fa-times"></i> Clear</a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Results Count -->
        <div style="margin-bottom: 15px; color: #666; font-size: 14px;">
            Showing <?php echo count($paginatedProducts); ?> of <?php echo $totalItems; ?> products
        </div>

        <script>
            document.getElementById('searchInput').addEventListener('input', function(e) {
                clearTimeout(window.searchTimeout);
                window.searchTimeout = setTimeout(function() {
                    document.getElementById('searchForm').submit();
                }, 300);
            });
        </script>

        <!-- Products Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 20px; margin-top: 20px;">
            <?php if (empty($paginatedProducts)): ?>
              <div style="grid-column: 1/-1; text-align: center; padding: 40px; color: #999;">
                <i class="fas fa-box-open" style="font-size: 48px; margin-bottom: 10px; display: block;"></i>
                No products found
              </div>
            <?php else: ?>
              <?php foreach ($paginatedProducts as $product): ?>
              <div style="background: white; border-radius: 10px; overflow: hidden; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: transform 0.3s ease, box-shadow 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.15)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)';">
                
                <!-- Product Image -->
                <div style="height: 200px; background: #f5f5f5; display: flex; align-items: center; justify-content: center; overflow: hidden;">
                  <?php 
                    $fileName = $product['displayImage'];
                    // Images are stored in resources/uploads/vendor/products/
                    $imagePath = 'resources/uploads/vendor/products/' . $fileName;
                    $imageExists = !empty($fileName) && file_exists($imagePath);
                  ?>
                  <?php if ($imageExists): ?>
                    <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                  <?php else: ?>
                    <div style="text-align: center; color: #ccc;">
                      <i class="fas fa-image" style="font-size: 48px; display: block; margin-bottom: 10px;"></i>
                      <span>No Image</span>
                    </div>
                  <?php endif; ?>
                </div>

                <!-- Product Info -->
                <div style="padding: 15px;">
                  <h3 style="margin: 0 0 8px 0; font-size: 16px; color: #333; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                    <?php echo htmlspecialchars($product['name']); ?>
                  </h3>
                  
                  <p style="margin: 0 0 8px 0; font-size: 13px; color: #666; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                    <i class="fas fa-store" style="margin-right: 5px;"></i><?php echo htmlspecialchars($product['shopName'] ?? 'N/A'); ?>
                  </p>

                  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <span style="font-size: 18px; font-weight: bold; color: #e91e63;">Rs.<?php echo number_format($product['price'], 2); ?></span>
                    <span class="status-badge" style="padding: 4px 10px; font-size: 12px; background-color: <?php echo $product['status'] === 'active' ? '#4caf50' : '#ff9800'; ?>; color: white; border-radius: 4px;">
                      <?php echo ucfirst($product['status']); ?>
                    </span>
                  </div>

                  <div style="display: flex; justify-content: space-between; font-size: 13px; color: #666; margin-bottom: 10px;">
                    <div>
                      <i class="fas fa-boxes" style="margin-right: 5px; color: #e91e63;"></i>
                      <span><?php echo htmlspecialchars($product['totalStock']); ?> Stock</span>
                    </div>
                    <div>
                      <i class="fas fa-tag" style="margin-right: 5px; color: #e91e63;"></i>
                      <span>Cat: <?php echo htmlspecialchars($product['mainCategory']); ?></span>
                    </div>
                  </div>

                  <div style="border-top: 1px solid #eee; padding-top: 10px; text-align: center;">
                    <small style="color: #999;">ID: #<?php echo htmlspecialchars($product['id']); ?></small>
                  </div>
                </div>
              </div>
              <?php endforeach; ?>
            <?php endif; ?>
        </div>

   <!-- Pagination Controls -->
                <?php if ($totalPages > 1): ?>
                <div style="margin-top: 30px; display: flex; justify-content: center; gap: 10px; align-items: center; flex-wrap: wrap;">
 
                    <?php 
                    $startPage = max(1, $currentPage - 2);
                    $endPage = min($totalPages, $currentPage + 2);
                    
                    if ($startPage > 1) echo '<span style="padding: 8px 5px;">...</span>';
                    
                    for ($i = $startPage; $i <= $endPage; $i++) {
                        $isActive = $i === $currentPage;
                        $bgColor = $isActive ? '#e91e63' : '#f0f0f0';
                        $color = $isActive ? 'white' : 'black';
                        $border = $isActive ? '1px solid #e91e63' : '1px solid #ddd';
                        echo '<a href="?controller=admin&action=dashboard/items&page=' . $i . ((!empty($search) ? '&search=' . urlencode($search) : '')) . '" style="padding: 8px 12px; background-color: ' . $bgColor . '; color: ' . $color . '; border: ' . $border . '; border-radius: 4px; text-decoration: none; cursor: pointer;">' . $i . '</a>';
                    }
                    ?>  
                </div>
                <div style="text-align: center; margin-top: 15px; color: #666;">
                    Page <?php echo $currentPage; ?> of <?php echo $totalPages; ?>
                </div>
                <?php endif; ?>
      </section>
    </div>
  </div>
</body>

</html>
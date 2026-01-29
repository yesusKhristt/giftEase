<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'wishlist';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Wishlist</h1>
                <p class="subtitle">Manage your gift items in the wishlist</p>
            </div>
            <div class="inventory-grid">
                <!-- Items will be populated by JavaScript -->
                <?php foreach ($allProducts as $row): ?>
                    <div class="inventory-item">
                        <a href="?controller=client&action=dashboard/viewitem/<?= $row['id'] ?>">
                            <img src="resources/kkid_c1.jpg" class="item-image">

                            <div class="item-content">
                                <div class="item-header">
                                    <div>
                                        <h3 class="item-name"><?= htmlspecialchars($row['name']) ?></h3>
                                    </div>
                                </div>
                                <div class="item-details">
                                    <div class="detail-item">
                                        <span class="detail-label">Price</span>
                                        <span class="detail-value">Rs <?= htmlspecialchars($row['price']) ?></span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <div class="item-actions">
                            <a class="btn1 btn-outline btn-small add-to-cart" href="#" data-id="<?= $row['id'] ?>">
                                Add to cart
                            </a>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>


</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/Dilma/style.css" />
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
            <div class="card">
                <div style="display:flex; flex-wrap:wrap; gap:20px; padding: 20px;">
                    <!-- Item 1 -->
                    <div class="item-card">
                        <img src="https://i.ytimg.com/vi/FHok-UlAT-E/maxresdefault.jpg" alt="Item Image" class="item-image small">
                        <h3>Chocolate</h3>
                        <p>Price: $180</p>
                        <button class="btn1">Add to Cart</button>
                    </div>
                    <!-- Item 2 -->
                    <div class="item-card">
                        <img src="https://i.ytimg.com/vi/FHok-UlAT-E/maxresdefault.jpg" alt="Item Image" class="item-image small">
                        <h3>Chocolate</h3>
                        <p>Price: $180</p>
                        <button class="btn1">Add to Cart</button>
                    </div>
                    <!-- Item 3 -->
                    <div class="item-card">
                        <img src="https://i.ytimg.com/vi/FHok-UlAT-E/maxresdefault.jpg" alt="Item Image" class="item-image small">
                        <h3>Chocolate</h3>
                        <p>Price: $180</p>
                        <button class="btn1">Add to Cart</button>
                    </div>
                </div>      

            </div>
</body>

</html>
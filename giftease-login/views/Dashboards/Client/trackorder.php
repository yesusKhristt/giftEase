<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'tracking';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>

        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Track Order</h1>
                <p class="subtitle">View delivery route and track your order in real-time.</p>
            </div>
            <!-- <div class="card"> -->
            <!-- <div class="summary-grid"> -->
            <div class="card">
                <div class="inventory-grid">
                    <a class="inventory-item" data-status="active" id="item">
                        <img src="resources/choco.jpg" class="item-image">
                    </a>

                    <a class="inventory-item" data-status="active" id="item">
                        <img src="resources/boxandbottle.jpeg" class="item-image">
                    </a>

                    <a class="inventory-item" data-status="active" id="item">
                        <img src="resources/headphones.jpeg" class="item-image">
                    </a>

                    <a class="inventory-item" data-status="active" id="item">
                        <img src="resources/toy.jpeg" class="item-image">
                    </a>

                    <a class="inventory-item" data-status="active" id="item">
                        <img src="resources/kkid_c1.jpg" class="item-image">
                    </a>
        
                </div>

                <iframe src="https://maps.google.com/maps?q=Colombo&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%"
                    height="400" frameborder="0" style="border:0; margin:10; padding:0;" allowfullscreen class="card">
                </iframe>

                <!-- Button -->
                <div style="text-align: center; margin-bottom: 30px;">
                    <button
                        style="background: #e91e63; color: white; padding: 12px 25px; border: none; border-radius: 25px; font-size: 16px; cursor: pointer;">
                        Track Order
                    </button>
                </div>
                <!-- </div> -->


            </div>

        </div>
</body>

</html>
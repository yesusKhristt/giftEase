<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

   
        <?php
        $activePage = 'giftWrapping';
        include 'views/commonElements/leftSidebarChathu.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Customize Order</h1>
                <p class="subtitle">Personalize your products with custom options</p>

            </div>



            <div class="card">
                <div class="services-grid">
                    <a href="?controller=admin&action=dashboard/addGiftWrappingItems">
                        <div class="card">
                            <div class="service-icon">
                                <i class="fas fa-gift"></i>
                            </div>
                            <h3 class="service-title">Add gift wrapping items</h3>
                        </div>
                    </a>

                    <a href="?controller=admin&action=dashboard/editGiftWrappingItems">
                        <div class="card">
                            <div class="service-icon">
                                <i class="fas fa-ribbon"></i>
                            </div>
                            <h3 class="service-title">Edit gift wrapping items</h3>
                        </div>
                    </a>
                </div>
            </div>
            <div class="card">

                <div class="services-grid">

                    <a href="?controller=admin&action=dashboard/addGiftWrappingPackages">
                        <div class="card">
                            <div class="service-icon">
                                <i class="fas fa-gift"></i>
                            </div>
                            <h3 class="service-title">Add gift wrapping packages</h3>
                        </div>
                    </a>

                    <a href="?controller=admin&action=dashboard/editGiftWrappingPackages">
                        <div class="card">
                            <div class="service-icon">
                                <i class="fas fa-ribbon"></i>
                            </div>
                            <h3 class="service-title">Edit gift wrapping packages</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    
    </div>
    </div>

    </div>
</body>

</html>
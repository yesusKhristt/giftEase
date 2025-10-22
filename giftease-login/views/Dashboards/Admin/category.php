<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'category';
        include 'views/commonElements/leftSidebarChathu.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Add Product Categories</h1>
                <p class="subtitle">Add Product Categories for efficient searching</p>

            </div>



            <div class="card">
                <div class="services-grid">
                    <a href="?controller=admin&action=dashboard/category/add" style="text-decoration: none;">
                        <div class="card">
                            <div class="service-icon">
                                <i class="fas fa-gift"></i>
                            </div>
                            <h3 class="service-title">Add Categories</h3>
                        </div>
                    </a>

                    <a href="?controller=admin&action=dashboard/category/edit">
                        <div class="card">
                            <div class="service-icon">
                                <i class="fas fa-ribbon"></i>
                            </div>
                            <h3 class="service-title">Edit Subcategory</h3>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
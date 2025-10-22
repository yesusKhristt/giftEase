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
        $activePage = 'customize';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Customize Order</h1>
                <p class="subtitle">Personalize your products with custom options</p>

            </div>



            <div class="card">
                <div class="services-grid">
                    <a href="?controller=client&action=dashboard/custom">
                        <div class="card">
                            <div class="service-icon">
                                <i class="fas fa-gift"></i>
                            </div>
                            <h3 class="service-title">Custom Wrapping</h3>
                            <p class="service-description">
                                Any wrapping of choice catered to customer's choice.
                            </p>
                        </div>
                    </a>

                    <div class="card">
                        <div class="service-icon">
                            <i class="fas fa-ribbon"></i>
                        </div>
                        <h3 class="service-title">Custom Ribbons & Bows</h3>
                        <p class="service-description">Personalized ribbon designs with custom colors, patterns, and
                            embossed messages.</p>
                        <div class="service-price">$5 - $15</div>
                        <div style="margin-top: 16px; display: flex; gap: 8px; justify-content: center;">
                            <button class="btn btn-outline" onclick="editService('custom-ribbons')">
                                <i class="fas fa-edit"></i>
                                Edit
                            </button>
                            <button class="btn btn-ghost" onclick="viewServiceStats('custom-ribbons')">
                                <i class="fas fa-chart-line"></i>
                                Stats
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    </div>
</body>

</html>
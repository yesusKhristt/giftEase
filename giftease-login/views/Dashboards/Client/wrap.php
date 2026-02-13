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
        $activePage = 'customize';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Gift Wrapping</h1>
                <p class="subtitle">Choose how you'd like your gift wrapped</p>
            </div>

            <div class="card">
                <div class="services-grid">
                    <a href="?controller=client&action=dashboard/custom">
                        <div class="card">
                            <div class="service-icon">
                                <i class="fas fa-paint-brush"></i>
                            </div>
                            <h3 class="service-title">Custom Wrapping</h3>
                            <p class="service-description">
                                Build your own custom gift wrap — pick your box, ribbons, chocolates, cards and more.
                            </p>
                        </div>
                    </a>

                    <a href="?controller=client&action=dashboard/wrappingPackages">
                        <div class="card">
                            <div class="service-icon">
                                <i class="fas fa-box-open"></i>
                            </div>
                            <h3 class="service-title">Pre-defined Packages</h3>
                            <p class="service-description">
                                Browse ready-made gift wrapping packages curated by our team.
                            </p>
                        </div>
                    </a>
                </div>
            </div>

        </div>
    </div>

</body>

</html>
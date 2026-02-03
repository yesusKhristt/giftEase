<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="profile" href="profile.php" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dkmvuFiYMuEv20&libraries=geometry,places"
        async defer></script>
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'service';
        include 'C:\laragon\www\giftEase\giftease-login\views\commonElements/leftSidebarJeshani.php';
        ?>
        <!-- <div id="home" class="tab-content active"> -->
        <!-- Home page -->
        <div class="main-content">
            <div class="section-header">
                <div>
                    <h2 class="section-title">Service Offerings</h2>
                    <p class="section-subtitle">Manage your wrapping services and pricing</p>
                </div>
                <button class="btn btn-primary" onclick="addNewService()">
                    <i class="fas fa-plus"></i>
                    Add Service
                </button>
            </div>

            <div class="card">
                <div class="services-grid">
                    <div class="card">
                        <div class="service-icon">
                            <i class="fas fa-gift"></i>
                        </div>
                        <h3 class="service-title">Premium Gift Wrapping</h3>
                        <p class="service-description">High-quality wrapping paper with elegant ribbons and bows.
                            Perfect for special occasions and luxury gifts.</p>
                        <div class="service-price">$15 - $35</div>
                        <div style="margin-top: 16px; display: flex; gap: 8px; justify-content: center;">
                            <button class="btn btn-outline" onclick="editService('premium-wrapping')">
                                <i class="fas fa-edit"></i>
                                Edit
                            </button>
                            <button class="btn btn-ghost" onclick="viewServiceStats('premium-wrapping')">
                                <i class="fas fa-chart-line"></i>
                                Stats
                            </button>
                        </div>
                    </div>

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

                    <div class="card">
                        <div class="service-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="service-title">Handwritten Gift Cards</h3>
                        <p class="service-description">Beautiful handwritten messages on premium cardstock with
                            calligraphy options.</p>
                        <div class="service-price">$3 - $8</div>
                        <div style="margin-top: 16px; display: flex; gap: 8px; justify-content: center;">
                            <button class="btn btn-outline" onclick="editService('gift-cards')">
                                <i class="fas fa-edit"></i>
                                Edit
                            </button>
                            <button class="btn btn-ghost" onclick="viewServiceStats('gift-cards')">
                                <i class="fas fa-chart-line"></i>
                                Stats
                            </button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="service-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <h3 class="service-title">Luxury Gift Boxes</h3>
                        <p class="service-description">Premium presentation boxes in various sizes with magnetic
                            closures and tissue paper.</p>
                        <div class="service-price">$10 - $25</div>
                        <div style="margin-top: 16px; display: flex; gap: 8px; justify-content: center;">
                            <button class="btn btn-outline" onclick="editService('gift-boxes')">
                                <i class="fas fa-edit"></i>
                                Edit
                            </button>
                            <button class="btn btn-ghost" onclick="viewServiceStats('gift-boxes')">
                                <i class="fas fa-chart-line"></i>
                                Stats
                            </button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="service-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h3 class="service-title">Express Delivery</h3>
                        <p class="service-description">Same-day delivery service for urgent orders within the city
                            limits.</p>
                        <div class="service-price">$8 - $20</div>
                        <div style="margin-top: 16px; display: flex; gap: 8px; justify-content: center;">
                            <button class="btn btn-outline" onclick="editService('express-delivery')">
                                <i class="fas fa-edit"></i>
                                Edit
                            </button>
                            <button class="btn btn-ghost" onclick="viewServiceStats('express-delivery')">
                                <i class="fas fa-chart-line"></i>
                                Stats
                            </button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="service-icon">
                            <i class="fas fa-palette"></i>
                        </div>
                        <h3 class="service-title">Theme Wrapping</h3>
                        <p class="service-description">Specialized wrapping for holidays, birthdays, weddings, and
                            corporate events.</p>
                        <div class="service-price">$12 - $30</div>
                        <div style="margin-top: 16px; display: flex; gap: 8px; justify-content: center;">
                            <button class="btn btn-outline" onclick="editService('theme-wrapping')">
                                <i class="fas fa-edit"></i>
                                Edit
                            </button>
                            <button class="btn btn-ghost" onclick="viewServiceStats('theme-wrapping')">
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

    <script src="script.js"></script>
</body>

</html>
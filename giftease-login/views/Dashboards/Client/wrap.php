<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="icon" type="image/png" href="resources/1.png">
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

            
                </div>
            </div>

            
            <div class="card">
                <div class="inventory-grid">
                    <a class="inventory-item" data-status="active" id="item">
                        <img src="resources/cards.jpg" class="item-image">
                        <div class="item-content">
                            <div class="item-header">
                                <div>
                                    <h3 class="item-name">Handwritten Gift Cards</h3>
                                    <p class="gallery-description">Beautiful handwritten messages on premium cardstock
                                        with
                                        calligraphy options. </p></br>
                                    <h4> Customer rating: 4/5 stars.</h4>
                                </div>
                            </div>
                            <div class="item-details">
                                <div class="detail-item">
                                </div>
                            </div>
                        </div>
                        <a class="inventory-item" data-status="active" id="item">
                            <img src="resources/f.jpg" class="item-image">
                            <div class="item-content">
                                <div class="item-header">
                                    <div>
                                        <h3 class="item-name">furoshiki wrapping</h3>
                                        <p class="gallery-description"> a traditional Japanese wrapping technique using
                                            a square piece of fabric to bundle and carry item </p></br>
                                        <h4> Customer rating: 5/5 stars.</h4>
                                    </div>
                                </div>
                                <div class="item-details">
                                    <div class="detail-item">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="inventory-item" data-status="active" id="item">
                            <img src="resources/luxury box.jpeg" class="item-image">
                            <div class="item-content">
                                <div class="item-header">
                                    <div>
                                        <h3 class="item-name">Luxury Presentation Box</h3>
                                        <p class="gallery-description">Elegant gold foil wrapping with silk ribbon for
                                            luxury
                                            jewelry gift. </p></br>
                                        <h4> Customer rating: 5/5 stars.</h4>
                                    </div>
                                </div>
                                <div class="item-details">
                                    <div class="detail-item">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="inventory-item" data-status="active" id="item">
                            <img src="resources/paper.jpeg" class="item-image">
                            <div class="item-content">
                                <div class="item-header">
                                    <div>
                                        <h3 class="item-name">Vintage Wedding Style</h3>
                                        <p class="gallery-description">Classic brown kraft paper with natural twine and
                                            dried
                                            flowers for rustic wedding gifts. </p></br>
                                        <h4> Customer rating: 4/5 stars.</h4>
                                    </div>
                                </div>
                                <div class="item-details">
                                    <div class="detail-item">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="inventory-item" data-status="active" id="item">
                            <img src="resources/premium gold.jpeg" class="item-image">
                            <div class="item-content">
                                <div class="item-header">
                                    <div>
                                        <h3 class="item-name">Premium Gold Foil Wrap</h3>
                                        <p class="gallery-description">Elegant gold foil wrapping with silk ribbon for
                                            luxury
                                            jewelry gift. </p></br>
                                        <h4> Customer rating: 5/5 stars.</h4>
                                    </div>
                                </div>
                                <div class="item-details">
                                    <div class="detail-item">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="inventory-item" data-status="active" id="item">
                            <img src="resources/tree.jpg" class="item-image">
                            <div class="item-content">
                                <div class="item-header">
                                    <div>
                                        <h3 class="item-name">Rustic, Natural & Eco-Friendly Styles</h3>
                                        <p class="gallery-description">These styles bring the outdoors in and are
                                            perfect for a cozy, handmade feel. </p></br>
                                        <h4> Customer rating: 3/5 stars.</h4>
                                    </div>
                                </div>
                                <div class="item-details">
                                    <div class="detail-item">
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a class="inventory-item" data-status="active" id="item">
                            <img src="resources/metalic.jpg" class="item-image">
                            <div class="item-content">
                                <div class="item-header">
                                    <div>
                                        <h3 class="item-name">Metallic Gradient</h3>
                                        <p class="gallery-description"> a design that gradually transitions from gold to
                                            another metallic color, or from gold to a deep, dark color</p></br>
                                        <h4> Customer rating: 5/5 stars.</h4>
                                    </div>
                                </div>
                                <div class="item-details">
                                    <div class="detail-item">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="inventory-item" data-status="active" id="item">
                            <img src="resources/themed.jpg" class="item-image">
                            <div class="item-content">
                                <div class="item-header">
                                    <div>
                                        <h3 class="item-name">Creative & Themed Styles</h3>
                                        <p class="gallery-description">These are for when you want the wrapping to be
                                            part of the fun and tell a story. </p></br>
                                        <h4> Customer rating: 4/5 stars.</h4>
                                    </div>
                                </div>
                                <div class="item-details">
                                    <div class="detail-item">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="inventory-item" data-status="active" id="item">
                            <img src="resources/geometric.jpeg" class="item-image">
                            <div class="item-content">
                                <div class="item-header">
                                    <div>
                                        <h3 class="item-name">Modern Minimalist Design</h3>
                                        <p class="gallery-description">Clean lines and simple elegance with geometric
                                            patterns
                                            for contemporary birthday gifts. </p></br>
                                        <h4> Customer rating: 5/5 stars.</h4>
                                    </div>
                                </div>
                                <div class="item-details">
                                    <div class="detail-item">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="inventory-item" data-status="active" id="item">
                            <img src="resources/logo.jpeg" class="item-image">
                            <div class="item-content">
                                <div class="item-header">
                                    <div>
                                        <h3 class="item-name">Corporate Branded Wrapping</h3>
                                        <p class="gallery-description">Professional wrapping with company colors and
                                            logo for
                                            executive gifts and client appreciation. </p></br>
                                        <h4> Customer rating: 5/5 stars.</h4>
                                    </div>
                                </div>
                                <div class="item-details">
                                    <div class="detail-item">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="inventory-item" data-status="active" id="item">
                            <img src="resources/floral.jpg" class="item-image">
                            <div class="item-content">
                                <div class="item-header">
                                    <div>
                                        <h3 class="item-name">Floral wrapping paper</h3>
                                        <p class="gallery-description"> Elegant and timeless, available in a variety of
                                            colors and styles</p></br>
                                        <h4> Customer rating: 5/5 stars.</h4>
                                    </div>
                                </div>
                                <div class="item-details">
                                    <div class="detail-item">
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="inventory-item" data-status="active" id="item">
                            <img src="resources/rainbow.jpeg" class="item-image">
                            <div class="item-content">
                                <div class="item-header">
                                    <div>
                                        <h3 class="item-name">Vibrant Birthday Collection</h3>
                                        <p class="gallery-description">Bright and cheerful wrapping with rainbow ribbons
                                            and fun
                                            patterns perfect for children's birthday parties. </p></br>
                                        <h4> Customer rating: 5/5 stars.</h4>
                                    </div>
                                </div>
                                <div class="item-details">
                                    <div class="detail-item">
                                    </div>
                                </div>
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
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
        $activePage = 'portfolio';
        include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarJeshani.php';
        ?>
        <!-- <div id="home" class="tab-content active"> -->
        <!-- Home page -->
        <div class="main-content">
            <div class="section-header">
                <div>
                    <h2 class="section-title">Portfolio Gallery</h2>
                    <p class="section-subtitle">Showcase your best wrapping work to attract customers</p>
                </div>
                <div style="display: flex; gap: 12px;">
                    <select style="padding: 8px 12px; border: 1px solid #e0e0e0; border-radius: 6px;"
                        onchange="filterGallery(this.value)">
                        <option value="all">All Categories</option>
                        <option value="premium">Premium Wrapping</option>
                        <option value="wedding">Wedding Gifts</option>
                        <option value="birthday">Birthday Gifts</option>
                        <option value="corporate">Corporate Gifts</option>
                    </select>
                    <button class="btn1" onclick="uploadPhoto()">
                        <i class="fas fa-camera"></i>
                        Upload Photo
                    </button>
                </div>
            </div>
            

            <div class="card">
                <div class="gallery-grid">
                    <div class="gallery-item" data-category="premium">
                        <img src="resources/premium gold.jpeg"
                            alt="Premium Gold Wrapping" class="gallery-image">
                        <div class="gallery-info">
                            <h4 class="gallery-title">Premium Gold Foil Wrap</h4>
                            <p class="gallery-description">Elegant gold foil wrapping with silk ribbon for luxury
                                jewelry gift. Customer rating: 5/5 stars.</p>
                            <div
                                style="margin-top: 12px; display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.8rem; color: #666;">
                                    <i class="fas fa-heart" style="color: #e91e63;"></i> 24 likes
                                </span>
                                <div style="display: flex; gap: 8px;">
                                    <button class="btn1" style="padding: 4px 8px; font-size: 0.8rem;"
                                        onclick="editPhoto(1)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn1" style="padding: 4px 8px; font-size: 0.8rem;"
                                        onclick="deletePhoto(1)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item" data-category="wedding">
                        <img src="resources/paper.jpeg"
                            alt="Wedding Gift Wrapping" class="gallery-image">
                        <div class="gallery-info">
                            <h4 class="gallery-title">Vintage Wedding Style</h4>
                            <p class="gallery-description">Classic brown kraft paper with natural twine and dried
                                flowers for rustic wedding gifts.</p>
                            <div
                                style="margin-top: 12px; display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.8rem; color: #666;">
                                    <i class="fas fa-heart" style="color: #e91e63;"></i> 18 likes
                                </span>
                                <div style="display: flex; gap: 8px;">
                                    <button class="btn1" style="padding: 4px 8px; font-size: 0.8rem;"
                                        onclick="editPhoto(2)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn1" style="padding: 4px 8px; font-size: 0.8rem;"
                                        onclick="deletePhoto(2)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item" data-category="premium">
                        <img src="resources/luxury box.jpeg"
                            alt="Luxury Box Set" class="gallery-image">
                        <div class="gallery-info">
                            <h4 class="gallery-title">Luxury Presentation Box</h4>
                            <p class="gallery-description">Premium magnetic closure box with custom tissue paper and
                                embossed logo for corporate gifts.</p>
                            <div
                                style="margin-top: 12px; display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.8rem; color: #666;">
                                    <i class="fas fa-heart" style="color: #e91e63;"></i> 31 likes
                                </span>
                                <div style="display: flex; gap: 8px;">
                                    <button class="btn1" style="padding: 4px 8px; font-size: 0.8rem;"
                                        onclick="editPhoto(3)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn1" style="padding: 4px 8px; font-size: 0.8rem;"
                                        onclick="deletePhoto(3)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item" data-category="birthday">
                        <img src="resources/geometric.jpeg"
                            alt="Modern Minimalist" class="gallery-image">
                        <div class="gallery-info">
                            <h4 class="gallery-title">Modern Minimalist Design</h4>
                            <p class="gallery-description">Clean lines and simple elegance with geometric patterns
                                for contemporary birthday gifts.</p>
                            <div
                                style="margin-top: 12px; display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.8rem; color: #666;">
                                    <i class="fas fa-heart" style="color: #e91e63;"></i> 15 likes
                                </span>
                                <div style="display: flex; gap: 8px;">
                                    <button class="btn1" style="padding: 4px 8px; font-size: 0.8rem;"
                                        onclick="editPhoto(4)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn1" style="padding: 4px 8px; font-size: 0.8rem;"
                                        onclick="deletePhoto(4)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item" data-category="corporate">
                        <img src="resources/logo.jpeg"
                            alt="Corporate Branding" class="gallery-image">
                        <div class="gallery-info">
                            <h4 class="gallery-title">Corporate Branded Wrapping</h4>
                            <p class="gallery-description">Professional wrapping with company colors and logo for
                                executive gifts and client appreciation.</p>
                            <div
                                style="margin-top: 12px; display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.8rem; color: #666;">
                                    <i class="fas fa-heart" style="color: #e91e63;"></i> 22 likes
                                </span>
                                <div style="display: flex; gap: 8px;">
                                    <button class="btn1" style="padding: 4px 8px; font-size: 0.8rem;"
                                        onclick="editPhoto(5)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn1" style="padding: 4px 8px; font-size: 0.8rem;"
                                        onclick="deletePhoto(5)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="gallery-item" data-category="birthday">
                        <img src="resources/rainbow.jpeg"
                            alt="Colorful Birthday Wrapping" class="gallery-image">
                        <div class="gallery-info">
                            <h4 class="gallery-title">Vibrant Birthday Collection</h4>
                            <p class="gallery-description">Bright and cheerful wrapping with rainbow ribbons and fun
                                patterns perfect for children's birthday parties.</p>
                            <div
                                style="margin-top: 12px; display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 0.8rem; color: #666;">
                                    <i class="fas fa-heart" style="color: #e91e63;"></i> 27 likes
                                </span>
                                <div style="display: flex; gap: 8px;">
                                    <button class="btn1" style="padding: 4px 8px; font-size: 0.8rem;"
                                        onclick="editPhoto(6)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn1" style="padding: 4px 8px; font-size: 0.8rem;"
                                        onclick="deletePhoto(6)">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
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
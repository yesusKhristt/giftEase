<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wrapping Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="profile" href="profile.php" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<<<<<<< HEAD
    
=======

>>>>>>> d0031c03e664ab4d00db702e8d9c350956e6969c
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'portfolio';
        include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarJeshani.php';
        ?>
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
                    <!-- <button class="btn1" onclick="uploadPhoto()"> 
                        <i class="fas fa-camera"></i>
                        Upload Photo  -->
                    <button type="button" class="btn1" onclick="document.getElementById('fileInput').click()"
                        aria-label="Upload Photo">
                        <i class="fas fa-cloud-upload-alt" style="margin-right: 8px;"></i>
                        Upload Photo
                    </button>
                    <input type="file" id="fileInput" multiple accept="image/*,.pdf" style="display: none;"
                        onchange="handleFileUpload(event)" />

                </div>
            </div>

            <div class="inventory-grid">
                <a class="inventory-item" data-status="active" id="item">
                    <img src="resources/paper.jpeg" class="item-image">
                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Vintage Wedding Style</h3>
                                <p class="gallery-description">Classic brown kraft paper with natural twine and dried
                                    flowers for rustic wedding gifts. </p></br>
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
                    <img src="resources/premium gold.jpeg" class="item-image">
                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Premium Gold Foil Wrap</h3>
                                <p class="gallery-description">Elegant gold foil wrapping with silk ribbon for luxury
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
                    <img src="resources/luxury box.jpeg" class="item-image">
                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Luxury Presentation Box</h3>
                                <p class="gallery-description">Elegant gold foil wrapping with silk ribbon for luxury
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
                    <img src="resources/geometric.jpeg" class="item-image">
                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Modern Minimalist Design</h3>
                                <p class="gallery-description">Clean lines and simple elegance with geometric patterns
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
                                <p class="gallery-description">Professional wrapping with company colors and logo for
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
                    <img src="resources/rainbow.jpeg" class="item-image">
                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Vibrant Birthday Collection</h3>
                                <p class="gallery-description">Bright and cheerful wrapping with rainbow ribbons and fun
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
<<<<<<< HEAD

        <div class="inventory-grid">
            <a class="inventory-item" data-status="active" id="item">
                <img src="resources/premium gold.jpeg" class="item-image">
                <div class="item-content">
                    <div class="item-header">
                        <div>
                            <h3 class="item-name">Premium Gold Foil Wrap</h3>
                            <p class="gallery-description">Elegant gold foil wrapping with silk ribbon for luxury
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
                <img src="resources/metalic.jpg" class="item-image">
                <div class="item-content">
                    <div class="item-header">
                        <div>
                            <h3 class="item-name">Metallic Gradient</h3>
                            <p class="gallery-description">  a design that gradually transitions from gold to another metallic color, or from gold to a deep, dark color</p></br>
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
                <img src="resources/f.jpg" class="item-image">
                <div class="item-content">
                    <div class="item-header">
                        <div>
                            <h3 class="item-name">furoshiki wrapping</h3>
                            <p class="gallery-description"> a traditional Japanese wrapping technique using a square piece of fabric to bundle and carry item  </p></br>
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
                            <p class="gallery-description">Elegant gold foil wrapping with silk ribbon for luxury
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
                            <p class="gallery-description">Classic brown kraft paper with natural twine and dried
                                flowers for rustic wedding gifts. </p></br>
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
                <img src="resources/geometric.jpeg" class="item-image">
                <div class="item-content">
                    <div class="item-header">
                        <div>
                            <h3 class="item-name">Modern Minimalist Design</h3>
                            <p class="gallery-description">Clean lines and simple elegance with geometric patterns
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
                            <p class="gallery-description">Professional wrapping with company colors and logo for
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
                <img src="resources/rainbow.jpeg" class="item-image">
                <div class="item-content">
                    <div class="item-header">
                        <div>
                            <h3 class="item-name">Vibrant Birthday Collection</h3>
                            <p class="gallery-description">Bright and cheerful wrapping with rainbow ribbons and fun
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
           
             <a class="inventory-item" data-status="active" id="item">
                <img src="resources/floral.jpg" class="item-image">
                <div class="item-content">
                    <div class="item-header">
                        <div>
                            <h3 class="item-name">Floral wrapping paper</h3>
                            <p class="gallery-description">   Elegant and timeless, available in a variety of colors and styles</p></br>
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
=======
>>>>>>> d0031c03e664ab4d00db702e8d9c350956e6969c
    </div>
</body>

</html>
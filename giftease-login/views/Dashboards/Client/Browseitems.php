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
        $activePage = 'items';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Browse Items</h1>
                <p class="subtitle">Manage your gift items </p>

            </div>

            <!-- Filter Tabs -->
            <div class="filter-tabs">

                <select class="btn1" onchange="filterProducts('category', this.value)">
                    <option value="">All Categories</option>
                    <option value="electronics">Electronics</option>
                    <option value="accessories">Accessories</option>
                    <option value="computers">Computers</option>
                </select>
                <select class="btn1" onchange="filterProducts('price', this.value)">
                    <option value="">All Prices</option>
                    <option value="0-100">$0 - $100</option>
                    <option value="100-500">$100 - $500</option>
                    <option value="500+">$500+</option>
                </select>
                <select class="btn1" onchange="sortProducts(this.value)">
                    <option value="">Sort By</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                    <option value="rating">Rating</option>
                    <option value="name">Name</option>
                </select>
            </div>

            <!-- Inventory Grid -->
            <div class="inventory-grid">
                <!-- Items will be populated by JavaScript -->
                <a class="inventory-item" data-status="${item.status}" id="item"
                    href="?action=dashboard&type=client&level=viewitem">

                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTixlPtW5WdcCEXOMq8wbUJptdoi8Mk_cNqw&s"
                        class="item-image">

                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Chocolate</h3>

                            </div>

                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">$120</span>
                            </div>


                        </div>

                        <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">Discription</p>
                        <div class="item-actions">
                            <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Add to
                                cart</button>

                            <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Add to
                                wishlist</button>
                        </div>

                    </div>
                </a>
                <a class="inventory-item" data-status="${item.status}" id="item"
                    href="?action=dashboard&type=vendor&level=viewitem">

                    <img src="https://images.meesho.com/images/products/423581114/8bcfz_512.webp?width=512"
                        class="item-image">

                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Glass Rose Flower</h3>

                            </div>

                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">$200</span>
                            </div>


                        </div>

                        <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">Discription</p>

                        <div class="item-actions">
                            <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Add to
                                cart</button>

                            <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Add to
                                wishlist</button>
                        </div>
                    </div>
                </a>
                <a class="inventory-item" data-status="${item.status}" id="item"
                    href="?action=dashboard&type=vendor&level=viewitem">

                    <img src="https://m.media-amazon.com/images/I/61-DnBSho5L._UF1000,1000_QL80_.jpg"
                        class="item-image">

                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Cute Libiniah Bear Stuffed Toys</h3>

                            </div>

                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">$120</span>
                            </div>


                        </div>

                        <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">Discription</p>
                        <div class="item-actions">
                            <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Add to
                                cart</button>

                            <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Add to
                                wishlist</button>
                        </div>

                    </div>
                </a>

                <a class="inventory-item" data-status="${item.status}" id="item"
                    href="?action=dashboard&type=vendor&level=viewitem">

                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTrPIrGNpAYW5S2dqvyIS9v4ze5k3oRDVYmSg&s"
                        class="item-image">

                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Men's watches|Swiss watch</h3>

                            </div>

                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">$120</span>
                            </div>


                        </div>

                        <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">Discription</p>
                        <div class="item-actions">
                            <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Add to
                                cart</button>

                            <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Add to
                                wishlist</button>
                        </div>

                    </div>
                </a>

                <a class="inventory-item" data-status="${item.status}" id="item"
                    href="?action=dashboard&type=vendor&level=viewitem">

                    <img src="https://img.drz.lazcdn.com/static/lk/p/3013f094949c0a6664c34a01d203b134.jpg_720x720q80.jpg"
                        class="item-image">

                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">I Love you with customized name gift mug cup</h3>

                            </div>

                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">$120</span>
                            </div>


                        </div>

                        <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">Discription</p>
                        <div class="item-actions">
                            <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Add to
                                cart</button>

                            <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Add to
                                wishlist</button>
                        </div>

                    </div>
                </a>

                <a class="inventory-item" data-status="${item.status}" id="item"
                    href="?action=dashboard&type=vendor&level=viewitem">

                    <img src="https://www.trulyearthy.com/cdn/shop/products/emaarcamel_900x.jpg?v=1637651273"
                        class="item-image">

                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Home Decor Gifts</h3>

                            </div>

                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">$120</span>
                            </div>


                        </div>

                        <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">Discription</p>
                        <div class="item-actions">
                            <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Add to
                                cart</button>

                            <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Add to
                                wishlist</button>
                        </div>

                    </div>
                </a>
                <a class="inventory-item" data-status="${item.status}" id="item"
                    href="?action=dashboard&type=vendor&level=viewitem">

                    <img src="https://m.media-amazon.com/images/I/91IEKqFv4YL._UY1000_.jpg" class="item-image">

                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">84 Pairs Gold Stud Earrings Set for Women Multipack</h3>

                            </div>

                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">$120</span>
                            </div>


                        </div>

                        <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">Discription</p>
                        <div class="item-actions">
                            <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Add to
                                cart</button>

                            <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Add to
                                wishlist</button>
                        </div>

                    </div>
                </a>

                <a class="inventory-item" data-status="${item.status}" id="item"
                    href="?action=dashboard&type=vendor&level=viewitem">

                    <img src="https://hips.hearstapps.com/hmg-prod/images/mhl-polo-polo-810-2-1-685e9228d7da8.jpg?crop=0.502xw:1.00xh;0.240xw,0&resize=1200:*"
                        class="item-image">

                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Best Polo Shirts for Men</h3>

                            </div>

                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">$120</span>
                            </div>


                        </div>

                        <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">Discription</p>
                        <div class="item-actions">
                            <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Add to
                                cart</button>

                            <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Add to
                                wishlist</button>
                        </div>

                    </div>
                </a>

                <a class="inventory-item" data-status="${item.status}" id="item"
                    href="?action=dashboard&type=vendor&level=viewitem">

                    <img src="https://images-cdn.ubuy.co.in/64d91ef52a203767b94313f9-dresbe-boho-anklet-silver-pearl-anklets.jpg" class="item-image">

                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Boho Silver Pearl Anklet with Starfish Pendant</h3>

                            </div>

                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">$120</span>
                            </div>


                        </div>

                        <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">Discription</p>
                        <div class="item-actions">
                            <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Add to
                                cart</button>

                            <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Add to
                                wishlist</button>
                        </div>

                    </div>
                </a>

                <a class="inventory-item" data-status="${item.status}" id="item"
                    href="?action=dashboard&type=vendor&level=viewitem">

                    <img src="https://m.media-amazon.com/images/I/714kO41XjDL.jpg" class="item-image">

                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Fender Acoustic Guitar</h3>

                            </div>

                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">$120</span>
                            </div>


                        </div>

                        <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">Discription</p>
                        <div class="item-actions">
                            <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Add to
                                cart</button>

                            <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Add to
                                wishlist</button>
                        </div>

                    </div>
                </a>

                 <a class="inventory-item" data-status="${item.status}" id="item"
                    href="?action=dashboard&type=vendor&level=viewitem">

                    <img src="https://www.unikwear.lk/wp-content/uploads/2023/06/2395.jpg" class="item-image">

                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Sri Lankan handmade modern cotton batik</h3>

                            </div>

                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">$120</span>
                            </div>


                        </div>

                        <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">Discription</p>
                        <div class="item-actions">
                            <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Add to
                                cart</button>

                            <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Add to
                                wishlist</button>
                        </div>

                    </div>
                </a>


            </div>

        </div>
    </div>

</body>

</html>
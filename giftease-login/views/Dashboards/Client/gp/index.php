<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopDash - Customer Dashboard</title>
    <link rel="stylesheet" href="views/Dashboards/Client/gp/style.css">
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
</head>
<body>
    <div class="dashboard-container">
        <!-- <aside class="sidebar" id="sidebar"> -->
            <aside class="left_sidebar">
                <div class="profile-section">
        <div class="profile-picture">
          <i class="fas fa-user"></i>
        </div>
        <div class="username">Dilma</div>
        <div class="rating">
          <div class="svg-cute-star">
            <?php
            function render_stars(float $rating): string
            {
              $output = '';
              $totalStars = 5;

              for ($i = 1; $i <= $totalStars; $i++) {
                if ($rating >= $i) {
                  $output .= '<span class="star filled">★</span>';
                } else {
                  $fraction = $rating - ($i - 1);
                  if ($fraction > 0) {
                    $percent = (1 - $fraction) * 100;
                    // Output partial star with inline style for clip-path percentage
                    $output .= '<span class="star partial" style="--empty-percent: ' . $percent . '%;">★</span>';
                  } else {
                    $output .= '<span class="star">★</span>';
                  }
                }
              }
              return $output;
            }

            $rating = 3.3;
            echo render_stars($rating);
            echo "<div class='rating-text'>$rating Rating</div>"
              ?>

          </div>
        </div>
      </div>
                <!-- <div class="sidebar-logo">📦</div>
                <span class="sidebar-title">ShopDash</span>
            </div> -->
            
            <nav>
                <ul class="nav-section">
                    <li><a href="#" class="nav-item active" data-section="browse"><i class="fas fa-search"></i>Browse</a></li>
                    <li><a href="#" class="nav-item" data-section="cart"><i class="fas fa-shop"></i>Cart</a></li>
                    <li><a href="#" class="nav-item"  data-section="wishlist"><i class="fas fa-heart"></i>Wishlist </a></li>
                    <li><a href="#" class="nav-item"  data-section="orders"><i class="fas fa-box"></i>Track Orders</a></li>
                    <li><a href="#" class="nav-item"  data-section="history"><i class="fa-solid fa-calendar"></i>Order History</a></li>
                    <li><a href="#" class="nav-item" data-section="payments"><i class="fab fa-cc-visa"></i>Payments</a></li>
                    <li><a href="#" class="nav-item"  data-section="customize"><i class="fas fa-gift"></i>Customize Items</a></li>
                    <li><a href="#" class="nav-item"  data-section="account"><i class="fas fa-user"></i> Account</a></li>
                    <li><a href="#" class="nav-item"  data-section="settings"><i class="fas fa-cog"></i> Settings</a></li>
                </ul>
            </nav>
             <div class="button-section">
        <a href="#logout" class="btn">
          <i class="fas fa-sign-out-alt"></i>
          Log Out
        </a>
      </div>
        </aside>

        <main class="main-content">
            <header class="header">
                <button class="mobile-menu-btn" onclick="toggleMobileMenu()">☰</button>
                
                <div class="search-container">
                    <span class="search-icon">🔍</span>
                    <input type="text" class="search-input" placeholder="Search within current section..." id="searchInput" oninput="handleSearch()">
                </div>
                
                <div class="header-actions">
                    <button class="btn" onclick="showNotification('You have 5 new notifications', 'info')">🔔</button>
                    <button class="btn cart-btn" onclick="navigateToSection('cart')">
                        🛒
                        <span class="cart-badge">3</span>
                    </button>
                </div>
            </header>

            <div class="content">
                <div class="content-header">
                    <h1 class="content-title" id="pageTitle">Welcome back, John!</h1>
                    <button class="btn" onclick="showNotification('Support chat opened!', 'info')">💬 Support</button>
                </div>

                <div id="searchResults" class="search-results">
                    <p>Searching for: <strong id="searchTerm"></strong></p>
                </div>

                <div id="section-overview" class="tab-content active">
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-title">Total Orders</span>
                                <span class="stat-icon">📦</span>
                            </div>
                            <div class="stat-value">24</div>
                            <div class="stat-change">+2 from last month</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-title">Total Spent</span>
                                <span class="stat-icon">💳</span>
                            </div>
                            <div class="stat-value">$2,350</div>
                            <div class="stat-change">+15% from last month</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-title">Wishlist Items</span>
                                <span class="stat-icon">❤️</span>
                            </div>
                            <div class="stat-value">12</div>
                            <div class="stat-change">3 items on sale</div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-title">Loyalty Points</span>
                                <span class="stat-icon">⭐</span>
                            </div>
                            <div class="stat-value">1,250</div>
                            <div class="stat-change">250 points to next reward</div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Recent Orders</h3>
                            <p class="card-description">Your latest order activity</p>
                        </div>
                        
                        <div class="order-item">
                            <div>
                                <div style="font-weight: 600;">ORD-001</div>
                                <div style="font-size: 0.875rem; color: #64748b;">2 items • 2024-01-15</div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <span class="badge badge-success">Delivered</span>
                                <span style="font-weight: 600;">$129.99</span>
                            </div>
                        </div>
                        
                        <div class="order-item">
                            <div>
                                <div style="font-weight: 600;">ORD-002</div>
                                <div style="font-size: 0.875rem; color: #64748b;">1 item • 2024-01-18</div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <span class="badge badge-warning">In Transit</span>
                                <span style="font-weight: 600;">$89.50</span>
                            </div>
                        </div>
                        
                        <button class="btn" style="width: 100%; margin-top: 1rem;" onclick="navigateToSection('orders')">👁️ View All Orders</button>
                    </div>
                </div>

                <div id="section-browse" class="tab-content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Browse Items</h3>
                            <p class="card-description">Discover and shop our latest products</p>
                        </div>
                        
                        <div class="filter-bar">
                            <select class="filter-select" onchange="filterProducts('category', this.value)">
                                <option value="">All Categories</option>
                                <option value="electronics">Electronics</option>
                                <option value="accessories">Accessories</option>
                                <option value="computers">Computers</option>
                            </select>
                            <select class="filter-select" onchange="filterProducts('price', this.value)">
                                <option value="">All Prices</option>
                                <option value="0-100">$0 - $100</option>
                                <option value="100-500">$100 - $500</option>
                                <option value="500+">$500+</option>
                            </select>
                            <select class="filter-select" onchange="sortProducts(this.value)">
                                <option value="">Sort By</option>
                                <option value="price-low">Price: Low to High</option>
                                <option value="price-high">Price: High to Low</option>
                                <option value="rating">Rating</option>
                                <option value="name">Name</option>
                            </select>
                        </div>
                        
                        <div class="products-grid" id="productsGrid">
                            <div class="product-card" data-name="wireless headphones" data-category="electronics" data-price="99.99">
                                <div class="product-image">🎧</div>
                                <div class="product-content">
                                    <h4 class="product-name">Wireless Headphones</h4>
                                    <div class="product-price">$99.99</div>
                                    <div class="product-rating">
                                        <span class="star">⭐</span>
                                        <span>4.5</span>
                                    </div>
                                    <div class="product-actions">
                                        <button class="btn btn-primary" style="flex: 1;" onclick="addToCart('Wireless Headphones', 99.99)">🛒 Add to Cart</button>
                                        <button class="btn" onclick="toggleWishlist(this)">❤️</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="product-card" data-name="smart watch" data-category="electronics" data-price="199.99">
                                <div class="product-image">⌚</div>
                                <div class="product-content">
                                    <h4 class="product-name">Smart Watch</h4>
                                    <div class="product-price">$199.99</div>
                                    <div class="product-rating">
                                        <span class="star">⭐</span>
                                        <span>4.8</span>
                                    </div>
                                    <div class="product-actions">
                                        <button class="btn btn-primary" style="flex: 1;" onclick="addToCart('Smart Watch', 199.99)">🛒 Add to Cart</button>
                                        <button class="btn" onclick="toggleWishlist(this)">❤️</button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="product-card" data-name="bluetooth speaker" data-category="electronics" data-price="79.99">
                                <div class="product-image">🔊</div>
                                <div class="product-content">
                                    <h4 class="product-name">Bluetooth Speaker</h4>
                                    <div class="product-price">$79.99</div>
                                    <div class="product-rating">
                                        <span class="star">⭐</span>
                                        <span>4.3</span>
                                    </div>
                                    <div class="product-actions">
                                        <button class="btn btn-primary" style="flex: 1;" onclick="addToCart('Bluetooth Speaker', 79.99)">🛒 Add to Cart</button>
                                        <button class="btn" onclick="toggleWishlist(this)">❤️</button>
                                    </div>
                                </div>
                            </div>

                            <div class="product-card" data-name="gaming laptop" data-category="computers" data-price="1299.99">
                                <div class="product-image">💻</div>
                                <div class="product-content">
                                    <h4 class="product-name">Gaming Laptop</h4>
                                    <div class="product-price">$1,299.99</div>
                                    <div class="product-rating">
                                        <span class="star">⭐</span>
                                        <span>4.7</span>
                                    </div>
                                    <div class="product-actions">
                                        <button class="btn btn-primary" style="flex: 1;" onclick="addToCart('Gaming Laptop', 1299.99)">🛒 Add to Cart</button>
                                        <button class="btn" onclick="toggleWishlist(this)">❤️</button>
                                    </div>
                                </div>
                            </div>

                            <div class="product-card" data-name="smartphone" data-category="electronics" data-price="699.99">
                                <div class="product-image">📱</div>
                                <div class="product-content">
                                    <h4 class="product-name">Smartphone</h4>
                                    <div class="product-price">$699.99</div>
                                    <div class="product-rating">
                                        <span class="star">⭐</span>
                                        <span>4.6</span>
                                    </div>
                                    <div class="product-actions">
                                        <button class="btn btn-primary" style="flex: 1;" onclick="addToCart('Smartphone', 699.99)">🛒 Add to Cart</button>
                                        <button class="btn" onclick="toggleWishlist(this)">❤️</button>
                                    </div>
                                </div>
                            </div>

                            <div class="product-card" data-name="tablet" data-category="electronics" data-price="399.99">
                                <div class="product-image">📱</div>
                                <div class="product-content">
                                    <h4 class="product-name">Tablet</h4>
                                    <div class="product-price">$399.99</div>
                                    <div class="product-rating">
                                        <span class="star">⭐</span>
                                        <span>4.4</span>
                                    </div>
                                    <div class="product-actions">
                                        <button class="btn btn-primary" style="flex: 1;" onclick="addToCart('Tablet', 399.99)">🛒 Add to Cart</button>
                                        <button class="btn" onclick="toggleWishlist(this)">❤️</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="section-cart" class="tab-content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Shopping Cart</h3>
                            <p class="card-description">Review your items before checkout</p>
                        </div>
                        
                        <div id="cartItems">
                            <div class="order-item">
                                <div class="order-info">
                                    <div class="order-image">🎧</div>
                                    <div>
                                        <div style="font-weight: 500;">Wireless Headphones</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">
                                            Qty: 
                                            <button onclick="updateQuantity(this, -1)" style="background: none; border: 1px solid #e2e8f0; padding: 0.25rem 0.5rem; margin: 0 0.25rem;">-</button>
                                            <span>1</span>
                                            <button onclick="updateQuantity(this, 1)" style="background: none; border: 1px solid #e2e8f0; padding: 0.25rem 0.5rem; margin: 0 0.25rem;">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <span style="font-weight: 600;">$99.99</span>
                                    <button class="btn btn-danger" onclick="removeFromCart(this)">❌</button>
                                </div>
                            </div>
                            
                            <div class="order-item">
                                <div class="order-info">
                                    <div class="order-image">⌚</div>
                                    <div>
                                        <div style="font-weight: 500;">Smart Watch</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">
                                            Qty: 
                                            <button onclick="updateQuantity(this, -1)" style="background: none; border: 1px solid #e2e8f0; padding: 0.25rem 0.5rem; margin: 0 0.25rem;">-</button>
                                            <span>1</span>
                                            <button onclick="updateQuantity(this, 1)" style="background: none; border: 1px solid #e2e8f0; padding: 0.25rem 0.5rem; margin: 0 0.25rem;">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <span style="font-weight: 600;">$199.99</span>
                                    <button class="btn btn-danger" onclick="removeFromCart(this)">❌</button>
                                </div>
                            </div>
                            
                            <div class="order-item">
                                <div class="order-info">
                                    <div class="order-image">🔊</div>
                                    <div>
                                        <div style="font-weight: 500;">Bluetooth Speaker</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">
                                            Qty: 
                                            <button onclick="updateQuantity(this, -1)" style="background: none; border: 1px solid #e2e8f0; padding: 0.25rem 0.5rem; margin: 0 0.25rem;">-</button>
                                            <span>1</span>
                                            <button onclick="updateQuantity(this, 1)" style="background: none; border: 1px solid #e2e8f0; padding: 0.25rem 0.5rem; margin: 0 0.25rem;">+</button>
                                        </div>
                                    </div>
                                </div>
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <span style="font-weight: 600;">$79.99</span>
                                    <button class="btn btn-danger" onclick="removeFromCart(this)">❌</button>
                                </div>
                            </div>
                        </div>

                        <div style="border-top: 1px solid #e2e8f0; padding-top: 1rem; margin-top: 1rem;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <span>Subtotal:</span>
                                <span id="cartSubtotal">$379.97</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <span>Tax:</span>
                                <span>$30.40</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; font-weight: bold; font-size: 1.125rem; border-top: 1px solid #e2e8f0; padding-top: 0.5rem;">
                                <span>Total:</span>
                                <span>$410.37</span>
                            </div>
                        </div>

                        <div class="action-buttons" style="margin-top: 1rem;">
                            <button class="btn" onclick="clearCart()">🗑️ Clear Cart</button>
                            <button class="btn" onclick="saveForLater()">💾 Save for Later</button>
                            <button class="btn btn-primary" style="flex: 1;" onclick="openCheckout()">🛒 Proceed to Checkout</button>
                        </div>
                    </div>
                </div>

                <div id="section-wishlist" class="tab-content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Wishlist</h3>
                            <p class="card-description">Items you've saved for later</p>
                        </div>
                        
                        <div class="filter-bar">
                            <button class="btn" onclick="filterWishlist('all')">All Items</button>
                            <button class="btn" onclick="filterWishlist('sale')">On Sale</button>
                            <button class="btn" onclick="filterWishlist('available')">In Stock</button>
                            <button class="btn btn-danger" onclick="clearWishlist()">Clear All</button>
                        </div>
                        
                        <div class="wishlist-grid">
                            <div class="wishlist-item" data-status="available">
                                <div class="wishlist-image">🎮</div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 500;">Gaming Console</div>
                                    <div style="color: #059669; font-weight: 600;">$499.99</div>
                                    <div style="font-size: 0.875rem; color: #64748b;">In Stock</div>
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                    <button class="btn btn-primary" onclick="addToCart('Gaming Console', 499.99)">🛒 Add to Cart</button>
                                    <button class="btn btn-danger" onclick="removeFromWishlist(this)">❌ Remove</button>
                                </div>
                            </div>

                            <div class="wishlist-item" data-status="sale">
                                <div class="wishlist-image">📷</div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 500;">Digital Camera</div>
                                    <div style="color: #059669; font-weight: 600;">$899.99 <span style="text-decoration: line-through; color: #64748b;">$1199.99</span></div>
                                    <div style="font-size: 0.875rem; color: #ef4444;">25% Off Sale!</div>
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                    <button class="btn btn-primary" onclick="addToCart('Digital Camera', 899.99)">🛒 Add to Cart</button>
                                    <button class="btn btn-danger" onclick="removeFromWishlist(this)">❌ Remove</button>
                                </div>
                            </div>

                            <div class="wishlist-item" data-status="available">
                                <div class="wishlist-image">🖥️</div>
                                <div style="flex: 1;">
                                    <div style="font-weight: 500;">4K Monitor</div>
                                    <div style="color: #059669; font-weight: 600;">$349.99</div>
                                    <div style="font-size: 0.875rem; color: #64748b;">In Stock</div>
                                </div>
                                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                    <button class="btn btn-primary" onclick="addToCart('4K Monitor', 349.99)">🛒 Add to Cart</button>
                                    <button class="btn btn-danger" onclick="removeFromWishlist(this)">❌ Remove</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="section-orders" class="tab-content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order Tracking</h3>
                            <p class="card-description">Track your current and past orders</p>
                        </div>
                        
                        <div class="filter-bar">
                            <select class="filter-select" onchange="filterOrders(this.value)">
                                <option value="">All Orders</option>
                                <option value="processing">Processing</option>
                                <option value="shipped">Shipped</option>
                                <option value="delivered">Delivered</option>
                            </select>
                            <button class="btn" onclick="refreshOrderStatus()">🔄 Refresh Status</button>
                        </div>
                        
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                            <div>
                                <div style="font-weight: 600;">Order #ORD-002</div>
                                <div style="font-size: 0.875rem; color: #64748b;">Estimated delivery: Jan 25, 2024</div>
                            </div>
                            <span class="badge badge-warning">In Transit</span>
                        </div>
                        
                        <div style="margin-bottom: 1rem;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.5rem;">
                                <span>Order Progress</span>
                                <span>75%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 75%;"></div>
                            </div>
                        </div>
                        
                        <div style="display: flex; flex-direction: column; gap: 1rem;">
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 8px; height: 8px; border-radius: 50%; background: #10b981;"></div>
                                <span>Order confirmed</span>
                                <span style="margin-left: auto; font-size: 0.875rem; color: #64748b;">Jan 18</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 8px; height: 8px; border-radius: 50%; background: #10b981;"></div>
                                <span>Order shipped</span>
                                <span style="margin-left: auto; font-size: 0.875rem; color: #64748b;">Jan 20</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 8px; height: 8px; border-radius: 50%; background: #3b82f6;"></div>
                                <span>In transit</span>
                                <span style="margin-left: auto; font-size: 0.875rem; color: #64748b;">Jan 22</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 8px; height: 8px; border-radius: 50%; background: #d1d5db;"></div>
                                <span style="color: #64748b;">Delivered</span>
                                <span style="margin-left: auto; font-size: 0.875rem; color: #64748b;">Pending</span>
                            </div>
                        </div>

                        <div class="action-buttons" style="margin-top: 1.5rem;">
                            <button class="btn" onclick="trackOrder('ORD-002')">📍 Track Package</button>
                            <button class="btn" onclick="contactSupport('ORD-002')">💬 Contact Support</button>
                            <button class="btn btn-danger" onclick="cancelOrder('ORD-002')">❌ Cancel Order</button>
                        </div>
                    </div>
                </div>

                <div id="section-history" class="tab-content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Order History</h3>
                            <p class="card-description">View and manage your past orders</p>
                        </div>
                        
                        <div class="filter-bar">
                            <input type="date" class="filter-select" onchange="filterByDate(this.value)" placeholder="From Date">
                            <input type="date" class="filter-select" onchange="filterByDate(this.value)" placeholder="To Date">
                            <select class="filter-select" onchange="filterByStatus(this.value)">
                                <option value="">All Status</option>
                                <option value="delivered">Delivered</option>
                                <option value="cancelled">Cancelled</option>
                                <option value="returned">Returned</option>
                            </select>
                            <button class="btn" onclick="exportHistory()">📥 Export</button>
                        </div>
                        
                        <div class="order-item">
                            <div>
                                <div style="font-weight: 600;">ORD-001</div>
                                <div style="font-size: 0.875rem; color: #64748b;">2 items • 2024-01-15</div>
                                <div style="font-size: 0.75rem; color: #64748b;">Wireless Headphones, Smart Watch</div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <span class="badge badge-success">Delivered</span>
                                <span style="font-weight: 600;">$129.99</span>
                                <div class="action-buttons">
                                    <button class="btn" onclick="reorderItems('ORD-001')">🔄 Reorder</button>
                                    <button class="btn" onclick="downloadInvoice('ORD-001')">📄 Invoice</button>
                                    <button class="btn" onclick="returnOrder('ORD-001')">↩️ Return</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="order-item">
                            <div>
                                <div style="font-weight: 600;">ORD-002</div>
                                <div style="font-size: 0.875rem; color: #64748b;">1 item • 2024-01-18</div>
                                <div style="font-size: 0.75rem; color: #64748b;">Bluetooth Speaker</div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <span class="badge badge-warning">In Transit</span>
                                <span style="font-weight: 600;">$89.50</span>
                                <div class="action-buttons">
                                    <button class="btn" onclick="trackOrder('ORD-002')">📦 Track</button>
                                    <button class="btn btn-danger" onclick="cancelOrder('ORD-002')">❌ Cancel</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="order-item">
                            <div>
                                <div style="font-weight: 600;">ORD-003</div>
                                <div style="font-size: 0.875rem; color: #64748b;">3 items • 2024-01-20</div>
                                <div style="font-size: 0.75rem; color: #64748b;">Gaming Laptop, Mouse, Keyboard</div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <span class="badge badge-secondary">Processing</span>
                                <span style="font-weight: 600;">$1,245.00</span>
                                <div class="action-buttons">
                                    <button class="btn" onclick="modifyOrder('ORD-003')">✏️ Modify</button>
                                    <button class="btn btn-danger" onclick="cancelOrder('ORD-003')">❌ Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="section-payments" class="tab-content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Payment Methods</h3>
                            <p class="card-description">Manage your payment options and billing</p>
                        </div>
                        
                        <div class="payment-method">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <span style="font-size: 1.5rem;">💳</span>
                                <div>
                                    <div style="font-weight: 500;">Visa •••• 4242</div>
                                    <div style="font-size: 0.875rem; color: #64748b;">Expires 12/25</div>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <span class="badge badge-secondary">Default</span>
                                <button class="btn" onclick="editPaymentMethod('card-1')">✏️ Edit</button>
                                <button class="btn" onclick="setDefaultPayment('card-1')">⭐ Set Default</button>
                            </div>
                        </div>
                        
                        <div class="payment-method">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <span style="font-size: 1.5rem;">💳</span>
                                <div>
                                    <div style="font-weight: 500;">Mastercard •••• 8888</div>
                                    <div style="font-size: 0.875rem; color: #64748b;">Expires 08/26</div>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <button class="btn" onclick="editPaymentMethod('card-2')">✏️ Edit</button>
                                <button class="btn" onclick="setDefaultPayment('card-2')">⭐ Set Default</button>
                                <button class="btn btn-danger" onclick="removePaymentMethod('card-2')">❌ Remove</button>
                            </div>
                        </div>

                        <div class="payment-method">
                            <div style="display: flex; align-items: center; gap: 0.75rem;">
                                <span style="font-size: 1.5rem;">🏦</span>
                                <div>
                                    <div style="font-weight: 500;">Bank Account •••• 1234</div>
                                    <div style="font-size: 0.875rem; color: #64748b;">Chase Bank</div>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <button class="btn" onclick="editPaymentMethod('bank-1')">✏️ Edit</button>
                                <button class="btn btn-danger" onclick="removePaymentMethod('bank-1')">❌ Remove</button>
                            </div>
                        </div>
                        
                        <div class="action-buttons" style="margin-top: 1rem;">
                            <button class="btn btn-primary" onclick="addPaymentMethod()">➕ Add Credit Card</button>
                            <button class="btn" onclick="addBankAccount()">🏦 Add Bank Account</button>
                            <button class="btn" onclick="viewBillingHistory()">📊 Billing History</button>
                        </div>
                    </div>
                </div>

                <div id="section-customize" class="tab-content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Customize Items</h3>
                            <p class="card-description">Personalize your products with custom options</p>
                        </div>
                        
                        <div class="filter-bar">
                            <select class="filter-select" onchange="filterCustomizable(this.value)">
                                <option value="">All Categories</option>
                                <option value="apparel">Apparel</option>
                                <option value="accessories">Accessories</option>
                                <option value="electronics">Electronics</option>
                            </select>
                            <button class="btn" onclick="viewCustomDesigns()">🎨 My Designs</button>
                        </div>
                        
                        <div class="products-grid">
                            <div class="product-card" data-category="apparel">
                                <div class="product-image">👕</div>
                                <div class="product-content">
                                    <h4 class="product-name">Custom T-Shirt</h4>
                                    <div class="product-price">Starting at $24.99</div>
                                    <div style="margin: 1rem 0;">
                                        <div style="margin-bottom: 0.5rem; font-weight: 500;">Customization Options:</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">• Custom text/logo</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">• Multiple colors</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">• Size selection</div>
                                    </div>
                                    <div class="action-buttons">
                                        <button class="btn btn-primary" onclick="openCustomizer('tshirt')">🎨 Customize</button>
                                        <button class="btn" onclick="viewTemplates('tshirt')">📋 Templates</button>
                                    </div>
                                </div>
                            </div>

                            <div class="product-card" data-category="accessories">
                                <div class="product-image">☕</div>
                                <div class="product-content">
                                    <h4 class="product-name">Custom Mug</h4>
                                    <div class="product-price">Starting at $14.99</div>
                                    <div style="margin: 1rem 0;">
                                        <div style="margin-bottom: 0.5rem; font-weight: 500;">Customization Options:</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">• Photo upload</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">• Custom message</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">• Color options</div>
                                    </div>
                                    <div class="action-buttons">
                                        <button class="btn btn-primary" onclick="openCustomizer('mug')">🎨 Customize</button>
                                        <button class="btn" onclick="viewTemplates('mug')">📋 Templates</button>
                                    </div>
                                </div>
                            </div>

                            <div class="product-card" data-category="electronics">
                                <div class="product-image">📱</div>
                                <div class="product-content">
                                    <h4 class="product-name">Phone Case</h4>
                                    <div class="product-price">Starting at $19.99</div>
                                    <div style="margin: 1rem 0;">
                                        <div style="margin-bottom: 0.5rem; font-weight: 500;">Customization Options:</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">• Custom design</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">• Device compatibility</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">• Material choice</div>
                                    </div>
                                    <div class="action-buttons">
                                        <button class="btn btn-primary" onclick="openCustomizer('phonecase')">🎨 Customize</button>
                                        <button class="btn" onclick="viewTemplates('phonecase')">📋 Templates</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="section-account" class="tab-content">
                    <div class="profile-info">
                        <div class="profile-avatar">👤</div>
                        <div class="profile-name">John Doe</div>
                        <div class="profile-email">john.doe@example.com</div>
                        <button class="btn btn-primary" onclick="openEditProfile()">✏️ Edit Profile</button>
                    </div>

                    <div class="grid-2">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Personal Information</h3>
                                <p class="card-description">Manage your account details</p>
                            </div>
                            
                            <div style="margin-bottom: 1rem;">
                                <div style="font-weight: 500; margin-bottom: 0.5rem;">Full Name</div>
                                <div style="color: #64748b;">John Doe</div>
                            </div>
                            
                            <div style="margin-bottom: 1rem;">
                                <div style="font-weight: 500; margin-bottom: 0.5rem;">Email</div>
                                <div style="color: #64748b;">john.doe@example.com</div>
                            </div>
                            
                            <div style="margin-bottom: 1rem;">
                                <div style="font-weight: 500; margin-bottom: 0.5rem;">Phone</div>
                                <div style="color: #64748b;">+1 (555) 123-4567</div>
                            </div>
                            
                            <div style="margin-bottom: 1rem;">
                                <div style="font-weight: 500; margin-bottom: 0.5rem;">Date of Birth</div>
                                <div style="color: #64748b;">January 15, 1990</div>
                            </div>
                            
                            <div class="action-buttons">
                                <button class="btn btn-primary" onclick="openEditProfile()">✏️ Edit Profile</button>
                                <button class="btn" onclick="changePassword()">🔒 Change Password</button>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Shipping Addresses</h3>
                                <p class="card-description">Manage your delivery addresses</p>
                            </div>
                            
                            <div style="display: flex; align-items: start; gap: 0.75rem; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 1rem;">
                                <span style="font-size: 1.25rem;">📍</span>
                                <div style="flex: 1;">
                                    <div style="font-weight: 500;">Home</div>
                                    <div style="font-size: 0.875rem; color: #64748b;">
                                        123 Main Street<br>
                                        Apartment 4B<br>
                                        New York, NY 10001<br>
                                        United States
                                    </div>
                                </div>
                                <div class="action-buttons">
                                    <span class="badge badge-secondary">Default</span>
                                    <button class="btn" onclick="editAddress('home')">✏️ Edit</button>
                                </div>
                            </div>
                            
                            <div style="display: flex; align-items: start; gap: 0.75rem; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 1rem;">
                                <span style="font-size: 1.25rem;">🏢</span>
                                <div style="flex: 1;">
                                    <div style="font-weight: 500;">Work</div>
                                    <div style="font-size: 0.875rem; color: #64748b;">
                                        456 Business Ave<br>
                                        Suite 200<br>
                                        New York, NY 10002<br>
                                        United States
                                    </div>
                                </div>
                                <div class="action-buttons">
                                    <button class="btn" onclick="editAddress('work')">✏️ Edit</button>
                                    <button class="btn btn-danger" onclick="removeAddress('work')">❌ Remove</button>
                                </div>
                            </div>
                            
                            <button class="btn btn-primary" style="width: 100%;" onclick="addNewAddress()">➕ Add New Address</button>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Account Security</h3>
                            <p class="card-description">Manage your security settings</p>
                        </div>
                        
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 1rem;">
                            <div>
                                <div style="font-weight: 500;">Two-Factor Authentication</div>
                                <div style="font-size: 0.875rem; color: #64748b;">Add an extra layer of security</div>
                            </div>
                            <button class="btn btn-success" onclick="enableTwoFactor()">🔐 Enable</button>
                        </div>
                        
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 1rem;">
                            <div>
                                <div style="font-weight: 500;">Login Activity</div>
                                <div style="font-size: 0.875rem; color: #64748b;">View recent login attempts</div>
                            </div>
                            <button class="btn" onclick="viewLoginActivity()">👁️ View</button>
                        </div>
                        
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; border: 1px solid #e2e8f0; border-radius: 8px; margin-bottom: 1rem;">
                            <div>
                                <div style="font-weight: 500;">Connected Devices</div>
                                <div style="font-size: 0.875rem; color: #64748b;">Manage logged in devices</div>
                            </div>
                            <button class="btn" onclick="manageDevices()">📱 Manage</button>
                        </div>
                    </div>
                </div>

                <div id="section-settings" class="tab-content">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Preferences</h3>
                            <p class="card-description">Customize your shopping experience</p>
                        </div>
                        
                        <div style="margin-bottom: 2rem;">
                            <div style="font-weight: 500; margin-bottom: 1rem;">Notifications</div>
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                <label style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer;">
                                    <div>
                                        <div style="font-weight: 500;">Email notifications</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">Receive order updates via email</div>
                                    </div>
                                    <input type="checkbox" checked onchange="updateNotificationSetting('email', this.checked)">
                                </label>
                                <label style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer;">
                                    <div>
                                        <div style="font-weight: 500;">SMS notifications</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">Receive delivery updates via SMS</div>
                                    </div>
                                    <input type="checkbox" onchange="updateNotificationSetting('sms', this.checked)">
                                </label>
                                <label style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer;">
                                    <div>
                                        <div style="font-weight: 500;">Order updates</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">Get notified about order status changes</div>
                                    </div>
                                    <input type="checkbox" checked onchange="updateNotificationSetting('orders', this.checked)">
                                </label>
                                <label style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer;">
                                    <div>
                                        <div style="font-weight: 500;">Marketing emails</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">Receive promotional offers and deals</div>
                                    </div>
                                    <input type="checkbox" onchange="updateNotificationSetting('marketing', this.checked)">
                                </label>
                            </div>
                        </div>

                        <div style="margin-bottom: 2rem;">
                            <div style="font-weight: 500; margin-bottom: 1rem;">Display Preferences</div>
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 8px;">
                                    <div>
                                        <div style="font-weight: 500;">Theme</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">Choose your preferred theme</div>
                                    </div>
                                    <select class="filter-select" onchange="changeTheme(this.value)">
                                        <option value="light">Light</option>
                                        <option value="dark">Dark</option>
                                        <option value="auto">Auto</option>
                                    </select>
                                </div>
                                <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 8px;">
                                    <div>
                                        <div style="font-weight: 500;">Language</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">Select your preferred language</div>
                                    </div>
                                    <select class="filter-select" onchange="changeLanguage(this.value)">
                                        <option value="en">English</option>
                                        <option value="es">Spanish</option>
                                        <option value="fr">French</option>
                                        <option value="de">German</option>
                                    </select>
                                </div>
                                <div style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 8px;">
                                    <div>
                                        <div style="font-weight: 500;">Currency</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">Choose your preferred currency</div>
                                    </div>
                                    <select class="filter-select" onchange="changeCurrency(this.value)">
                                        <option value="usd">USD ($)</option>
                                        <option value="eur">EUR (€)</option>
                                        <option value="gbp">GBP (£)</option>
                                        <option value="cad">CAD ($)</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div style="margin-bottom: 2rem;">
                            <div style="font-weight: 500; margin-bottom: 1rem;">Privacy</div>
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                <label style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer;">
                                    <div>
                                        <div style="font-weight: 500;">Data collection for personalization</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">Allow us to personalize your experience</div>
                                    </div>
                                    <input type="checkbox" checked onchange="updatePrivacySetting('personalization', this.checked)">
                                </label>
                                <label style="display: flex; align-items: center; justify-content: space-between; padding: 0.75rem; border: 1px solid #e2e8f0; border-radius: 8px; cursor: pointer;">
                                    <div>
                                        <div style="font-weight: 500;">Share data with partners</div>
                                        <div style="font-size: 0.875rem; color: #64748b;">Allow sharing for better deals</div>
                                    </div>
                                    <input type="checkbox" onchange="updatePrivacySetting('sharing', this.checked)">
                                </label>
                            </div>
                        </div>
                        
                        <div class="action-buttons">
                            <button class="btn btn-primary" onclick="saveAllSettings()">💾 Save All Settings</button>
                            <button class="btn" onclick="resetToDefaults()">🔄 Reset to Defaults</button>
                            <button class="btn btn-danger" onclick="deleteAccount()">🗑️ Delete Account</button>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="editProfileModal" class="modal-overlay">
        <div class="modal">
            <div class="modal-header">
                <div>
                    <h2 class="modal-title">Edit Profile</h2>
                    <p class="modal-description">Update your personal information</p>
                </div>
                <button class="modal-close" onclick="closeEditProfile()">✕</button>
            </div>

            <div class="form-group">
                <label class="form-label">Profile Picture</label>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div class="profile-avatar">👤</div>
                    <div>
                        <button class="btn" onclick="uploadProfilePicture()">📷 Upload Photo</button>
                        <div style="font-size: 0.875rem; color: #64748b; margin-top: 0.25rem;">JPG, PNG up to 5MB</div>
                    </div>
                </div>
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label">First Name</label>
                    <input type="text" class="form-input" value="John" id="firstName">
                </div>
                <div class="form-group">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-input" value="Doe" id="lastName">
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-input" value="john.doe@example.com" id="email">
            </div>

            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="tel" class="form-input" value="+1 (555) 123-4567" id="phone">
            </div>

            <div class="form-group">
                <label class="form-label">Date of Birth</label>
                <input type="date" class="form-input" value="1990-01-15" id="dateOfBirth">
            </div>

            <div class="form-group">
                <label class="form-label">Bio</label>
                <textarea class="form-textarea" placeholder="Tell us about yourself..." id="bio"></textarea>
            </div>

            <div class="modal-actions">
                <button class="btn" onclick="closeEditProfile()">Cancel</button>
                <button class="btn btn-primary" onclick="saveProfile()">💾 Save Changes</button>
            </div>
        </div>
    </div>

    <div id="checkoutModal" class="modal-overlay">
        <div class="modal">
            <div class="modal-header">
                <div>
                    <h2 class="modal-title">Checkout</h2>
                    <p class="modal-description">Complete your purchase with customization options</p>
                </div>
                <button class="modal-close" onclick="closeCheckout()">✕</button>
            </div>

            <div class="form-group">
                <h3 style="margin-bottom: 1rem;">Order Summary</h3>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div class="order-image">🎧</div>
                        <div>
                            <div style="font-weight: 500;">Wireless Headphones</div>
                            <div style="font-size: 0.875rem; color: #64748b;">Qty: 1</div>
                        </div>
                    </div>
                    <span style="font-weight: 600;">$99.99</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div class="order-image">⌚</div>
                        <div>
                            <div style="font-weight: 500;">Smart Watch</div>
                            <div style="font-size: 0.875rem; color: #64748b;">Qty: 1</div>
                        </div>
                    </div>
                    <span style="font-weight: 600;">$199.99</span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div class="order-image">🔊</div>
                        <div>
                            <div style="font-weight: 500;">Bluetooth Speaker</div>
                            <div style="font-size: 0.875rem; color: #64748b;">Qty: 1</div>
                        </div>
                    </div>
                    <span style="font-weight: 600;">$79.99</span>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Gift Wrapping</label>
                <div class="radio-group">
                    <div class="radio-item selected" onclick="selectGiftWrap('none', 0)">
                        <input type="radio" name="giftWrap" value="none" checked class="radio-input">
                        <div class="radio-label">
                            <span>No Gift Wrap</span>
                            <span style="font-weight: 600;">Free</span>
                        </div>
                    </div>
                    <div class="radio-item" onclick="selectGiftWrap('basic', 4.99)">
                        <input type="radio" name="giftWrap" value="basic" class="radio-input">
                        <div class="radio-label">
                            <span>Basic Gift Wrap</span>
                            <span style="font-weight: 600;">+$4.99</span>
                        </div>
                    </div>
                    <div class="radio-item" onclick="selectGiftWrap('premium', 9.99)">
                        <input type="radio" name="giftWrap" value="premium" class="radio-input">
                        <div class="radio-label">
                            <span>Premium Gift Wrap</span>
                            <span style="font-weight: 600;">+$9.99</span>
                        </div>
                    </div>
                    <div class="radio-item" onclick="selectGiftWrap('luxury', 14.99)">
                        <input type="radio" name="giftWrap" value="luxury" class="radio-input">
                        <div class="radio-label">
                            <span>Luxury Gift Wrap</span>
                            <span style="font-weight: 600;">+$14.99</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Delivery Options</label>
                <div class="radio-group">
                    <div class="radio-item selected" onclick="selectDelivery('standard', 0)">
                        <input type="radio" name="delivery" value="standard" checked class="radio-input">
                        <div class="radio-label">
                            <span>Standard Delivery (5-7 days)</span>
                            <span style="font-weight: 600;">Free</span>
                        </div>
                    </div>
                    <div class="radio-item" onclick="selectDelivery('express', 12.99)">
                        <input type="radio" name="delivery" value="express" class="radio-input">
                        <div class="radio-label">
                            <span>Express Delivery (2-3 days)</span>
                            <span style="font-weight: 600;">+$12.99</span>
                        </div>
                    </div>
                    <div class="radio-item" onclick="selectDelivery('overnight', 24.99)">
                        <input type="radio" name="delivery" value="overnight" class="radio-input">
                        <div class="radio-label">
                            <span>Overnight Delivery</span>
                            <span style="font-weight: 600;">+$24.99</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="checkbox-item" onclick="togglePersonalMessage()">
                    <input type="checkbox" id="personalMessageCheck" class="radio-input">
                    <div class="radio-label">
                        <span>Add Personal Message</span>
                        <span style="font-weight: 600;">+$2.99</span>
                    </div>
                </div>
                <textarea id="personalMessageText" class="form-textarea" style="display: none; margin-top: 0.5rem;" placeholder="Enter your personal message..." maxlength="200"></textarea>
            </div>

            <div class="form-group">
                <h3 style="margin-bottom: 1rem;">Shipping Information</h3>
                <div class="grid-2">
                    <div>
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-input" placeholder="John">
                    </div>
                    <div>
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-input" placeholder="Doe">
                    </div>
                </div>
                <div>
                    <label class="form-label">Address</label>
                    <input type="text" class="form-input" placeholder="123 Main St">
                </div>
                <div class="grid-2">
                    <div>
                        <label class="form-label">City</label>
                        <input type="text" class="form-input" placeholder="New York">
                    </div>
                    <div>
                        <label class="form-label">ZIP Code</label>
                        <input type="text" class="form-input" placeholder="10001">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <h3 style="margin-bottom: 1rem;">Payment Information</h3>
                <div>
                    <label class="form-label">Card Number</label>
                    <input type="text" class="form-input" placeholder="1234 5678 9012 3456">
                </div>
                <div class="grid-2">
                    <div>
                        <label class="form-label">Expiry Date</label>
                        <input type="text" class="form-input" placeholder="MM/YY">
                    </div>
                    <div>
                        <label class="form-label">CVV</label>
                        <input type="text" class="form-input" placeholder="123">
                    </div>
                </div>
            </div>

            <div class="price-breakdown">
                <div class="price-row">
                    <span>Subtotal:</span>
                    <span id="subtotal">$379.97</span>
                </div>
                <div class="price-row" id="giftWrapRow" style="display: none;">
                    <span>Gift Wrapping:</span>
                    <span id="giftWrapPrice">+$0.00</span>
                </div>
                <div class="price-row" id="deliveryRow" style="display: none;">
                    <span>Delivery:</span>
                    <span id="deliveryPrice">+$0.00</span>
                </div>
                <div class="price-row" id="messageRow" style="display: none;">
                    <span>Personal Message:</span>
                    <span id="messagePrice">+$2.99</span>
                </div>
                <div class="price-row">
                    <span>Tax:</span>
                    <span id="tax">$30.40</span>
                </div>
                <div class="price-total">
                    <span>Total:</span>
                    <span id="total">$410.37</span>
                </div>
            </div>

            <div class="modal-actions">
                <button class="btn" onclick="closeCheckout()">Cancel</button>
                <button class="btn btn-primary" onclick="completePurchase()">Complete Purchase</button>
            </div>
        </div>
    </div>

    <script src="views/Dashboards/Client/gp/script.js"></script>
             
    </script>
</body>
</html>

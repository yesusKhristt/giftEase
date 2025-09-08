<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopDash - Customer Dashboard</title>
    <style>
        /*--------------------------CSS FILE-----------------------------*/
        @font-face {
            font-family: 'Century Gothic';
            src: url('fonts/centurygothic.ttf') format('truetype');
        }

        * {
            font-family: 'Century Gothic';
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
            width: 100%;
            margin: 0;
            gap: 20px;
            padding: 20px;
        }

        /* Sidebar Styles */
        .sidebar {
            background: linear-gradient(180deg, #FFFFFF 0%, #fed2ed 100%);
            border: 5px solid #fff;
            border-left: 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            width: 280px;
            height: 100vh;
            border-radius: 25px;
            display: flex;
            flex-direction: column;
            position: relative;
            top: 0;
            left: 0;
            overflow-y: auto;
            z-index: 1000;
        }

        .sidebar.mobile-hidden {
            transform: translateX(-100%);
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            padding: 0.5rem;
        }

        .sidebar-logo {
            width: 32px;
            height: 32px;
            background: #e91e63;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .sidebar-title {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .sidebar-nav {
            list-style: none;
        }

        .sidebar-nav li {
            margin-bottom: 0.25rem;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem;
            text-decoration: none;
            color: #64748b;
            border-radius: 25px;
            transition: all 0.2s;
            cursor: pointer;
        }

        .sidebar-nav a:hover {
            background: #fed2ed;
            color: #1e293b;
        }

        .sidebar-nav a.active {
            background: #fed2ed;
            color: #d81b60;
            border-left: 3px solid #d81b60;
        }

        .sidebar-nav .badge {
            background: rgba(233, 30, 99, 0.2);
            color: #64748b;
            padding: 0.125rem 0.5rem;
            border-radius: 25px;
            font-size: 0.75rem;
            margin-left: auto;
        }

        /* Main Content */
        .main-content {
            flex: 1;
            background: white;
            border-radius: 25px;
            overflow: hidden;
        }

        .header {
            padding: 40px 32px;
            border-bottom: 1px solid #fed2ed;
            background: white;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
        }

        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .search-container {
            position: relative;
            flex: 1;
            max-width: 400px;
        }

        .search-input {
            width: 100%;
            padding: 0.5rem 0.75rem 0.5rem 2.5rem;
            border: 1px solid rgba(233, 30, 99, 0.2);
            border-radius: 25px;
            font-size: 0.875rem;
        }

        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #e91e63;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-left: auto;
        }

        .btn {
            background: #e91e63;
            color: white;
            border: 1px solid #e91e63;
            border-radius: 25px;
            padding: 8px 14px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            font-weight: 500;
        }

        .btn:hover {
            background: white;
            color: #e91e63;
            transform: scale(1.05);
        }

        .btn-primary {
            background: #e91e63;
            color: white;
            border-color: #e91e63;
        }

        .btn-primary:hover {
            background: #d81b60;
        }

        .btn-danger {
            background: #ef4444;
            color: white;
            border-color: #ef4444;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .btn-success {
            background: #10b981;
            color: white;
            border-color: #10b981;
        }

        .btn-success:hover {
            background: #059669;
        }

        .cart-btn {
            position: relative;
        }

        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #ef4444;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Content Area */
        .content {
            padding: 1.5rem;
        }

        .content-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .content-title {
            font-size: 2rem;
            font-weight: bold;
        }

        /* Tab Content */
        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        /* Search Results */
        .search-results {
            background: #f8fafc;
            padding: 1rem;
            border-radius: 25px;
            margin-bottom: 1rem;
            border-left: 4px solid #e91e63;
            display: none;
        }

        .search-results.show {
            display: block;
        }

        /* Cards */
        .card {
            background: white;
            border: 1px solid rgba(233, 30, 99, 0.2);
            border-radius: 25px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .card-header {
            margin-bottom: 1rem;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .card-description {
            color: #64748b;
            font-size: 0.875rem;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            border: 1px solid rgba(233, 30, 99, 0.2);
            border-radius: 25px;
            padding: 1.5rem;
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }

        .stat-title {
            font-size: 0.875rem;
            color: #64748b;
        }

        .stat-icon {
            color: #e91e63;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 0.25rem;
        }

        .stat-change {
            font-size: 0.75rem;
            color: #64748b;
        }

        /* Products Grid */
        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .product-card {
            background: white;
            border: 1px solid rgba(233, 30, 99, 0.2);
            border-radius: 25px;
            overflow: hidden;
            transition: transform 0.2s;
        }

        .product-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .product-image {
            width: 100%;
            height: 200px;
            background: #fed2ed;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #e91e63;
            font-size: 3rem;
        }

        .product-content {
            padding: 1rem;
        }

        .product-name {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .product-price {
            font-size: 1.25rem;
            font-weight: bold;
            color: #059669;
            margin-bottom: 0.5rem;
        }

        .product-rating {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            margin-bottom: 1rem;
        }

        .star {
            color: #fbbf24;
        }

        .product-actions {
            display: flex;
            gap: 0.5rem;
        }

        /* Modal */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2000;
            display: none;
        }

        .modal-overlay.show {
            display: flex;
        }

        .modal {
            background: white;
            border-radius: 25px;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 2rem;
        }

        .modal-header {
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .modal-description {
            color: #64748b;
        }

        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #64748b;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(233, 30, 99, 0.2);
            border-radius: 25px;
            font-size: 0.875rem;
        }

        .form-textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(233, 30, 99, 0.2);
            border-radius: 25px;
            font-size: 0.875rem;
            min-height: 100px;
            resize: vertical;
        }

        .radio-group {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .radio-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem;
            border: 1px solid rgba(233, 30, 99, 0.2);
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .radio-item:hover {
            background: #f8fafc;
        }

        .radio-item.selected {
            border-color: #e91e63;
            background: #fed2ed;
        }

        .radio-input {
            margin: 0;
        }

        .radio-label {
            flex: 1;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem;
            border: 1px solid rgba(233, 30, 99, 0.2);
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .checkbox-item:hover {
            background: #f8fafc;
        }

        .checkbox-item.checked {
            border-color: #e91e63;
            background: #fed2ed;
        }

        .price-breakdown {
            border-top: 1px solid rgba(233, 30, 99, 0.2);
            padding-top: 1rem;
            margin-top: 1rem;
        }

        .price-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .price-total {
            display: flex;
            justify-content: space-between;
            font-weight: bold;
            font-size: 1.125rem;
            border-top: 1px solid rgba(233, 30, 99, 0.2);
            padding-top: 0.5rem;
            margin-top: 0.5rem;
        }

        .modal-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .order-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1rem;
            border: 1px solid rgba(233, 30, 99, 0.2);
            border-radius: 25px;
            margin-bottom: 1rem;
        }

        .order-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .order-image {
            width: 50px;
            height: 50px;
            background: #fed2ed;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #e91e63;
            font-size: 1.5rem;
        }

        .badge {
            padding: 6px 14px;
            border-radius: 25px;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .badge-warning {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-secondary {
            background: #fed2ed;
            color: #475569;
        }

        .badge-danger {
            background: #fecaca;
            color: #991b1b;
        }

        .progress-bar {
            width: 100%;
            height: 8px;
            background: #fed2ed;
            border-radius: 25px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            background: #e91e63;
            transition: width 0.3s;
        }

        .wishlist-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
        }

        .wishlist-item {
            background: white;
            border: 1px solid rgba(233, 30, 99, 0.2);
            border-radius: 25px;
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .wishlist-image {
            width: 60px;
            height: 60px;
            background: #fed2ed;
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }

        .payment-method {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem;
            border: 1px solid rgba(233, 30, 99, 0.2);
            border-radius: 25px;
            margin-bottom: 1rem;
        }

        .filter-bar {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .filter-select {
            padding: 0.5rem;
            border: 1px solid rgba(233, 30, 99, 0.2);
            border-radius: 25px;
            background: white;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .profile-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #fed2ed;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1rem;
        }

        .profile-info {
            text-align: center;
            margin-bottom: 2rem;
        }

        .profile-name {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .profile-email {
            color: #64748b;
            margin-bottom: 1rem;
        }

        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }

            .header {
                flex-wrap: wrap;
                gap: 0.5rem;
            }

            .search-container {
                order: 3;
                flex-basis: 100%;
                max-width: none;
                margin-top: 1rem;
            }

            .header-actions {
                margin-left: 0;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }

            .modal {
                width: 95%;
                padding: 1rem;
            }

            .grid-2 {
                grid-template-columns: 1fr;
            }

            .filter-bar {
                flex-direction: column;
            }

            .action-buttons {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-logo">📦</div>
                <span class="sidebar-title">ShopDash</span>
            </div>
            
            <nav>
                <ul class="sidebar-nav">
                    <li><a href="#" onclick="navigateToSection('browse')" data-section="browse">🔍 Browse Items</a></li>
                    <li><a href="#" onclick="navigateToSection('cart')" data-section="cart">🛒 Cart <span class="badge" id="cart-count">3</span></a></li>
                    <li><a href="#" onclick="navigateToSection('wishlist')" data-section="wishlist">❤️ Wishlist <span class="badge">12</span></a></li>
                    <li><a href="#" onclick="navigateToSection('orders')" data-section="orders">📦 Track Orders</a></li>
                    <li><a href="#" onclick="navigateToSection('history')" data-section="history">📋 Order History</a></li>
                    <li><a href="#" onclick="navigateToSection('payments')" data-section="payments">💳 Payments</a></li>
                    <li><a href="#" onclick="navigateToSection('customize')" data-section="customize">🎁 Customize Items</a></li>
                    <li><a href="#" onclick="navigateToSection('account')" data-section="account">👤 Account</a></li>
                    <li><a href="#" onclick="navigateToSection('settings')" data-section="settings">⚙️ Settings</a></li>
                </ul>
            </nav>
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

    <script>
        let currentSection = 'overview';
        let searchTerm = '';
        let cartCount = 3;
        
        // Pricing variables
        let subtotal = 379.97;
        let giftWrapPrice = 0;
        let deliveryPrice = 0;
        let personalMessagePrice = 0;

        // Page titles for different sections
        const pageTitles = {
            'overview': 'Welcome back, John!',
            'browse': 'Browse Items',
            'cart': 'Shopping Cart',
            'wishlist': 'Your Wishlist',
            'orders': 'Track Orders',
            'history': 'Order History',
            'payments': 'Payment Methods',
            'customize': 'Customize Items',
            'account': 'Account Settings',
            'settings': 'Preferences'
        };

        function navigateToSection(sectionName) {
            // Hide all sections
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Remove active class from all sidebar links
            document.querySelectorAll('.sidebar-nav a').forEach(link => {
                link.classList.remove('active');
            });
            
            // Show selected section
            const targetSection = document.getElementById(`section-${sectionName}`);
            if (targetSection) {
                targetSection.classList.add('active');
            } else {
                // If section doesn't exist, show overview
                document.getElementById('section-overview').classList.add('active');
                sectionName = 'overview';
            }
            
            // Add active class to clicked sidebar link
            const activeLink = document.querySelector(`[data-section="${sectionName}"]`);
            if (activeLink) {
                activeLink.classList.add('active');
            }
            
            // Update page title
            const pageTitle = document.getElementById('pageTitle');
            pageTitle.textContent = pageTitles[sectionName] || 'ShopDash';
            
            currentSection = sectionName;
            
            // Close mobile menu if open
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.remove('mobile-open');
            
            // Clear search when navigating
            document.getElementById('searchInput').value = '';
            handleSearch();
        }

        function toggleMobileMenu() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('mobile-open');
        }

        function handleSearch() {
            const input = document.getElementById('searchInput');
            searchTerm = input.value.toLowerCase();
            
            const searchResults = document.getElementById('searchResults');
            const searchTermSpan = document.getElementById('searchTerm');
            
            if (searchTerm) {
                searchResults.classList.add('show');
                searchTermSpan.textContent = searchTerm;
                
                // Filter products if on browse section
                if (currentSection === 'browse') {
                    const products = document.querySelectorAll('.product-card');
                    products.forEach(product => {
                        const name = product.getAttribute('data-name');
                        if (name && name.includes(searchTerm)) {
                            product.style.display = 'block';
                        } else {
                            product.style.display = 'none';
                        }
                    });
                }
            } else {
                searchResults.classList.remove('show');
                
                // Show all products
                if (currentSection === 'browse') {
                    document.querySelectorAll('.product-card').forEach(product => {
                        product.style.display = 'block';
                    });
                }
            }
        }

        // Product filtering and sorting functions
        function filterProducts(type, value) {
            const products = document.querySelectorAll('.product-card');
            products.forEach(product => {
                let show = true;
                
                if (type === 'category' && value) {
                    const category = product.getAttribute('data-category');
                    show = category === value;
                } else if (type === 'price' && value) {
                    const price = parseFloat(product.getAttribute('data-price'));
                    if (value === '0-100') show = price <= 100;
                    else if (value === '100-500') show = price > 100 && price <= 500;
                    else if (value === '500+') show = price > 500;
                }
                
                product.style.display = show ? 'block' : 'none';
            });
        }

        function sortProducts(sortBy) {
            const grid = document.getElementById('productsGrid');
            const products = Array.from(grid.children);
            
            products.sort((a, b) => {
                if (sortBy === 'price-low') {
                    return parseFloat(a.getAttribute('data-price')) - parseFloat(b.getAttribute('data-price'));
                } else if (sortBy === 'price-high') {
                    return parseFloat(b.getAttribute('data-price')) - parseFloat(a.getAttribute('data-price'));
                } else if (sortBy === 'name') {
                    return a.getAttribute('data-name').localeCompare(b.getAttribute('data-name'));
                }
                return 0;
            });
            
            products.forEach(product => grid.appendChild(product));
        }

        // Cart functions
        function addToCart(itemName, price) {
            cartCount++;
            document.querySelector('.cart-badge').textContent = cartCount;
            document.getElementById('cart-count').textContent = cartCount;
            
            showNotification(`${itemName} added to cart!`, 'success');
        }

        function removeFromCart(button) {
            const orderItem = button.closest('.order-item');
            orderItem.remove();
            
            cartCount--;
            document.querySelector('.cart-badge').textContent = cartCount;
            document.getElementById('cart-count').textContent = cartCount;
            
            updateCartTotal();
            showNotification('Item removed from cart', 'info');
        }

        function updateQuantity(button, change) {
            const qtySpan = button.parentElement.querySelector('span');
            let qty = parseInt(qtySpan.textContent);
            qty = Math.max(1, qty + change);
            qtySpan.textContent = qty;
            updateCartTotal();
        }

        function updateCartTotal() {
            const remainingItems = document.querySelectorAll('#cartItems .order-item').length;
            const newSubtotal = remainingItems * 100;
            document.getElementById('cartSubtotal').textContent = `$${newSubtotal.toFixed(2)}`;
        }

        function clearCart() {
            if (confirm('Are you sure you want to clear your cart?')) {
                document.getElementById('cartItems').innerHTML = '';
                cartCount = 0;
                document.querySelector('.cart-badge').textContent = cartCount;
                document.getElementById('cart-count').textContent = cartCount;
                updateCartTotal();
                showNotification('Cart cleared', 'info');
            }
        }

        function saveForLater() {
            showNotification('Items saved for later!', 'success');
        }

        // Wishlist functions
        function toggleWishlist(button) {
            const isInWishlist = button.style.color === 'red';
            
            if (isInWishlist) {
                button.style.color = '';
                showNotification('Removed from wishlist', 'info');
            } else {
                button.style.color = 'red';
                showNotification('Added to wishlist!', 'success');
            }
        }

        function filterWishlist(filter) {
            const items = document.querySelectorAll('.wishlist-item');
            items.forEach(item => {
                const status = item.getAttribute('data-status');
                let show = true;
                
                if (filter === 'sale') show = status === 'sale';
                else if (filter === 'available') show = status === 'available';
                
                item.style.display = show ? 'flex' : 'none';
            });
        }

        function removeFromWishlist(button) {
            const item = button.closest('.wishlist-item');
            item.remove();
            showNotification('Item removed from wishlist', 'info');
        }

        function clearWishlist() {
            if (confirm('Are you sure you want to clear your wishlist?')) {
                document.querySelectorAll('.wishlist-item').forEach(item => item.remove());
                showNotification('Wishlist cleared', 'info');
            }
        }

        // Order functions
        function filterOrders(status) {
            showNotification(`Filtering orders by: ${status || 'all'}`, 'info');
        }

        function refreshOrderStatus() {
            showNotification('Order status refreshed!', 'success');
        }

        function trackOrder(orderId) {
            showNotification(`Tracking order ${orderId}`, 'info');
        }

        function contactSupport(orderId) {
            showNotification(`Opening support chat for order ${orderId}`, 'info');
        }

        function cancelOrder(orderId) {
            if (confirm(`Are you sure you want to cancel order ${orderId}?`)) {
                showNotification(`Order ${orderId} cancelled`, 'success');
            }
        }

        function reorderItems(orderId) {
            showNotification(`Items from order ${orderId} added to cart!`, 'success');
        }

        function downloadInvoice(orderId) {
            showNotification(`Downloading invoice for order ${orderId}`, 'info');
        }

        function returnOrder(orderId) {
            showNotification(`Return initiated for order ${orderId}`, 'info');
        }

        function modifyOrder(orderId) {
            showNotification(`Opening order modification for ${orderId}`, 'info');
        }

        function exportHistory() {
            showNotification('Exporting order history...', 'info');
        }

        function filterByDate(date) {
            showNotification(`Filtering by date: ${date}`, 'info');
        }

        function filterByStatus(status) {
            showNotification(`Filtering by status: ${status}`, 'info');
        }

        // Payment functions
        function editPaymentMethod(id) {
            showNotification(`Editing payment method ${id}`, 'info');
        }

        function setDefaultPayment(id) {
            showNotification(`Set payment method ${id} as default`, 'success');
        }

        function removePaymentMethod(id) {
            if (confirm('Are you sure you want to remove this payment method?')) {
                showNotification(`Payment method ${id} removed`, 'info');
            }
        }

        function addPaymentMethod() {
            showNotification('Opening add payment method form', 'info');
        }

        function addBankAccount() {
            showNotification('Opening add bank account form', 'info');
        }

        function viewBillingHistory() {
            showNotification('Opening billing history', 'info');
        }

        // Customization functions
        function filterCustomizable(category) {
            const products = document.querySelectorAll('#section-customize .product-card');
            products.forEach(product => {
                const productCategory = product.getAttribute('data-category');
                const show = !category || productCategory === category;
                product.style.display = show ? 'block' : 'none';
            });
        }

        function openCustomizer(product) {
            showNotification(`Opening customizer for ${product}`, 'info');
        }

        function viewTemplates(product) {
            showNotification(`Viewing templates for ${product}`, 'info');
        }

        function viewCustomDesigns() {
            showNotification('Opening your custom designs', 'info');
        }

        // Account functions
        function openEditProfile() {
            document.getElementById('editProfileModal').classList.add('show');
        }

        function closeEditProfile() {
            document.getElementById('editProfileModal').classList.remove('show');
        }

        function saveProfile() {
            const firstName = document.getElementById('firstName').value;
            const lastName = document.getElementById('lastName').value;
            const email = document.getElementById('email').value;
            
            // Update profile display
            document.querySelector('.profile-name').textContent = `${firstName} ${lastName}`;
            document.querySelector('.profile-email').textContent = email;
            
            closeEditProfile();
            showNotification('Profile updated successfully!', 'success');
        }

        function uploadProfilePicture() {
            showNotification('Opening file picker for profile picture', 'info');
        }

        function changePassword() {
            showNotification('Opening change password form', 'info');
        }

        function editAddress(type) {
            showNotification(`Editing ${type} address`, 'info');
        }

        function removeAddress(type) {
            if (confirm(`Are you sure you want to remove the ${type} address?`)) {
                showNotification(`${type} address removed`, 'info');
            }
        }

        function addNewAddress() {
            showNotification('Opening add new address form', 'info');
        }

        function enableTwoFactor() {
            showNotification('Setting up two-factor authentication', 'info');
        }

        function viewLoginActivity() {
            showNotification('Opening login activity log', 'info');
        }

        function manageDevices() {
            showNotification('Opening device management', 'info');
        }

        // Settings functions
        function updateNotificationSetting(type, enabled) {
            showNotification(`${type} notifications ${enabled ? 'enabled' : 'disabled'}`, 'success');
        }

        function changeTheme(theme) {
            showNotification(`Theme changed to ${theme}`, 'success');
        }

        function changeLanguage(language) {
            showNotification(`Language changed to ${language}`, 'success');
        }

        function changeCurrency(currency) {
            showNotification(`Currency changed to ${currency}`, 'success');
        }

        function updatePrivacySetting(type, enabled) {
            showNotification(`Privacy setting ${type} ${enabled ? 'enabled' : 'disabled'}`, 'success');
        }

        function saveAllSettings() {
            showNotification('All settings saved successfully!', 'success');
        }

        function resetToDefaults() {
            if (confirm('Are you sure you want to reset all settings to defaults?')) {
                showNotification('Settings reset to defaults', 'info');
            }
        }

        function deleteAccount() {
            if (confirm('Are you sure you want to delete your account? This action cannot be undone.')) {
                showNotification('Account deletion initiated', 'warning');
            }
        }

        // Checkout functions
        function openCheckout() {
            document.getElementById('checkoutModal').classList.add('show');
            updatePricing();
        }

        function closeCheckout() {
            document.getElementById('checkoutModal').classList.remove('show');
        }

        function selectGiftWrap(type, price) {
            document.querySelectorAll('#checkoutModal .radio-group .radio-item').forEach(item => {
                if (item.querySelector('input[name="giftWrap"]')) {
                    item.classList.remove('selected');
                }
            });
            
            event.currentTarget.classList.add('selected');
            giftWrapPrice = price;
            updatePricing();
        }

        function selectDelivery(type, price) {
            document.querySelectorAll('#checkoutModal .radio-group .radio-item').forEach(item => {
                if (item.querySelector('input[name="delivery"]')) {
                    item.classList.remove('selected');
                }
            });
            
            event.currentTarget.classList.add('selected');
            deliveryPrice = price;
            updatePricing();
        }

        function togglePersonalMessage() {
            const checkbox = document.getElementById('personalMessageCheck');
            const textarea = document.getElementById('personalMessageText');
            const checkboxItem = event.currentTarget;
            
            checkbox.checked = !checkbox.checked;
            
            if (checkbox.checked) {
                checkboxItem.classList.add('checked');
                textarea.style.display = 'block';
                personalMessagePrice = 2.99;
            } else {
                checkboxItem.classList.remove('checked');
                textarea.style.display = 'none';
                personalMessagePrice = 0;
            }
            
            updatePricing();
        }

        function updatePricing() {
            const tax = (subtotal + giftWrapPrice + deliveryPrice + personalMessagePrice) * 0.08;
            const total = subtotal + giftWrapPrice + deliveryPrice + personalMessagePrice + tax;
            
            document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
            document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
            document.getElementById('total').textContent = `$${total.toFixed(2)}`;
            
            const giftWrapRow = document.getElementById('giftWrapRow');
            const deliveryRow = document.getElementById('deliveryRow');
            const messageRow = document.getElementById('messageRow');
            
            if (giftWrapPrice > 0) {
                giftWrapRow.style.display = 'flex';
                document.getElementById('giftWrapPrice').textContent = `+$${giftWrapPrice.toFixed(2)}`;
            } else {
                giftWrapRow.style.display = 'none';
            }
            
            if (deliveryPrice > 0) {
                deliveryRow.style.display = 'flex';
                document.getElementById('deliveryPrice').textContent = `+$${deliveryPrice.toFixed(2)}`;
            } else {
                deliveryRow.style.display = 'none';
            }
            
            if (personalMessagePrice > 0) {
                messageRow.style.display = 'flex';
                document.getElementById('messagePrice').textContent = `+$${personalMessagePrice.toFixed(2)}`;
            } else {
                messageRow.style.display = 'none';
            }
        }

        function completePurchase() {
            showNotification('Purchase completed successfully! 🎉', 'success');
            closeCheckout();
            navigateToSection('orders');
        }

        // Notification system
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            notification.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                padding: 12px 20px;
                border-radius: 6px;
                color: white;
                font-weight: 500;
                z-index: 9999;
                transform: translateX(100%);
                transition: transform 0.3s ease;
                max-width: 300px;
            `;
            
            switch (type) {
                case 'success':
                    notification.style.backgroundColor = '#10b981';
                    break;
                case 'error':
                    notification.style.backgroundColor = '#ef4444';
                    break;
                case 'warning':
                    notification.style.backgroundColor = '#f59e0b';
                    break;
                default:
                    notification.style.backgroundColor = '#3b82f6';
            }
            
            notification.textContent = message;
            document.body.appendChild(notification);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(0)';
            }, 100);
            
            setTimeout(() => {
                notification.style.transform = 'translateX(100%)';
                setTimeout(() => {
                    if (document.body.contains(notification)) {
                        document.body.removeChild(notification);
                    }
                }, 300);
            }, 3000);
        }

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            const sidebar = document.getElementById('sidebar');
            const mobileMenuBtn = document.querySelector('.mobile-menu-btn');
            
            if (window.innerWidth <= 768 && 
                sidebar.classList.contains('mobile-open') && 
                !sidebar.contains(e.target) && 
                !mobileMenuBtn.contains(e.target)) {
                sidebar.classList.remove('mobile-open');
            }
        });

        // Initialize the dashboard
        document.addEventListener('DOMContentLoaded', () => {
            navigateToSection('overview');
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GiftEase - Professional Wrapping Service Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="public/Jeshani/styles.css" />
</head>
<body>
    <div class="dashboard-layout">
        <!-- Sidebar -->
        <aside class="left_sidebar">
            <div class="sidebar-header">
                <i class="fas fa-gift logo-icon"></i>
                <span class="brand-name">GiftEase</span>
                <span class="wrapping-badge">Pro</span>
            </div>
            
            <nav class="nav-section">
                <ul>
                    <li>
                        <a href="#overview" class="nav-item active" data-tab="overview">
                            <i class="fas fa-home"></i>
                            <span>Overview</span>
                        </a>
                    </li>
                    <li>
                        <a href="#orders" class="nav-item" data-tab="orders">
                            <i class="fas fa-gift"></i>
                            <span>Wrapping Orders</span>
                            <span class="nav-badge">3</span>
                        </a>
                    </li>
                    <li>
                        <a href="#services" class="nav-item" data-tab="services">
                            <i class="fas fa-palette"></i>
                            <span>Services</span>
                        </a>
                    </li>
                    <li>
                        <a href="#gallery" class="nav-item" data-tab="gallery">
                            <i class="fas fa-images"></i>
                            <span>Portfolio</span>
                        </a>
                    </li>
                    <li>
                        <a href="#earnings" class="nav-item" data-tab="earnings">
                            <i class="fas fa-dollar-sign"></i>
                            <span>Earnings</span>
                        </a>
                    </li>
                    <li>
                        <a href="#analytics" class="nav-item" data-tab="analytics">
                            <i class="fas fa-chart-line"></i>
                            <span>Analytics</span>
                        </a>
                    </li>
                    <li>
                        <a href="#profile" class="nav-item" data-tab="profile">
                            <i class="fas fa-user"></i>
                            <span>Profile</span>
                        </a>
                    </li>
                    <li style="margin-top: 20px; border-top: 1px solid #e0e0e0; padding-top: 20px;">
                        <a href="#" onclick="logout()" style="display: flex; align-items: center; gap: 12px; padding: 14px 24px; color: #f44336; text-decoration: none;">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="dashboard-main">
            <!-- Header -->
            <header class="main-header">
                <div>
                    <button class="mobile-menu-btn" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    <h1 class="header-title">Professional Wrapping Dashboard</h1>
                    <p class="header-subtitle">Manage your gift wrapping business with ease</p>
                </div>
                
                <div class="header-actions">
                    <button class="notification-btn" onclick="showNotifications()">
                        <i class="fas fa-bell"></i>
                        <span class="notification-badge">5</span>
                    </button>
                    
                    <div class="user-profile" onclick="showProfileMenu()">
                        <div class="user-avatar">EW</div>
                        <div class="user-info">
                            <span class="user-name">Elegant Wraps</span>
                            <span class="user-status">Online</span>
                        </div>
                        <i class="fas fa-chevron-down" style="color: #666; font-size: 0.8rem;"></i>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <div class="main-content">
                <!-- Overview Tab -->
                <div id="overview" class="tab-content active">
                    <!-- Stats Cards -->
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-label">Urgent Orders</span>
                                <div class="stat-icon" style="background: linear-gradient(135deg, #ff5722, #ff7043);">
                                    <i class="fas fa-exclamation-triangle"></i>
                                </div>
                            </div>
                            <div class="stat-value">3</div>
                            <div class="stat-description">
                                <i class="fas fa-arrow-up trend-up"></i>
                                <span>2 due today, 1 overdue</span>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-label">Pending Orders</span>
                                <div class="stat-icon" style="background: linear-gradient(135deg, #ff9800, #ffb74d);">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <div class="stat-value">12</div>
                            <div class="stat-description">
                                <i class="fas fa-arrow-up trend-up"></i>
                                <span>+3 from yesterday</span>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-label">Completed Today</span>
                                <div class="stat-icon" style="background: linear-gradient(135deg, #4caf50, #66bb6a);">
                                    <i class="fas fa-check-circle"></i>
                                </div>
                            </div>
                            <div class="stat-value">8</div>
                            <div class="stat-description">
                                <i class="fas fa-arrow-up trend-up"></i>
                                <span>+2 from yesterday</span>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-label">Today's Revenue</span>
                                <div class="stat-icon" style="background: linear-gradient(135deg, #9c27b0, #ba68c8);">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                            <div class="stat-value">$156</div>
                            <div class="stat-description">
                                <i class="fas fa-arrow-up trend-up"></i>
                                <span>Avg $19.50 per order</span>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-label">Customer Rating</span>
                                <div class="stat-icon" style="background: linear-gradient(135deg, #2196f3, #42a5f5);">
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                            <div class="stat-value">4.9</div>
                            <div class="stat-description">
                                <i class="fas fa-arrow-up trend-up"></i>
                                <span>Based on 187 reviews</span>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-label">Response Time</span>
                                <div class="stat-icon" style="background: linear-gradient(135deg, #607d8b, #78909c);">
                                    <i class="fas fa-stopwatch"></i>
                                </div>
                            </div>
                            <div class="stat-value">12m</div>
                            <div class="stat-description">
                                <i class="fas fa-arrow-down trend-up"></i>
                                <span>Average response time</span>
                            </div>
                        </div>
                    </div>

                    <!-- Urgent Orders Section -->
                    <div class="section-header">
                        <div>
                            <h2 class="section-title">
                                <i class="fas fa-exclamation-triangle" style="color: #ff5722; margin-right: 8px;"></i>
                                Urgent Orders Requiring Attention
                            </h2>
                            <p class="section-subtitle">Orders with tight deadlines or special requirements</p>
                        </div>
                        <button class="btn btn-primary" onclick="refreshOrders()">
                            <i class="fas fa-sync-alt"></i>
                            Refresh
                        </button>
                    </div>

                    <div class="order-card">
                        <div class="order-header">
                            <div>
                                <div class="order-id">WRP-001</div>
                                <div style="font-size: 0.8rem; color: #666; margin-top: 4px;">
                                    <i class="fas fa-clock"></i> Created 2 hours ago
                                </div>
                            </div>
                            <span class="urgency-badge urgency-urgent">
                                <i class="fas fa-fire"></i> Urgent
                            </span>
                        </div>
                        
                        <div class="order-details">
                            <div class="detail-item">
                                <i class="fas fa-gift"></i>
                                <span>Item: <span class="detail-value">Premium Rose Bouquet</span></span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-user"></i>
                                <span>Customer: <span class="detail-value">Sarah Johnson</span></span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-phone"></i>
                                <span>Contact: <span class="detail-value">+1 (555) 123-4567</span></span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-clock"></i>
                                <span>Due: <span class="detail-value" style="color: #ff5722;">Today 2:00 PM</span></span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-dollar-sign"></i>
                                <span>Fee: <span class="detail-value">$25.00</span></span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Delivery: <span class="detail-value">Downtown Office</span></span>
                            </div>
                        </div>
                        
                        <div class="wrapping-options">
                            <h4>
                                <i class="fas fa-list-check"></i>
                                Wrapping Specifications
                            </h4>
                            <div class="option-item">
                                <span class="option-label">Paper Type:</span>
                                <span class="option-value">Premium Gold Foil</span>
                            </div>
                            <div class="option-item">
                                <span class="option-label">Ribbon Style:</span>
                                <span class="option-value">Silk Red with Bow</span>
                            </div>
                            <div class="option-item">
                                <span class="option-label">Card Message:</span>
                                <span class="option-value">"Happy Birthday Mom! Love, Sarah"</span>
                            </div>
                            <div class="option-item">
                                <span class="option-label">Special Instructions:</span>
                                <span class="option-value">Handle with extra care - fragile flowers</span>
                            </div>
                        </div>
                        
                        <div class="progress-section">
                            <div class="progress-header">
                                <span class="progress-label">
                                    <i class="fas fa-tasks"></i>
                                    Progress Status
                                </span>
                                <span class="progress-percentage">0%</span>
                            </div>
                            <div class="progress-bar">
                                <div class="progress-fill" style="width: 0%"></div>
                            </div>
                            <div style="margin-top: 8px; font-size: 0.8rem; color: #666;">
                                Status: Waiting to start
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
                            <button class="btn btn-primary" onclick="startWrapping('WRP-001')">
                                <i class="fas fa-play"></i>
                                Start Wrapping
                            </button>
                            <button class="btn btn-outline" onclick="viewOrderDetails('WRP-001')">
                                <i class="fas fa-eye"></i>
                                View Details
                            </button>
                            <button class="btn btn-ghost" onclick="contactCustomer('WRP-001')">
                                <i class="fas fa-phone"></i>
                                Contact Customer
                            </button>
                            <button class="btn btn-warning" onclick="requestExtension('WRP-001')">
                                <i class="fas fa-clock"></i>
                                Request Extension
                            </button>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="section-header">
                        <div>
                            <h2 class="section-title">
                                <i class="fas fa-bolt" style="color: #ff9800; margin-right: 8px;"></i>
                                Quick Actions
                            </h2>
                            <p class="section-subtitle">Frequently used tools and shortcuts</p>
                        </div>
                    </div>

                    <div class="services-grid">
                        <div class="service-card" onclick="createNewOrder()">
                            <div class="service-icon">
                                <i class="fas fa-plus"></i>
                            </div>
                            <h3 class="service-title">New Order</h3>
                            <p class="service-description">Create a new wrapping order manually</p>
                        </div>
                        
                        <div class="service-card" onclick="scanQRCode()">
                            <div class="service-icon">
                                <i class="fas fa-qrcode"></i>
                            </div>
                            <h3 class="service-title">Scan QR Code</h3>
                            <p class="service-description">Scan customer QR code for quick order access</p>
                        </div>
                        
                        <div class="service-card" onclick="viewInventory()">
                            <div class="service-icon">
                                <i class="fas fa-boxes"></i>
                            </div>
                            <h3 class="service-title">Check Inventory</h3>
                            <p class="service-description">View available wrapping materials</p>
                        </div>
                        
                        <div class="service-card" onclick="generateReport()">
                            <div class="service-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <h3 class="service-title">Generate Report</h3>
                            <p class="service-description">Create daily or weekly performance reports</p>
                        </div>
                    </div>
                </div>

                <!-- Orders Tab -->
                <div id="orders" class="tab-content">
                    <div class="section-header">
                        <div>
                            <h2 class="section-title">All Wrapping Orders</h2>
                            <p class="section-subtitle">Manage and track all your wrapping assignments</p>
                        </div>
                        <div style="display: flex; gap: 12px; align-items: center;">
                            <select style="padding: 8px 12px; border: 1px solid #e0e0e0; border-radius: 6px;" onchange="filterOrders(this.value)">
                                <option value="all">All Orders</option>
                                <option value="urgent">Urgent</option>
                                <option value="pending">Pending</option>
                                <option value="in-progress">In Progress</option>
                                <option value="completed">Completed</option>
                            </select>
                            <button class="btn btn-primary" onclick="createNewOrder()">
                                <i class="fas fa-plus"></i>
                                New Order
                            </button>
                        </div>
                    </div>

                    <!-- Order Cards -->
                    <div id="orders-container">
                        <!-- Urgent Order -->
                        <div class="order-card" data-status="urgent">
                            <div class="order-header">
                                <div>
                                    <div class="order-id">WRP-001</div>
                                    <div style="font-size: 0.8rem; color: #666; margin-top: 4px;">
                                        Premium Rose Bouquet → Sarah Johnson
                                    </div>
                                </div>
                                <span class="urgency-badge urgency-urgent">Urgent</span>
                            </div>
                            
                            <div style="margin-bottom: 16px;">
                                <div style="font-size: 0.9rem; color: #666; margin-bottom: 8px;">
                                    <i class="fas fa-clock"></i> Due: Today 2:00 PM • 
                                    <i class="fas fa-dollar-sign"></i> Fee: $25.00
                                </div>
                            </div>
                            
                            <div class="progress-section">
                                <div class="progress-header">
                                    <span class="progress-label">Progress</span>
                                    <span class="progress-percentage">25%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 25%"></div>
                                </div>
                            </div>
                            
                            <div style="display: flex; gap: 12px; margin-top: 16px;">
                                <button class="btn btn-primary" onclick="updateProgress('WRP-001')">
                                    <i class="fas fa-edit"></i>
                                    Update Progress
                                </button>
                                <button class="btn btn-success" onclick="markComplete('WRP-001')">
                                    <i class="fas fa-check"></i>
                                    Mark Complete
                                </button>
                            </div>
                        </div>

                        <!-- Normal Order -->
                        <div class="order-card" data-status="pending">
                            <div class="order-header">
                                <div>
                                    <div class="order-id">WRP-002</div>
                                    <div style="font-size: 0.8rem; color: #666; margin-top: 4px;">
                                        Wedding Gift Set → Michael & Emma
                                    </div>
                                </div>
                                <span class="urgency-badge urgency-normal">Normal</span>
                            </div>
                            
                            <div style="margin-bottom: 16px;">
                                <div style="font-size: 0.9rem; color: #666; margin-bottom: 8px;">
                                    <i class="fas fa-clock"></i> Due: Tomorrow 10:00 AM • 
                                    <i class="fas fa-dollar-sign"></i> Fee: $35.00
                                </div>
                            </div>
                            
                            <div class="progress-section">
                                <div class="progress-header">
                                    <span class="progress-label">Progress</span>
                                    <span class="progress-percentage">0%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 0%"></div>
                                </div>
                            </div>
                            
                            <div style="display: flex; gap: 12px; margin-top: 16px;">
                                <button class="btn btn-primary" onclick="startWrapping('WRP-002')">
                                    <i class="fas fa-play"></i>
                                    Start Wrapping
                                </button>
                                <button class="btn btn-outline" onclick="viewOrderDetails('WRP-002')">
                                    <i class="fas fa-eye"></i>
                                    View Details
                                </button>
                            </div>
                        </div>

                        <!-- In Progress Order -->
                        <div class="order-card" data-status="in-progress">
                            <div class="order-header">
                                <div>
                                    <div class="order-id">WRP-003</div>
                                    <div style="font-size: 0.8rem; color: #666; margin-top: 4px;">
                                        Birthday Surprise → David Chen
                                    </div>
                                </div>
                                <span class="urgency-badge urgency-low">Low Priority</span>
                            </div>
                            
                            <div style="margin-bottom: 16px;">
                                <div style="font-size: 0.9rem; color: #666; margin-bottom: 8px;">
                                    <i class="fas fa-clock"></i> Due: Friday 3:00 PM • 
                                    <i class="fas fa-dollar-sign"></i> Fee: $18.00
                                </div>
                            </div>
                            
                            <div class="progress-section">
                                <div class="progress-header">
                                    <span class="progress-label">Progress</span>
                                    <span class="progress-percentage">75%</span>
                                </div>
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: 75%"></div>
                                </div>
                            </div>
                            
                            <div style="display: flex; gap: 12px; margin-top: 16px;">
                                <button class="btn btn-primary" onclick="continueWrapping('WRP-003')">
                                    <i class="fas fa-play"></i>
                                    Continue
                                </button>
                                <button class="btn btn-success" onclick="markComplete('WRP-003')">
                                    <i class="fas fa-check"></i>
                                    Complete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Services Tab -->
                <div id="services" class="tab-content">
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

                    <div class="services-grid">
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-gift"></i>
                            </div>
                            <h3 class="service-title">Premium Gift Wrapping</h3>
                            <p class="service-description">High-quality wrapping paper with elegant ribbons and bows. Perfect for special occasions and luxury gifts.</p>
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
                        
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-ribbon"></i>
                            </div>
                            <h3 class="service-title">Custom Ribbons & Bows</h3>
                            <p class="service-description">Personalized ribbon designs with custom colors, patterns, and embossed messages.</p>
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
                        
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <h3 class="service-title">Handwritten Gift Cards</h3>
                            <p class="service-description">Beautiful handwritten messages on premium cardstock with calligraphy options.</p>
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
                        
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <h3 class="service-title">Luxury Gift Boxes</h3>
                            <p class="service-description">Premium presentation boxes in various sizes with magnetic closures and tissue paper.</p>
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
                        
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-truck"></i>
                            </div>
                            <h3 class="service-title">Express Delivery</h3>
                            <p class="service-description">Same-day delivery service for urgent orders within the city limits.</p>
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
                        
                        <div class="service-card">
                            <div class="service-icon">
                                <i class="fas fa-palette"></i>
                            </div>
                            <h3 class="service-title">Theme Wrapping</h3>
                            <p class="service-description">Specialized wrapping for holidays, birthdays, weddings, and corporate events.</p>
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

                <!-- Gallery Tab -->
                <div id="gallery" class="tab-content">
                    <div class="section-header">
                        <div>
                            <h2 class="section-title">Portfolio Gallery</h2>
                            <p class="section-subtitle">Showcase your best wrapping work to attract customers</p>
                        </div>
                        <div style="display: flex; gap: 12px;">
                            <select style="padding: 8px 12px; border: 1px solid #e0e0e0; border-radius: 6px;" onchange="filterGallery(this.value)">
                                <option value="all">All Categories</option>
                                <option value="premium">Premium Wrapping</option>
                                <option value="wedding">Wedding Gifts</option>
                                <option value="birthday">Birthday Gifts</option>
                                <option value="corporate">Corporate Gifts</option>
                            </select>
                            <button class="btn btn-primary" onclick="uploadPhoto()">
                                <i class="fas fa-camera"></i>
                                Upload Photo
                            </button>
                        </div>
                    </div>

                    <div class="gallery-grid">
                        <div class="gallery-item" data-category="premium">
                            <img src="https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=400&h=300&fit=crop" alt="Premium Gold Wrapping" class="gallery-image">
                            <div class="gallery-info">
                                <h4 class="gallery-title">Premium Gold Foil Wrap</h4>
                                <p class="gallery-description">Elegant gold foil wrapping with silk ribbon for luxury jewelry gift. Customer rating: 5/5 stars.</p>
                                <div style="margin-top: 12px; display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 0.8rem; color: #666;">
                                        <i class="fas fa-heart" style="color: #e91e63;"></i> 24 likes
                                    </span>
                                    <div style="display: flex; gap: 8px;">
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="editPhoto(1)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="deletePhoto(1)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="gallery-item" data-category="wedding">
                            <img src="https://images.unsplash.com/photo-1549007994-cb92caebd54b?w=400&h=300&fit=crop" alt="Wedding Gift Wrapping" class="gallery-image">
                            <div class="gallery-info">
                                <h4 class="gallery-title">Vintage Wedding Style</h4>
                                <p class="gallery-description">Classic brown kraft paper with natural twine and dried flowers for rustic wedding gifts.</p>
                                <div style="margin-top: 12px; display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 0.8rem; color: #666;">
                                        <i class="fas fa-heart" style="color: #e91e63;"></i> 18 likes
                                    </span>
                                    <div style="display: flex; gap: 8px;">
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="editPhoto(2)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="deletePhoto(2)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="gallery-item" data-category="premium">
                            <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=300&fit=crop" alt="Luxury Box Set" class="gallery-image">
                            <div class="gallery-info">
                                <h4 class="gallery-title">Luxury Presentation Box</h4>
                                <p class="gallery-description">Premium magnetic closure box with custom tissue paper and embossed logo for corporate gifts.</p>
                                <div style="margin-top: 12px; display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 0.8rem; color: #666;">
                                        <i class="fas fa-heart" style="color: #e91e63;"></i> 31 likes
                                    </span>
                                    <div style="display: flex; gap: 8px;">
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="editPhoto(3)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="deletePhoto(3)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="gallery-item" data-category="birthday">
                            <img src="https://images.unsplash.com/photo-1572569511254-d8f925fe2cbb?w=400&h=300&fit=crop" alt="Modern Minimalist" class="gallery-image">
                            <div class="gallery-info">
                                <h4 class="gallery-title">Modern Minimalist Design</h4>
                                <p class="gallery-description">Clean lines and simple elegance with geometric patterns for contemporary birthday gifts.</p>
                                <div style="margin-top: 12px; display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 0.8rem; color: #666;">
                                        <i class="fas fa-heart" style="color: #e91e63;"></i> 15 likes
                                    </span>
                                    <div style="display: flex; gap: 8px;">
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="editPhoto(4)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="deletePhoto(4)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="gallery-item" data-category="corporate">
                            <img src="https://images.unsplash.com/photo-1607344645866-009c7d0f2e8d?w=400&h=300&fit=crop" alt="Corporate Branding" class="gallery-image">
                            <div class="gallery-info">
                                <h4 class="gallery-title">Corporate Branded Wrapping</h4>
                                <p class="gallery-description">Professional wrapping with company colors and logo for executive gifts and client appreciation.</p>
                                <div style="margin-top: 12px; display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 0.8rem; color: #666;">
                                        <i class="fas fa-heart" style="color: #e91e63;"></i> 22 likes
                                    </span>
                                    <div style="display: flex; gap: 8px;">
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="editPhoto(5)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="deletePhoto(5)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="gallery-item" data-category="birthday">
                            <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=400&h=300&fit=crop" alt="Colorful Birthday Wrapping" class="gallery-image">
                            <div class="gallery-info">
                                <h4 class="gallery-title">Vibrant Birthday Collection</h4>
                                <p class="gallery-description">Bright and cheerful wrapping with rainbow ribbons and fun patterns perfect for children's birthday parties.</p>
                                <div style="margin-top: 12px; display: flex; justify-content: space-between; align-items: center;">
                                    <span style="font-size: 0.8rem; color: #666;">
                                        <i class="fas fa-heart" style="color: #e91e63;"></i> 27 likes
                                    </span>
                                    <div style="display: flex; gap: 8px;">
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="editPhoto(6)">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="deletePhoto(6)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Earnings Tab -->
                <div id="earnings" class="tab-content">
                    <div class="stats-grid" style="margin-bottom: 32px;">
                        <div class="stat-card" style="grid-column: span 2;">
                            <div style="text-align: center; padding: 20px;">
                                <div style="font-size: 3rem; font-weight: bold; background: linear-gradient(135deg, #9c27b0, #ba68c8); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 8px;">$1,847</div>
                                <div style="font-size: 1.1rem; color: #666; margin-bottom: 16px;">Total Earnings This Month</div>
                                <div style="display: flex; justify-content: center; gap: 24px; font-size: 0.9rem;">
                                    <div>
                                        <div style="font-weight: 600; color: #333;">$156</div>
                                        <div style="color: #666;">Today</div>
                                    </div>
                                    <div>
                                        <div style="font-weight: 600; color: #333;">$892</div>
                                        <div style="color: #666;">This Week</div>
                                    </div>
                                    <div>
                                        <div style="font-weight: 600; color: #333;">47</div>
                                        <div style="color: #666;">Orders Completed</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-label">Average Order Value</span>
                                <div class="stat-icon" style="background: linear-gradient(135deg, #4caf50, #66bb6a);">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                            </div>
                            <div class="stat-value">$39.30</div>
                            <div class="stat-description">
                                <i class="fas fa-arrow-up trend-up"></i>
                                <span>+12% from last month</span>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-label">Completion Rate</span>
                                <div class="stat-icon" style="background: linear-gradient(135deg, #2196f3, #42a5f5);">
                                    <i class="fas fa-percentage"></i>
                                </div>
                            </div>
                            <div class="stat-value">98.5%</div>
                            <div class="stat-description">
                                <i class="fas fa-arrow-up trend-up"></i>
                                <span>Excellent performance</span>
                            </div>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 32px;">
                        <div style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                            <h3 style="margin-bottom: 24px; color: #333; font-size: 1.2rem;">
                                <i class="fas fa-chart-pie" style="color: #9c27b0; margin-right: 8px;"></i>
                                Service Revenue Breakdown
                            </h3>
                            <div style="space-y: 16px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding: 12px; background: #f8f9fa; border-radius: 8px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 12px; height: 12px; background: #9c27b0; border-radius: 50%;"></div>
                                        <span style="font-size: 0.9rem; color: #666;">Premium Wrapping</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-weight: 600; color: #333;">$1,247</div>
                                        <div style="font-size: 0.8rem; color: #666;">67.5%</div>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding: 12px; background: #f8f9fa; border-radius: 8px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 12px; height: 12px; background: #4caf50; border-radius: 50%;"></div>
                                        <span style="font-size: 0.9rem; color: #666;">Custom Ribbons</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-weight: 600; color: #333;">$324</div>
                                        <div style="font-size: 0.8rem; color: #666;">17.5%</div>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding: 12px; background: #f8f9fa; border-radius: 8px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 12px; height: 12px; background: #ff9800; border-radius: 50%;"></div>
                                        <span style="font-size: 0.9rem; color: #666;">Gift Cards</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-weight: 600; color: #333;">$156</div>
                                        <div style="font-size: 0.8rem; color: #666;">8.4%</div>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0; padding: 12px; background: #f8f9fa; border-radius: 8px;">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="width: 12px; height: 12px; background: #2196f3; border-radius: 50%;"></div>
                                        <span style="font-size: 0.9rem; color: #666;">Gift Boxes</span>
                                    </div>
                                    <div style="text-align: right;">
                                        <div style="font-weight: 600; color: #333;">$120</div>
                                        <div style="font-size: 0.8rem; color: #666;">6.5%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                            <h3 style="margin-bottom: 24px; color: #333; font-size: 1.2rem;">
                                <i class="fas fa-calendar-alt" style="color: #9c27b0; margin-right: 8px;"></i>
                                Weekly Performance
                            </h3>
                            <div style="space-y: 12px;">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <span style="font-size: 0.9rem; color: #666;">Monday</span>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 60px; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                            <div style="height: 100%; background: #9c27b0; width: 80%;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #333; font-size: 0.9rem;">$124</span>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <span style="font-size: 0.9rem; color: #666;">Tuesday</span>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 60px; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                            <div style="height: 100%; background: #9c27b0; width: 65%;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #333; font-size: 0.9rem;">$98</span>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <span style="font-size: 0.9rem; color: #666;">Wednesday</span>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 60px; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                            <div style="height: 100%; background: #9c27b0; width: 90%;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #333; font-size: 0.9rem;">$142</span>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <span style="font-size: 0.9rem; color: #666;">Thursday</span>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 60px; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                            <div style="height: 100%; background: #9c27b0; width: 100%;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #333; font-size: 0.9rem;">$156</span>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <span style="font-size: 0.9rem; color: #666;">Friday</span>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 60px; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                            <div style="height: 100%; background: #9c27b0; width: 75%;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #333; font-size: 0.9rem;">$118</span>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                    <span style="font-size: 0.9rem; color: #666;">Saturday</span>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 60px; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                            <div style="height: 100%; background: #9c27b0; width: 95%;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #333; font-size: 0.9rem;">$148</span>
                                    </div>
                                </div>
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0;">
                                    <span style="font-size: 0.9rem; color: #666;">Sunday</span>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <div style="width: 60px; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                            <div style="height: 100%; background: #9c27b0; width: 60%;"></div>
                                        </div>
                                        <span style="font-weight: 600; color: #333; font-size: 0.9rem;">$92</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                            <h3 style="color: #333; font-size: 1.2rem;">
                                <i class="fas fa-receipt" style="color: #9c27b0; margin-right: 8px;"></i>
                                Recent Payment History
                            </h3>
                            <button class="btn btn-outline" onclick="exportPayments()">
                                <i class="fas fa-download"></i>
                                Export
                            </button>
                        </div>
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Order ID</th>
                                    <th>Service</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jan 20, 2024</td>
                                    <td>WRP-001</td>
                                    <td>Premium Gift Wrapping</td>
                                    <td>Sarah Johnson</td>
                                    <td style="font-weight: 600;">$25.00</td>
                                    <td><span class="status-badge status-paid">Paid</span></td>
                                    <td>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="viewReceipt('WRP-001')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jan 19, 2024</td>
                                    <td>WRP-002</td>
                                    <td>Custom Ribbon + Card</td>
                                    <td>Michael Chen</td>
                                    <td style="font-weight: 600;">$12.00</td>
                                    <td><span class="status-badge status-paid">Paid</span></td>
                                    <td>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="viewReceipt('WRP-002')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jan 18, 2024</td>
                                    <td>WRP-003</td>
                                    <td>Luxury Gift Box</td>
                                    <td>Emma Wilson</td>
                                    <td style="font-weight: 600;">$35.00</td>
                                    <td><span class="status-badge status-pending">Pending</span></td>
                                    <td>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="followUpPayment('WRP-003')">
                                            <i class="fas fa-phone"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jan 17, 2024</td>
                                    <td>WRP-004</td>
                                    <td>Theme Wrapping</td>
                                    <td>David Lee</td>
                                    <td style="font-weight: 600;">$28.00</td>
                                    <td><span class="status-badge status-paid">Paid</span></td>
                                    <td>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="viewReceipt('WRP-004')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Analytics Tab -->
                <div id="analytics" class="tab-content">
                    <div class="section-header">
                        <div>
                            <h2 class="section-title">Business Analytics</h2>
                            <p class="section-subtitle">Detailed insights into your wrapping business performance</p>
                        </div>
                        <div style="display: flex; gap: 12px;">
                            <select style="padding: 8px 12px; border: 1px solid #e0e0e0; border-radius: 6px;" onchange="changeAnalyticsPeriod(this.value)">
                                <option value="week">This Week</option>
                                <option value="month" selected>This Month</option>
                                <option value="quarter">This Quarter</option>
                                <option value="year">This Year</option>
                            </select>
                            <button class="btn btn-primary" onclick="generateReport()">
                                <i class="fas fa-file-pdf"></i>
                                Generate Report
                            </button>
                        </div>
                    </div>

                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-label">Total Orders</span>
                                <div class="stat-icon" style="background: linear-gradient(135deg, #9c27b0, #ba68c8);">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                            </div>
                            <div class="stat-value">47</div>
                            <div class="stat-description">
                                <i class="fas fa-arrow-up trend-up"></i>
                                <span>+23% from last month</span>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-label">Customer Retention</span>
                                <div class="stat-icon" style="background: linear-gradient(135deg, #4caf50, #66bb6a);">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="stat-value">78%</div>
                            <div class="stat-description">
                                <i class="fas fa-arrow-up trend-up"></i>
                                <span>Excellent retention rate</span>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-label">Peak Hours</span>
                                <div class="stat-icon" style="background: linear-gradient(135deg, #ff9800, #ffb74d);">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <div class="stat-value">2-6 PM</div>
                            <div class="stat-description">
                                <i class="fas fa-info-circle"></i>
                                <span>Busiest time period</span>
                            </div>
                        </div>
                        
                        <div class="stat-card">
                            <div class="stat-header">
                                <span class="stat-label">Efficiency Score</span>
                                <div class="stat-icon" style="background: linear-gradient(135deg, #2196f3, #42a5f5);">
                                    <i class="fas fa-tachometer-alt"></i>
                                </div>
                            </div>
                            <div class="stat-value">94%</div>
                            <div class="stat-description">
                                <i class="fas fa-arrow-up trend-up"></i>
                                <span>Above industry average</span>
                            </div>
                        </div>
                    </div>

                    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; margin-bottom: 32px;">
                        <div style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                            <h3 style="margin-bottom: 24px; color: #333; font-size: 1.2rem;">
                                <i class="fas fa-chart-area" style="color: #9c27b0; margin-right: 8px;"></i>
                                Revenue Trend
                            </h3>
                            <div style="height: 200px; display: flex; align-items: end; justify-content: space-between; padding: 20px; background: #f8f9fa; border-radius: 12px;">
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                    <div style="width: 30px; height: 80px; background: linear-gradient(to top, #9c27b0, #ba68c8); border-radius: 4px;"></div>
                                    <span style="font-size: 0.8rem; color: #666;">Week 1</span>
                                </div>
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                    <div style="width: 30px; height: 120px; background: linear-gradient(to top, #9c27b0, #ba68c8); border-radius: 4px;"></div>
                                    <span style="font-size: 0.8rem; color: #666;">Week 2</span>
                                </div>
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                    <div style="width: 30px; height: 100px; background: linear-gradient(to top, #9c27b0, #ba68c8); border-radius: 4px;"></div>
                                    <span style="font-size: 0.8rem; color: #666;">Week 3</span>
                                </div>
                                <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                    <div style="width: 30px; height: 160px; background: linear-gradient(to top, #9c27b0, #ba68c8); border-radius: 4px;"></div>
                                    <span style="font-size: 0.8rem; color: #666;">Week 4</span>
                                </div>
                            </div>
                        </div>
                        
                        <div style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                            <h3 style="margin-bottom: 24px; color: #333; font-size: 1.2rem;">
                                <i class="fas fa-star" style="color: #9c27b0; margin-right: 8px;"></i>
                                Customer Feedback
                            </h3>
                            <div style="space-y: 16px;">
                                <div style="margin-bottom: 16px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                        <span style="font-size: 0.9rem; color: #666;">5 Stars</span>
                                        <span style="font-size: 0.9rem; font-weight: 600;">78%</span>
                                    </div>
                                    <div style="width: 100%; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                        <div style="height: 100%; background: #4caf50; width: 78%;"></div>
                                    </div>
                                </div>
                                <div style="margin-bottom: 16px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                        <span style="font-size: 0.9rem; color: #666;">4 Stars</span>
                                        <span style="font-size: 0.9rem; font-weight: 600;">18%</span>
                                    </div>
                                    <div style="width: 100%; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                        <div style="height: 100%; background: #8bc34a; width: 18%;"></div>
                                    </div>
                                </div>
                                <div style="margin-bottom: 16px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                        <span style="font-size: 0.9rem; color: #666;">3 Stars</span>
                                        <span style="font-size: 0.9rem; font-weight: 600;">3%</span>
                                    </div>
                                    <div style="width: 100%; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                        <div style="height: 100%; background: #ff9800; width: 3%;"></div>
                                    </div>
                                </div>
                                <div style="margin-bottom: 16px;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                        <span style="font-size: 0.9rem; color: #666;">2 Stars</span>
                                        <span style="font-size: 0.9rem; font-weight: 600;">1%</span>
                                    </div>
                                    <div style="width: 100%; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                        <div style="height: 100%; background: #ff5722; width: 1%;"></div>
                                    </div>
                                </div>
                                <div style="margin-bottom: 0;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                        <span style="font-size: 0.9rem; color: #666;">1 Star</span>
                                        <span style="font-size: 0.9rem; font-weight: 600;">0%</span>
                                    </div>
                                    <div style="width: 100%; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                        <div style="height: 100%; background: #f44336; width: 0%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                        <h3 style="margin-bottom: 24px; color: #333; font-size: 1.2rem;">
                            <i class="fas fa-lightbulb" style="color: #9c27b0; margin-right: 8px;"></i>
                            Business Insights & Recommendations
                        </h3>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 20px;">
                            <div style="padding: 20px; background: linear-gradient(135deg, #e3f2fd, #bbdefb); border-radius: 12px; border-left: 4px solid #2196f3;">
                                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                                    <i class="fas fa-trending-up" style="color: #2196f3; font-size: 1.2rem;"></i>
                                    <h4 style="color: #1976d2; font-size: 1rem;">Growth Opportunity</h4>
                                </div>
                                <p style="color: #1565c0; font-size: 0.9rem; line-height: 1.4;">Your premium wrapping service has 23% higher demand. Consider expanding your premium material inventory.</p>
                            </div>
                            
                            <div style="padding: 20px; background: linear-gradient(135deg, #f3e5f5, #e1bee7); border-radius: 12px; border-left: 4px solid #9c27b0;">
                                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                                    <i class="fas fa-clock" style="color: #9c27b0; font-size: 1.2rem;"></i>
                                    <h4 style="color: #7b1fa2; font-size: 1rem;">Peak Time Insight</h4>
                                </div>
                                <p style="color: #6a1b9a; font-size: 0.9rem; line-height: 1.4;">Most orders come between 2-6 PM. Consider offering express service during these hours for premium pricing.</p>
                            </div>
                            
                            <div style="padding: 20px; background: linear-gradient(135deg, #e8f5e8, #c8e6c9); border-radius: 12px; border-left: 4px solid #4caf50;">
                                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px;">
                                    <i class="fas fa-users" style="color: #4caf50; font-size: 1.2rem;"></i>
                                    <h4 style="color: #388e3c; font-size: 1rem;">Customer Loyalty</h4>
                                </div>
                                <p style="color: #2e7d32; font-size: 0.9rem; line-height: 1.4;">78% customer retention rate is excellent! Consider implementing a loyalty program to reward repeat customers.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Profile Tab -->
                <div id="profile" class="tab-content">
                    <div class="section-header">
                        <div>
                            <h2 class="section-title">Business Profile</h2>
                            <p class="section-subtitle">Manage your business information and preferences</p>
                        </div>
                        <button class="btn btn-primary" onclick="saveProfile()">
                            <i class="fas fa-save"></i>
                            Save Changes
                        </button>
                    </div>

                    <div style="display: grid; grid-template-columns: 1fr 2fr; gap: 32px;">
                        <div style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); text-align: center;">
                            <div style="width: 120px; height: 120px; background: linear-gradient(135deg, #9c27b0, #ba68c8); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 3rem; font-weight: bold; margin: 0 auto 20px;">EW</div>
                            <h3 style="margin-bottom: 8px; color: #333;">Elegant Wraps</h3>
                            <p style="color: #666; margin-bottom: 16px;">Professional Gift Wrapping Service</p>
                            <div style="display: flex; justify-content: center; gap: 8px; margin-bottom: 20px;">
                                <div style="display: flex; align-items: center; gap: 4px;">
                                    <i class="fas fa-star" style="color: #ff9800;"></i>
                                    <span style="font-weight: 600;">4.9</span>
                                </div>
                                <span style="color: #666;">•</span>
                                <span style="color: #666;">187 reviews</span>
                            </div>
                            <button class="btn btn-outline" onclick="changeProfilePicture()">
                                <i class="fas fa-camera"></i>
                                Change Photo
                            </button>
                        </div>
                        
                        <div style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                            <h3 style="margin-bottom: 24px; color: #333; font-size: 1.2rem;">
                                <i class="fas fa-edit" style="color: #9c27b0; margin-right: 8px;"></i>
                                Business Information
                            </h3>
                            <form style="space-y: 20px;">
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Business Name</label>
                                    <input type="text" value="Elegant Wraps" style="width: 100%; padding: 12px; border: 1px solid #e0e0e0; border-radius: 8px; font-size: 0.9rem;">
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Email Address</label>
                                    <input type="email" value="contact@elegantwraps.com" style="width: 100%; padding: 12px; border: 1px solid #e0e0e0; border-radius: 8px; font-size: 0.9rem;">
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Phone Number</label>
                                    <input type="tel" value="+1 (555) 123-4567" style="width: 100%; padding: 12px; border: 1px solid #e0e0e0; border-radius: 8px; font-size: 0.9rem;">
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Business Address</label>
                                    <textarea rows="3" style="width: 100%; padding: 12px; border: 1px solid #e0e0e0; border-radius: 8px; font-size: 0.9rem; resize: vertical;">123 Main Street, Suite 456
Downtown District
New York, NY 10001</textarea>
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Business Description</label>
                                    <textarea rows="4" style="width: 100%; padding: 12px; border: 1px solid #e0e0e0; border-radius: 8px; font-size: 0.9rem; resize: vertical;">Professional gift wrapping service specializing in premium presentations for all occasions. We offer custom designs, luxury materials, and same-day service for your special gifts.</textarea>
                                </div>
                                <div style="margin-bottom: 20px;">
                                    <label style="display: block; margin-bottom: 8px; font-weight: 600; color: #333;">Operating Hours</label>
                                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                                        <input type="time" value="09:00" style="padding: 12px; border: 1px solid #e0e0e0; border-radius: 8px; font-size: 0.9rem;">
                                        <input type="time" value="18:00" style="padding: 12px; border: 1px solid #e0e0e0; border-radius: 8px; font-size: 0.9rem;">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08); margin-top: 24px;">
                        <h3 style="margin-bottom: 24px; color: #333; font-size: 1.2rem;">
                            <i class="fas fa-cog" style="color: #9c27b0; margin-right: 8px;"></i>
                            Preferences & Settings
                        </h3>
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 24px;">
                            <div>
                                <h4 style="margin-bottom: 16px; color: #333;">Notification Settings</h4>
                                <div style="space-y: 12px;">
                                    <label style="display: flex; align-items: center; gap: 12px; cursor: pointer; margin-bottom: 12px;">
                                        <input type="checkbox" checked style="width: 18px; height: 18px;">
                                        <span style="color: #666;">Email notifications for new orders</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 12px; cursor: pointer; margin-bottom: 12px;">
                                        <input type="checkbox" checked style="width: 18px; height: 18px;">
                                        <span style="color: #666;">SMS alerts for urgent orders</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 12px; cursor: pointer; margin-bottom: 12px;">
                                        <input type="checkbox" style="width: 18px; height: 18px;">
                                        <span style="color: #666;">Daily summary reports</span>
                                    </label>
                                    <label style="display: flex; align-items: center; gap: 12px; cursor: pointer; margin-bottom: 0;">
                                        <input type="checkbox" checked style="width: 18px; height: 18px;">
                                        <span style="color: #666;">Customer feedback notifications</span>
                                    </label>
                                </div>
                            </div>
                            
                            <div>
                                <h4 style="margin-bottom: 16px; color: #333;">Business Settings</h4>
                                <div style="space-y: 16px;">
                                    <div style="margin-bottom: 16px;">
                                        <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #666;">Default Service Fee</label>
                                        <input type="number" value="15" min="0" step="0.01" style="width: 100%; padding: 10px; border: 1px solid #e0e0e0; border-radius: 6px; font-size: 0.9rem;">
                                    </div>
                                    <div style="margin-bottom: 16px;">
                                        <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #666;">Rush Order Multiplier</label>
                                        <select style="width: 100%; padding: 10px; border: 1px solid #e0e0e0; border-radius: 6px; font-size: 0.9rem;">
                                            <option value="1.5" selected>1.5x</option>
                                            <option value="2.0">2.0x</option>
                                            <option value="2.5">2.5x</option>
                                        </select>
                                    </div>
                                    <div style="margin-bottom: 0;">
                                        <label style="display: block; margin-bottom: 8px; font-weight: 500; color: #666;">Auto-Accept Orders</label>
                                        <select style="width: 100%; padding: 10px; border: 1px solid #e0e0e0; border-radius: 6px; font-size: 0.9rem;">
                                            <option value="manual" selected>Manual Review</option>
                                            <option value="auto">Auto Accept</option>
                                            <option value="conditions">Based on Conditions</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="script.js"></script>
</body>
</html>
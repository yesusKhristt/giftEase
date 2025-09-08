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
        $activePage = 'overview';
        include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarJeshani.php';
        ?>
        <!-- <div id="home" class="tab-content active"> -->
        <!-- Home page -->
        <div class="main-content">


            <!-- Main Content -->
            <main class="dashboard-main">
                <header class="browse-header">
                    <div class="topbar-container" style="display: flex; align-items: center; padding: 10px 20px;">
                        <!-- Logo -->
                        <div><span class="gift">
                                gift<b style="color:#000000">Ease</b>
                            </span>
                        </div>


                        <!-- Search Bar -->
                        <div class="search-bar">
                            <input type="text" class="search-input" placeholder="Search..." />
                        </div>

                        <!-- Right Side Links/Buttons -->
                        <nav class="topbar-actions" style="display: flex; gap: 16px;">
                            <a href="#">Login</a>
                            <a href="#">Sign Up</a>
                            <a href="#" class="settings-btn">
                                <i class="fas fa-cog"></i>
                            </a>
                        </nav>
                    </div>
                </header>
                <!-- Header -->
                <!-- <header class="main-header">
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
            </header> -->

                <!-- Main Content Area -->

                <div class="main-content">
                    <!-- Overview Tab -->
                    <div id="overview" class="tab-content active">
                        <!-- Stats Cards -->
                        <div class="card">
                            <div class="stats-grid">
                                <div class="cardColour">
                                    <div class="stat-header">
                                        <span class="stat-label">Urgent Orders</span>
                                        <!-- <div class="stat-icon"
                                        style="background: linear-gradient(135deg, #ff5722, #ff7043);"> -->
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <!-- </div> -->
                                    </div>
                                    <div class="stat-value">3</div>
                                    <div class="stat-description">
                                        <i class="fas fa-arrow-up trend-up"></i>
                                        <span>2 due today, 1 overdue</span>
                                    </div>
                                </div>

                                <div class="cardColour">
                                    <div class="stat-header">
                                        <span class="stat-label">Pending Orders</span>
                                        <!-- <div class="stat-icon" -->
                                        <!-- style="background: linear-gradient(135deg, #ff9800, #ffb74d);"> -->
                                        <i class="fas fa-clock"></i>
                                        <!-- </div> -->
                                    </div>
                                    <div class="stat-value">12</div>
                                    <div class="stat-description">
                                        <i class="fas fa-arrow-up trend-up"></i>
                                        <span>+3 from yesterday</span>
                                    </div>
                                </div>

                                <div class="cardColour">
                                    <div class="stat-header">
                                        <span class="stat-label">Completed Today</span>
                                        <!-- <div class="stat-icon" -->
                                        <!-- style="background: linear-gradient(135deg, #4caf50, #66bb6a);"> -->
                                        <i class="fas fa-check-circle"></i>
                                        <!-- </div> -->
                                    </div>
                                    <div class="stat-value">8</div>
                                    <div class="stat-description">
                                        <i class="fas fa-arrow-up trend-up"></i>
                                        <span>+2 from yesterday</span>
                                    </div>
                                </div>

                                <div class="cardColour">
                                    <div class="stat-header">
                                        <span class="stat-label">Today's Revenue</span>
                                        <!-- <div class="stat-icon" -->
                                        <!-- style="background: linear-gradient(135deg, #9c27b0, #ba68c8);"> -->
                                        <i class="fas fa-dollar-sign"></i>
                                        <!-- </div> -->
                                    </div>
                                    <div class="stat-value">$156</div>
                                    <div class="stat-description">
                                        <i class="fas fa-arrow-up trend-up"></i>
                                        <span>Avg $19.50 per order</span>
                                    </div>
                                </div>

                                <div class="cardColour">
                                    <div class="stat-header">
                                        <span class="stat-label">Customer Rating</span>
                                        <!-- <div class="stat-icon" -->
                                        <!-- style="background: linear-gradient(135deg, #2196f3, #42a5f5);"> -->
                                        <i class="fas fa-star"></i>
                                        <!-- </div> -->
                                    </div>
                                    <div class="stat-value">4.9</div>
                                    <div class="stat-description">
                                        <i class="fas fa-arrow-up trend-up"></i>
                                        <span>Based on 187 reviews</span>
                                    </div>
                                </div>

                                <div class="cardColour">
                                    <div class="stat-header">
                                        <span class="stat-label">Response Time</span>
                                        <!-- <div class="stat-icon" -->
                                        <!-- style="background: linear-gradient(135deg, #607d8b, #78909c);"> -->
                                        <i class="fas fa-stopwatch"></i>
                                        <!-- </div> -->
                                    </div>
                                    <div class="stat-value">12m</div>
                                    <div class="stat-description">
                                        <i class="fas fa-arrow-down trend-up"></i>
                                        <span>Average response time</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Urgent Orders Section -->
                        <div class="card">
                            <!-- <div class="section-header"> -->
                            <div>
                                <h2 class="section-title">
                                    <i class="fas fa-exclamation-triangle"
                                        style="color: #e91e63; margin-right: 8px;"></i>
                                    Urgent Orders Requiring Attention
                                </h2>
                                <p class="section-subtitle">Orders with tight deadlines or special requirements</p>
                            </div>
                            <button class="btn1" onclick="refreshOrders()">
                                <i class="fas fa-sync-alt"></i>
                                Refresh
                            </button>
                            <!-- </div> -->
                        </div>

                        <div class="card">
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
                                    <span>Due: <span class="detail-value" ;">Today 2:00
                                            PM</span></span>
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

                            <div class="card">
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
                                <button class="btn1" onclick="startWrapping('WRP-001')">
                                    <i class="fas fa-play"></i>
                                    Start Wrapping
                                </button>
                                <button class="btn1" onclick="viewOrderDetails('WRP-001')">
                                    <i class="fas fa-eye"></i>
                                    View Details
                                </button>
                                <button class="btn1" onclick="contactCustomer('WRP-001')">
                                    <i class="fas fa-phone"></i>
                                    Contact Customer
                                </button>
                                <button class="btn1" onclick="requestExtension('WRP-001')">
                                    <i class="fas fa-clock"></i>
                                    Request Extension
                                </button>
                            </div>
                        </div>

                        <!-- Quick Actions -->

                        <div class="card">
                            <div class="section-header">
                                <div>
                                    <h2 class="section-title">
                                        <i class="fas fa-bolt" style="color: #e91e63; margin-right: 8px;"></i>
                                        Quick Actions
                                    </h2>
                                    <p class="section-subtitle">Frequently used tools and shortcuts</p>
                                </div>
                            </div>


                            <div class="services-grid">
                                <div class="cardColour" onclick="createNewOrder()">
                                    <div class="service-icon">
                                        <i class="fas fa-plus"></i>
                                    </div>
                                    <h3 class="service-title">New Order</h3>
                                    <p class="service-description">Create a new wrapping order manually</p>
                                </div>

                                <div class="cardColour" onclick="scanQRCode()">
                                    <div class="service-icon">
                                        <i class="fas fa-qrcode"></i>
                                    </div>
                                    <h3 class="service-title">Scan QR Code</h3>
                                    <p class="service-description">Scan customer QR code for quick order access</p>
                                </div>

                                <div class="cardColour" onclick="viewInventory()">
                                    <div class="service-icon">
                                        <i class="fas fa-boxes"></i>
                                    </div>
                                    <h3 class="service-title">Check Inventory</h3>
                                    <p class="service-description">View available wrapping materials</p>
                                </div>

                                <div class="cardColour" onclick="generateReport()">
                                    <div class="service-icon">
                                        <i class="fas fa-chart-bar"></i>
                                    </div>
                                    <h3 class="service-title">Generate Report</h3>
                                    <p class="service-description">Create daily or weekly performance reports</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    </div>


    <script src="script.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GiftEase - Professional Wrapping Service Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- <a href="index.html"></a> -->
    <div class="dashboard-layout">
        <!-- Sidebar -->
        <aside class="left_sidebar">
            <div class="profile-section">
                <div class="profile-picture">
                    <i class="fas fa-user"></i>
                </div>
                <div class="username">Jeshani Shavindya</div>
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

            <!-- <div class="sidebar-header">
                <i class="fas fa-gift logo-icon"></i>
                <span class="brand-name">GiftEase</span>
                <span class="wrapping-badge">Pro</span>
            </div> -->

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
                </ul>
            </nav>
            <div class="button-section"
                style="display: flex; justify-content: center; align-items: center; margin-top: 24px;">
                <a href="#logout" class="btn"
                    style="width: 100%; display: flex; align-items: center; justify-content: center;">
                    <i class="fas fa-sign-out-alt" style="margin-right: 8px;"></i>
                    Log Out
                </a>
            </div>
        </aside>

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
                                <i class="fas fa-exclamation-triangle" style="color: #e91e63; margin-right: 8px;"></i>
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
                                <span>Due: <span class="detail-value";">Today 2:00
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


            <script src="script.js"></script>
</body>

</html>
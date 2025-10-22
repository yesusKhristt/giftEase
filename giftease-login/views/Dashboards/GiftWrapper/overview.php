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
        <div class="main-content">
            <div id="overview" class="tab-content active">
                <div class="card">
                    <div class="summary-grid">
                        <div class="card">
                            <div class="title">Urgent Orders : 3</div>
                            <div class="subtitle">2 due today, 1 overdue</div>
                        </div>
                        <div class="card">
                            <div class="title">Pending Orders : 12</div>
                            <div class="subtitle">+3 from yesterday</div>
                        </div>
                        <div class="card">
                            <div class="title">Completed Today : 8</div>
                            <div class="subtitle">+2 from yesterday</div>
                        </div>
                    </div>

                    <div class="summary-grid">
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

                <div class="card">
                    <div class="summary-grid">
                        <div>
                            <h2>Urgent Orders Requiring Attention</h2>
                            <p class="section-subtitle">Orders with tight deadlines or special requirements</p>
                        </div>
                        <div style="display: flex; justify-content: flex-end; gap: 12px; flex-wrap: wrap; width: 100%;">
                            <button class="btn1" onclick="refreshOrders()">
                                <i class="fas fa-sync-alt"></i>
                                Refresh
                            </button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="summary-grid">
                        <div class="title">WRP-001</div>
                        <div style="display: flex; justify-content: flex-end; gap: 12px; flex-wrap: wrap; width: 100%;">
                            <button class="btn1" onclick="Urgent()">
                                <i class="fas fa-fire"></i>
                                Urgent
                            </button>
                        </div>
                    </div>

                    <div class="order-details">
                        <div class="summary-grid">
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
                        </div>
                        <div class="summary-grid">
                            <div class="detail-item">
                                <i class="fas fa-clock"></i>
                                <span>Due: <span class="detail-value" ;">Today 2:00PM</span></span>
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
                    </div>

                    <div class="card">
                        <h4>
                            <i class="fas fa-list-check"></i>
                            Wrapping Specifications
                        </h4>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Specification</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Paper Type</td>
                                    <td>Premium Gold Foil</td>
                                </tr>
                                <tr>
                                    <td>Ribbon Style</td>
                                    <td>Silk Red with Bow</td>
                                </tr>
                                <tr>
                                    <td>Card Message</td>
                                    <td>"Happy Birthday Mom! Love, Sarah"</td>
                                </tr>
                                <tr>
                                    <td>Special Instructions</td>
                                    <td>Handle with extra care - fragile flowers</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="progress-section">
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
                    </div> -->

                    <!-- <div style="display: flex; gap: 12px; flex-wrap: wrap;"> -->
                    <div class="summary-grid">
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
                <div class="card">
                    <div class="title">
                        <i class="fas fa-bolt" style="color: #e91e63; margin-right: 8px;"></i>
                        Quick Actions
                    </div>
                    <p class="section-subtitle">Frequently used tools and shortcuts</p>
                    <div class="summary-grid">
                        <div class="card" onclick="createNewOrder()">
                            <i class="fas fa-plus"></i>
                            <div class="title">New Order</div>
                            <p class="service-description">Create a new wrapping order manually</p>
                        </div>
                        <div class="card" onclick="scanQRCode()">
                            <i class="fas fa-qrcode"></i>
                            <div class="title">Scan QR Code</div>
                            <p class="service-description">Scan customer QR code for quick order access</p>
                        </div>
                    </div>
                    <div class="summary-grid">
                        <div class="card" onclick="viewInventory()">
                            <i class="fas fa-boxes"></i>
                            <div class="title">Check Inventory</div>
                            <p class="service-description">View available wrapping materials</p>
                        </div>
                        <div class="card" onclick="generateReport()">
                            <i class="fas fa-chart-bar"></i>
                            <div class="title">Generate Report</div>
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
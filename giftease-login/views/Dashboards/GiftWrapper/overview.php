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
                        <div class="cardColour">
                            <div class="title">Urgent Orders : 3</div>
                            <div class="subtitle">2 due today, 1 overdue</div>
                        </div>

                        <div class="cardColour">
                            <div class="title">Pending Orders : 12</div>
                            <div class="subtitle">+3 from yesterday</div>
                        </div>

                        <div class="cardColour">
                            <div class="title">Completed Today : 8</div>
                            <div class="subtitle">+2 from yesterday</div>
                        </div>
                    </div>

                    <div class="summary-grid">
                        <div class="cardColour">
                            <div class="title">Today's Revenue : $156</div>
                            <div class="subtitle">Avg $19.50 per order</div>
                        </div>

                        <div class="cardColour">
                            <div class="title">Customer Rating : 4.9 </div>
                            <div class="subtitle">Based on 187 reviews</div>
                        </div>

                        <div class="cardColour">
                            <div class="title">Response Time : 12m </div>
                            <div class="subtitle">Average response time</div>
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
                        <div class="cardColour" onclick="createNewOrder()">
                                <i class="fas fa-plus"></i>
                            
                            <div class="title">New Order</div>
                            <p class="service-description">Create a new wrapping order manually</p>
                        </div>

                        <div class="cardColour" onclick="scanQRCode()">
                            
                                <i class="fas fa-qrcode"></i>
                           
                            <div class="title">Scan QR Code</div>
                            <p class="service-description">Scan customer QR code for quick order access</p>
                        </div>
                        </div>
                        
                        <div class="summary-grid">
                        <div class="cardColour" onclick="viewInventory()">
                           
                                <i class="fas fa-boxes"></i>
                            
                            <div class="title">Check Inventory</div>
                            <p class="service-description">View available wrapping materials</p>
                        </div>

                        <div class="cardColour" onclick="generateReport()">
                            
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
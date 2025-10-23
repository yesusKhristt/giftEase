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

</head>
<body>
    <div class="container">
        <?php
        $activePage = 'overview';
        include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarJeshani.php';
        ?>
        <div class="main-content">
            <div id="overview" class="tab-content active">
              
                
                    <div class="summary-grid">
                        <div class="card">
                                
                                    <i class="fas fa-exclamation-triangle"></i>
                         
                            <h4>Urgent Orders : 3</h4>

                            
                           
                             <i class="fas fa-arrow-up trend-up"></i>
                                
                            <div class="subtitle">2 due today, 1 overdue</div>
                        </div>
                        <div class="card">
                           
                             <i class="fas fa-clock"></i>
                             <h4>Pending Orders : 12</h4>
                                    <i class="fas fa-arrow-up trend-up"></i>
                            <div class="subtitle">+3 from yesterday</div>
                        </div>
                        <div class="card">
                            
                             <i class="fas fa-check-circle"></i>
                             <h4>Completed Today : 8</h4>
                                    <i class="fas fa-arrow-up trend-up"></i>
                            <div class="subtitle">+2 from yesterday</div>
                        </div>
                    </div>

                    <div class="summary-grid">
                        <div class="card">
                            
                               <i class="fas fa-rupee-sign"></i>
                            <h4>Today's Avenue : Rs156</h4>
                                   <i class="fas fa-arrow-up trend-up"></i>
                            <div class="subtitle">Avg Rs19.50 per order</div>
                        </div>
                        <div class="card">
                            
                              <i class="fas fa-star"></i>
                            <h4>Customer Rating : 4.9</h4>
                                   <i class="fas fa-arrow-up trend-up"></i>
                            <div class="subtitle">Based on 187 reviews</div>
                        </div>
                        <div class="card">
                            
                             <i class="fas fa-stopwatch"></i>
                            <h4>Response Time : 12min</h4>
                                   <i class="fas fa-arrow-up trend-up"></i>
                            <div class="subtitle">Average response time</div>
                        </div>
                    </div>
              

                <div class="card">
                    <div class="summary-grid">
                        <div>
                            <h2>Refreshing Orders</h2>
                            <p class="section-subtitle">Orders with tight deadlines</p>
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
                                <span>Customer: <span class="detail-value">Sara Dissanayake</span></span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-phone"></i> 
                                <span>Contact: <span class="detail-value">+94 7601306</span></span>
                            </div>
                        </div>
                        <div class="summary-grid">
                            <div class="detail-item">
                                <i class="fas fa-clock"></i>
                                <span>Due: <span class="detail-value" ;">Today 2:00PM</span></span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-rupee-sign"></i>
                                <span>Fee: <span class="detail-value">Rs2500.00</span></span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>Delivery: <span class="detail-value">Colombo Office</span></span>
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
                   
               
                    <div class="summary-grid">
                        <div class="card" onclick="viewInventory()">
                            <i class="fas fa-boxes"></i>
                            
                            <h4>Check Inventory</h4>
                            <p class="service-description">View available wrapping materials</p>
                        </div>
                        <div class="card" onclick="generateReport()">
                            <i class="fas fa-chart-bar"></i>
                            
                            <h4>Generate Report</h4>
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
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
        $activePage = 'order';
        include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarJeshani.php';
        ?>

        <div class="main-content">
            <div class="page-header">
                <h1 class="title">All Wrapping Orders</h2>
                    <p class="subtitle">Manage and track all your wrapping assignments</p>
                    <div style="display: flex; gap: 12px; align-items: center;">
                        <select style="padding: 8px 12px; border: 1px solid #e0e0e0; border-radius: 6px;"
                            onchange="filterOrders(this.value)">
                            <option value="all">All Orders</option>
                            <option value="urgent">Urgent</option>
                            <option value="pending">My Orders</option>
                            <!-- <option value="in-progress">In Progress</option> -->
                            <option value="completed">Completed</option>
                        </select>
                        <!-- <button class="btn1" onclick="createNewOrder()">
                            <i class="fas fa-plus"></i>
                            New Order
                        </button> -->
                    </div>
            </div>

            <!-- Order Cards -->

            <div class="card">
                <!-- <div class="summary-grid"> -->
                    <!-- <div style="display: flex; justify-content: flex-start; gap: 12px; flex-wrap: wrap; width: 100%;"> -->
                        <!-- <button class="btn1" onclick="allOrders()"> -->
                            <!-- <i class="fas fa-list"></i> -->
                            <div class="title">All Orders</div>
                        <!-- </button> -->
                    <!-- </div> -->

                    <!-- <div style="display: flex; justify-content: flex-end; gap: 12px; flex-wrap: wrap; width: 100%;">
                        <button class="btn1" onclick="myOrders()">
                            <i class="fas fa-list"></i>
                            My Orders
                        </button>
                    </div> -->
                <!-- </div> -->
           
            <!-- <div class="summary-grid"> -->
            <div class="card">
                <div class="title">WRP-001</div>
                <div class="subtitle">
                    Premium Rose Bouquet → Sarah Johnson
                </div>
                <span class="urgency-badge urgency-urgent">Urgent</span>
                <div style="margin-bottom: 16px;">
                    <div style="font-size: 0.9rem; color: #666; margin-bottom: 8px;">
                        <i class="fas fa-clock"></i> Due: Today 2:00 PM •
                        <i class="fas fa-dollar-sign"></i> Fee: $25.00
                    </div>
                </div>

                <div class="progress-section">
                    <div class="progress-header">
                        <!-- <span class="progress-label">Progress</span> -->
                        <!-- <span class="progress-percentage">25%</span> -->
                    </div>

                    <div class="summary-grid">
                        <button class="btn1" onclick="startWrapping('WRP-001')">
                            <i class="fas fa-play"></i>
                            Start Wrapping
                        </button>

                        <button class="btn1" onclick="markComplete('WRP-001')">
                            <i class="fas fa-check"></i>
                            Mark Complete
                        </button>
                    </div>

                </div>

                <div class="title">WRP-002</div>
                <div class="subtitle">
                    Wedding Gift Set → Michael & Emma
                </div>
                <span class="urgency-badge urgency-urgent">Normal</span>
                <div style="margin-bottom: 16px;">
                    <div style="font-size: 0.9rem; color: #666; margin-bottom: 8px;">
                        <i class="fas fa-clock"></i> Due: Tomorrow 10:00 AM •
                        <i class="fas fa-dollar-sign"></i> Fee: $35.00
                    </div>
                </div>

                <div class="progress-section">
                    <div class="progress-header">
                        <!-- <span class="progress-label">Progress</span> -->
                        <!-- <span class="progress-percentage">0%</span> -->
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 0%"></div>
                    </div>

                    <div class="summary-grid">
                        <button class="btn1" onclick="startWrapping('WRP-002')">
                            <i class="fas fa-play"></i>
                            Start Wrapping
                        </button>
                        <button class="btn1" onclick="markComplete('WRP-002')">
                            <i class="fas fa-check"></i>
                            Mark Complete
                        </button>
                    </div>
                </div>

                <div class="title">WRP-003</div>
                <div class="subtitle">
                    Birthday Surprise → David Chen
                </div>
                <span class="urgency-badge urgency-low">Low Priority</span>
                <div style="margin-bottom: 16px;">
                    <div style="font-size: 0.9rem; color: #666; margin-bottom: 8px;">
                        <i class="fas fa-clock"></i> Due: Friday 3:00 PM •
                        <i class="fas fa-dollar-sign"></i> Fee: $18.00
                    </div>
                </div>

                <div class="progress-section">
                    <div class="progress-header">
                        <!-- <span class="progress-label">Progress</span> -->
                        <!-- <span class="progress-percentage">75%</span> -->
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 75%"></div>
                    </div>

                    <div class="summary-grid">
                        <button class="btn1" onclick="continueWrapping('WRP-003')">
                            <i class="fas fa-play"></i>
                            Continue
                        </button>
                        <button class="btn1" onclick="markComplete('WRP-001')">
                            <i class="fas fa-check"></i>
                            Mark Complete
                        </button>
                    </div>
                </div>

                <div class="title">WRP-004</div>
                <div class="subtitle">
                    Birthday Surprise → Edvad Marker
                </div>
                <span class="urgency-badge urgency-low">Low Priority</span>
                <div style="margin-bottom: 16px;">
                    <div style="font-size: 0.9rem; color: #666; margin-bottom: 8px;">
                        <i class="fas fa-clock"></i> Due: Friday 3:00 PM •
                        <i class="fas fa-dollar-sign"></i> Fee: $18.00
                    </div>
                </div>

                <div class="progress-section">
                    <div class="progress-header">
                        <!-- <span class="progress-label">Progress</span> -->
                        <!-- <span class="progress-percentage">60%</span> -->
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 75%"></div>
                    </div>

                    <div class="summary-grid">
                        <button class="btn1" onclick="continueWrapping('WRP-003')">
                            <i class="fas fa-play"></i>
                            Continue
                        </button>
                        <button class="btn1" onclick="markComplete('WRP-001')">
                            <i class="fas fa-check"></i>
                            Mark Complete
                        </button>
                    </div>
                </div>

                <div class="title">WRP-005</div>
                <div class="subtitle">
                    Aniversary Surprise → Robhin  Williams                </div>
                <span class="urgency-badge urgency-low">Normal</span>
                <div style="margin-bottom: 16px;">
                    <div style="font-size: 0.9rem; color: #666; margin-bottom: 8px;">
                        <i class="fas fa-clock"></i> Due: Friday 3:00 PM •
                        <i class="fas fa-dollar-sign"></i> Fee: $18.00
                    </div>
                </div>

                <div class="progress-section">
                    <div class="progress-header">
                        <!-- <span class="progress-label">Progress</span> -->
                        <!-- <span class="progress-percentage">15%</span> -->
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 75%"></div>
                    </div>

                    <div class="summary-grid">
                        <button class="btn1" onclick="continueWrapping('WRP-003')">
                            <i class="fas fa-play"></i>
                            Continue
                        </button>
                        <button class="btn1" onclick="markComplete('WRP-001')">
                            <i class="fas fa-check"></i>
                            Mark Complete
                        </button>
                    </div>
                </div>

                <div class="title">WRP-006</div>
                <div class="subtitle">
                    Christmas Surprise → Shain banes
                </div>
                <span class="urgency-badge urgency-low">High</span>
                <div style="margin-bottom: 16px;">
                    <div style="font-size: 0.9rem; color: #666; margin-bottom: 8px;">
                        <i class="fas fa-clock"></i> Due: Friday 3:00 PM •
                        <i class="fas fa-dollar-sign"></i> Fee: $18.00
                    </div>
                </div>

                <div class="progress-section">
                    <div class="progress-header">
                        <!-- <span class="progress-label">Progress</span> -->
                        <!-- <span class="progress-percentage">75%</span> -->
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 75%"></div>
                    </div>

                    <div class="summary-grid">
                        <button class="btn1" onclick="continueWrapping('WRP-003')">
                            <i class="fas fa-play"></i>
                            Continue
                        </button>
                        <button class="btn1" onclick="markComplete('WRP-001')">
                            <i class="fas fa-check"></i>
                            Mark Complete
                        </button>
                    </div>
                </div>

                <div class="title">WRP-007</div>
                <div class="subtitle">
                    Valentine Surprise → Baker hood
                </div>
                <span class="urgency-badge urgency-low">Low Priority</span>
                <div style="margin-bottom: 16px;">
                    <div style="font-size: 0.9rem; color: #666; margin-bottom: 8px;">
                        <i class="fas fa-clock"></i> Due: Friday 3:00 PM •
                        <i class="fas fa-dollar-sign"></i> Fee: $18.00
                    </div>
                </div>

                <div class="progress-section">
                    <div class="progress-header">
                        <!-- <span class="progress-label">Progress</span> -->
                        <!-- <span class="progress-percentage">0%</span> -->
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: 75%"></div>
                    </div>

                    <div class="summary-grid">
                        <button class="btn1" onclick="continueWrapping('WRP-003')">
                            <i class="fas fa-play"></i>
                            Continue
                        </button>
                        <button class="btn1" onclick="markComplete('WRP-001')">
                            <i class="fas fa-check"></i>
                            Mark Complete
                        </button>
                    </div>
                </div>

            </div>


        </div>
    </div>
    </div>
    <script src="script.js"></script>
</body>

</html>
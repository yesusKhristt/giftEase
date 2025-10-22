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
                            <option value="completed">Completed</option>
                        </select>
                    </div>
            </div>
            <div class="card">
                <div class="title">All Orders</div>
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
                        Birthday Surprise → David Chen
                    </div>
                    <span class="urgency-badge urgency-low">Normal</span>
                    <div style="margin-bottom: 16px;">
                        <div style="font-size: 0.9rem; color: #666; margin-bottom: 8px;">
                            <i class="fas fa-clock"></i> Due: Friday 3:00 PM •
                            <i class="fas fa-dollar-sign"></i> Fee: $18.00
                        </div>
                    </div>

                    <div class="progress-section">
                        <div class="progress-header">
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
                        Birthday Surprise → David Chen
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
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="order-actions">
    <div class="summary-grid">
        <button class="btn1" onclick="startWrapping('DEL-001')">Start Wrapping</button>
        <button class="btn1" onclick="markComplete('DEL-001')">Mark Complete</button>
    </div>
</div>

<script>
    function startWrapping(orderId) {
        Swal.fire({
            title: 'Wrapping Started!',
            text: 'You have started wrapping order ' + orderId + '.',
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }

    function markComplete(orderId) {
        Swal.fire({
            title: 'Mark Complete!',
            text: 'You have marked order ' + orderId + ' as complete.',
            icon: 'success',
            confirmButtonText: 'Great!'
        });
    }
</script>

</html>
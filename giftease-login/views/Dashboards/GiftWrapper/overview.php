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
        include 'views\commonElements/leftSidebarJeshani.php';

        $allOrdersCount = $allOrdersCount ?? 0;
        $totalAssignedOrdersCount = $totalAssignedOrdersCount ?? 0;
        $pendingOrdersCount = $pendingOrdersCount ?? 0;
        $completedOrdersCount = $completedOrdersCount ?? 0;
        $weeklyRevenue = $weeklyRevenue ?? 0;
        $weeklyOrderCount = $weeklyOrderCount ?? 0;
        $avgWeeklyPerOrder = $avgWeeklyPerOrder ?? 0;
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Dashboard Overview</h1>
                <p class="subtitle">Your live performance snapshot</p>
            </div>
                <div class="summary-grid">
                    <div class="card">
                        <i class="fas fa-user-check"></i>
                        <h4>Total Assigned Orders: <?= htmlspecialchars($totalAssignedOrdersCount) ?></h4>
                        <div class="subtitle">All orders assigned to you</div>
                    </div>
                    <div class="card">
                        <i class="fas fa-check-circle"></i>
                        <h4>Completed Orders: <?= htmlspecialchars($completedOrdersCount) ?></h4>
                        <div class="subtitle">Successfully wrapped</div>
                    </div>
                    <div class="card">
                        <i class="fas fa-clock"></i>
                        <h4>Pending Orders: <?= htmlspecialchars($pendingOrdersCount) ?></h4>
                        <div class="subtitle">Awaiting completion</div>
                    </div>
                    <div class="card">
                        <i class="fas fa-rupee-sign"></i>
                        <h4>Weekly Total Avenue: Rs<?= htmlspecialchars(number_format($weeklyRevenue, 2)) ?></h4>
                        <div class="subtitle">Avg Rs<?= htmlspecialchars(number_format($avgWeeklyPerOrder, 2)) ?> / order</div>
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
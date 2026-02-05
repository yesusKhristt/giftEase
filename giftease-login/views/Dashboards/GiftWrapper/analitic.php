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

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'analytics';
        include 'views\commonElements/leftSidebarJeshani.php';
        
        // Extract analytics data (passed from controller)
        $totalOrders = $analyticsData['totalOrders'] ?? 0;
        $completedOrders = $analyticsData['completedOrders'] ?? 0;
        $pendingOrders = $analyticsData['pendingOrders'] ?? 0;
        $monthlyGrowth = $analyticsData['monthlyGrowth'] ?? 0;
        $customerRetention = $analyticsData['customerRetention'] ?? 0;
        $efficiencyScore = $analyticsData['efficiencyScore'] ?? 0;
        $ordersByMonth = $analyticsData['ordersByMonth'] ?? [];
        $peakHours = $analyticsData['peakHours'] ?? 'N/A';
        $averageRating = $analyticsData['averageRating'] ?? 0;
        ?>

        <div class="main-content">
            <div class="section-header">
                <div>
                    <h2 class="section-title">Business Analytics</h2>
                    <p class="section-subtitle">Detailed insights into your wrapping business performance</p>
                </div>
                <div style="display: flex; gap: 12px;">
                    <select style="padding: 8px 12px; border: 1px solid #e0e0e0; border-radius: 6px;"
                        onchange="changeAnalyticsPeriod(this.value)">
                        <option value="week">This Week</option>
                        <option value="month" selected>This Month</option>
                        <option value="quarter">This Quarter</option>
                        <option value="year">This Year</option>
                    </select>
                    <button class="btn1" onclick="generateReport()">
                        <i class="fas fa-file-pdf"></i>
                        Generate Report
                    </button>
                </div>
            </div>

            <div class="card">
                <div class="summary-grid">
                    <div class="card">
                        <div class="stat-header">
                            <span class="stat-label">Total Orders</span>
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                        <div class="stat-value"><?php echo number_format($totalOrders); ?></div>
                        <div class="stat-description">
                            <i class="fas fa-arrow-<?php echo $monthlyGrowth >= 0 ? 'up trend-up' : 'down trend-down'; ?>"></i>
                            <span><?php echo ($monthlyGrowth >= 0 ? '+' : '') . $monthlyGrowth; ?>% from last month</span>
                        </div>
                    </div>



                    <div class="card">
                        <div class="stat-header">
                            <span class="stat-label">Customer Retention</span>

                            <i class="fas fa-users"></i>

                        </div>
                        <div class="stat-value"><?php echo $customerRetention; ?>%</div>
                        <div class="stat-description">
                            <i class="fas fa-arrow-up trend-up"></i>
                            <span><?php echo $customerRetention >= 70 ? 'Excellent' : ($customerRetention >= 50 ? 'Good' : 'Needs improvement'); ?> retention rate</span>
                        </div>
                    </div>
                </div>



                <div class="summary-grid">
                    <div class="card">
                        <div class="stat-header">
                            <span class="stat-label">Peak Hours</span>

                            <i class="fas fa-clock"></i>

                        </div>
                        <div class="stat-value"><?php echo htmlspecialchars($peakHours); ?></div>
                        <div class="stat-description">
                            <i class="fas fa-info-circle"></i>
                            <span>Busiest time period</span>
                        </div>
                    </div>



                    <div class="card">
                        <div class="stat-header">
                            <span class="stat-label">Efficiency Score</span>

                            <i class="fas fa-tachometer-alt"></i>

                        </div>
                        <div class="stat-value"><?php echo $efficiencyScore; ?>%</div>
                        <div class="stat-description">
                            <i class="fas fa-arrow-<?php echo $efficiencyScore >= 80 ? 'up trend-up' : 'down trend-down'; ?>"></i>
                            <span><?php echo $efficiencyScore >= 80 ? 'Above industry average' : 'Room for improvement'; ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Order Status Summary -->
            <div class="card">
                <div class="summary-grid">
                    <div class="card" style="background: linear-gradient(135deg, #4CAF50 0%, #45a049 100%); color: white;">
                        <div class="stat-header">
                            <span class="stat-label" style="color: white;">Completed Orders</span>
                            <i class="fas fa-check-circle" style="color: white;"></i>
                        </div>
                        <div class="stat-value" style="color: white;"><?php echo number_format($completedOrders); ?></div>
                    </div>
                    <div class="card" style="background: linear-gradient(135deg, #ff9800 0%, #f57c00 100%); color: white;">
                        <div class="stat-header">
                            <span class="stat-label" style="color: white;">Pending Orders</span>
                            <i class="fas fa-clock" style="color: white;"></i>
                        </div>
                        <div class="stat-value" style="color: white;"><?php echo number_format($pendingOrders); ?></div>
                    </div>
                </div>
            </div>
            
            <div class="card">
                <h3 style="margin-bottom: 24px; color: #333; font-size: 1.2rem;">
                    <i class="fas fa-chart-area" style="color: #e91e63; margin-right: 8px;"></i>
                    Wrapping Orders by Month
                </h3>
                <canvas id="riskChart"></canvas>
            </div>


            <div class="card">

            </div>

            <div class="card">
                <div
                    style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                    <h3 style="margin-bottom: 24px; color: #333; font-size: 1.2rem;">
                        <i class="fas fa-star" style="color: #e91e63; margin-right: 8px;"></i>
                        Customer Feedback
                    </h3>
                    <div style="space-y: 16px;">
                        <div style="margin-bottom: 16px;">
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span style="font-size: 0.9rem; color: #666;">5 Stars</span>
                                <span style="font-size: 0.9rem; font-weight: 600;">78%</span>
                            </div>
                            <div
                                style="width: 100%; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                <div style="height: 100%; background: #e91e63; width: 78%;"></div>
                            </div>
                        </div>
                        <div style="margin-bottom: 16px;">
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span style="font-size: 0.9rem; color: #666;">4 Stars</span>
                                <span style="font-size: 0.9rem; font-weight: 600;">18%</span>
                            </div>
                            <div
                                style="width: 100%; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                <div style="height: 100%; background: #e91e63; width: 18%;"></div>
                            </div>
                        </div>
                        <div style="margin-bottom: 16px;">
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span style="font-size: 0.9rem; color: #666;">3 Stars</span>
                                <span style="font-size: 0.9rem; font-weight: 600;">3%</span>
                            </div>
                            <div
                                style="width: 100%; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                <div style="height: 100%; background: #e91e63; width: 3%;"></div>
                            </div>
                        </div>
                        <div style="margin-bottom: 16px;">
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span style="font-size: 0.9rem; color: #666;">2 Stars</span>
                                <span style="font-size: 0.9rem; font-weight: 600;">1%</span>
                            </div>
                            <div
                                style="width: 100%; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                <div style="height: 100%; background: #e91e63; width: 1%;"></div>
                            </div>
                        </div>
                        <div style="margin-bottom: 0;">
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <span style="font-size: 0.9rem; color: #666;">1 Star</span>
                                <span style="font-size: 0.9rem; font-weight: 600;">0%</span>
                            </div>
                            <div
                                style="width: 100%; height: 6px; background: #e0e0e0; border-radius: 3px; overflow: hidden;">
                                <div style="height: 100%; background: #e91e63; width: 0%;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                style="background: white; border-radius: 16px; padding: 28px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);">
                <h3 style="margin-bottom: 24px; color: #333; font-size: 1.2rem;">
                    <i class="fas fa-lightbulb" style="color: #e91e63; margin-right: 8px;"></i>
                    Business Insights & Recommendations
                </h3>
                <div class="summary-grid">
                    <div class="card">
                        <h4>Growth Opportunity</h4>
                        <p><?php 
                            if ($monthlyGrowth > 0) {
                                echo "Great progress! You've grown by {$monthlyGrowth}% this month. Keep up the excellent work!";
                            } else if ($monthlyGrowth == 0) {
                                echo "Your orders are stable. Consider promoting your services to attract new customers.";
                            } else {
                                echo "Orders have decreased by " . abs($monthlyGrowth) . "%. Consider reaching out to past clients or offering promotions.";
                            }
                        ?></p>
                    </div>
                    <div class="card">
                        <h4>Peak Time Insight</h4>
                        <p>Most orders come during <?php echo htmlspecialchars($peakHours); ?>. Consider offering express service during these hours for
                            premium pricing.</p>
                    </div>
                    <div class="card">
                        <h4>Customer Loyalty</h4>
                        <p><?php 
                            if ($customerRetention >= 70) {
                                echo "{$customerRetention}% customer retention rate is excellent! Consider implementing a loyalty program to reward repeat customers.";
                            } else if ($customerRetention >= 50) {
                                echo "{$customerRetention}% retention is good. Focus on quality to increase repeat business.";
                            } else {
                                echo "Focus on customer satisfaction to improve retention from {$customerRetention}%.";
                            }
                        ?></p>
                    </div>
                </div>


            </div>
        </div>
    </div>



    <script>
        // Prepare data for charts from PHP
        const ordersByMonth = <?php echo json_encode($ordersByMonth); ?>;
        
        const riskCtx = document.getElementById('riskChart').getContext('2d');

        const riskData = {
            labels: ordersByMonth.length > 0 ? ordersByMonth.map(item => item.month_name || item.month) : ['No Data'],
            datasets: [
                {
                    label: 'Completed',
                    data: ordersByMonth.length > 0 ? ordersByMonth.map(item => parseInt(item.completed) || 0) : [0],
                    backgroundColor: '#4CAF50',
                    borderRadius: 6,
                    barThickness: 28
                },
                {
                    label: 'Pending',
                    data: ordersByMonth.length > 0 ? ordersByMonth.map(item => parseInt(item.pending) || 0) : [0],
                    backgroundColor: '#ff9800',
                    borderRadius: 6,
                    barThickness: 28
                }
            ]
        };

        const riskConfig = {
            type: 'bar',
            data: riskData,
            options: {
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: { boxWidth: 12, boxHeight: 12, padding: 12 }
                    },
                    tooltip: { mode: 'index', intersect: false }
                },
                scales: {
                    x: {
                        stacked: true,
                        grid: { display: false },
                        ticks: { color: '#374151', font: { size: 12 } }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5,
                            color: '#6b7280',
                            font: { size: 12 }
                        },
                        grid: {
                            borderDash: [4, 4],
                            color: 'rgba(15, 23, 42, 0.06)'
                        }
                    }
                }
            }
        };

        new Chart(riskCtx, riskConfig);
    </script>
</body>

</html>
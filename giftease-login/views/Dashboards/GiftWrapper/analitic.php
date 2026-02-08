<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Analytics - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="profile" href="profile.php" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .page-header {
            margin-bottom: 24px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 16px;
        }
        .page-header h1 {
            font-size: 1.8rem;
            color: #333;
            margin-bottom: 4px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .page-header h1 i {
            color: #e91e63;
        }
        .page-header p {
            color: #666;
            font-size: 0.95rem;
        }
        .header-actions {
            display: flex;
            gap: 12px;
            align-items: center;
        }
        .header-actions select {
            padding: 10px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            background: white;
            font-size: 0.9rem;
            cursor: pointer;
            transition: border-color 0.2s;
        }
        .header-actions select:hover {
            border-color: #e91e63;
        }
        .btn-report {
            background: linear-gradient(135deg, #e91e63 0%, #c2185b 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 500;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .btn-report:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(233, 30, 99, 0.4);
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 24px;
        }
        .stat-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s, box-shadow 0.2s;
            position: relative;
            overflow: hidden;
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
        }
        .stat-card.primary {
            background: linear-gradient(135deg, #e91e63 0%, #c2185b 100%);
            color: white;
        }
        .stat-card.success {
            background: linear-gradient(135deg, #66bb6a 0%, #43a047 100%);
            color: white;
        }
        .stat-card.warning {
            background: linear-gradient(135deg, #ffa726 0%, #fb8c00 100%);
            color: white;
        }
        .stat-card.info {
            background: linear-gradient(135deg, #42a5f5 0%, #1e88e5 100%);
            color: white;
        }
        .stat-card.purple {
            background: linear-gradient(135deg, #ab47bc 0%, #8e24aa 100%);
            color: white;
        }
        .stat-card .stat-icon {
            font-size: 2rem;
            opacity: 0.9;
            margin-bottom: 12px;
        }
        .stat-card .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 4px;
        }
        .stat-card .stat-label {
            font-size: 0.95rem;
            opacity: 0.9;
            margin-bottom: 8px;
        }
        .stat-card .stat-change {
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 4px;
            opacity: 0.9;
        }
        .section-card {
            background: white;
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 24px;
        }
        .section-card h3 {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .section-card h3 i {
            color: #e91e63;
        }
        .chart-container {
            position: relative;
            height: 300px;
        }
        .feedback-section {
            padding: 24px;
        }
        .feedback-bar {
            margin-bottom: 16px;
        }
        .feedback-bar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        .feedback-bar-header span {
            font-size: 0.9rem;
            color: #666;
        }
        .feedback-bar-header .percent {
            font-weight: 600;
            color: #333;
        }
        .progress-bar {
            width: 100%;
            height: 8px;
            background: #e0e0e0;
            border-radius: 4px;
            overflow: hidden;
        }
        .progress-bar .fill {
            height: 100%;
            background: linear-gradient(135deg, #e91e63 0%, #c2185b 100%);
            border-radius: 4px;
            transition: width 0.5s ease;
        }
        .insights-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 20px;
        }
        .insight-card {
            background: #fafafa;
            border-radius: 12px;
            padding: 20px;
            border-left: 4px solid #e91e63;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .insight-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        .insight-card h4 {
            color: #333;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .insight-card h4 i {
            color: #e91e63;
        }
        .insight-card p {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.5;
        }
    </style>
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
            <div class="page-header">
                <div>
                    <h1><i class="fas fa-chart-line"></i> Business Analytics</h1>
                    <p>Detailed insights into your wrapping business performance</p>
                </div>
                <div class="header-actions">
                    <select onchange="changeAnalyticsPeriod(this.value)">
                        <option value="week">This Week</option>
                        <option value="month" selected>This Month</option>
                        <option value="quarter">This Quarter</option>
                        <option value="year">This Year</option>
                    </select>
                    <button class="btn-report" onclick="generateReport()">
                        <i class="fas fa-file-pdf"></i>
                        Generate Report
                    </button>
                </div>
            </div>

            <!-- Main Stats -->
            <div class="stats-grid">
                <div class="stat-card primary">
                    <i class="fas fa-shopping-bag stat-icon"></i>
                    <div class="stat-value"><?php echo number_format($totalOrders); ?></div>
                    <div class="stat-label">Total Orders</div>
                    <div class="stat-change">
                        <i class="fas fa-arrow-<?php echo $monthlyGrowth >= 0 ? 'up' : 'down'; ?>"></i>
                        <span><?php echo ($monthlyGrowth >= 0 ? '+' : '') . $monthlyGrowth; ?>% from last month</span>
                    </div>
                </div>
                <div class="stat-card success">
                    <i class="fas fa-check-circle stat-icon"></i>
                    <div class="stat-value"><?php echo number_format($completedOrders); ?></div>
                    <div class="stat-label">Completed Orders</div>
                    <div class="stat-change">
                        <i class="fas fa-thumbs-up"></i>
                        <span>Successfully wrapped</span>
                    </div>
                </div>
                <div class="stat-card warning">
                    <i class="fas fa-clock stat-icon"></i>
                    <div class="stat-value"><?php echo number_format($pendingOrders); ?></div>
                    <div class="stat-label">Pending Orders</div>
                    <div class="stat-change">
                        <i class="fas fa-hourglass-half"></i>
                        <span>Awaiting completion</span>
                    </div>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card purple">
                    <i class="fas fa-users stat-icon"></i>
                    <div class="stat-value"><?php echo $customerRetention; ?>%</div>
                    <div class="stat-label">Customer Retention</div>
                    <div class="stat-change">
                        <i class="fas fa-heart"></i>
                        <span><?php echo $customerRetention >= 70 ? 'Excellent' : ($customerRetention >= 50 ? 'Good' : 'Needs improvement'); ?></span>
                    </div>
                </div>
                <div class="stat-card info">
                    <i class="fas fa-clock stat-icon"></i>
                    <div class="stat-value"><?php echo htmlspecialchars($peakHours); ?></div>
                    <div class="stat-label">Peak Hours</div>
                    <div class="stat-change">
                        <i class="fas fa-info-circle"></i>
                        <span>Busiest time period</span>
                    </div>
                </div>
                <div class="stat-card <?php echo $efficiencyScore >= 80 ? 'success' : 'warning'; ?>">
                    <i class="fas fa-tachometer-alt stat-icon"></i>
                    <div class="stat-value"><?php echo $efficiencyScore; ?>%</div>
                    <div class="stat-label">Efficiency Score</div>
                    <div class="stat-change">
                        <i class="fas fa-bolt"></i>
                        <span><?php echo $efficiencyScore >= 80 ? 'Above average' : 'Room to improve'; ?></span>
                    </div>
                </div>
            </div>

            <!-- Chart Section -->
            <div class="section-card">
                <h3><i class="fas fa-chart-bar"></i> Orders by Month</h3>
                <div class="chart-container">
                    <canvas id="ordersChart"></canvas>
                </div>
            </div>

            <!-- Customer Feedback -->
            <div class="section-card">
                <h3><i class="fas fa-star"></i> Customer Feedback</h3>
                <div class="feedback-section">
                    <div class="feedback-bar">
                        <div class="feedback-bar-header">
                            <span>5 Stars</span>
                            <span class="percent">78%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="fill" style="width: 78%;"></div>
                        </div>
                    </div>
                    <div class="feedback-bar">
                        <div class="feedback-bar-header">
                            <span>4 Stars</span>
                            <span class="percent">18%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="fill" style="width: 18%;"></div>
                        </div>
                    </div>
                    <div class="feedback-bar">
                        <div class="feedback-bar-header">
                            <span>3 Stars</span>
                            <span class="percent">3%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="fill" style="width: 3%;"></div>
                        </div>
                    </div>
                    <div class="feedback-bar">
                        <div class="feedback-bar-header">
                            <span>2 Stars</span>
                            <span class="percent">1%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="fill" style="width: 1%;"></div>
                        </div>
                    </div>
                    <div class="feedback-bar">
                        <div class="feedback-bar-header">
                            <span>1 Star</span>
                            <span class="percent">0%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="fill" style="width: 0%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Business Insights -->
            <div class="section-card">
                <h3><i class="fas fa-lightbulb"></i> Business Insights & Recommendations</h3>
                <div class="insights-grid">
                    <div class="insight-card">
                        <h4><i class="fas fa-rocket"></i> Growth Opportunity</h4>
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
                    <div class="insight-card">
                        <h4><i class="fas fa-clock"></i> Peak Time Insight</h4>
                        <p>Most orders come during <?php echo htmlspecialchars($peakHours); ?>. Consider offering express service during these hours for premium pricing.</p>
                    </div>
                    <div class="insight-card">
                        <h4><i class="fas fa-heart"></i> Customer Loyalty</h4>
                        <p><?php 
                            if ($customerRetention >= 70) {
                                echo "{$customerRetention}% customer retention is excellent! Consider implementing a loyalty program to reward repeat customers.";
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
        
        const ctx = document.getElementById('ordersChart').getContext('2d');

        const chartData = {
            labels: ordersByMonth.length > 0 ? ordersByMonth.map(item => item.month_name || item.month) : ['No Data'],
            datasets: [
                {
                    label: 'Completed',
                    data: ordersByMonth.length > 0 ? ordersByMonth.map(item => parseInt(item.completed) || 0) : [0],
                    backgroundColor: 'rgba(102, 187, 106, 0.8)',
                    borderColor: '#43a047',
                    borderWidth: 2,
                    borderRadius: 8,
                    barThickness: 32
                },
                {
                    label: 'Pending',
                    data: ordersByMonth.length > 0 ? ordersByMonth.map(item => parseInt(item.pending) || 0) : [0],
                    backgroundColor: 'rgba(255, 167, 38, 0.8)',
                    borderColor: '#fb8c00',
                    borderWidth: 2,
                    borderRadius: 8,
                    barThickness: 32
                }
            ]
        };

        new Chart(ctx, {
            type: 'bar',
            data: chartData,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: { 
                            boxWidth: 14, 
                            boxHeight: 14, 
                            padding: 16,
                            font: { size: 13 }
                        }
                    },
                    tooltip: { 
                        mode: 'index', 
                        intersect: false,
                        backgroundColor: 'rgba(0,0,0,0.8)',
                        padding: 12,
                        cornerRadius: 8
                    }
                },
                scales: {
                    x: {
                        stacked: true,
                        grid: { display: false },
                        ticks: { color: '#666', font: { size: 12 } }
                    },
                    y: {
                        stacked: true,
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5,
                            color: '#666',
                            font: { size: 12 }
                        },
                        grid: {
                            borderDash: [4, 4],
                            color: 'rgba(0, 0, 0, 0.06)'
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
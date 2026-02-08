<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reports & Analytics</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .main-content {
            margin-left: 240px;
            padding: 20px 40px;
            width: calc(100% - 240px);
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header input {
            padding: 8px 12px;
            border: none;
            border-radius: 15px;
            background: #fedbd2;
            width: 200px;
        }

        .summary-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
            margin: 20px 0;
        }

        .summary-card {
            background: linear-gradient(135deg, #d03c2e 0%, #d03c2e 100%);
            border-radius: 15px;
            padding: 20px;
            color: white;
            text-align: center;
        }

        .summary-card i {
            font-size: 2em;
            margin-bottom: 10px;
        }

        .summary-card h3 {
            font-size: 0.9em;
            margin-bottom: 5px;
            opacity: 0.9;
        }

        .summary-card p {
            font-size: 1.8em;
            font-weight: 700;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin: 30px 0;
        }

        .card {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(255, 105, 180, 0.3);
            text-align: center;
        }

        .card h3 {
            color: #d03c2e;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 1.4em;
            font-weight: 600;
            color: #333;
        }

        .card p.positive {
            color: #28a745;
        }

        .card p.negative {
            color: #d03c2e;
        }

        .charts {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 30px;
        }

        .chart-container {
            background: #fff;
            border-radius: 20px;
            padding: 20px;
            flex: 1;
            min-width: 350px;
            box-shadow: 0 2px 8px rgba(255, 105, 180, 0.2);
        }

        .chart-container h3 {
            text-align: center;
            color: #d03c2e;
            margin-bottom: 15px;
        }

        .report-buttons {
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }

        .report-buttons .card {
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            min-width: 150px;
        }

        .report-buttons .card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(255, 105, 180, 0.4);
        }

        .top-products {
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(255, 105, 180, 0.3);
            margin-top: 30px;
        }

        .top-products h3 {
            color: #d03c2e;
            margin-bottom: 15px;
        }

        .top-products table {
            width: 100%;
            border-collapse: collapse;
        }

        .top-products th, .top-products td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #fedbd2;
        }

        .top-products th {
            color: #d03c2e;
            font-weight: 600;
        }

        .top-products tr:hover {
            background: #fff5f8;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'reports';
        include 'views/commonElements/leftSidebarChathu.php';
        
        // Extract report data (passed from controller)
        $totalOrders = $reportData['totalOrders'] ?? 0;
        $totalProducts = $reportData['totalProducts'] ?? 0;
        $totalClients = $reportData['totalClients'] ?? 0;
        $totalVendors = $reportData['totalVendors'] ?? 0;
        $totalRevenue = $reportData['totalRevenue'] ?? 0;
        $monthlyGrowth = $reportData['monthlyGrowth'] ?? 0;
        $topCategory = $reportData['topCategory'] ?? 'N/A';
        $customerRetention = $reportData['customerRetention'] ?? 0;
        $ordersByMonth = $reportData['ordersByMonth'] ?? [];
        $topSellingProducts = $reportData['topSellingProducts'] ?? [];
        $salesByCategory = $reportData['salesByCategory'] ?? [];
        ?>
        <div class="main-content">
            <section id="reports" class="page active" aria-labelledby="reports-title">
                <div class="page-header">
                    <h1 class="title">Reports & Analytics</h1>
                    <p class="subtitle">View business insights and generate reports</p>
                </div>

                <!-- Summary Cards -->
                <section class="summary-cards">
                    <div class="summary-card">
                        <i class="fas fa-shopping-cart"></i>
                        <h3>Total Orders</h3>
                        <p><?php echo number_format($totalOrders); ?></p>
                    </div>
                    <div class="summary-card">
                        <i class="fas fa-box"></i>
                        <h3>Total Products</h3>
                        <p><?php echo number_format($totalProducts); ?></p>
                    </div>
                    <div class="summary-card">
                        <i class="fas fa-users"></i>
                        <h3>Total Clients</h3>
                        <p><?php echo number_format($totalClients); ?></p>
                    </div>
                    <div class="summary-card">
                        <i class="fas fa-store"></i>
                        <h3>Total Vendors</h3>
                        <p><?php echo number_format($totalVendors); ?></p>
                    </div>
                    <div class="summary-card">
                        <i class="fas fa-dollar-sign"></i>
                        <h3>Total Revenue</h3>
                        <p>Rs. <?php echo number_format($totalRevenue); ?></p>
                    </div>
                </section>

                <!-- Report Buttons -->
                <div class="report-buttons">
                    <button class="card">
                        <h4><i class="fas fa-store"></i> Vendor Report</h4>
                    </button>
                    <button class="card">
                        <h4><i class="fas fa-box"></i> Items Report</h4>
                    </button>
                    <button class="card">
                        <h4><i class="fas fa-calendar-day"></i> Daily Summary</h4>
                    </button>
                    <button class="card">
                        <h4><i class="fas fa-chart-pie"></i> Cost Analysis</h4>
                    </button>
                </div>

            </section>

            <!-- Analytics Cards -->
            <section class="cards">
                <div class="card">
                    <h3>Monthly Growth</h3>
                    <p class="<?php echo $monthlyGrowth >= 0 ? 'positive' : 'negative'; ?>">
                        <?php echo ($monthlyGrowth >= 0 ? '+' : '') . $monthlyGrowth; ?>%
                    </p>
                </div>
                <div class="card">
                    <h3>Top Category</h3>
                    <p><?php echo htmlspecialchars($topCategory); ?></p>
                </div>
                <div class="card">
                    <h3>Customer Retention</h3>
                    <p><?php echo $customerRetention; ?>%</p>
                </div>
                <div class="card">
                    <h3>Avg Order Value</h3>
                    <p>Rs. <?php echo $totalOrders > 0 ? number_format($totalRevenue / $totalOrders) : 0; ?></p>
                </div>
            </section>

            <!-- Charts -->
            <section class="charts">
                <div class="chart-container">
                    <h3>Orders & Revenue (Last 6 Months)</h3>
                    <canvas id="ordersChart"></canvas>
                </div>
                <div class="chart-container">
                    <h3>Sales by Category</h3>
                    <canvas id="categoryChart"></canvas>
                </div>
            </section>

            <!-- Top Selling Products -->
            <div class="top-products">
                <h3><i class="fas fa-trophy"></i> Top Selling Products</h3>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Units Sold</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($topSellingProducts)): ?>
                            <tr>
                                <td colspan="3" style="text-align: center; color: #999;">No sales data available</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($topSellingProducts as $index => $product): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                                    <td><?php echo number_format($product['total_sold']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        // Prepare data for charts
        const ordersByMonth = <?php echo json_encode($ordersByMonth); ?>;
        const salesByCategory = <?php echo json_encode($salesByCategory); ?>;

        // Orders & Revenue Chart (Bar + Line)
        const ordersCtx = document.getElementById('ordersChart').getContext('2d');
        new Chart(ordersCtx, {
            type: 'bar',
            data: {
                labels: ordersByMonth.map(item => item.month),
                datasets: [
                    {
                        label: 'Orders',
                        data: ordersByMonth.map(item => item.total_orders),
                        backgroundColor: '#94c997',
                        borderColor: '#d03c2e',
                        borderWidth: 1
                    },
                    {
                        label: 'Revenue (Rs.)',
                        data: ordersByMonth.map(item => item.revenue),
                        type: 'line',
                        borderColor: '#d03c2e',
                        backgroundColor: '#ab94c9',
                        fill: true,
                        tension: 0.4,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: { display: true, text: 'Orders' }
                    },
                    y1: {
                        beginAtZero: true,
                        position: 'right',
                        title: { display: true, text: 'Revenue (Rs.)' },
                        grid: { drawOnChartArea: false }
                    }
                }
            }
        });

        // Category Sales Pie Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryColors = [
            '#d03c2e', '#d08d2e', '#74d02e', '#2ed087', '#2eb2d0',
            '#362ed0', '#d02eba', '#d02e8d', '#d02e2e', '#848484'
        ];
        new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: salesByCategory.map(item => item.name),
                datasets: [{
                    data: salesByCategory.map(item => item.total_sold),
                    backgroundColor: categoryColors.slice(0, salesByCategory.length),
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>

</html>
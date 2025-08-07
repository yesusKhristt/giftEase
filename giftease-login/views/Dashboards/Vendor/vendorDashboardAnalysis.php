<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vendor Analysis</title>
    <link rel="stylesheet" href="public/style2.css">
</head>

<body>
    <div class="dashboard-container">
        <div class="sidebar">
            <div class="sidebar-header">
                <div class="logo">
                    <span class="gift">gift</span><span class="Ease">Ease</span>
                </div>
            </div>

            <nav class="sidebar-nav">
                <ul class="nav-list">
                    <li class="nav-item" onclick="navigateTo('orders')">
                        <span class="nav-icon">📦</span>
                        Orders
                    </li>
                    <li class="nav-item" onclick="navigateTo('inventory')">
                        <span class="nav-icon">📋</span>
                        Inventory
                    </li>
                    <li class="nav-item" onclick="navigateTo('messages')">
                        <span class="nav-icon">💬</span>
                        Messages
                    </li>
                    <li class="nav-item active">
                        <span class="nav-icon">📊</span>
                        Analysis
                    </li>
                </ul>
            </nav>
        </div>

        <main class="main-content">
            <div class="content-wrapper">
                <div class="page-header">
                    <h1 class="page-title">Performance Analysis</h1>
                    <p class="page-subtitle">Track your business performance and growth</p>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Sales Performance</h2>
                    </div>
                    <div class="card-content">
                        <div class="chart-container">
                            <canvas id="performanceChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="summary-grid">
                    <div class="summary-card">
                        <div class="summary-content">
                            <div class="summary-text">
                                <div class="summary-label">Items Sold</div>
                                <div class="summary-value primary">125</div>
                                <p class="summary-description">items sold this month</p>
                            </div>
                            <div class="summary-icon primary">📈</div>
                        </div>
                    </div>

                    <div class="summary-card">
                        <div class="summary-content">
                            <div class="summary-text">
                                <div class="summary-label">Client Interactions</div>
                                <div class="summary-value primary">37</div>
                                <p class="summary-description">clients messaged</p>
                            </div>
                            <div class="summary-icon primary">👥</div>
                        </div>
                    </div>

                    <div class="summary-card">
                        <div class="summary-content">
                            <div class="summary-text">
                                <div class="summary-label">Repeat Clients</div>
                                <div class="summary-value danger">24</div>
                                <p class="summary-description">returning customers</p>
                            </div>
                            <div class="summary-icon danger">🔄</div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Navigation function
        function navigateTo(page) {
            console.log('Navigate to:', page);
            // You can implement actual navigation logic here
            // For example: window.location.href = `?action=dashboard&type=vendor&level=${page}`;
        }

        // Chart initialization
        const ctx = document.getElementById('performanceChart').getContext('2d');
        const performanceChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Apr', 'May', 'Jun', 'Jul', 'Aug'],
                datasets: [{
                    label: 'Orders Completed',
                    data: [12, 19, 14, 23, 30],
                    borderColor: '#032f40',
                    backgroundColor: 'rgba(3, 47, 64, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2,
                    pointBackgroundColor: '#032f40',
                    pointBorderColor: '#032f40',
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            color: '#6b7280'
                        }
                    },
                    x: {
                        grid: {
                            color: 'rgba(0, 0, 0, 0.1)'
                        },
                        ticks: {
                            color: '#6b7280'
                        }
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index'
                }
            }
        });

        // Add some interactivity to nav items
        document.querySelectorAll('.nav-item:not(.active)').forEach(item => {
            item.addEventListener('click', function () {
                // Remove active class from all items
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                // Add active class to clicked item
                this.classList.add('active');
            });
        });
    </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vendor Analysis</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebar.php'; ?>
        <div class="main-content">
            <?php include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/topbar.php'; ?>
            <div class="page-header">
                <h1 class="title">Performance Analysis</h1>
                <p class="subtitle">Track your business performance and growth</p>
            </div>
            <div class="filter-tabs">
                <button class="btn1" onclick="filterItems('all')">This Week</button>
                <button class="btn1" onclick="filterItems('active')">This Month</button>
                <button class="btn1" onclick="filterItems('paused')">This Year</button>
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
                <div class="card">

                    <p class="subtitle">Items Sold</p><br>
                    <p class="title">125</p>

                </div>

                <div class="card">
                    <p class="subtitle">Client Interactions</p><br>
                    <p class="title">37</p>
                </div>

                <div class="card">

                    <p class="subtitle">Repeat Clients</p><br>
                    <p class="title">12</p>

                </div>
            </div>
            <div class="summary-grid">
                <div class="card">

                    <p class="subtitle">Low Stock</p><br>
                    <p class="title">2</p>

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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Analysis</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="public/vendor-analysis.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
</head>

<body>
    <?php
    $activePage = 'analysis';
    $analysisStats = $analysisStats ?? [
        'itemsSold' => 0,
        'clientInteractions' => 0,
        'repeatClients' => 0,
        'lowStock' => 0,
    ];
    $salesTrend = $salesTrend ?? ['labels' => [], 'values' => []];
    $selectedRange = $selectedRange ?? 'month';
    ?>
    <div class="container">
        <?php include 'views\commonElements/leftSidebar.php'; ?>

        <div class="main-content analysis-page">
            <div class="analysis-shell">
                <div class="analysis-header">
                    <div>
                        <h1 class="title">Performance Analysis</h1>
                        <p class="subtitle">Real-time view of your sales, engagement, and stock health.</p>
                    </div>
                    <div class="badge-live"><i class="fa-solid fa-signal"></i> Live Data</div>
                </div>

                <div class="filter-tabs analysis-filters">
                    <a class="btn1 <?= $selectedRange === 'week' ? 'is-active' : '' ?>" href="?controller=vendor&action=dashboard/analysis&range=week">
                        <i class="fa-regular fa-calendar-days"></i> This Week
                    </a>
                    <a class="btn1 <?= $selectedRange === 'month' ? 'is-active' : '' ?>" href="?controller=vendor&action=dashboard/analysis&range=month">
                        <i class="fa-regular fa-calendar"></i> This Month
                    </a>
                    <a class="btn1 <?= $selectedRange === 'year' ? 'is-active' : '' ?>" href="?controller=vendor&action=dashboard/analysis&range=year">
                        <i class="fa-regular fa-calendar-check"></i> This Year
                    </a>
                </div>

                <div class="card chart-card">
                    <div class="card-header">
                        <h2 class="card-title">Sales Trend</h2>
                        <p class="chart-caption">Delivered item units over the selected period</p>
                    </div>
                    <div class="card-content">
                        <div class="chart-container">
                            <canvas id="performanceChart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="summary-grid analysis-grid">
                    <div class="card metric-card metric-primary">
                        <div class="metric-top">
                            <p class="subtitle">Items Sold</p>
                            <span class="metric-icon"><i class="fa-solid fa-box-open"></i></span>
                        </div>
                        <p class="title"><?= htmlspecialchars(number_format((int) ($analysisStats['itemsSold'] ?? 0))) ?></p>
                    </div>

                    <div class="card metric-card">
                        <div class="metric-top">
                            <p class="subtitle">Client Interactions</p>
                            <span class="metric-icon"><i class="fa-regular fa-comments"></i></span>
                        </div>
                        <p class="title"><?= htmlspecialchars(number_format((int) ($analysisStats['clientInteractions'] ?? 0))) ?></p>
                    </div>

                    <div class="card metric-card">
                        <div class="metric-top">
                            <p class="subtitle">Repeat Clients</p>
                            <span class="metric-icon"><i class="fa-solid fa-user-check"></i></span>
                        </div>
                        <p class="title"><?= htmlspecialchars(number_format((int) ($analysisStats['repeatClients'] ?? 0))) ?></p>
                    </div>

                    <div class="card metric-card metric-alert">
                        <div class="metric-top">
                            <p class="subtitle">Low Stock Products</p>
                            <span class="metric-icon"><i class="fa-solid fa-triangle-exclamation"></i></span>
                        </div>
                        <p class="title"><?= htmlspecialchars(number_format((int) ($analysisStats['lowStock'] ?? 0))) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const labels = <?= json_encode($salesTrend['labels'] ?? []) ?>;
        const values = <?= json_encode($salesTrend['values'] ?? []) ?>;

        const ctx = document.getElementById('performanceChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels.length ? labels : ['No Data'],
                datasets: [{
                    label: 'Items Sold',
                    data: values.length ? values : [0],
                    borderColor: '#d03c2e',
                    backgroundColor: 'rgba(208, 60, 46, 0.14)',
                    fill: true,
                    tension: 0.35,
                    borderWidth: 3,
                    pointRadius: 3,
                    pointHoverRadius: 6,
                    pointBackgroundColor: '#032e3f'
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
                        ticks: {
                            color: '#29424d',
                            precision: 0
                        },
                        grid: {
                            color: 'rgba(3, 46, 63, 0.08)'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#29424d'
                        },
                        grid: {
                            color: 'rgba(3, 46, 63, 0.06)'
                        }
                    }
                }
            }
        });
    </script>

</body>

</html>
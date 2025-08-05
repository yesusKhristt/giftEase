<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="public/style.css">
</head>

<body>
    <div class="sideBar">
        <div class="sideBar">
            <h2 class="Heading blueT"><span class="orangeT">gift</span><b>Ease</b></h2>
            <ul>
                <li onclick="location.href='?action=dashboard&type=vendor&level=primary'">Orders</a>
                <li onclick="location.href='?action=dashboard&type=vendor&level=inventory'">Inventory</a>
                <li onclick="location.href='?action=dashboard&type=vendor&level=messeges'">Messages</a>
                <li class="active">Analysis</a>
            </ul>
        </div>

        <div class="main">
            <div class="HeadingB blueT">Performance Analysis</div>

            <div class="chart-container">
                <canvas id="performanceChart"></canvas>
            </div>

            <div class="summary-box">
                <div class="subHeadingB">Items Sold</div>
                <p>125 items sold this month</p>
            </div>

            <div class="summary-box">
                <div class="subHeadingB">Clients Interacted</div>
                <p>37 clients messaged, 24 repeat clients</p>
            </div>
        </div>

        <script>
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
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: false }
                    }
                }
            });
        </script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Delivery Partner Dashboard - GiftEase</title>
  <link rel="stylesheet" href="public/deliverystyle.css" />
  <link rel="icon" type="image/png" href="resources/1.png">
  <link rel="profile" href="profile.php" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dkmvuFiYMuEv20&libraries=geometry,places"
    async defer></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

  <div class="container">
    <?php
    $activePage = 'home';
    include 'views\commonElements/leftSidebarSaneth.php';
    ?>
    <!-- <div id="home" class="tab-content active"> -->
    <!-- Home page -->
    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Welcome Back, <?php echo htmlspecialchars($_SESSION['user']['first_name'] ?? 'Delivery Partner'); ?>!</h1>
        <p class="subtitle">Ready to make some deliveries today</p>
      </div>


      <div class="card">
        <h3>Today's Overview</h3>
        <div class="summary-grid">
          <div class="cardColour">
            <div class="title" id="weeklyEarnings">Rs. <?php echo htmlspecialchars(number_format($dashboardStats['weekly_earnings'] ?? 0, 2)); ?></div>
            <div class="subtitle">This Week's Earnings</div>
          </div>
          <div class="cardColour">
            <div class="title"><?php echo htmlspecialchars($dashboardStats['assigned_total'] ?? 0); ?></div>
            <div class="subtitle">Total Orders Assigned</div>
          </div>
          <div class="cardColour">
            <div class="title"><?php echo htmlspecialchars($dashboardStats['delivered_total'] ?? 0); ?></div>
            <div class="subtitle">Total Delivered</div>
          </div>
          <div class="cardColour">
            <div class="title"><?php echo htmlspecialchars($dashboardStats['pending_total'] ?? 0); ?></div>
            <div class="subtitle">Pending Deliveries</div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="chart-wrapper" style="margin-top: 20px; background: #fff; border-radius: 20px; padding: 18px; border: 1px solid #fed2ed;">
          <h4 style="margin-bottom: 12px; color: #2C2C2C;">Daily Deliveries and Earnings Trend (Last 30 Days)</h4>
          <canvas id="lastMonthAnalyticsChart" height="120"></canvas>
        </div>
      </div>

    </div>
  </div>


</body>
<script src="public/main.js"></script>
<script>
  (function() {
    const labels = <?php echo json_encode($lastMonthTrend['labels'] ?? [], JSON_UNESCAPED_SLASHES); ?>;
    const deliveredData = <?php echo json_encode($lastMonthTrend['delivered'] ?? [], JSON_UNESCAPED_SLASHES); ?>;
    const earningsData = <?php echo json_encode($lastMonthTrend['earnings'] ?? [], JSON_UNESCAPED_SLASHES); ?>;

    const canvas = document.getElementById('lastMonthAnalyticsChart');
    if (!canvas || !Array.isArray(labels) || labels.length === 0) {
      return;
    }

    new Chart(canvas, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
            type: 'bar',
            label: 'Completed Deliveries',
            data: deliveredData,
            backgroundColor: 'rgba(233, 30, 99, 0.45)',
            borderColor: '#e91e63',
            borderWidth: 1,
            yAxisID: 'yDeliveries',
            borderRadius: 6
          },
          {
            type: 'line',
            label: 'Earnings (Rs.)',
            data: earningsData,
            borderColor: '#2C2C2C',
            backgroundColor: 'rgba(44, 44, 44, 0.12)',
            tension: 0.3,
            fill: true,
            yAxisID: 'yEarnings',
            pointRadius: 2
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: true,
        scales: {
          yDeliveries: {
            beginAtZero: true,
            position: 'left',
            title: {
              display: true,
              text: 'Deliveries'
            }
          },
          yEarnings: {
            beginAtZero: true,
            position: 'right',
            grid: {
              drawOnChartArea: false
            },
            title: {
              display: true,
              text: 'Earnings (Rs.)'
            }
          }
        },
        plugins: {
          legend: {
            position: 'top'
          }
        }
      }
    });
  })();
</script>

</html>
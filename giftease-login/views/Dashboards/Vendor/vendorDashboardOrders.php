<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Vendor Orders</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="icon" href="resources/icon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
  <div class="container">
    <?php
    $activePage = 'orders';
<<<<<<< Updated upstream
    include 'views\commonElements/leftSidebar.php';
=======
    include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebar.php';
>>>>>>> Stashed changes
    ?>
    <div class="main-content">

      <div class="page-header">
        <h1 class="title">Orders Dashboard</h1>
        <p class="subtitle">Manage and track your current orders</p>
      </div>
      <div class="card">
        <h4>Current Orders</h4>
        <table class="table">
          <thead>
            <tr>
              <th style="width: 80px;">Action</th>
              <th>Client</th>
              <th>Cost</th>
              <th>Order Received</th>
              <th>Order Due</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
              <tr>
                <td>
                  <a class="view-btn" href="?action=dashboard&type=vendor&level=vieworder">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                      </path>
                    </svg>
                  </a>
                </td>
                <td>Thenuka Ranasinghe</td>
                <td>$25.00</td>
                <td>2025-08-05</td>
                <td>2025-08-10</td>
                <td><span class="badge blue">On-Track</span></td>
              </tr>
              <tr>
                <td>
                  <a class="view-btn" href="?action=dashboard&type=vendor&level=vieworder">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                      </path>
                    </svg>
                  </a>
                </td>
                <td>Matt Patterson</td>
                <td>$40.00</td>
                <td>2025-08-04</td>
                <td>2025-08-09</td>
                <td><span class="badge red">Urgent</span></td>
          </tbody>
        </table>
      </div>
      <div class="summary-grid">
        <div class="card">

          <p class="subtitle">Total Orders</p><br>
          <p class="title">2</p>

        </div>

        <div class="card">
          <p class="subtitle">Total Revenue</p><br>
          <p class="title">$65.00</p>
        </div>

        <div class="card">

          <p class="subtitle">Urgent Orders</p><br>
          <p class="title">1</p>
        </div>
      </div>
    </div>
  </div>
  <script>
    // Add hover effect to stars
    document.querySelectorAll('.star').forEach(star => {
      star.addEventListener('mouseenter', function () {
        this.style.transform = 'scale(1.2) rotate(15deg)';
      });

      star.addEventListener('mouseleave', function () {
        this.style.transform = 'scale(1) rotate(0deg)';
      });
    });

    // Profile picture click effect
    document.querySelector('.profile-picture').addEventListener('click', function () {
      this.style.transform = 'scale(1.1) rotate(360deg)';
      setTimeout(() => {
        this.style.transform = 'scale(1) rotate(0deg)';
      }, 500);
    });

    // Add click handlers for navigation
    document.querySelectorAll('.nav-item').forEach(item => {
      item.addEventListener('click', function (e) {
        // Remove active class from all items
        document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
        // Add active class to clicked item
        this.classList.add('active');
      });
    });

    // Add click handlers for view buttons
    document.querySelectorAll('.view-btn').forEach(btn => {
      btn.addEventListener('click', function () {
        alert('View order details - This would open a modal or navigate to order details page');
      });
    });
  </script>
</body>

</html>
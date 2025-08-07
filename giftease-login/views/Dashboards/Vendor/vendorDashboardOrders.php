<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Vendor Orders</title>
  <link rel="stylesheet" href="public/style2.css">
  <link rel="icon" href="resources/icon.png">
</head>

<body>

  <body>
    <div class="dashboard-container">
      <!-- Sidebar -->
      <div class="sidebar">
        <div class="sidebar-header">
          <p class="logo">
            <span class="gift">gift</span><span class="Ease">Ease</span>
          </p>
        </div>

        <nav class="sidebar-nav">
          <ul class="nav-list">
            <li>
              <a href="#" class="nav-item active">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                </svg>
                Orders
              </a>
            </li>
            <li>
              <a href="?action=dashboard&type=vendor&level=inventory" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
                Inventory
              </a>
            </li>
            <li>
              <a href="?action=dashboard&type=vendor&level=messeges" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                  </path>
                </svg>
                Messages
              </a>
            </li>
            <li>
              <a href="?action=dashboard&type=vendor&level=analysis" class="nav-item">
                <svg class="nav-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                  </path>
                </svg>
                Analysis
              </a>
            </li>
          </ul>
        </nav>
      </div>

      <!-- Main Content -->
      <div class="main-content">
        <div class="page-header">
          <h1 class="page-title">Orders Dashboard</h1>
          <p class="page-subtitle">Manage and track your current orders</p>
        </div>

        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Current Orders</h4>
          </div>
          <div class="card-content">
            <div class="table-container">
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
                      <button class="view-btn">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                          </path>
                        </svg>
                      </button>
                    </td>
                    <td class="client-name">Thenuka Ranasinghe</td>
                    <td class="cost">$25.00</td>
                    <td>2025-08-05</td>
                    <td>2025-08-10</td>
                    <td><span class="badge badge-on-track">On Track</span></td>
                  </tr>
                  <tr>
                    <td>
                      <button class="view-btn">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                          </path>
                        </svg>
                      </button>
                    </td>
                    <td class="client-name">Umaya Perera</td>
                    <td class="cost">$40.00</td>
                    <td>2025-08-04</td>
                    <td>2025-08-09</td>
                    <td><span class="badge badge-urgent">Urgent</span></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Summary Cards -->
        <div class="summary-grid">
          <div class="summary-card">
            <div class="summary-content">
              <div class="summary-text">
                <p class="summary-label">Total Orders</p>
                <p class="summary-value primary">2</p>
              </div>
              <svg class="summary-icon primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
              </svg>
            </div>
          </div>

          <div class="summary-card">
            <div class="summary-content">
              <div class="summary-text">
                <p class="summary-label">Total Revenue</p>
                <p class="summary-value primary">$65.00</p>
              </div>
              <svg class="summary-icon primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                </path>
              </svg>
            </div>
          </div>

          <div class="summary-card">
            <div class="summary-content">
              <div class="summary-text">
                <p class="summary-label">Urgent Orders</p>
                <p class="summary-value danger">1</p>
              </div>
              <svg class="summary-icon danger" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
              </svg>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
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
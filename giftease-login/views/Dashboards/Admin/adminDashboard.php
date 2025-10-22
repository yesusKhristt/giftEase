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
    <?php
    $activePage = 'dashboard';
    include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarChathu.php';
    ?>
    <div class="main-content">
      <div class="page-header">
                <h1 class="title">Account</h1>
                <p class="subtitle">Manage your Personal Information</p>
            </div>
      <header class="topbar">
        <div class="left">
          <button class="hamburger" id="sidebarToggle" aria-label="Toggle sidebar">
            <span aria-hidden="true">☰</span>
          </button>
          <div class="brand" aria-label="GiftEase home">
            <span class="logo" aria-hidden="true">🎁</span>
            <span class="brand-name">GiftEase</span>
          </div>
          <h1 id="pageTitle" class="page-title">Dashboard</h1>
        </div>

        <div class="center">
          <div class="search-wrap">
            <span class="search-icon" aria-hidden="true">🔍</span>
            <input id="searchInput" type="text" placeholder="Search vendors, phones, item ids..." class="search"
              aria-label="Search" />
          </div>
        </div>

        <div class="topbar-right">
          <button id="notificationBtn" class="icon-btn" aria-haspopup="true" aria-expanded="false"
            title="Notifications">
            <span aria-hidden="true">🔔</span>
            <span class="badge" id="notifBadge">3</span>
          </button>
          <button id="profileDropdown" class="icon-btn profile" aria-haspopup="true" aria-expanded="false"
            title="Profile menu">
            <span aria-hidden="true">👤</span>
          </button>
        </div>

        Notifications dropdown
        <div id="notificationDropdown" class="notification-dropdown" role="menu" aria-label="Notifications">
          <div class="notification-header">
            <h4>Notifications</h4>
            <button class="mark-all-read" type="button">Mark all as read</button>
          </div>
          <div class="notification-list">
            <div class="notification-item unread">
              <div class="ni-ico" aria-hidden="true">➕</div>
              <div>
                <p><strong>New vendor</strong> “Lakshan” added</p>
                <span class="time">2 minutes ago</span>
              </div>
            </div>
            <div class="notification-item unread">
              <div class="ni-ico" aria-hidden="true">⬇️</div>
              <div>
                <p>Vendor export completed</p>
                <span class="time">10 minutes ago</span>
              </div>
            </div>
            <div class="notification-item">
              <div class="ni-ico" aria-hidden="true">📈</div>
              <div>
                <p>Weekly report is ready</p>
                <span class="time">1 hour ago</span>
              </div>
            </div>
          </div>
        </div>

        Profile dropdown
        <div id="profileDropdownMenu" class="profile-dropdown-menu" role="menu" aria-label="Profile menu">
          <div class="profile-info">
            <div class="avatar" aria-hidden="true">👤</div>
            <div>
              <h4>Admin User</h4>
              <p>admin@company.com</p>
            </div>
          </div>
          <nav class="profile-links">
            <a href="#" class="profile-link"><span aria-hidden="true">👤</span> Profile Settings</a>
            <a href="#" class="profile-link"><span aria-hidden="true">⚙️</span> Account Settings</a>
            <a href="#" class="profile-link"><span aria-hidden="true">❓</span> Help & Support</a>
            <div class="divider"></div>
            <a href="#" class="profile-link danger"><span aria-hidden="true">↩️</span> Logout</a>
          </nav>
        </div>
      </header>

      <main class="content" id="contentRoot">
        Dashboard Page
        <section id="dashboard" class="page active" aria-labelledby="dashboard-title">
          <h2 id="dashboard-title" class="sr-only">Dashboard Overview</h2>

          <div class="cards">
            <div class="card blue">
              <div class="card-icon" aria-hidden="true">🛒</div>
              <div class="card-meta">
                <strong>Total Orders</strong>
                <p id="totalOrders">120</p>
              </div>
            </div>
            <div class="card red">
              <div class="card-icon" aria-hidden="true">✂️</div>
              <div class="card-meta">
                <strong>Pending</strong>
                <p>Wrapping</p>
              </div>
            </div>
            <div class="card yellow">
              <div class="card-icon" aria-hidden="true">👔</div>
              <div class="card-meta">
                <strong>Total Vendors</strong>
                <p id="totalVendors">0</p>
              </div>
            </div>
          </div>

          <div class="quick-grid">
            <a class="quick ellipse items" data-page="items" role="button" aria-label="Go to Items">📦
              <span>Items</span></a>
            <a class="quick ellipse vendors" data-page="vendors" role="button" aria-label="Go to Vendors">👔
              <span>Vendors</span></a>
            <a class="quick ellipse customers" data-page="customers" role="button" aria-label="Go to Customers">👥
              <span>Customers</span></a>
            <a class="quick ellipse deliveries" data-page="deliveries" role="button" aria-label="Go to Deliveries">🚚
              <span>Deliveries</span></a>
          </div>

          <div class="panel">
            <div class="panel-header">
              <h3>Recent Vendors</h3>
              <button id="viewAllVendors" class="btn primary btn-sm">View All</button>
            </div>
            <div id="recentVendorsList" class="recent-list" aria-live="polite"></div>
          </div>
        </section>

        Items Page
        <section id="items" class="page" aria-labelledby="items-title">
          <div class="page-header">
            <div>
              <h3 id="items-title">Items</h3>
              <p class="muted">Inventory overview</p>
            </div>
            <button class="btn primary" disabled title="Demo">＋ Add Item</button>
          </div>

          <div class="table">
            <div class="table-controls">
              <div class="left-controls">
                <select id="itemsSort" class="select" aria-label="Sort items">
                  <option value="date">Sort by Date</option>
                  <option value="name">Sort by Name</option>
                  <option value="sku">Sort by SKU</option>
                </select>
              </div>
              <div class="right-controls">
                <button class="btn outline btn-sm" disabled title="Demo">⬇️ Export</button>
                <button class="btn outline btn-sm" disabled title="Demo">🖨️ Print</button>
              </div>
            </div>
            <div class="table-wrap">
              <table>
                <thead>
                  <tr>
                    <th>SKU</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Updated</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>#ITM-001</td>
                    <td>Wrapping Paper</td>
                    <td>Supplies</td>
                    <td>320</td>
                    <td>2025-01-12</td>
                  </tr>
                  <tr>
                    <td>#ITM-002</td>
                    <td>Gift Box</td>
                    <td>Supplies</td>
                    <td>180</td>
                    <td>2025-01-10</td>
                  </tr>
                  <tr>
                    <td>#ITM-003</td>
                    <td>Ribbon</td>
                    <td>Supplies</td>
                    <td>540</td>
                    <td>2025-01-16</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </section>

        Vendors Page
        <section id="vendors" class="page" aria-labelledby="vendors-title">
          <div class="page-header">
            <div>
              <h3 id="vendors-title">Vendors</h3>
              <p class="muted">Manage all your vendors and their items</p>
            </div>
            <button id="addVendorBtn" class="btn primary">＋ Add Vendor</button>
          </div>

          <div class="table">
            <div class="table-controls">
              <div class="left-controls">
                <select id="sortBy" class="select" aria-label="Sort vendors">
                  <option value="date">Sort by Date</option>
                  <option value="name">Sort by Name</option>
                  <option value="id">Sort by Vendor ID</option>
                  <option value="item">Sort by Item ID</option>
                </select>
                <button id="resetFilters" class="btn outline btn-sm" title="Reset filters">🔄 Reset</button>
              </div>
              <div class="right-controls">
                <button id="exportBtn" class="btn outline btn-sm">⬇️ Export</button>
                <button id="printBtn" class="btn outline btn-sm">🖨️ Print</button>
              </div>
            </div>

            <div class="table-wrap">
              <table id="vendorsTable" class="vendor-table">
                <thead>
                  <tr>
                    <th><input id="selectAll" type="checkbox" aria-label="Select all" /></th>
                    <th>vendor id</th>
                    <th>name</th>
                    <th>phone number</th>
                    <th>profile pic</th>
                    <th>item id</th>
                    <th>date</th>
                    <th>actions</th>
                  </tr>
                </thead>
                <tbody id="vendorsTableBody">
                  Rows rendered by JavaScript
                </tbody>
              </table>
            </div>

            <div class="pagination" role="navigation" aria-label="Vendor table pagination">
              <div class="info">Showing <span id="showingStart">0</span> to <span id="showingEnd">0</span> of <span
                  id="totalRecords">0</span></div>
              <div class="controls">
                <button id="prevPage" class="page-btn" disabled aria-label="Previous page">◀️</button>
                <div id="paginationNumbers" class="numbers"></div>
                <button id="nextPage" class="page-btn" aria-label="Next page">▶️</button>
              </div>
            </div>
          </div>
        </section>

        Customers Page
        <section id="customers" class="page" aria-labelledby="customers-title">
          <div class="page-header">
            <div>
              <h3 id="customers-title">Customers</h3>
              <p class="muted">Customer list (demo)</p>
            </div>
          </div>
          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Joined</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>C-101</td>
                  <td>Amal</td>
                  <td>0711111111</td>
                  <td>2025-01-05</td>
                </tr>
                <tr>
                  <td>C-102</td>
                  <td>Nadee</td>
                  <td>0722222222</td>
                  <td>2025-01-07</td>
                </tr>
                <tr>
                  <td>C-103</td>
                  <td>Ruwan</td>
                  <td>0755555555</td>
                  <td>2025-01-12</td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>

        Deliveries Page
        <section id="deliveries" class="page" aria-labelledby="deliveries-title">
          <div class="page-header">
            <div>
              <h3 id="deliveries-title">Deliveries</h3>
              <p class="muted">Delivery overview (demo)</p>
            </div>
          </div>
          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>Order</th>
                  <th>Vendor</th>
                  <th>Status</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>#ORD-001</td>
                  <td>kamal</td>
                  <td><span class="badge warn">Pending</span></td>
                  <td>2025-01-16</td>
                </tr>
                <tr>
                  <td>#ORD-002</td>
                  <td>nimal</td>
                  <td><span class="badge ok">Delivered</span></td>
                  <td>2025-01-14</td>
                </tr>
                <tr>
                  <td>#ORD-003</td>
                  <td>saman</td>
                  <td><span class="badge info">In Transit</span></td>
                  <td>2025-01-13</td>
                </tr>
              </tbody>
            </table>
          </div>
        </section>

        Reports Page
        <section id="reports" class="page" aria-labelledby="reports-title">
          <div class="page-header">
            <div>
              <h3 id="reports-title">Reports</h3>
              <p class="muted">Generate and download reports (demo)</p>
            </div>
          </div>
          <div class="cards">
            <button class="card press button-card">👔 Vendor Report</button>
            <button class="card press button-card">📦 Items Report</button>
            <button class="card press button-card">📅 Daily Summary</button>
            <button class="card press button-card">💲 Cost Analysis</button>
          </div>
        </section>

        Settings Page
        <section id="settings" class="page" aria-labelledby="settings-title">
          <div class="page-header">
            <div>
              <h3 id="settings-title">Settings</h3>
              <p class="muted">Customize your dashboard</p>
            </div>
          </div>

          <div class="settings-grid">
            <div class="setting-card">
              <h4>Appearance</h4>
              <div class="theme-toggle" role="group" aria-label="Theme toggle">
                <button class="theme-btn active" data-theme="light">☀️ Light</button>
                <button class="theme-btn" data-theme="dark">🌙 Dark</button>
              </div>
            </div>

            <div class="setting-card">
              <h4>Notifications</h4>
              <div class="row">
                <label>Email Notifications</label>
                <label class="switch">
                  <input type="checkbox" id="emailNotifications" checked />
                  <span class="slider"></span>
                </label>
              </div>
              <div class="row">
                <label>Push Notifications</label>
                <label class="switch">
                  <input type="checkbox" id="pushNotifications" checked />
                  <span class="slider"></span>
                </label>
              </div>
            </div>
          </div>
        </section>
      </main>
    </div>
  </div>

  Vendor Modal
  <div id="vendorModal" class="modal" aria-hidden="true" aria-labelledby="modalTitle" role="dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 id="modalTitle">Add Vendor</h3>
        <button id="closeModal" class="close-btn" aria-label="Close">✖️</button>
      </div>
      <form id="vendorForm">
        <div class="form-grid">
          <div class="form-group">
            <label for="vendorName">Name *</label>
            <input id="vendorName" type="text" required />
          </div>
          <div class="form-group">
            <label for="vendorPhone">Phone Number *</label>
            <input id="vendorPhone" type="tel" required />
          </div>
          <div class="form-group">
            <label for="itemId">Item ID *</label>
            <input id="itemId" type="text" placeholder="#001" required />
          </div>
          <div class="form-group">
            <label for="vendorDate">Date *</label>
            <input id="vendorDate" type="date" required />
          </div>
        </div>
        <div class="form-group">
          <label for="profilePicUrl">Profile Pic (optional URL)</label>
          <input id="profilePicUrl" type="url" placeholder="https://..." />
        </div>
        <div class="form-actions">
          <button type="button" id="cancelBtn" class="btn outline">Cancel</button>
          <button type="submit" class="btn primary">Save Vendor</button>
        </div>
      </form>
    </div>
  </div>

  <script src="script.js"></script>
</body>

</html>
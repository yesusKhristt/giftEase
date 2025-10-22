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
    $activePage = 'vendor';
    include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarChathu.php';
    ?>
    <div class="main-content">
  <div class="page-header">
                <h1 class="title">Account</h1>
                <p class="subtitle">Manage your Personal Information</p>
            </div>

      <!-- <section id="vendors" class="page active">
        <div class="page-header">
          <div>
            <h3>Vendors</h3>
            <p class="muted">Manage all your vendors and their items</p>
          </div>
          <button id="addVendorBtn" class="btn primary">＋ Add Vendor</button>
        </div> -->

        <!-- <div class="table"> -->
          <!-- <div class="table-controls">
            <div class="left-controls">
              <select id="sortBy" class="select">
                <option value="date">Sort by Date</option>
                <option value="name">Sort by Name</option>
                <option value="id">Sort by Vendor ID</option>
                <option value="item">Sort by Item ID</option>
              </select>
              <button id="resetFilters" class="btn outline btn-sm">🔄 Reset</button>
            </div>
            <div class="right-controls">
              <button id="exportBtn" class="btn outline btn-sm">⬇️ Export</button>
              <button id="printBtn" class="btn outline btn-sm">🖨️ Print</button>
            </div>
          </div>

          <div class="table-wrap">
            <table class="vendor-table">
              <thead>
                <tr>
                  <th><input type="checkbox" /></th>
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
                <!-- Filled dynamically -->
              <!-- </tbody>
            </table> --> 
             <table class="table">
                            <thead>
                                <tr>
                                    <th>oredr ID</th>
                                    <th>Vendor</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jan 20, 2024</td>
                                    <td>WRP-001</td>
                                    <td>Premium Gift Wrapping</td>
                                    <td>Sarah Johnson</td>
                                    <td style="font-weight: 600;">$25.00</td>
                                    <td><span class="status-badge status-paid">Paid</span></td>
                                    <!-- <td>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="viewReceipt('WRP-001')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td> -->
                                </tr>
                                <tr>
                                    <td>Jan 19, 2024</td>
                                    <td>WRP-002</td>
                                    <td>Custom Ribbon + Card</td>
                                    <td>Michael Chen</td>
                                    <td style="font-weight: 600;">$12.00</td>
                                    <td><span class="status-badge status-paid">Paid</span></td>
                                    <!-- <td>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="viewReceipt('WRP-002')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td> -->
                                </tr>
                                <tr>
                                    <td>Jan 18, 2024</td>
                                    <td>WRP-003</td>
                                    <td>Luxury Gift Box</td>
                                    <td>Emma Wilson</td>
                                    <td style="font-weight: 600;">$35.00</td>
                                    <td><span class="status-badge status-pending">Pending</span></td>
                                    <!-- <td>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="followUpPayment('WRP-003')">
                                            <i class="fas fa-phone"></i>
                                        </button>
                                    </td> -->
                                </tr>
                                <tr>
                                    <td>Jan 17, 2024</td>
                                    <td>WRP-004</td>
                                    <td>Theme Wrapping</td>
                                    <td>David Lee</td>
                                    <td style="font-weight: 600;">$28.00</td>
                                    <td><span class="status-badge status-paid">Paid</span></td>
                                    <!-- <td>
                                        <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="viewReceipt('WRP-004')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td> -->
                                </tr>
                            </tbody>
                        </table>
          </div>

          <div class="pagination">
            <div class="info">Showing <span id="showingStart">0</span> to <span id="showingEnd">0</span> of <span
                id="totalRecords">0</span></div>
            <div class="controls">
              <button id="prevPage" class="page-btn" disabled>◀️</button>
              <div id="paginationNumbers" class="numbers"></div>
              <button id="nextPage" class="page-btn">▶️</button>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>

</html>
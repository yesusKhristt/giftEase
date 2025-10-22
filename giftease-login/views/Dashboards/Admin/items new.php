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
    $activePage = 'items';
    include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarChathu.php';
    ?>
    <div class="main-content">
      <div class="page-header">
                <h1 class="title">Account</h1>
                <p class="subtitle">Manage your Personal Information</p>
            </div>

      <!-- <section id="items" class="page active" aria-labelledby="items-title">
        <div class="page-header">
          <div>
            <h3 id="items-title">Items</h3>
            <p class="muted">Inventory overview</p>
          </div>
          <button class="btn primary" disabled title="Demo">＋ Add Item</button>
        </div> -->
<!-- 
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
            
          </div>
        </div>
      </section>
    </div>
  </div>
</body>

</html>
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
    $activePage = 'delivery';
    include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarChathu.php';
    ?>
    <div class="main-content">
      <div class="page-header">
                <h1 class="title">Account</h1>
                <p class="subtitle">Manage your Personal Information</p>
            </div>
      <!-- <section id="deliveries" class="page active">
        <div class="page-header">
          <div>
            <h3>Deliveries</h3>
            <p class="muted">Delivery overview (demo)</p>
          </div>
        </div>
        <div class="table-wrap"> -->
          <!-- <table>
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
      </section>
    </div>
  </div>
</body>

</html>
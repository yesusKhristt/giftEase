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
    $activePage = 'customer';
    include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarChathu.php';
    ?>
    <div class="main-content">
      <div class="page-header">
                <h1 class="title">Customer</h1>
                <p class="subtitle">Customer List</p>
            </div>

      <!-- <section id="customers" class="page active">
        <div class="page-header">
          <div>
            <h3>Customers</h3>
            <p class="muted">Customer list (demo)</p>
          </div>
        </div> -->
        <!-- <div class="table-wrap">
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
          </table> -->

           <table class="table">
                            <thead>
                                <tr>
                                    <th>oredr ID</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Date</th>
                                    <!-- <th>Status</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>001</td>
                                    <td>chathu</td>
                                    <td>0786607436</td>
                                    <td>102/8 colombo</td>
                                    <td style="font-weight: 600;">2026/02/03</td>
                                    <!-- <td><span class="status-badge status-paid">Paid</span></td>
                                     -->
                                        <!-- <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="viewReceipt('WRP-001')">
                                            <i class="fas fa-eye"></i>
                                        </button> -->
                                    
                                </tr>
                                <tr>
                                    <td>002</td>
                                    <td>oshani</td>
                                    <td>0786607436</td>
                                    <td>1000 colombo </td>
                                    <td style="font-weight: 600;">2026/02/05</td>
                                    <!-- <td><span class="status-badge status-paid">Paid</span></td>
                                     -->
                                        <!-- <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="viewReceipt('WRP-002')">
                                            <i class="fas fa-eye"></i>
                                        </button> -->
                                    
                                </tr>
                                <tr>
                                    <td>002</td>
                                    <td>ruwanthika</td>
                                    <td>0786607436</td>
                                    <td></td>
                                    <td style="font-weight: 600;">$35.00</td>
                                    <td><span class="status-badge status-pending">Pending</span></td>
                                    
                                        <!-- <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="followUpPayment('WRP-003')">
                                            <i class="fas fa-phone"></i>
                                        </button> -->
                                    
                                </tr>
                                <tr>
                                    <td>003</td>
                                    <td>sadunika</td>
                                    <td>0786607436</td>
                                    <td>David Lee</td>
                                    <td style="font-weight: 600;">$28.00</td>
                                    <td><span class="status-badge status-paid">Paid</span></td>
                                    
                                        <!-- <button class="btn btn-ghost" style="padding: 4px 8px; font-size: 0.8rem;" onclick="viewReceipt('WRP-004')">
                                            <i class="fas fa-eye"></i>
                                        </button> -->
                                    
                                </tr>
                            </tbody>
                        </table>
        </div>
        </div>
      </section>
    </div>
  </div>
</body>

</html>
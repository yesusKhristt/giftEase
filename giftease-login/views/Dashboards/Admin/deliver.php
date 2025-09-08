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
      <section id="deliveries" class="page active">
        <div class="page-header">
          <div>
            <h3>Deliveries</h3>
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
    </div>
  </div>
</body>

</html>
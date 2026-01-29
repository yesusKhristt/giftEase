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
    include 'views/commonElements/leftSidebarChathu.php';
    ?>
    <div class="main-content">
      <section id="items" class="page active" aria-labelledby="items-title">
        <div class="page-header">
          <h1 class="title">items</h1>
          <p class="subtitle">items list</p>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>oder id</th>
              <th>Vendor id </td>
              <th>product name </th>
              <th>quantity</th>
              <th>price</th>
              <th>category</td>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>001</td>
              <td>WRP-001</td>
              <td>mugs</td>
              <td>589</td>
              <td style="font-weight: 600;">Rs.2500.00</td>
              <td><span class="status-badge status-paid">pakeging</span></td>

            </tr>
            <tr>
              <td>004</td>
              <td>WRP-002</td>
              <td>flowers</td>
              <td>900</td>
              <td style="font-weight: 600;">Rs.1200.00</td>
              <td><span class="status-badge status-paid">cards></td></span>

            </tr>
            <tr>
              <td>007</td>
              <td>WRP-003</td>
              <td>chocolates</td>
              <td>10000</td>
              <td style="font-weight: 600;">Rs.3500.00</td>
              <td><span class="status-badge status-pending">cards</td></span>

            </tr>
            <tr>
              <td>0011</td>
              <td>WRP-004</td>
              <td>cats</td>
              <td>200</td>
              <td style="font-weight: 600;">Rs.2800.00</td>
              <td><span class="status-badge status-paid">ass</td></span>

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
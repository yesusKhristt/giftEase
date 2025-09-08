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
      <section id="customers" class="page active">
        <div class="page-header">
          <div>
            <h3>Customers</h3>
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
    </div>
  </div>
</body>

</html>
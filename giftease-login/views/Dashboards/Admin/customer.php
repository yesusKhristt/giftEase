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
    include 'views/commonElements/leftSidebarChathu.php';
    ?>
    <div class="main-content">

      <section id="customers" class="page active">
        <div class="page-header">
          <h1 class="title">Customer</h1>
          <p class="subtitle">Customer List</p>

        </div>




        <table class="table" style="border: 20px;">
          <thead>
            <tr>
              <th>oredr ID</th>
              <th>Name</th>
              <th>Phone</th>
              <th>coustomer ID</th>
              <th>Date</th>

            </tr>
          </thead>
          <tbody>
            <tr>
              <td>001</td>
              <td>chathu</td>
              <td>0786607436</td>
              <td>*009</td>
              <td style="font-weight: 600;">2026/02/03</td>


            </tr>
            <tr>
              <td>002</td>
              <td>oshani</td>
              <td>0786607436</td>
              <td>*008 </td>
              <td style="font-weight: 600;">2026/02/05</td>


            </tr>
            <tr>
              <td>003</td>
              <td>ruwanthika</td>
              <td>0786607436</td>
              <td>*001</td>
              <td style="font-weight: 600;">2026/02/04</td>


            </tr>
            <tr>
              <td>003</td>
              <td>sadunika</td>
              <td>0786607436</td>
              <td>*007</td>
              <td style="font-weight: 600;">2026/03/04</td>


            </tr>
          </tbody>
        </table>
    </div>
  </div>
  </section>
  </div>
  </div>
</body>
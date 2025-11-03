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
    include 'views/commonElements/leftSidebarChathu.php';
    ?>
    <div class="main-content">

      <section id="customers" class="page active">
        <div class="page-header">
          <h1 class="title">Deliver</h1>
          <p class="subtitle">Deliver List</p>

          </button>
          <table class="table">
            <thead>
              <tr>
                <th>date</th>
                <th>Vendor id</th>
                <th>method</th>
                <th>Address</th>
                <th>oder id</th>
                <th>deliver id</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Jan 20, 2024</td>
                <td>WRP-001</td>
                <td>Premium Gift Wrapping</td>
                <td>wawrukannala ,kadurupokuna,tangalle</td>
                <td style="font-weight: 600;">001</td>
                <td><span class="status-badge status-paid">#997</span></td>

              </tr>
              <tr>
                <td>Jan 19, 2024</td>
                <td>WRP-002</td>
                <td>Custom Ribbon + Card</td>
                <td>ashen home,kadurupokuna ,tanglle</td>
                <td style="font-weight: 600;">002</td>
                <td><span class="status-badge status-paid">#998</span></td>

              </tr>
              <tr>
                <td>Jan 18, 2024</td>
                <td>WRP-003</td>
                <td>Luxury Gift Box</td>
                <td>100/5, colombo 7</td>
                <td style="font-weight: 600;">003</td>
                <td><span class="status-badge status-pending">#999</span></td>

              </tr>
              <tr>
                <td>Jan 17, 2024</td>
                <td>WRP-004</td>
                <td>Theme Wrapping</td>
                <td>100/10 ,goyambokka,tanglle</td>
                <td style="font-weight: 600;">004</td>
                <td><span class="status-badge status-paid">#992</span></td>

              </tr>
            </tbody>
          </table>
        </div>
      </section>
    </div>
  </div>
</body>
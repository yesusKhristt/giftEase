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
          </div>

          <table class="table">
            <thead>
              <tr>
                <th>Delivery id</th>
                <th>Phone</th>
                <th>vehicle Number</th>
                <th>Address</th>
                <th>Created at</th>
              </tr>
            </thead>
            <tbody>
              
              <?php foreach ($allDelivery as $row): ?>
              <tr>
                <td><?= htmlspecialchars($row['id']); ?></td>
                <td><?=htmlspecialchars($row['phone']); ?></td>
                <td><?=htmlspecialchars($row['vehicleNumber']); ?></td>
                <td><?=htmlspecialchars($row['address']); ?></td>
                <td><?=htmlspecialchars( $row['created_at']);?></td>              
              
              <?php endforeach ?>
              
            </tbody>
          </table>
        </div>
      </section>
    </div>
  </div>
</body>
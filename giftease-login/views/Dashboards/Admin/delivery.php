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
          <h1 class="title">Delivery</h1>
          <p class="subtitle">Delivery List</p>
          </button>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email</th>
              <th>Status</th>
              <th>Address</th>
              <th>Vehicle Plate</th>
              <th>Phone</th>
              <th>Created At</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($allDelivery as $delivery): ?>
              <tr>
                <td><?= $delivery['id'] ?></td>
                <td><?= $delivery['first_name'] ?></td>
                <td><?= $delivery['last_name'] ?></td>
                <td><?= $delivery['email'] ?></td>
                <td><?= $delivery['status'] ?></td>
                <td><?= $delivery['address'] ?></td>
                <td><?= $delivery['vehiclePlate'] ?></td>
                <td><?= $delivery['phone'] ?></td>
                <td><?= $delivery['created_at'] ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
    </section>
  </div>
  </div>
</body>
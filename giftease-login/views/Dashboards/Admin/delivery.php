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
              <th>Verified</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($allDelivery as $delivery): ?>
              <tr>
                <td><?php echo $delivery['id']?></td>
                <td><?php echo $delivery['first_name']?></td>
                <td><?php echo $delivery['last_name']?></td>
                <td><?php echo $delivery['email']?></td>
                <td><?php echo $delivery['status']?></td>
                <td><?php echo $delivery['address']?></td>
                <td><?php echo $delivery['vehiclePlate']?></td>
                <td><?php echo $delivery['phone']?></td>
                <td><?php echo $delivery['created_at']?></td>
                <?php if ($row['verified']) {?>
                                <td>
                                    <a class="btn2" href="?controller=admin&action=dashboard/vendor/unverify/<?php echo htmlspecialchars($row['id'])?>">
                                        Unverify
                                    </a>
                                </td>
                            <?php } else {?>
                                <td>
                                    <a class="btn1" href="?controller=admin&action=dashboard/vendor/verify/<?php echo htmlspecialchars($row['id'])?>">
                                        Verify
                                    </a>
                                </td>
                            <?php }?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
    </section>
  </div>
  </div>
</body>
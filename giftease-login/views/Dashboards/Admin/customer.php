<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Vendor Analysis</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body data-page="customer">
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
              <th>Email</th>
              <th>Date</th>

            </tr>
          </thead>
          <tbody>
            <?php if (!empty($clients)) : ?>
              <?php foreach ($clients as $row) : ?>
                <tr>
                  <td><?= htmlspecialchars($row['id']) ?></td>
                  <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                  <td><?= htmlspecialchars($row['phone']) ?></td>
                  <td><?= htmlspecialchars($row['email']) ?></td>
                  <td><?= htmlspecialchars($row['created_at']) ?></td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="5" style="text-align:center;color:red;">
                  No customers found
                </td>
              </tr>
            <?php endif; ?>

          </tbody>
        </table>
    </div>
  </div>
  </section>
  </div>
  </div>
</body>
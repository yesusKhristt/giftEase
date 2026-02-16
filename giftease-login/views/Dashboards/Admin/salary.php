<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Monthly Salary - GiftEase</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="icon" type="image/png" href="resources/1.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  <div class="container">
    <?php
    $activePage = 'salary';
    include 'views/commonElements/leftSidebarChathu.php';
    $rows = $rows ?? [];
    ?>

    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Monthly Salary</h1>
        <p class="subtitle">Stakeholders with salary in the current month</p>
      </div>

      <div class="card">
        <table class="table">
          <thead>
            <tr>
              <th>Role</th>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Monthly Salary</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($rows)) : ?>
              <tr>
                <td colspan="7" style="text-align:center; padding:30px; color:#999;">No salary records this month.</td>
              </tr>
            <?php else : ?>
              <?php foreach ($rows as $row) : ?>
                <tr>
                  <td><?= htmlspecialchars($row['role']) ?></td>
                  <td>#<?= htmlspecialchars($row['id']) ?></td>
                  <td><?= htmlspecialchars($row['name'] !== '' ? $row['name'] : 'N/A') ?></td>
                  <td><?= htmlspecialchars($row['email']) ?></td>
                  <td><?= htmlspecialchars($row['phone']) ?></td>
                  <td style="font-weight: 600;">Rs<?= htmlspecialchars(number_format((float) $row['monthly'], 2)) ?></td>
                  <td><a class="btn1" href="<?= htmlspecialchars($row['link']) ?>">View</a></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

</html>

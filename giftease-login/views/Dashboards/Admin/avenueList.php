<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Avenue - GiftEase</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
 
    <?php
    $activePage = 'avenue';
    include 'views/commonElements/leftSidebarChathu.php';
    ?>

    <div class="main-content">
      <div class="page-header">
        <h1 class="title"><?= htmlspecialchars($pageTitle ?? 'Stakeholders') ?></h1>
        <p class="subtitle">Select a record to view full details</p>
      </div>

      <div class="card">
        <table class="table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($items)) : ?>
              <tr>
                <td colspan="6" style="text-align:center; padding:30px; color:#999;">No records found.</td>
              </tr>
            <?php else : ?>
              <?php foreach ($items as $row) : ?>
                <?php
                  $name = trim(($row['first_name'] ?? '') . ' ' . ($row['last_name'] ?? ''));
                  $statusLabel = $row['status'] ?? 'inactive';
                ?>
                <tr>
                  <td>#<?= htmlspecialchars($row['id']) ?></td>
                  <td><?= htmlspecialchars($name !== '' ? $name : 'N/A') ?></td>
                  <td><?= htmlspecialchars($row['email'] ?? 'N/A') ?></td>
                  <td><?= htmlspecialchars($row['phone'] ?? 'N/A') ?></td>
                  <td>
                    <span class="status-pill <?= $statusLabel === 'active' ? 'status-active' : 'status-inactive' ?>">
                      <?= htmlspecialchars(ucfirst($statusLabel)) ?>
                    </span>
                  </td>
                  <td>
                    <a class="btn1" href="?controller=admin&action=dashboard/avenue/<?= htmlspecialchars($type) ?>/<?= htmlspecialchars($row['id']) ?>">
                      View
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
 
</body>

</html>

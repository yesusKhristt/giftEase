<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" type="image/png" href="resources/1.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Delivery Partner Dashboard - GiftEase</title>
  <link rel="stylesheet" href="public/backup/style.css">
  <link rel="stylesheet" href="public/sideTopBar.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>


  <?php
  $activePage = 'codecheck';
  include 'views/commonElements/leftSidebarChathu.php';

  $adminProfile = $adminProfile ?? [];
  $profileStats = $profileStats ?? [];
  $fullName = trim((string)(($adminProfile['first_name'] ?? '') . ' ' . ($adminProfile['last_name'] ?? '')));
  $displayName = $fullName !== '' ? $fullName : 'Admin';
  $profileImage = trim((string)($adminProfile['image_loc'] ?? ''));
  $createdAt = !empty($adminProfile['created_at']) ? date('M Y', strtotime((string)$adminProfile['created_at'])) : 'N/A';
  ?>
  <div class="main-content">
    <div class="page-header">
      <h1 class="title">Code Check</h1>
      <p class="subtitle">Finish 2nd Year</p>
    </div>





    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Role</th>
          <th>Requested Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($all)) : ?>
          <tr>
            <td colspan="5" class="empty-row">No pending withdrawal requests right now.</td>
          </tr>
        <?php else : ?>
          <?php foreach ($all as $row) :
            $id;
            $role;
            $status;
            //var_dump($row);
            if ($row['vendor_id']) {
              $id = htmlspecialchars($row['vendor_id']);
              $role = 'Vendor';
            }
            if ($row['delivery_id']) {
              $id = htmlspecialchars($row['delivery_id']);
              $role = 'Delivery';
            }
            if ($row['giftWrapper_id']) {
              $id = htmlspecialchars($row['giftWrapper_id']);
              $role = 'Gift Wrapper';
            }

            if ($row['status'] === null) {
              $status = 'Pending';
            }
            if ($row['status'] === 1) {
              $status = 'Aproved';
            }
            if ($row['status'] === 0) {
              $status = 'Rejected';
            }
          ?>
            <tr>
              <td><?= htmlspecialchars($row['id']) ?></td>
              <td><?= htmlspecialchars($row['fName']) ?> <?= htmlspecialchars($row['lName']) ?></td>
              <td><?= htmlspecialchars($role) ?></td>
              <td><?= htmlspecialchars($row['amount']) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>

    <table class='table'>
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Requested Amount</th>
        </tr>
        
      </thead>
      <tbody>
        <?php foreach ($users as $row) :
        ?>
      <tr>
              <td><?= htmlspecialchars($row['vendor_id']) ?></td>
              <td><?= htmlspecialchars($row['fName']) ?> <?= htmlspecialchars($row['lName']) ?></td>
              <td><?= htmlspecialchars($row['count']) ?></td>
            </tr>
            <?php endforeach; ?>
      </tbody>
    </table>
</body>

</html>
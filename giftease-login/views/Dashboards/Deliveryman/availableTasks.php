<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Available Pickup Tasks - GiftEase</title>
  <link rel="stylesheet" href="public/deliverystyle.css">
  <link rel="icon" type="image/png" href="resources/1.png">
</head>
<body>
  <div class="container">
    <?php
      $activePage = 'available';
      include 'views/commonElements/leftSidebarDeliveryman.php';
    ?>

    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Available Pickup Tasks</h1>
        <p class="subtitle">Accept pending tasks from shops</p>
      </div>

      <div class="card">
        <table class="table">
          <thead>
            <tr>
              <th>Task</th>
              <th>Client</th>
              <th>Shop</th>
              <th>Items</th>
              <th>Due Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($availableTasks)): ?>
              <tr>
                <td colspan="6" style="text-align: center; color: #888;">No available pickup tasks right now.</td>
              </tr>
            <?php else: ?>
              <?php foreach ($availableTasks as $task): ?>
                <tr>
                  <td>#PK-<?= htmlspecialchars((string)$task['id']) ?> / ORD-<?= htmlspecialchars((string)$task['order_id']) ?></td>
                  <td><?= htmlspecialchars($task['client_first_name'] . ' ' . $task['client_last_name']) ?></td>
                  <td>
                    <?= htmlspecialchars($task['shopName']) ?><br>
                    <small><?= htmlspecialchars($task['vendor_address']) ?></small>
                  </td>
                  <td><?= htmlspecialchars($task['products'] ?? 'N/A') ?> (<?= (int)($task['total_quantity'] ?? 0) ?>)</td>
                  <td><?= htmlspecialchars((string)$task['deliveryDate']) ?></td>
                  <td>
                    <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                      <a class="btn1" style="display: inline-flex; width: auto;" href="?controller=deliveryman&action=dashboard/map&destination=<?= urlencode($task['vendor_address']) ?>&task=<?= (int)$task['id'] ?>">Open Shop Map</a>
                      <a class="btn1" style="display: inline-flex; width: auto;" href="?controller=deliveryman&action=dashboard/acceptTask/<?= (int)$task['id'] ?>">Accept</a>
                    </div>
                  </td>
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

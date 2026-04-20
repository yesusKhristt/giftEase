<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Pickup Tasks - GiftEase</title>
  <link rel="stylesheet" href="public/deliverystyle.css">
  <link rel="stylesheet" href="public/sideTopBar.css" />
  <link rel="icon" type="image/png" href="resources/1.png">
</head>

<body>
  <div class="container">
    <?php
    $activePage = 'myTasks';
    include 'views/commonElements/leftSidebarDeliveryman.php';
    ?>

    <div class="main-content">
      <div class="page-header">
        <h1 class="title">My Pickup Tasks</h1>
        <p class="subtitle">Track and update your assigned tasks</p>
      </div>

      <div class="card">
        <table class="table">
          <thead>
            <tr>
              <th>Task</th>
              <th>Status</th>
              <th>Shop</th>
              <th>Items</th>
              <th>Due Date</th>
              <th class="action-col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (empty($myTasks)): ?>
              <tr>
                <td colspan="6" style="text-align: center; color: #888;">No assigned tasks yet.</td>
              </tr>
            <?php else: ?>
              <?php foreach ($myTasks as $task): ?>
                <?php
                $statusText = [
                  'assigned' => 'Go to Shop',
                  'picked_up' => 'Picked From Shop',
                  'at_outlet' => 'Reached Outlet',
                  'completed' => 'Completed',
                  'cancelled' => 'Cancelled',
                ];
                ?>
                <tr>
                  <td>#PK-<?= htmlspecialchars((string)$task['id']) ?> / ORD-<?= htmlspecialchars((string)$task['order_id']) ?></td>
                  <td><?= htmlspecialchars($statusText[$task['status']] ?? ucfirst(str_replace('_', ' ', (string)$task['status']))) ?></td>
                  <td><?= htmlspecialchars($task['shopName']) ?></td>
                  <td><?= htmlspecialchars($task['products'] ?? 'N/A') ?></td>
                  <td><?= htmlspecialchars((string)$task['deliveryDate']) ?></td>
                  <td class="action-cell">
                    <div class="action-buttons">
                      <a class="btn1" style="display: inline-flex; width: auto;" href="?controller=deliveryman&action=dashboard/map&destination=<?= urlencode($task['vendor_address']) ?>&task=<?= (int)$task['id'] ?>">Open Shop Map</a>
                      <?php if ($task['status'] === 'assigned'): ?>
                        <a class="btn1" style="display: inline-flex; width: auto;" href="?controller=deliveryman&action=dashboard/markPickedUp/<?= (int)$task['id'] ?>">Confirm Pickup</a>
                        <a class="btn1" style="display: inline-flex; width: auto; background: #b91c1c; color: #ffffff ;" href="?controller=deliveryman&action=dashboard/cancelTask/<?= (int)$task['id'] ?>" onclick="return confirm('Cancel this task and return it to available tasks?');">Cancel Task</a>
                      <?php elseif ($task['status'] === 'picked_up'): ?>
                        <a class="btn1" style="display: inline-flex; width: auto;" href="?controller=deliveryman&action=dashboard/markAtOutlet/<?= (int)$task['id'] ?>/<?= $task['order_id'] ?>">Confirm At Outlet</a>
                      <?php elseif ($task['status'] === 'at_outlet'): ?>
                        <a class="btn1" style="display: inline-flex; width: auto;" href="?controller=deliveryman&action=dashboard/markCompleted/<?= (int)$task['id'] ?>">Finish Task</a>
                      <?php else: ?>
                        <span style="color: #666;">Done</span>
                      <?php endif; ?>
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
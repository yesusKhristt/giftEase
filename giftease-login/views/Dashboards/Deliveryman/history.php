<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pickup History - GiftEase</title>
    <link rel="stylesheet" href="public/deliverystyle.css">
    <link rel="stylesheet" href="public/sideTopBar.css" />
    <link rel="icon" type="image/png" href="resources/1.png">
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'history';
        include 'views/commonElements/leftSidebarDeliveryman.php';

        $dateFrom = $_GET['dateFrom'] ?? '';
        $dateTo   = $_GET['dateTo'] ?? '';
        $status   = $_GET['status'] ?? 'all';
        $customer = $_GET['customer'] ?? '';
        ?>

        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Pickup History</h1>
                <p class="subtitle">Completed and closed tasks</p>
            </div>

            <!-- FILTER FORM -->
            <form method="GET" action="index.php">
                <input type="hidden" name="controller" value="deliveryman">
                <input type="hidden" name="action" value="dashboard/history">

                <div class="filter-tabs history-filters">
                    <div class="filter-group">
                        <label>Date From</label>
                        <input type="date" name="dateFrom" value="<?= htmlspecialchars($dateFrom) ?>">
                    </div>

                    <div class="filter-group">
                        <label>Date To</label>
                        <input type="date" name="dateTo" value="<?= htmlspecialchars($dateTo) ?>">
                    </div>

                    <div class="filter-group">
                        <label>Status</label>
                        <select name="status">
                            <option value="all" <?= $status === 'all' ? 'selected' : '' ?>>All Status</option>
                            <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Completed</option>
                            <option value="cancelled" <?= $status === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Shop Name</label>
                        <input type="text" name="customer" placeholder="Search shop..." value="<?= htmlspecialchars($customer) ?>">
                    </div>

                    <div class="filter-actions history-filter-actions">
                        <button type="submit" class="btn1"><i class="fas fa-search"></i> Filter</button>
                        <a href="index.php?controller=deliveryman&action=dashboard/history" class="btn1"><i class="fas fa-undo"></i> Reset</a>
                    </div>
                </div>
            </form>





            <table class="table">
                <thead>
                    <tr>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Shop</th>
                        <th>Items</th>
                        <th>Due Date</th>
                        <th>Completed At</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($historyTasks)): ?>
                        <tr>
                            <td colspan="6" style="text-align: center; color: #888;">No history records yet.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($historyTasks as $task): ?>
                            <tr>
                                <td>#PK-<?= htmlspecialchars((string)$task['id']) ?> / ORD-<?= htmlspecialchars((string)$task['order_id']) ?></td>
                                <td><?= htmlspecialchars(str_replace('_', ' ', ucfirst((string)$task['status']))) ?></td>
                                <td><?= htmlspecialchars($task['shopName']) ?></td>
                                <td><?= htmlspecialchars($task['products'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars((string)$task['deliveryDate']) ?></td>
                                <td><?= htmlspecialchars((string)($task['completed_at'] ?? $task['at_outlet_at'] ?? $task['picked_up_at'] ?? 'N/A')) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>
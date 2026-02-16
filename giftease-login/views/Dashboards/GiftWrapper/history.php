<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wrapping Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="icon" type="image/png" href="resources/1.png">
    <link rel="profile" href="profile.php" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>

    <div class="container">
        <?php
        $activePage = 'history';
        include 'views\commonElements/leftSidebarJeshani.php';

        $dateFrom = $_GET['dateFrom'] ?? '';
        $dateTo = $_GET['dateTo'] ?? '';
        $status = $_GET['status'] ?? 'all';
        $customer = $_GET['customer'] ?? '';
        ?>

        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Wrapping History</h1>
                <p class="subtitle">View your completed and pending wrapping orders</p>
            </div>

            <form method="GET" action="index.php">
                <input type="hidden" name="controller" value="giftWrapper">
                <input type="hidden" name="action" value="dashboard/history">

                <div class="filter-tabs">
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
                            <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <label>Customer Name</label>
                        <input type="text" name="customer" placeholder="Search customer..." value="<?= htmlspecialchars($customer) ?>">
                    </div>

                    <div class="filter-actions">
                        <button type="submit" class="btn1"><i class="fas fa-search"></i> Filter</button>
                        <a href="index.php?controller=giftWrapper&action=dashboard/history" class="btn1"><i class="fas fa-undo"></i> Reset</a>
                    </div>
                </div>
            </form>

            <div style="margin: 15px 0; color: #666;">
                Showing <?= count($history) ?> records
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Delivery Date</th>
                        <th>Status</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($history)) : ?>
                        <tr>
                            <td colspan="5" style="text-align:center; padding:30px; color:#999;">
                                No records found matching your filters.
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ($history as $row) : ?>
                            <?php
                                $dateLabel = !empty($row['deliveryDate']) ? date('M d, Y', strtotime($row['deliveryDate'])) : 'N/A';
                                $customerName = trim(($row['first_name'] ?? '') . ' ' . ($row['last_name'] ?? ''));
                                $statusLabel = ((int) ($row['is_wrapped'] ?? 0)) === 1 ? 'Completed' : 'Pending';
                                $statusClass = ((int) ($row['is_wrapped'] ?? 0)) === 1 ? 'status-verified' : 'status-pending';
                            ?>
                            <tr>
                                <td>#<?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($customerName !== '' ? $customerName : 'N/A') ?></td>
                                <td><?= htmlspecialchars($dateLabel) ?></td>
                                <td><span class="status-badge <?= $statusClass ?>"><?= htmlspecialchars($statusLabel) ?></span></td>
                                <td style="font-weight: 600;">Rs<?= htmlspecialchars(number_format((float) ($row['amount'] ?? 0), 2)) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

        </div>
    </div>

    <script src="script.js"></script>
</body>

</html>

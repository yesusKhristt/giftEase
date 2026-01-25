<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order</title>
</head>
<body>

<?php
session_start();
require_once 'config/database.php';
require_once 'models/NotificationModel.php';

if (!isset($_SESSION['user'])) {
    die("Login required");
}

$notificationModel = new NotificationModel($pdo);
$notifications = $notificationModel->getNotifications($_SESSION['user']['id'], 50);
?>

<h2>🔔 Admin Notifications</h2>

<?php if (empty($notifications)): ?>
    <p>No notifications</p>
<?php endif; ?>

<?php foreach ($notifications as $n): ?>
    <div style="padding:10px; margin-bottom:10px;
        border:1px solid #ccc;
        background: <?= $n['is_read'] ? '#f9f9f9' : '#e6f7ff' ?>">

        <strong><?= htmlspecialchars($n['message']) ?></strong><br>
        <small><?= $n['created_at'] ?></small>

        <?php if (!$n['is_read']): ?>
            <form method="POST" action="mark-read.php">
                <input type="hidden" name="id" value="<?= $n['id'] ?>">
                <button type="submit">Mark as read</button>
            </form>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

    
</body>
</html>

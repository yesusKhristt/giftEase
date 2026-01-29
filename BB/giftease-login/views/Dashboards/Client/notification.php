<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'allOrder';
        include 'views\commonElements/leftSidebarDilma.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">All Orders</h1>
                <p class="subtitle">Orders currently placed by clients.</p>
            </div>
            <div class="filter-tabs">
                <button class="btn2" onclick="markAllRead()">Mark All Read</button>
                <button class="btn1" onclick="clearNotifications()">Clear All</button>
            </div>
            <?php foreach ($notifications as $row): ?>
                <?php
                $seconds = time() - strtotime($row['created_at']) + 19800;

                if ($seconds < 60) {
                    $ago = "$seconds seconds ago";
                } else if ($seconds < 3600) {
                    $ago = floor($seconds / 60) . " minutes ago";
                } else if ($seconds < 86400) {
                    $ago = floor($seconds / 3600) . " hours ago";
                } else if ($seconds < 604800) {
                    $ago = floor($seconds / 86400) . " days ago";
                } else {
                    $ago = floor($seconds / 604800) . " weeks ago";
                }

                ?>
                <?php
                if ($row['is_read']) echo ("<div class='notification-item read'>");
                else echo ("<div class='notification-item unread'>");
                ?>
                <div class="notification-content">
                    <div class="notification-title"><?php echo htmlspecialchars($row['title']) ?></div>
                    <div class="notification-text"><?php echo htmlspecialchars($row['message']) ?></div>
                    <button class="btn1"
                        onclick="loadPage(
        '<?php echo htmlspecialchars($row['href'], ENT_QUOTES); ?>',
        <?php echo (int)$row['id']; ?>
    )">
                        View
                    </button>
                </div>
        </div>

    <?php endforeach ?>
    <div class="notification-time"><?php echo htmlspecialchars($ago) ?></div>
    <button class="notification-dismiss" onclick="dismissNotification(1)">&times;</button>
    </div>
    </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <button class="btn1" onclick="acceptOrder('DEL-006')">Accept</button>
    <button class="btn2" onclick="markAllRead()">Mark All Read</button>
    <button class="btn1" onclick="clearNotifications()">Clear All</button>
</body>
<script>
    async function loadPage(href, id) {
        const url = "?controller=client&action=dashboard/notificationViewed/" + id;

        const response = await fetch(url, {
            method: "GET",
            keepalive: true
        });

        if (!response.ok) {
            console.error("Network error");
        }

        window.location.href = href;
    }
</script>

</html>
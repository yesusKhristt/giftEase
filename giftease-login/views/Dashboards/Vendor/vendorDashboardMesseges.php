<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="public/style.css">
</head>

<body>
    <div class="sideBar">
        <h2 class="Heading blueT"><span class="orangeT">gift</span><b>Ease</b></h2>
        <ul>
            <li onclick="location.href='?action=dashboard&type=vendor&level=primary'">Orders</a>
            <li onclick="location.href='?action=dashboard&type=vendor&level=inventory'">Inventory</a>
            <li class="active">Messages</a>
            <li onclick="location.href='?action=dashboard&type=vendor&level=analysis'">Analysis</a>
        </ul>
    </div>

    <div class="main">
        <div class="client-list">
            <div class="bold">Clients</div>
            <p>Thenuka</p>
            <p>Umaya</p>
            <!-- More clients -->
        </div>

        <div class="message-box">
            <div class="bold">Messages</div>
            <p>Hi, can I change the wrap color?</p>
            <p>Sure, please confirm the new color.</p>
            <!-- Message history -->
        </div>

        <div class="client-details">
            <div class="client-name">Thenuka Ranasinghe</div>
            <p>Order Deadline: 2025-08-10</p>
            <button class="blue">View Order</button>
            <button class="orange">Cancel Order</button>
        </div>
    </div>
</body>

</html>
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
            <li class="active">Inventory</a>
            <li onclick="location.href='?action=dashboard&type=vendor&level=messeges'">Messages</a>
            <li onclick="location.href='?action=dashboard&type=vendor&level=analysis'">Analysis</a>
        </ul>
    </div>

    <div class="main">
        <div class="HeadingB blueT">Inventory</div>
        <div class="subHeading">Active & Paused Items</div>

        <div class="item-row">
            <div class="item-card">
                <img src="placeholder.jpg" alt="Gift Wrap A">
                <div class="bold">Gift Wrap A</div>
                <div class="status blueT">Active</div>
            </div>
            <div class="item-card">
                <img src="placeholder.jpg" alt="Gift Wrap B">
                <div class="bold">Gift Wrap B</div>
                <div class="status orangeT">Paused</div>
            </div>
            <!-- Add more items dynamically -->
        </div>
    </div>
</body>

</html>
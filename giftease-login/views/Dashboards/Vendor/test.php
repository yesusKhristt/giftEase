<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vendor Orders</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="icon" href="resources/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
    <div class="container">
        <?php
        $activePage = 'orders';
        include 'views\commonElements/leftSidebar.php';
        ?>
        <div class="main-content">

            <?php
            var_dump($profilePicPath);
            ?>
        </div>
    </div>
</body>

</html>
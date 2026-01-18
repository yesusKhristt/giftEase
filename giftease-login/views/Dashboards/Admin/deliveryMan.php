<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vendor Analysis</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body data-page="delivery man">
<div class="container">

<?php
$activePage = 'delivery';
include 'views/commonElements/leftSidebarChathu.php';
?>

<div class="main-content">
<section id="customers" class="page active">
    <div class="page-header">
        <h1 class="title">Delivery</h1>
        <p class="subtitle">Delivery List</p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Delivery ID</th>
                <th>Phone</th>
                <th>Vehicle Number</th>
                <th>Address</th>
                <th>Created At</th>
            </tr>
        </thead>

<tbody>
<?php if (!empty($deliveries)) : ?>
    <?php foreach ($deliveries as $row) : ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['phone']) ?></td>
            <td><?= htmlspecialchars($row['vehiclePlate']) ?></td>
            <td><?= htmlspecialchars($row['address']) ?></td>
            <td><?= htmlspecialchars($row['created_at']) ?></td>
        </tr>
    <?php endforeach; ?>
<?php else : ?>
    <tr>
        <td colspan="5" style="text-align:center;color:red;">
            No delivery persons found
        </td>
    </tr>
<?php endif; ?>
</tbody>

    </table>

</section>
</div>

</div>
</body>
</html>

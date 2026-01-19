<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vendor Analysis</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php
            $activePage = 'deliveryman';
            include 'views/commonElements/leftSidebarChathu.php';
        ?>
        <div class="main-content">

            <section id="customers" class="page active">
                <div class="page-header">
                    <h1 class="title">Deliverman</h1>
                    <p class="subtitle">Deliverman List</p>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Address</th>
                            <th>Vehicle Plate</th>
                            <th>Phone</th>
                            <th>Created At</th>
                            <th>Verified</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allDeliveryman as $row): ?>
                            <tr>
                                <td><?php echo $row['id'] ?></td>
                                <td><?php echo $row['first_name'] ?></td>
                                <td><?php echo $row['last_name'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['status'] ?></td>
                                <td><?php echo $row['address'] ?></td>
                                <td><?php echo $row['vehiclePlate'] ?></td>
                                <td><?php echo $row['phone'] ?></td>
                                <td><?php echo $row['created_at'] ?></td>
                                <?php if ($row['verified']) {?>
                                <td>
                                    <a class="btn2" href="?controller=admin&action=dashboard/vendor/unverify/<?php echo htmlspecialchars($row['id'])?>">
                                        Unverify
                                    </a>
                                </td>
                            <?php } else {?>
                                <td>
                                    <a class="btn1" href="?controller=admin&action=dashboard/vendor/verify/<?php echo htmlspecialchars($row['id'])?>">
                                        Verify
                                    </a>
                                </td>
                            <?php }?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
        </section>
    </div>
    </div>
</body>
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
        $activePage = 'vendor';
        include 'views/commonElements/leftSidebarChathu.php';
        ?>
        <div class="main-content">
            <section id="deliveries" class="page active">
                <div class="page-header">
                    <h1 class="title">vendor</h1>
                    <p class="subtitle">vendor list</p>
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
                            <th>Shop Name</th>
                            <th>Phone</th>
                            <th>Rating</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($allVendors as $row): ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['first_name'] ?></td>
                                <td><?= $row['last_name'] ?></td>
                                <td><?= $row['email'] ?></td>
                                <td><?= $row['status'] ?></td>
                                <td><?= $row['address'] ?></td>
                                <td><?= $row['shopName'] ?></td>
                                <td><?= $row['phone'] ?></td>
                                <td><?= number_format($row['rating'], 1) ?></td>
                                <td><?= $row['created_at'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </div>
        </section>
    </div>
    </div>
</body>
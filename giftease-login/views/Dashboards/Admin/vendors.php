<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vendor Analysis</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body data-page="vendor">
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
                            <th>Vendor id</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Shop name</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($vendors)) : ?>
                            <?php foreach ($vendors as $row) : ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['id']) ?></td>
                                    <td><?= htmlspecialchars($row['first_name'] . ' ' . $row['last_name']) ?></td>
                                    <td><?= htmlspecialchars($row['phone']) ?></td>
                                    <td><?= htmlspecialchars($row['shopName']) ?></td>
                                    <td><?= htmlspecialchars($row['address']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="6" style="text-align:center;color:red;">
                                    No vendors found
                                </td>
                            </tr>
                        <?php endif; ?>
                </table>
        </div>
        </section>
    </div>
    </div>
</body>
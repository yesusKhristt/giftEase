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
        $activePage = 'history';
        include 'views/commonElements/leftSidebar.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Order History</h1>
                <p class="subtitle">View your past orders</p>

            </div>

            <div>
                <table style="margin-top: 20px;" class="order-table">
                    <div>
                        <thead class="order-table-card ">
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>#12345</td>
                                <td>2023-10-01</td>
                                <td>Delivered</td>
                                <td>$180</td>
                            </tr>
                            <tr>
                                <td>#12346</td>
                                <td>2023-09-25</td>
                                <td>Pending</td>
                                <td>$200</td>
                            </tr>
                            <tr>
                                <td>#12347</td>
                                <td>2023-09-20</td>
                                <td>Cancelled</td>
                                <td>$150</td>
                            </tr>
                        </tbody>

                </table>
            </div>

        </div>
</body>

</html>
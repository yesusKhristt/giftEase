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
        $activePage = 'orders';
        include 'views\commonElements/leftSidebar.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">View Order</h1>
                <p class="subtitle">Slaughterspine</p>
            </div>

            <h2>Order #10234</h2>

            <div class="order-info">
                <p><strong>Date:</strong> Feb 17, 2025</p>
                <p><strong>Customer:</strong> John Doe</p>
                <p><strong>Email:</strong> john@example.com</p>
                <p><strong>Address:</strong> 123 Main Street, Colombo</p>
                <p><strong>Payment Status:</strong> <span class="status status-paid">Paid</span></p>
                <p><strong>Delivery Status:</strong> <span class="status status-processing">Processing</span></p>
            </div>

            <h3>Purchased Items</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Premium Chocolate Box</td>
                        <td>2</td>
                        <td>$25.99</td>
                        <td>$51.98</td>
                    </tr>
                    <tr>
                        <td>Golden Bow Tie</td>
                        <td>1</td>
                        <td>$3.75</td>
                        <td>$3.75</td>
                    </tr>
                    <tr>
                        <td>Luxury Wrapping Paper</td>
                        <td>3</td>
                        <td>$7.25</td>
                        <td>$21.75</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3">Total</td>
                        <td>$77.48</td>
                    </tr>
                </tfoot>
            </table>

        </div>
</body>

</html>
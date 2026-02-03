<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>


<body>

    <div class="container">
        <?php
        $activePage = 'cart';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Payment Details</h1>
                <p class="subtitle">Confirm your payment moethod and Place your order</p>

            </div>


            <div>
                <div>
                    <table>
                        <tr>
                            <td>
                                <h3>Product Price :</h3>
                            </td>
                            <td>
                                <h2>Rs. <?php echo html_entity_decode($_SESSION['checkout']['cart']['productPrice']); ?></h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Delivery Price :</h3>
                            </td>
                            <td>
                                <h2>Rs. <?php echo html_entity_decode($_SESSION['checkout']['delivery']['deliveryPrice']); ?></h2>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h3>Wrapping Price :</h3>
                            </td>
                            <td>
                                <h2>Rs. <?php echo html_entity_decode($_SESSION['checkout']['wrap']['totalPrice']); ?></h2>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- <form method="post"> -->
                <form method="post" action="https://sandbox.payhere.lk/pay/checkout">
                    <input type="hidden" name="merchant_id" value="1233868">
                    <input type="hidden" name="return_url" value="http://localhost/giftEase/giftease-login/index.php?controller=client&action=dashboard/payhere">
                    <input type="hidden" name="cancel_url" value="http://localhost/giftEase/giftease-login/index.php?controller=client&action=dashboard/checkout">
                    <input type="hidden" name="notify_url" value="http://localhost/giftEase/giftease-login/index.php?controller=admin&action=dashboard/recievePayment">
                    <!-- Order details (REQUIRED) -->
                    <input type="hidden" name="order_id" value=<?html_entity_decode($order_id)?>>
                    <input type="hidden" name="items" value="Custom Gift Box">
                    <input type="hidden" name="currency" value="LKR">
                    <input type="hidden" name="amount" value=<?html_entity_decode($_SESSION['checkout']['wrap']['totalPrice']
                    + $_SESSION['checkout']['delivery']['deliveryPrice'] + $_SESSION['checkout']['cart']['productPrice']
                    )?>>

                    <!-- Customer details (REQUIRED) -->
                    <input type="hidden" name="first_name" value="<?html_entity_decode($_SESSION['user']['first_name'])?>">
                    <input type="hidden" name="last_name" value="<?html_entity_decode($_SESSION['user']['lasst_name'])?>">
                    <input type="hidden" name="email" value="<?html_entity_decode($_SESSION['user']['email'])?>">
                    <input type="hidden" name="phone" value="<?html_entity_decode($_SESSION['user']['phone'])?>">
                    <input type="hidden" name="address" value="Null">
                    <input type="hidden" name="city" value="Colombo">
                    <input type="hidden" name="country" value="Sri Lanka">

                    <button type="submit">Pay Now</button>
                    <?php var_dump($_SESSION['checkout']) ?>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
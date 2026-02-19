<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
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
                <?php
                // var_dump($_SESSION['checkout']);
                ?>
                <tr>
                    <td>
                        <h3>Total Price :</h3>
                    </td>
                    <td>
                        <?php
                        $total = $_SESSION['checkout']['wrap']['totalPrice'] + $_SESSION['checkout']['delivery']['deliveryPrice'] + $_SESSION['checkout']['cart']['productPrice'];
                        ?>
                        <h2>Rs. <?php echo html_entity_decode($total); ?></h2>
                    </td>
                </tr>
            </table>
            <div>
                <button class="btn1" id="payhere-payment">Pay Through Card</button>
                <form action="?controller=client&action=dashboard/payhere" method="post">
                    <input type="hidden" value="cash" name="method">
                    <button type="submit" class="btn1">Cash on Delivery</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        const amountTotal = "<?= number_format($total, 2, '.', '') ?>";

        payhere.onCompleted = function(orderId) {
            console.log("Payment completed. OrderID:", orderId);
            // You can redirect to success page here if needed
        };

        payhere.onDismissed = function() {
            console.log("Payment dismissed");
        };

        payhere.onError = function(error) {
            console.log("PayHere Error:", error);
        };

        document.getElementById("payhere-payment").onclick = function() {
            let ngrokURL = "https://localhost"
            fetch("/giftEase/giftease-login/views/Dashboards/Client/payhere/get-hash.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        order_id: "ORDER_" + Date.now(),
                        amount: amountTotal,
                        currency: "LKR"
                    })
                })
                .then(res => res.json())

                .then(data => {

                    var payment = {
                        sandbox: true,
                        merchant_id: "1233868",

                        return_url: ngrokURL + "/giftEase/giftease-login/views/Dashboards/Client/payhere/success.php",
                        cancel_url: ngrokURL + "/giftEase/giftease-login/views/Dashboards/Client/payhere/payhere.php",
                        notify_url: ngrokURL + "/giftEase/giftease-login/views/Dashboards/Client/payhere/notify.php",

                        order_id: data.order_id,
                        items: "GiftEase Order",
                        amount: data.amount,
                        currency: data.currency,
                        hash: data.hash,

                        first_name: "Test",
                        last_name: "User",
                        email: "test@example.com",
                        phone: "0771234567",
                        address: "Colombo",
                        city: "Colombo",
                        country: "Sri Lanka"
                    };

                    payhere.startPayment(payment);
                });
        };
    </script>

</body>

</html>
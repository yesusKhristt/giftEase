<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/client.css" />
    <link rel="stylesheet" href="public/sideTopBar.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'cart';
        include 'views/commonElements/leftSidebarDilma.php';

        $productPrice  = $_SESSION['checkout']['cart']['productPrice'];
        $deliveryPrice = $_SESSION['checkout']['delivery']['deliveryPrice'];
        $wrapPrice     = $_SESSION['checkout']['wrap']['totalPrice'];
        $total         = $productPrice + $deliveryPrice + $wrapPrice;
        ?>

        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Payment Details</h1>
                <p class="subtitle">Review your order and choose a payment method</p>
            </div>

            <!-- Order Summary -->
            <div class="cardColour">
                <h4>Order Summary</h4>

                <table class="table" style="margin-bottom: 0;">
                    <tbody>
                        <tr>
                            <td><i class="fas fa-gift" style="color:#d03c2e; margin-right:8px;"></i> Products</td>
                            <td style="text-align:right;">Rs. <?= number_format($productPrice, 2) ?></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-truck" style="color:#d03c2e; margin-right:8px;"></i> Delivery</td>
                            <td style="text-align:right;">Rs. <?= number_format($deliveryPrice, 2) ?></td>
                        </tr>
                        <tr>
                            <td><i class="fas fa-box-open" style="color:#d03c2e; margin-right:8px;"></i> Gift Wrapping</td>
                            <td style="text-align:right;">Rs. <?= number_format($wrapPrice, 2) ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><strong>Total</strong></td>
                            <td style="text-align:right;">
                                <span class="title" style="font-size:22px;">
                                    Rs. <?= number_format($total, 2) ?>
                                </span>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Payment Methods -->
            <div class="card">
                <h4>Choose Payment Method</h4>

                <div class="summary-grid">

                    <!-- Card payment -->
                    <button class="cardColour" id="payhere-payment"
                        style="cursor:pointer; text-align:center; border:none;">
                        <i class="fas fa-credit-card"
                            style="font-size:2rem; color:#d03c2e; margin-bottom:12px; display:block;"></i>
                        <p style="font-weight:700; font-size:15px; color:#032e3f;">Pay by Card</p>
                        <p class="subtitle" style="font-size:12px; margin-top:6px;">
                            Visa, Mastercard, PayHere
                        </p>
                    </button>

                    <!-- Cash on delivery -->
                    <form action="?controller=client&action=dashboard/payhere" method="POST">
                        <input type="hidden" name="method" value="cash">
                        <button type="submit" class="cardColour"
                            style="width:100%; cursor:pointer; text-align:center; border:none;">
                            <i class="fas fa-money-bill-wave"
                                style="font-size:2rem; color:#d03c2e; margin-bottom:12px; display:block;"></i>
                            <p style="font-weight:700; font-size:15px; color:#032e3f;">Cash on Delivery</p>
                            <p class="subtitle" style="font-size:12px; margin-top:6px;">
                                Pay when your order arrives
                            </p>
                        </button>
                    </form>

                </div>
            </div>

        </div>
    </div>

    <script>
        const amountTotal = "<?= number_format($total, 2, '.', '') ?>";
        let ngrokURL = "https://f99b-192-248-22-102.ngrok-free.app";

        payhere.onCompleted = function(orderId) {
            console.log("Payment completed. OrderID:", orderId);
            window.location.href = "index.php?controller=client&action=dashboard/tracking";
        };

        payhere.onDismissed = function() {
            console.log("Payment dismissed");
        };

        payhere.onError = function(error) {
            console.log("PayHere Error:", error);
        };

        document.getElementById("payhere-payment").addEventListener('click', function(e) {
            e.preventDefault();

            // Step 1: Create the order in DB first via AJAX
            fetch('index.php?controller=client&action=dashboard/payhere', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'method=card'
                })
                .then(response => response.json()) // ← your controller must return JSON with order_id
                .then(orderData => {
                    const dbOrderId = orderData.order_id; // ← DB order ID

                    // Step 2: Get PayHere hash using the DB order ID
                    return fetch("/giftEase/giftease-login/views/Dashboards/Client/payhere/get-hash.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json"
                        },
                        body: JSON.stringify({
                            order_id: dbOrderId,
                            amount: amountTotal,
                            currency: "LKR"
                        })
                    }).then(res => res.json());
                })
                .then(data => {
                    // Step 3: Launch PayHere popup
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
                })
                .catch(error => console.error('Error:', error));
        });
    </script>

</body>

</html>
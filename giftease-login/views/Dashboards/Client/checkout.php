<?php
$distance = null;
$pricePerKm = 60;  // constant
$total = null;

if (isset($_POST['generate'])) {
    // Generate random float between 0.5 km and 20 km
    $distance = mt_rand(50, 2000) / 100; // 0.50 to 20.00
    $total = $distance * $pricePerKm;
    $totalI = (int) $total;
}
?>

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
                <h1 class="title">Checkout</h1>
                <p class="subtitle">Review your order details</p>
            </div>
            <div class="card">
                <form method="post">
                    <div class="filter-tabs">
                        <label class="checkbox"><input type="radio" name="orderType" value="gift"> <span>It's a
                                gift</span></label>
                        <label class="checkbox"><input type="radio" name="orderType" value="self"> <span>It's for
                                me</span></label>
                        <label class="checkbox"><input type="radio" name="orderType" value="pickup"> <span>I will
                                pickup</span></label>
                    </div>


                    <div class="section">
                        <div id="recipientFields">
                            <div class="field">
                                <label for="recipientName">Recipient's Name *</label>
                                <input id="recipientName" name="recipientName" type="text" placeholder="Name" required>
                            </div>


                            <div class="field">
                                <label for="recipientPhone">Recipient's Phone</label>
                                <input id="recipientPhone" name="recipientPhone" type="tel"
                                    placeholder="Phone number(s)">
                                <div class="helper">You can separate multiple numbers with commas.</div>
                            </div>


                            <div class="field">
                                <label for="deliveryAddress">Delivery Address</label>
                                <textarea id="deliveryAddress" name="deliveryAddress" placeholder="Address"></textarea>
                            </div>



                            <div class="field">
                                <label for="locationType">Location Type</label>
                                <select id="locationType" name="locationType">
                                    <option value="">-- choose --</option>
                                    <option>Apartment</option>
                                    <option>House</option>
                                    <option>Office</option>
                                    <option>Other</option>
                                </select>
                            </div>



                            <div class="row">
                                <div class="field">
                                    <label for="deliveryDate">Delivery Date</label>
                                    <input id="deliveryDate" name="deliveryDate" type="date" placeholder="mm/dd/yyyy">
                                    <div class="helper">Specific delivery times are not guaranteed.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="deliveryPrice" name="deliveryPrice">
                    <input type="submit">
                </form>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const price_per_km = 500;
            const randomFloat = Math.random() * price_per_km;
            document.getElementById('deliveryPrice').value = randomFloat.toFixed(2);
        });
    </script>
</body>

</html>
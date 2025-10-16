<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/Dilma/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'payment';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>
        <div class="main-content">
             <div class="page-header">
                <h1 class="title">Payment</h1>
                <p class="subtitle">Manage your payment methods</p>

            </div>
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;border: 1px solid #af5ea148; padding:20px;border-radius:30px;margin-top:20px;">
                <div style="display: flex; align-items: center;">
                    <img src="https://img.icons8.com/color/48/visa.png" alt="Visa">
                    <div style="margin-left: 10px;">
                        <h3>Visa •••• 4242</h3>
                        <small>Expires 12/25</small>
                    </div>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button class="btn1">Default</button>
                    <button class="btn1">Edit</button>
                    <button class="btn1">Set Default</button>
                </div>
            </div>


            <div
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;border: 1px solid #af5ea148; padding:20px;border-radius:30px;">
                <div style="display: flex; align-items: center;">
                    <img src="https://img.icons8.com/color/48/mastercard.png" alt="Mastercard">
                    <div style="margin-left: 10px;">
                        <h3>Mastercard •••• 8888</h3>
                        <small>Expires 08/26</small>
                    </div>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button class="btn1">Edit</button>
                    <button class="btn1">Set Default</button>
                    <button class="btn1">Remove</button>
                </div>
            </div>


            <div
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;border: 1px solid #af5ea148; padding:20px;border-radius:30px;">
                <div style="display: flex; align-items: center;">
                    <img src="https://img.icons8.com/ios-filled/50/bank-building.png" alt="Bank">
                    <div style="margin-left: 10px;">
                        <h3>Bank Account •••• 1234</h3>
                        <small>Chase Bank</small>
                    </div>
                </div>
                <div style="display: flex; gap: 10px;">
                    <button class="btn1">Edit</button>
                    <button class="btn1">Remove</button>
                </div>
            </div>


            <div style="display: flex; gap:10px;margin-top: 20px;">
                <button class="btn1">+ Add Credit Card</button>
                <button class="btn1">+ Add Bank Account</button>
                <button class="btn1">Billing History</button>
            </div>
        </div>
    </div>
</body>

</html>
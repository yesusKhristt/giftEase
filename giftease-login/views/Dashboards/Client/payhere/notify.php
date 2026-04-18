<?php

$merchant_id         = $_POST['merchant_id'];
$order_id            = $_POST['order_id'];
$payhere_amount      = $_POST['payhere_amount'];
$payhere_currency    = $_POST['payhere_currency'];
$status_code         = $_POST['status_code'];
$md5sig              = $_POST['md5sig'];


$merchant_secret = "MzgwMjg0ODA0ODI5MzY3NDEzMjIxODU1MzMyNjY2MzM2Nzg4OTY5MA==";

$local_md5sig = strtoupper(
    md5(
        $merchant_id .
        $order_id .
        $payhere_amount .
        $payhere_currency .
        $status_code .
        strtoupper(md5($merchant_secret))
    )
);

if ($local_md5sig === $md5sig && $status_code == 2) {
    file_put_contents("payments.log", "$order_id SUCCESS\n", FILE_APPEND);

    // Connect to DB - adjust credentials to match your project
    $pdo = new PDO("mysql:host=localhost;dbname=giftease", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Update payment method to 'card' for this order
    $stmt = $pdo->prepare("UPDATE orders SET payment_method = 'card' WHERE order_id = ?");
    $stmt->execute([$order_id]);

    file_put_contents("payments.log", "$order_id DB UPDATED\n", FILE_APPEND);
} else {
    file_put_contents("payments.log", "$order_id FAILED ($status_code)\n", FILE_APPEND);
}
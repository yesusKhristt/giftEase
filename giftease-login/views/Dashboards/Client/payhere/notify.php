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
    $pdo = new PDO("mysql:host=localhost;dbname=giftease", "root", "");

    $payhere_payment_id = $_POST['payment_id']; // ← PayHere's transaction ID

    $stmt = $pdo->prepare("UPDATE orders SET payment_method = ? WHERE id = ?");
    $stmt->execute([$payhere_payment_id, $order_id]);

    file_put_contents("payments.log", "$order_id | PayHere ID: $payhere_payment_id SUCCESS\n", FILE_APPEND);
}
else {
    file_put_contents("payments.log", "$order_id FAILED ($status_code)\n", FILE_APPEND);
}
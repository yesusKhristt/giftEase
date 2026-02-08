<?php

$merchant_id         = $_POST['merchant_id'];
$order_id            = $_POST['order_id'];
$payhere_amount      = $_POST['payhere_amount'];
$payhere_currency    = $_POST['payhere_currency'];
$status_code         = $_POST['status_code'];
$md5sig              = $_POST['md5sig'];


$merchant_secret = "MTIyOTE3MTQxNjY0MDY3NzY0NDI4NzM1NzExMjA1NTYyOTcwODA=";

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
    // ✅ PAYMENT SUCCESS
    file_put_contents("payments.log", "$order_id SUCCESS\n", FILE_APPEND);

    // TODO: update DB, mark order as paid
} else {
    file_put_contents("payments.log", "$order_id FAILED ($status_code)\n", FILE_APPEND);
}

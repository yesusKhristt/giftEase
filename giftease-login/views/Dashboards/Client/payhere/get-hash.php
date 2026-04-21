<?php
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$merchant_id = "1233868";
$merchant_secret = "MzgwMjg0ODA0ODI5MzY3NDEzMjIxODU1MzMyNjY2MzM2Nzg4OTY5MA==";

$order_id = $data['order_id'];
$amount = number_format($data['amount'], 2, '.', '');
$currency = $data['currency'];

$hash = strtoupper(
    md5(
        $merchant_id .
        $order_id .
        $amount .
        $currency .
        strtoupper(md5($merchant_secret))
    )
);

echo json_encode([
    "order_id" => $order_id,
    "amount" => $amount,
    "currency" => $currency,
    "hash" => $hash
]);





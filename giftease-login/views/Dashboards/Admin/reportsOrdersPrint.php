<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" type="image/png" href="resources/1.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detailed Orders Report</title>
    <style>
        :root {
            --ink: #1f2937;
            --muted: #6b7280;
            --line: #e5e7eb;
            --accent: #d03c2e;
            --paper: #ffffff;
            --bg: #f6f7fb;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
            color: var(--ink);
            background: var(--bg);
        }

        .container {
            max-width: 1080px;
            margin: 24px auto;
            padding: 0 16px 24px;
        }

        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 14px;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            border: none;
            border-radius: 10px;
            padding: 10px 14px;
            text-decoration: none;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--accent);
            color: #fff;
        }

        .btn-secondary {
            background: #fff;
            color: var(--ink);
            border: 1px solid var(--line);
        }

        .report {
            background: var(--paper);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 22px;
        }

        .report-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            border-bottom: 2px solid var(--line);
            padding-bottom: 14px;
            margin-bottom: 14px;
        }

        .report-title {
            margin: 0;
            font-size: 24px;
            color: var(--accent);
        }

        .meta {
            margin: 4px 0 0;
            color: var(--muted);
            font-size: 13px;
        }

        .summary-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 10px;
            margin-bottom: 18px;
        }

        .summary-card {
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 10px 12px;
            background: #fafafa;
        }

        .summary-card .label {
            font-size: 12px;
            color: var(--muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .summary-card .value {
            margin-top: 5px;
            font-size: 20px;
            font-weight: 700;
        }

        .order-section {
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 12px;
            margin-bottom: 14px;
            break-inside: avoid;
        }

        .order-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 10px;
            padding-bottom: 8px;
            border-bottom: 1px solid var(--line);
        }

        .order-id {
            font-size: 18px;
            font-weight: 700;
            color: #111827;
            margin: 0;
        }

        .order-status {
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
            color: #fff;
            display: inline-block;
        }

        .status-delivered {
            background: #16a34a;
        }

        .status-pending {
            background: #f59e0b;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 8px;
            margin-bottom: 10px;
            font-size: 13px;
        }

        .details-grid div {
            background: #fcfcfd;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 8px;
        }

        .details-grid strong {
            display: block;
            color: var(--muted);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 8px;
            font-size: 13px;
        }

        th,
        td {
            border: 1px solid var(--line);
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background: #f3f4f6;
            font-weight: 700;
        }

        .right {
            text-align: right;
        }

        .order-total {
            margin-top: 10px;
            text-align: right;
            font-size: 14px;
            font-weight: 700;
        }

        .empty {
            border: 1px dashed var(--line);
            border-radius: 10px;
            padding: 28px;
            text-align: center;
            color: var(--muted);
            background: #fafafa;
        }

        @media print {
            @page {
                size: A4;
                margin: 12mm;
            }

            body {
                background: #fff;
            }

            .toolbar {
                display: none;
            }

            .container {
                max-width: 100%;
                margin: 0;
                padding: 0;
            }

            .report {
                border: none;
                border-radius: 0;
                padding: 0;
            }

            .order-section {
                break-inside: avoid;
                page-break-inside: avoid;
            }
        }
    </style>
</head>

<body>
    <?php
    $orders = $detailedOrders ?? [];
    $summary = $reportSummary ?? [];

    $totalOrders = (int) ($summary['total_orders'] ?? 0);
    $totalProductAmount = (float) ($summary['total_product_amount'] ?? 0);
    $totalDeliveryAmount = (float) ($summary['total_delivery_amount'] ?? 0);
    $grandTotal = (float) ($summary['grand_total'] ?? 0);
    $avgOrderValue = (float) ($summary['avg_order_value'] ?? 0);

    $generatedDate = !empty($generatedAt) ? date('d M Y, h:i A', strtotime($generatedAt)) : date('d M Y, h:i A');
    ?>

    <div class="container">
        <div class="toolbar">
            <a class="btn btn-secondary" href="?controller=admin&action=dashboard/reports">Back to Reports</a>
            <button class="btn" type="button" onclick="window.print()">Print / Save as PDF</button>
        </div>

        <div class="report">
            <div class="report-header">
                <div>
                    <h1 class="report-title">Detailed Orders Report</h1>
                    <p class="meta">Professional export for administrative review</p>
                </div>
                <div>
                    <p class="meta"><strong>Generated:</strong> <?php echo htmlspecialchars($generatedDate); ?></p>
                    <p class="meta"><strong>Scope:</strong> All Orders</p>
                </div>
            </div>

            <div class="summary-grid">
                <div class="summary-card">
                    <div class="label">Total Orders</div>
                    <div class="value"><?php echo number_format($totalOrders); ?></div>
                </div>
                <div class="summary-card">
                    <div class="label">Product Amount</div>
                    <div class="value">Rs. <?php echo number_format($totalProductAmount, 2); ?></div>
                </div>
                <div class="summary-card">
                    <div class="label">Delivery Amount</div>
                    <div class="value">Rs. <?php echo number_format($totalDeliveryAmount, 2); ?></div>
                </div>
                <div class="summary-card">
                    <div class="label">Grand Total</div>
                    <div class="value">Rs. <?php echo number_format($grandTotal, 2); ?></div>
                </div>
                <div class="summary-card">
                    <div class="label">Avg Order Value</div>
                    <div class="value">Rs. <?php echo number_format($avgOrderValue, 2); ?></div>
                </div>
            </div>

            <?php if (empty($orders)): ?>
                <div class="empty">No orders available to generate the detailed report.</div>
            <?php else: ?>
                <?php foreach ($orders as $order): ?>
                    <?php
                    $isDelivered = !empty($order['is_delivered']);
                    $statusLabel = $isDelivered ? 'Delivered' : 'Pending';
                    $statusClass = $isDelivered ? 'status-delivered' : 'status-pending';

                    $productPrice = isset($order['productPrice']) ? (float) $order['productPrice'] : (float) ($order['computed_product_total'] ?? 0);
                    $deliveryPrice = isset($order['deliveryPrice']) ? (float) $order['deliveryPrice'] : 0.0;
                    $orderGrandTotal = (float) ($order['computed_grand_total'] ?? ($productPrice + $deliveryPrice));

                    $clientName = trim(($order['client_first_name'] ?? '') . ' ' . ($order['client_last_name'] ?? ''));
                    $recipientName = $order['recipientName'] ?? 'N/A';
                    $paymentMethod = $order['payment_method'] ?? 'N/A';
                    $deliveredAt = !empty($order['delivered_at']) ? date('d M Y, h:i A', strtotime($order['delivered_at'])) : 'N/A';
                    ?>
                    <div class="order-section">
                        <div class="order-head">
                            <div>
                                <p class="order-id">Order #<?php echo htmlspecialchars((string) ($order['id'] ?? 'N/A')); ?></p>
                                <p class="meta">Delivery Date: <?php echo htmlspecialchars((string) ($order['deliveryDate'] ?? 'N/A')); ?></p>
                            </div>
                            <span class="order-status <?php echo $statusClass; ?>"><?php echo htmlspecialchars($statusLabel); ?></span>
                        </div>

                        <div class="details-grid">
                            <div>
                                <strong>Customer</strong>
                                <?php echo htmlspecialchars($clientName !== '' ? $clientName : 'N/A'); ?><br>
                                <?php echo htmlspecialchars((string) ($order['client_email'] ?? 'N/A')); ?><br>
                                <?php echo htmlspecialchars((string) ($order['client_phone'] ?? 'N/A')); ?>
                            </div>
                            <div>
                                <strong>Recipient</strong>
                                <?php echo htmlspecialchars((string) $recipientName); ?><br>
                                <?php echo htmlspecialchars((string) ($order['recipientPhone'] ?? 'N/A')); ?>
                            </div>
                            <div>
                                <strong>Delivery</strong>
                                <?php echo htmlspecialchars((string) ($order['deliveryAddress'] ?? 'N/A')); ?><br>
                                Type: <?php echo htmlspecialchars((string) ($order['locationType'] ?? 'N/A')); ?><br>
                                Delivered At: <?php echo htmlspecialchars($deliveredAt); ?>
                            </div>
                            <div>
                                <strong>Payment</strong>
                                Method: <?php echo htmlspecialchars((string) $paymentMethod); ?><br>
                                Order Type: <?php echo htmlspecialchars((string) ($order['orderType'] ?? 'N/A')); ?><br>
                                Wrapped: <?php echo !empty($order['is_wrapped']) ? 'Yes' : 'No'; ?>
                            </div>
                        </div>

                        <table>
                            <thead>
                                <tr>
                                    <th style="width: 45%;">Product</th>
                                    <th style="width: 20%;">Vendor</th>
                                    <th style="width: 10%;" class="right">Qty</th>
                                    <th style="width: 12%;" class="right">Unit Price</th>
                                    <th style="width: 13%;" class="right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $items = $order['items'] ?? []; ?>
                                <?php if (empty($items)): ?>
                                    <tr>
                                        <td colspan="5" style="text-align:center; color:#6b7280;">No line items found for this order.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($items as $item): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars((string) ($item['product_name'] ?? 'N/A')); ?></td>
                                            <td><?php echo htmlspecialchars((string) ($item['vendor_shop'] ?? 'N/A')); ?></td>
                                            <td class="right"><?php echo number_format((int) ($item['quantity'] ?? 0)); ?></td>
                                            <td class="right">Rs. <?php echo number_format((float) ($item['price'] ?? 0), 2); ?></td>
                                            <td class="right">Rs. <?php echo number_format((float) ($item['subtotal'] ?? 0), 2); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>

                        <div class="order-total">
                            Product: Rs. <?php echo number_format($productPrice, 2); ?> |
                            Delivery: Rs. <?php echo number_format($deliveryPrice, 2); ?> |
                            Grand Total: Rs. <?php echo number_format($orderGrandTotal, 2); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>

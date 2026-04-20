<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Track Order #<?= htmlspecialchars($order['id']) ?> - GiftEase</title>
    <link rel="stylesheet" href="public/client.css" />
    <link rel="stylesheet" href="public/sideTopBar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .tracker-steps {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0;
            margin: 8px 0 32px;
            position: relative;
        }

        /* Connecting line running through all steps */
        .tracker-steps::before {
            content: '';
            position: absolute;
            top: 28px;
            left: calc(12.5%);
            width: calc(75%);
            height: 4px;
            background: #fedbd2;
            z-index: 0;
        }

        .tracker-step {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .step-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #f0f0f0;
            border: 3px solid #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: #aaa;
            margin-bottom: 12px;
            transition: all 0.3s ease;
        }

        .step-icon.done {
            background: #d03c2e;
            border-color: #d03c2e;
            color: #fff;
        }

        .step-icon.current {
            background: #fff;
            border-color: #d03c2e;
            color: #d03c2e;
            box-shadow: 0 0 0 4px rgba(208, 60, 46, 0.15);
        }

        .step-label {
            font-size: 13px;
            font-weight: 600;
            color: #aaa;
            text-align: center;
        }

        .step-label.done,
        .step-label.current {
            color: #032e3f;
        }

        .step-sub {
            font-size: 11px;
            color: #bbb;
            text-align: center;
            margin-top: 4px;
        }

        .step-sub.done,
        .step-sub.current {
            color: #d03c2e;
        }

        /* Progress line fill — width driven by PHP */
        .tracker-progress {
            position: absolute;
            top: 28px;
            left: calc(12.5%);
            height: 4px;
            background: #d03c2e;
            z-index: 0;
            transition: width 0.4s ease;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'orders';
        include 'views/commonElements/leftSidebarDilma.php';

        /*
         * Step logic
         *  Step 0 — With Vendor   : nothing true yet
         *  Step 1 — In Warehouse  : in_warehouse = true
         *  Step 2 — Wrapped       : is_wrapped   = true
         *  Step 3 — On the Way    : is_delivered = true
         *
         * $currentStep drives icon states and the progress bar width.
         */
        if ($order['is_delivered'])     $currentStep = 3;
        elseif ($order['is_wrapped'])   $currentStep = 2;
        elseif ($order['in_warehouse']) $currentStep = 1;
        else                            $currentStep = 0;

        /*
         * Progress bar: 0 steps done = 0%, 3 steps done = 100%
         * Bar runs between centre of step 0 and centre of step 3 (75% of grid).
         * Each step adds 33.33% of that span.
         */
        $progressPct = ($currentStep / 3) * 100;

        $steps = [
            ['icon' => 'fa-store',        'label' => 'With Vendor',  'sub' => 'Order received'],
            ['icon' => 'fa-warehouse',     'label' => 'In Warehouse', 'sub' => 'Being prepared'],
            ['icon' => 'fa-gift',          'label' => 'Wrapped',      'sub' => 'Ready for dispatch'],
            ['icon' => 'fa-shipping-fast', 'label' => 'Delivered',   'sub' => 'Already Recieved'],
        ];
        ?>

        <div class="main-content">

            <?php if (empty($order)): ?>
                <div class="page-header">
                    <h1 class="title">Order Not Found</h1>
                    <p class="subtitle">This order doesn't exist or doesn't belong to you.</p>
                </div>
                <a href="?controller=client&action=dashboard/orders" class="btn1" style="width:fit-content;">
                    <i class="fas fa-arrow-left"></i> Back to Orders
                </a>

            <?php else: ?>

                <div class="page-header">
                    <h1 class="title">Track Order #<?= htmlspecialchars($order['id']) ?></h1>
                    <p class="subtitle">
                        For <?= htmlspecialchars($order['recipientName'] ?? 'N/A') ?>
                        &nbsp;·&nbsp; Due
                        <strong><?= htmlspecialchars($order['deliveryDate'] ?? 'N/A') ?></strong>
                    </p>
                </div>

                <!-- Tracker -->
                <div class="cardColour">
                    <h4>Order Progress</h4>

                    <div class="tracker-steps">

                        <!-- Filled progress line -->
                        <div class="tracker-progress"
                            style="width: calc(<?= $progressPct ?>% * 0.75);">
                        </div>

                        <?php foreach ($steps as $i => $step):
                            if ($i < $currentStep)      $state = 'done';
                            elseif ($i === $currentStep) $state = 'current';
                            else                         $state = '';
                        ?>
                            <div class="tracker-step">
                                <div class="step-icon <?= $state ?>">
                                    <i class="fas <?= $step['icon'] ?>"></i>
                                </div>
                                <span class="step-label <?= $state ?>"><?= $step['label'] ?></span>
                                <span class="step-sub <?= $state ?>"><?= $step['sub'] ?></span>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <!-- Current status callout -->
                    <div class="card" style="margin:0; text-align:center;">
                        <p class="subtitle">Current Status</p>
                        <p class="title" style="margin-top:8px;"><?= $steps[$currentStep]['label'] ?></p>
                        <p style="color:#999; font-size:13px; margin-top:4px;"><?= $steps[$currentStep]['sub'] ?></p>
                    </div>
                </div>

                <!-- Delivery details -->
                <div class="summary-grid">
                    <div class="card">
                        <p class="subtitle">Delivering To</p>
                        <p style="margin-top:8px; font-weight:600;"><?= htmlspecialchars($order['recipientName'] ?? 'N/A') ?></p>
                        <p style="font-size:13px; color:#555; margin-top:4px;"><?= htmlspecialchars($order['deliveryAddress'] ?? 'N/A') ?></p>
                        <p style="font-size:12px; color:#999; margin-top:4px;"><?= htmlspecialchars($order['locationType'] ?? '') ?></p>
                    </div>
                    <div class="card">
                        <p class="subtitle">Expected Delivery</p>
                        <p style="margin-top:8px;">
                            <i class="fas fa-calendar-alt" style="color:#d03c2e; margin-right:6px;"></i>
                            <strong><?= htmlspecialchars($order['deliveryDate'] ?? 'N/A') ?></strong>
                        </p>
                        <?php if ($order['is_delivered'] && $order['delivered_at']): ?>
                            <p style="font-size:13px; color:#27ae60; margin-top:8px;">
                                <i class="fas fa-check-circle"></i>
                                Delivered <?= htmlspecialchars($order['delivered_at']) ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </div>

                <div style="display:flex; gap:12px;">
                    <a href="?controller=client&action=dashboard/orders" class="btn1" style="width:fit-content;">
                        <i class="fas fa-arrow-left"></i> Back to Orders
                    </a>
                    <a href="?controller=client&action=dashboard/orderItems/<?= $order['id'] ?>"
                        class="btn2" style="width:fit-content;">
                        <i class="fas fa-eye"></i> View Items
                    </a>
                </div>

            <?php endif; ?>

        </div>
    </div>
</body>

</html>
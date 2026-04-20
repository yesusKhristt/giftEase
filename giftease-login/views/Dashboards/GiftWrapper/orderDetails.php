<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="profile" href="profile.php" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBFw0Qbyq9zTFTd-tUY6dkmvuFiYMuEv20&libraries=geometry,places"
        async defer></script>
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'assignedOrder';
        include 'views\commonElements/leftSidebarJeshani.php';
        ?>

        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Order Details</h1>
                <p class="subtitle">Monitor your orders</p>
            </div>

            <?php
            $components = [
                ['icon' => 'fa-box',        'label' => 'Box',        'value' => $customwrap['boxName']       ?? null],
                ['icon' => 'fa-shopping-bag', 'label' => 'Bag',       'value' => $customwrap['bagName']       ?? null],
                ['icon' => 'fa-envelope',   'label' => 'Card',       'value' => $customwrap['cardName']      ?? null],
                ['icon' => 'fa-dog',        'label' => 'Soft Toy',   'value' => $customwrap['softToyName']   ?? null],
                ['icon' => 'fa-candy-cane', 'label' => 'Chocolate',  'value' => $customwrap['chocolateName'] ?? null],
                ['icon' => 'fa-star',       'label' => 'Box Deco',   'value' => $customwrap['boxDecoName']   ?? null],
                ['icon' => 'fa-magic',      'label' => 'Bag Deco',   'value' => $customwrap['bagDecoName']   ?? null],
            ];

            $selectedCount = count(array_filter($components, fn($c) => !empty($c['value'])));
            ?>

            <div class="card">

                <!-- Header -->
                <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:20px;">
                    <div>
                        <p class="subtitle" style="font-size:12px; margin-bottom:4px;">Custom Wrap Package</p>
                        <p class="title" style="font-size:22px;">
                            WRP-<?= htmlspecialchars($customwrap['id'] ?? '—') ?>
                        </p>
                    </div>
                    <div style="text-align:right;">
                        <span style="
                background: #fedbd2;
                color: #d03c2e;
                padding: 6px 14px;
                border-radius: 25px;
                font-size: 13px;
                font-weight: 600;">
                            <?= $selectedCount ?> / <?= count($components) ?> items
                        </span>
                    </div>
                </div>

                <hr style="border:none; border-top:1px solid #fedbd2; margin-bottom:20px;">

                <!-- Components grid -->
                <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap:12px;">
                    <?php foreach ($components as $item): ?>
                        <div style="
                padding: 14px 16px;
                border-radius: 12px;
                border: 1.5px solid <?= !empty($item['value']) ? '#d03c2e' : '#f0f0f0' ?>;
                background: <?= !empty($item['value']) ? 'linear-gradient(135deg, #fff, #fedbd2)' : '#fafafa' ?>;
                display:flex;
                flex-direction:column;
                gap:6px;">

                            <div style="display:flex; align-items:center; gap:8px;">
                                <i class="fas <?= $item['icon'] ?>"
                                    style="color: <?= !empty($item['value']) ? '#d03c2e' : '#ccc' ?>; font-size:14px;"></i>
                                <span style="font-size:12px; font-weight:600; text-transform:uppercase;
                                 letter-spacing:0.05em;
                                 color: <?= !empty($item['value']) ? '#032e3f' : '#bbb' ?>;">
                                    <?= $item['label'] ?>
                                </span>
                            </div>

                            <p style="font-size:14px; font-weight:500;
                          color: <?= !empty($item['value']) ? '#032e3f' : '#ccc' ?>;
                          font-style: <?= empty($item['value']) ? 'italic' : 'normal' ?>;">
                                <?= !empty($item['value']) ? htmlspecialchars($item['value']) : 'Not selected' ?>
                            </p>

                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>

</body>

</html>
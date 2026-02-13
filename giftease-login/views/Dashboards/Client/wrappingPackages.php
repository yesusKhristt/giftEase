<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .package-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 20px;
            padding: 10px 0;
        }

        .package-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border: 1px solid #eef2ff;
        }

        .package-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        }

        .package-image-container {
            position: relative;
            width: 100%;
            height: 220px;
            overflow: hidden;
        }

        .package-image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .package-image-slider {
            display: flex;
            transition: transform 0.4s ease;
            height: 100%;
        }

        .package-image-slider img {
            min-width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .slider-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.85);
            border: none;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 2;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .slider-btn:hover {
            background: #fff;
        }

        .slider-btn.prev {
            left: 8px;
        }

        .slider-btn.next {
            right: 8px;
        }

        .package-info {
            padding: 16px;
        }

        .package-title {
            font-size: 18px;
            font-weight: 600;
            color: #1a1a2e;
            margin: 0 0 8px;
        }

        .package-description {
            font-size: 14px;
            color: #64748b;
            margin: 0 0 12px;
            line-height: 1.5;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .package-price {
            font-size: 20px;
            font-weight: 700;
            color: #e91e63;
            margin: 0 0 14px;
        }

        .package-select-btn {
            width: 100%;
            padding: 10px;
            background: var(--accent, #6c5ce7);
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .package-select-btn:hover {
            opacity: 0.9;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: var(--accent, #6c5ce7);
            text-decoration: none;
            font-size: 14px;
            margin-bottom: 16px;
        }

        .back-link:hover {
            text-decoration: underline;
        }

        .no-packages {
            text-align: center;
            padding: 60px 20px;
            color: #64748b;
        }

        .no-packages i {
            font-size: 48px;
            margin-bottom: 16px;
            color: #cbd5e1;
        }

        .no-packages h3 {
            margin: 0 0 8px;
            color: #334155;
        }
    </style>
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'customize';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Gift Wrapping Packages</h1>
                <p class="subtitle">Choose from our ready-made gift wrapping packages</p>
            </div>

            <a href="?controller=client&action=dashboard/wrap" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to wrapping options
            </a>

            <?php if (!empty($packages)): ?>
                <div class="package-grid">
                    <?php foreach ($packages as $package):
                        $images = json_decode($package['images'], true) ?? [];
                    ?>
                        <div class="package-card">
                            <div class="package-image-container">
                                <?php if (count($images) > 0): ?>
                                    <div class="package-image-slider" data-index="0">
                                        <?php foreach ($images as $img): ?>
                                            <img src="resources/uploads/admin/giftWrappingPackages/<?= htmlspecialchars($img) ?>"
                                                alt="<?= htmlspecialchars($package['title']) ?>">
                                        <?php endforeach; ?>
                                    </div>
                                    <?php if (count($images) > 1): ?>
                                        <button class="slider-btn prev" onclick="slideImage(this, -1)">
                                            <i class="fas fa-chevron-left"></i>
                                        </button>
                                        <button class="slider-btn next" onclick="slideImage(this, 1)">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <img src="resources/uploads/admin/giftWrappingPackages/default.png"
                                        alt="No image available"
                                        style="width:100%;height:100%;object-fit:cover;">
                                <?php endif; ?>
                            </div>

                            <div class="package-info">
                                <h3 class="package-title"><?= htmlspecialchars($package['title']) ?></h3>
                                <p class="package-description"><?= htmlspecialchars($package['description']) ?></p>
                                <div class="package-price">Rs <?= number_format($package['price']) ?></div>

                                <form method="POST" action="?controller=client&action=dashboard/wrappingPackages">
                                    <input type="hidden" name="package_id" value="<?= $package['id'] ?>">
                                    <button type="submit" class="package-select-btn">
                                        <i class="fas fa-check-circle"></i> Select Package
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-packages">
                    <i class="fas fa-box-open"></i>
                    <h3>No packages available yet</h3>
                    <p>Check back later or try our <a href="?controller=client&action=dashboard/custom">custom wrapping</a> option.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script> 
        function slideImage(btn, direction) {
            const container = btn.parentElement;
            const slider = container.querySelector('.package-image-slider');
            const totalImages = slider.querySelectorAll('img').length;
            let currentIndex = parseInt(slider.dataset.index) || 0;

            currentIndex += direction;
            if (currentIndex < 0) currentIndex = totalImages - 1;
            if (currentIndex >= totalImages) currentIndex = 0;

            slider.dataset.index = currentIndex;
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        }
    </script>

</body>

</html>
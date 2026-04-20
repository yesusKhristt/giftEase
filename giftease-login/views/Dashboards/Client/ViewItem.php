<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client Partner Dashboard - GiftEase</title>
    <style>
        .image-scroll {
            display: flex;
            overflow-x: hidden;
            overflow-y: hidden;
            /* horizontal scroll */

            scroll-behavior: smooth;
            /* prevents shrinking */
            width: 570px;
            /* width of each image box */
            height: 400px;
        }

        .image-item {
            flex: 0 0 auto;
            /* prevents shrinking */
            width: 560px;
            /* width of each image box */
            height: 390px;
            gap: 0px;
            /* space between images */
            padding: 0px 10px;
        }

        .image-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* maintain aspect ratio and fill box */
            border-radius: 8px;
        }

        .center-vertical {
            display: flex;
            flex-direction: row;
            /* Stack elements vertically */
            justify-content: center;
            /* Center vertically */
            align-items: center;
            /* Center horizontally (optional) */
        }
    </style>
    <link rel="stylesheet" href="public/client.css" />
    <link rel="stylesheet" href="public/sideTopBar.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'inventory';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">View Item</h1>
            </div>
            <div class="card">
                <div>
                    <div style="display:flex">
                        <div class="center-vertical">
                            <button class="btn1"
                                style="border-radius: 100%; height: 40px;width: 40px; text-align: center;"
                                id="scroll-left">◀</button>
                            <div class="image-scroll">
                                <?php
                                foreach ($productDetails['images'] as $image): ?>
                                    <div class="image-item">
                                        <img src="resources/uploads/vendor/products/<?= htmlspecialchars($image['image_loc']) ?>"
                                            class="item-image">
                                    </div>
                                <?php endforeach; ?>
                            </div>



                            <button id="scroll-right" class="btn1"
                                style="border-radius: 100%; height: 40px;width: 40px; text-align: center;">▶</button>

                        </div>



                        <div style="padding:10px;">
                            <h4><?= htmlspecialchars($productDetails['name']) ?></h4>
                            <p>
                                <?php

                                require_once 'views/commonElements/rating.php';
                                $rating = $productDetails['rating'];
                                echo render_stars($rating);
                                echo "<div class='rating-text'>$rating Rating</div>"
                                ?>
                            <div class="title">Rs.<?= htmlspecialchars($productDetails['price']) ?></div>
                            <table class="table">
                                <tr>
                                    <td>Available Stock</td>
                                    <td><?= htmlspecialchars($productDetails['totalStock'] - $productDetails['reservedStock']) ?>
                                    </td>
                                </tr>
                            </table>
                            <h4 class="subtitle">Sold By</h4>
                            <h3 class="subtitle"><?= htmlspecialchars($productDetails['shop']) ?></h3>
                            <?php
                            $rating = $productDetails['vendorRating'];
                            echo render_stars($rating);
                            echo "<div class='rating-text'>$rating Rating</div>"
                            ?>
                            <a class="btn1" href="?controller=client&action=dashboard/messeges/vendor/view/<?= htmlspecialchars($productDetails['vendor_id']) ?>/direct">Contact Now</a>
                            </p>
                        </div>
                    </div>
                    <div class="card">

                        <?php echo nl2br(htmlspecialchars($productDetails['description'])) ?>

                    </div>

                    <?php
                    // ── Compute summary from $ratings ──
                    $count      = count($ratings);
                    $avgRating  = $count > 0 ? round(array_sum(array_column($ratings, 'rating')) / $count, 1) : 0;

                    $breakdown  = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
                    foreach ($ratings as $r) {
                        $breakdown[(int)$r['rating']]++;
                    }
                    ?>

                    <div class="card">

                        <?php if ($count === 0): ?>

                            <div style="text-align:center; padding: 40px 20px;">
                                <i class="fas fa-star" style="font-size:2.5rem; color:#ddd; display:block; margin-bottom:12px;"></i>
                                <h3 style="color:#032e3f; margin-bottom:8px;">No reviews yet</h3>
                                <p class="subtitle">Be the first to review this product</p>
                            </div>

                        <?php else: ?>

                            <h4 style="margin-bottom:20px;">Customer Reviews</h4>

                            <!-- ── Summary row ── -->
                            <div style="display:flex; gap:24px; align-items:stretch; margin-bottom:28px; flex-wrap:wrap;">

                                <!-- Big score -->
                                <div class="cardColour" style="margin:0; min-width:140px; text-align:center;
                        display:flex; flex-direction:column; align-items:center; justify-content:center;">
                                    <p class="title" style="font-size:3.5rem; margin-bottom:0;"><?= $avgRating ?></p>
                                    <div style="font-size:1.4rem; color:#d03c2e; letter-spacing:3px; margin: 6px 0;">
                                        <?php for ($i = 1; $i <= 5; $i++):
                                            $filled = $i <= floor($avgRating);
                                            $half   = !$filled && ($i - $avgRating) < 1;
                                        ?>
                                            <span style="color: <?= ($filled || $half) ? '#d03c2e' : '#ddd' ?>;">★</span>
                                        <?php endfor; ?>
                                    </div>
                                    <p class="subtitle" style="font-size:12px;"><?= $count ?> <?= $count === 1 ? 'review' : 'reviews' ?></p>
                                </div>

                                <!-- Per-star breakdown -->
                                <div style="flex:1; min-width:200px; display:flex; flex-direction:column;
                        justify-content:center; gap:8px;">
                                    <?php for ($star = 5; $star >= 1; $star--):
                                        $pct = $count > 0 ? round(($breakdown[$star] / $count) * 100) : 0;
                                    ?>
                                        <div style="display:flex; align-items:center; gap:10px; font-size:13px;">
                                            <span style="min-width:14px; color:#032e3f; font-weight:600;"><?= $star ?></span>
                                            <span style="color:#d03c2e;">★</span>
                                            <div style="flex:1; background:#f0f0f0; border-radius:25px; height:8px; overflow:hidden;">
                                                <div style="width:<?= $pct ?>%; background:#d03c2e;
                                        height:100%; border-radius:25px;"></div>
                                            </div>
                                            <span style="min-width:28px; color:#999; font-size:12px;"><?= $breakdown[$star] ?></span>
                                        </div>
                                    <?php endfor; ?>
                                </div>

                            </div>

                            <!-- ── Review list ── -->
                            <div style="display:flex; flex-direction:column; gap:16px;">
                                <?php foreach ($ratings as $review):
                                    $initials = strtoupper(
                                        substr($review['first_name'], 0, 1) .
                                            substr($review['last_name'],  0, 1)
                                    );
                                    $name = htmlspecialchars($review['first_name'] . ' ' . $review['last_name']);
                                    $date = date('M d, Y', strtotime($review['created_at']));
                                    $stars = (int)$review['rating'];
                                ?>
                                    <div style="padding:16px 20px; border-radius:14px;
                            border: 1px solid #fedbd2; background:#fff;">

                                        <div style="display:flex; align-items:center;
                                justify-content:space-between; margin-bottom:10px;">

                                            <!-- Avatar + name -->
                                            <div style="display:flex; align-items:center; gap:12px;">
                                                <div style="width:40px; height:40px; border-radius:50%;
                                        background:#d03c2e; color:#fff; font-weight:700;
                                        font-size:14px; display:flex; align-items:center;
                                        justify-content:center; flex-shrink:0;">
                                                    <?= $initials ?>
                                                </div>
                                                <div>
                                                    <p style="font-weight:600; color:#032e3f; font-size:14px;">
                                                        <?= $name ?>
                                                    </p>
                                                    <p style="font-size:12px; color:#999;"><?= $date ?></p>
                                                </div>
                                            </div>

                                            <!-- Stars -->
                                            <div style="font-size:1.1rem; letter-spacing:2px;">
                                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                                    <span style="color: <?= $i <= $stars ? '#d03c2e' : '#ddd' ?>;">★</span>
                                                <?php endfor; ?>
                                            </div>

                                        </div>

                                        <?php if (!empty($review['review'])): ?>
                                            <p style="font-size:14px; color:#444; line-height:1.6; padding-left:52px;">
                                                "<?= htmlspecialchars($review['review']) ?>"
                                            </p>
                                        <?php endif; ?>

                                    </div>
                                <?php endforeach; ?>
                            </div>

                        <?php endif; ?>

                    </div>

                </div>
            </div>
        </div>
        <script>
            const container = document.querySelector('.image-scroll');
            document.getElementById('scroll-left').addEventListener('click', () => {
                container.scrollBy({
                    left: -570,
                    behavior: 'smooth'
                });
            });
            document.getElementById('scroll-right').addEventListener('click', () => {
                container.scrollBy({
                    left: 570,
                    behavior: 'smooth'
                });
            });
        </script>
</body>

</html>
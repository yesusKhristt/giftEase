<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Ratings - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="icon" type="image/png" href="resources/1.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <?php
        $activePage = 'vendor_ratings';
        include 'views\commonElements/leftSidebar.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1>Vendor Ratings & Reviews</h1>
                <p class="subtitle">See what customers are saying about your shop.</p>
            </div>

                <?php if (!empty($ratings)): ?>
                    <?php
                        $totalRating = 0;
                        $count = count($ratings);
                        foreach ($ratings as $rating) {
                            $totalRating += $rating['rating'];
                        }
                        $avgRating = $count > 0 ? round($totalRating / $count, 1) : 0;
                    ?>

                    <div class="hero-card">
                        <div class="hero-metric">
                            <div class="hero-stars">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <?= $i <= $avgRating ? '★' : '☆' ?>
                                <?php endfor; ?>
                            </div>
                            <div class="hero-score"><?= $avgRating ?></div>
                            <div class="hero-sub"><?= $count ?> <?= $count == 1 ? 'rating' : 'ratings' ?></div>
                        </div>
                        <div class="hero-meta">
                            <div class="pill">
                                <div>
                                    <small>Shop</small>
                                    <?= htmlspecialchars($vendorStats['shopName'] ?? 'Your store') ?>
                                </div>
                            </div>
                            <div class="pill">
                                <div>
                                    <small>Last updated</small>
                                    <?= htmlspecialchars(date('M d, Y')) ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cards-grid">
                        <div class="stat-card">
                            <div class="stat-label">Average Rating</div>
                            <div class="stat-value"><?= $avgRating ?> / 5</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-label">Total Ratings</div>
                            <div class="stat-value"><?= $count ?></div>
                        </div>
                    </div>

                    <div class="reviews-stack">
                        <?php foreach ($ratings as $rating): ?>
                            <?php
                                $initials = strtoupper(substr($rating['first_name'] ?? '', 0, 1) . substr($rating['last_name'] ?? '', 0, 1));
                            ?>
                            <div class="review-card">
                                <div class="review-head">
                                    <div class="user-chip">
                                        <div class="avatar"><?= htmlspecialchars($initials ?: 'C') ?></div>
                                        <div>
                                            <div class="user-name"><?= htmlspecialchars($rating['first_name'] . ' ' . $rating['last_name']) ?></div>
                                            <div class="date"><?= date('M d, Y', strtotime($rating['created_at'])) ?></div>
                                        </div>
                                    </div>
                                    <div class="stars">
                                        <?php for ($i = 1; $i <= 5; $i++): ?>
                                            <?= $i <= $rating['rating'] ? '★' : '☆' ?>
                                        <?php endfor; ?>
                                        <span class="score"><?= $rating['rating'] ?>/5</span>
                                    </div>
                                </div>
                                <?php if (!empty($rating['review'])): ?>
                                    <div class="review-text">“<?= htmlspecialchars($rating['review']) ?>”</div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="ratings-no-ratings">
                        <i class="fas fa-star"></i>
                        <p>No ratings yet. Once customers start reviewing, you will see them here.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
</body>
</html>

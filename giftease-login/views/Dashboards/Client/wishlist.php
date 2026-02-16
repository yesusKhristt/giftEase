<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="icon" type="image/png" href="resources/1.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'wishlist';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Wishlist</h1>
                <p class="subtitle">Manage your gift items in the wishlist</p>
            </div>

            <div class="inventory-grid">

                <?php foreach ($allProducts as $row): ?>
                    <div class="inventory-item">
                        <a href="?controller=client&action=dashboard/viewitem/<?= $row['id'] ?>">
                            <img src="resources/uploads/vendor/products/<?= htmlspecialchars($row['displayImage']) ?>"
                                class="item-image">

                            <div class="item-content">
                                <div class="item-header">
                                    <div>
                                        <h3 class="item-name"><?= htmlspecialchars($row['name']) ?></h3>
                                    </div>
                                </div>
                                <div class="item-details">
                                    <div class="detail-item">
                                        <span class="detail-label">Price</span>
                                        <span class="detail-value">Rs <?= htmlspecialchars($row['price']) ?></span>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <div class="item-actions">
                            <a class="btn1 btn-outline btn-small add-to-wishlist" href="#" data-id="<?= $row['product_id'] ?>">
                                Add to wishlist
                            </a>

                        </div>
                    </div>
                <?php endforeach; ?>

            </div>


            <?php if ($totalPages > 1): ?>
                <div class="pagination">


                    <?php if ($page > 1): ?>
                        <a class="page-arrow" href="?controller=client&action=dashboard/wishlist&page=<?= $page - 1 ?>">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    <?php else: ?>
                        <span class="page-arrow disabled">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    <?php endif; ?>


                    <a class="page-num <?= $page == 1 ? 'active' : '' ?>"
                        href="?controller=client&action=dashboard/wishlist&page=1">1</a>

                    <?php if ($totalPages > 1): ?>
                        <?php

                        $range = 2;
                        $start = max(2, $page - $range);
                        $end = min($totalPages - 1, $page + $range);


                        if ($start > 2): ?>
                            <span class="page-dots">...</span>
                        <?php endif; ?>


                        <?php for ($i = $start; $i <= $end; $i++): ?>
                            <a class="page-num <?= $page == $i ? 'active' : '' ?>"
                                href="?controller=client&action=dashboard/wishlist&page=<?= $i ?>"><?= $i ?></a>
                        <?php endfor; ?>


                        <?php if ($end < $totalPages - 1): ?>
                            <span class="page-dots">...</span>
                        <?php endif; ?>


                        <a class="page-num <?= $page == $totalPages ? 'active' : '' ?>"
                            href="?controller=client&action=dashboard/wishlist&page=<?= $totalPages ?>\"><?= $totalPages ?></a>
                    <?php endif; ?>


                    <?php if ($page < $totalPages): ?>
                        <a class="page-arrow" href="?controller=client&action=dashboard/wishlist&page=<?= $page + 1 ?>">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    <?php else: ?>
                        <span class="page-arrow disabled">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    <?php endif; ?>

                </div>
            <?php endif; ?>


        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            async function updateWishlistButton(link, event = null, triggeredByClick = false) {
                const productId = link.dataset.id;
                let url;

                if (triggeredByClick) {
                    event.preventDefault();
                    url = `?controller=client&action=dashboard/wishlist/${productId}&state=wishlist`;
                } else {
                    url = `?controller=client&action=dashboard/wishlist/${productId}&state=wishlistCheck`;
                }

                try {
                    const response = await fetch(url, {
                        method: 'GET'
                    });
                    if (!response.ok) throw new Error('Network error');

                    const result = await response.json();


                    if (result.inWishlist) {
                        link.textContent = 'Remove from Wishlist';
                        link.classList.remove('btn-outline');
                        link.classList.add('btn-danger');
                    } else {
                        link.textContent = 'Add to Wishlist';
                        link.classList.remove('btn-danger');
                        link.classList.add('btn-outline');
                    }

                } catch (err) {
                    console.error('Add/remove wishlist failed:', err);
                    if (triggeredByClick) alert('Could not update wishlist. Try again.');
                }
            }

            document.querySelectorAll('.add-to-wishlist').forEach(link => {
                // ✅ Check current state on page load
                updateWishlistButton(link);

                // ✅ Toggle when clicked
                link.addEventListener('click', (event) => updateWishlistButton(link, event, true));
            });
        });
    </script>


</body>

</html>
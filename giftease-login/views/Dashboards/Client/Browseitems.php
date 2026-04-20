<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/client.css" />
    <link rel="stylesheet" href="public/sideTopBar.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>


<body>

    <div class="container">
        <?php
        $activePage = 'items';
        include 'views/commonElements/leftSidebarDilma.php';
        $selectedCategoryId = isset($selectedCategoryId) ? (int) $selectedCategoryId : 0;
        $selectedSubcategoryId = isset($selectedSubcategoryId) ? (int) $selectedSubcategoryId : 0;
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Browse Items</h1>
                <p class="subtitle">Manage your gift items </p>

            </div>

            <div class="filter-tabs history-filters">
                <div class="filter-group">
                    <label>Category</label>
                    <select id="categoryFilter" aria-label="Filter by category">
                        <option value="0">All</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= (int) $category['id'] ?>" <?= $selectedCategoryId === (int) $category['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-group">
                    <label>Subcategory</label>
                    <select id="subcategoryFilter" aria-label="Filter by subcategory">
                        <option value="0">All</option>
                        <?php foreach ($subcategories as $subcategory): ?>
                            <option value="<?= (int) $subcategory['id'] ?>" <?= $selectedSubcategoryId === (int) $subcategory['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($subcategory['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="filter-actions history-filter-actions">
                    <a href="index.php?controller=client&action=dashboard/items" class="btn1"><i class="fas fa-undo"></i> Reset</a>
                </div>
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
                                    <a class="btn1 btn-outline btn-small add-to-cart" href="#" data-id="<?= $row['id'] ?>">
                                        Add to cart
                                    </a>

                                    <a class="btn1 btn-outline btn-small add-to-wishlist" href="#" data-id="<?= $row['id'] ?>">
                                        Add to wishlist

                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

            <?php
            $paginationParams = [
                'controller' => 'client',
                'action' => 'dashboard/items',
            ];
            if ($selectedCategoryId > 0) {
                $paginationParams['category'] = $selectedCategoryId;
            }
            if ($selectedSubcategoryId > 0) {
                $paginationParams['subcategory'] = $selectedSubcategoryId;
            }
            ?>

                    <?php if ($totalPages > 1): ?>
                        <div class="pagination">


                            <?php if ($page > 1): ?>
                                <a class="page-arrow" href="?<?= htmlspecialchars(http_build_query(array_merge($paginationParams, ['page' => $page - 1]))) ?>">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            <?php else: ?>
                                <span class="page-arrow disabled">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            <?php endif; ?>


                            <a class="page-num <?= $page == 1 ? 'active' : '' ?>" href="?<?= htmlspecialchars(http_build_query(array_merge($paginationParams, ['page' => 1]))) ?>">1</a>

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
                                        href="?<?= htmlspecialchars(http_build_query(array_merge($paginationParams, ['page' => $i]))) ?>"><?= $i ?></a>
                                <?php endfor; ?>


                                <?php if ($end < $totalPages - 1): ?>
                                    <span class="page-dots">...</span>
                                <?php endif; ?>


                                <a class="page-num <?= $page == $totalPages ? 'active' : '' ?>"
                                    href="?<?= htmlspecialchars(http_build_query(array_merge($paginationParams, ['page' => $totalPages]))) ?>"><?= $totalPages ?></a>
                            <?php endif; ?>


                            <?php if ($page < $totalPages): ?>
                                <a class="page-arrow" href="?<?= htmlspecialchars(http_build_query(array_merge($paginationParams, ['page' => $page + 1]))) ?>">
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
                const categorySelect = document.getElementById('categoryFilter');
                const subcategorySelect = document.getElementById('subcategoryFilter');

                const redirectWithFilters = (resetSubcategory = false) => {
                    if (!categorySelect || !subcategorySelect) {
                        return;
                    }

                    const categoryId = categorySelect.value || '0';
                    const subcategoryId = resetSubcategory ? '0' : (subcategorySelect.value || '0');
                    if (resetSubcategory) {
                        subcategorySelect.value = '0';
                    }

                    const params = new URLSearchParams({
                        controller: 'client',
                        action: 'dashboard/items'
                    });

                    if (Number(categoryId) > 0) {
                        params.set('category', categoryId);
                    }
                    if (Number(subcategoryId) > 0) {
                        params.set('subcategory', subcategoryId);
                    }

                    window.location.href = `?${params.toString()}`;
                };

                if (categorySelect) {
                    categorySelect.addEventListener('change', () => redirectWithFilters(true));
                }
                if (subcategorySelect) {
                    subcategorySelect.addEventListener('change', () => redirectWithFilters(false));
                }

                async function updateCartButton(link, event = null, triggeredByClick = false) {
                    const productId = link.dataset.id;
                    let url;

                    if (triggeredByClick) {
                        event.preventDefault();
                        url = `?controller=client&action=dashboard/items/${productId}&state=cart`;
                    } else {
                        url = `?controller=client&action=dashboard/items/${productId}&state=cartCheck`;
                    }

                    try {
                        const response = await fetch(url, {
                            method: 'GET'
                        });
                        if (!response.ok) throw new Error('Network error');

                        const result = await response.json();


                        if (result.inCart) {
                            link.textContent = 'Remove from Cart';
                            link.classList.remove('btn-outline');
                            link.classList.add('btn-danger');
                        } else {
                            link.textContent = 'Add to Cart';
                            link.classList.remove('btn-danger');
                            link.classList.add('btn-outline');
                        }

                    } catch (err) {
                        console.error('Add/remove cart failed:', err);
                        if (triggeredByClick) alert('Could not update cart. Try again.');
                    }
                }

                async function updateWishlistButton(link, event = null, triggeredByClick = false) {
                    const productId = link.dataset.id;
                    let url;

                    if (triggeredByClick) {
                        event.preventDefault();
                        url = `?controller=client&action=dashboard/items/${productId}&state=wishlist`;
                    } else {
                        url = `?controller=client&action=dashboard/items/${productId}&state=wishlistCheck`;
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

                // Loop through all cart buttons
                document.querySelectorAll('.add-to-cart').forEach(link => {
                    // ✅ Check current state on page load
                    updateCartButton(link);

                    // ✅ Toggle when clicked
                    link.addEventListener('click', (event) => updateCartButton(link, event, true));
                });
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
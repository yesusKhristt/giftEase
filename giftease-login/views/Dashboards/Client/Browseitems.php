<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'items';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Browse Items</h1>
                <p class="subtitle">Manage your gift items </p>

            </div>

            <!-- Filter Tabs -->
            <h4 class="subtitle" style="padding: 10px">Filter by:</h4>
            <div class="filter-tabs">

                <select class="btn1" onchange="filterProducts('category', this.value)">
                    <option value="">Categories</option>
                    <option value="electronics">Electronics</option>
                    <option value="accessories">Accessories</option>
                    <option value="computers">Computers</option>
                </select>
                <select class="btn1" onchange="filterProducts('subcategory', this.value)">
                    <option value="">Subcategories</option>
                    <option value="electronics">Electronics</option>
                    <option value="accessories">Accessories</option>
                    <option value="computers">Computers</option>
                </select>
                <select class="btn1" onchange="filterProducts('price', this.value)">
                    <option value="">All Prices</option>
                    <option value="0-100">Rs 0 - 100</option>
                    <option value="100-500">Rs 100 - 500</option>
                    <option value="500+">500+</option>
                </select>
                <select class="btn1" onchange="sortProducts(this.value)">
                    <option value="">Sort By</option>
                    <option value="price-low">Price: Low to High</option>
                    <option value="price-high">Price: High to Low</option>
                    <option value="rating">Rating</option>
                    <option value="name">Name</option>
                </select>
            </div>

            <!-- Inventory Grid -->
            <div class="inventory-grid">
                <!-- Items will be populated by JavaScript -->
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

                            <button class="btn1 btn-danger btn-small">Add to wishlist</button>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>

            <!-- PAGINATION -->
        <?php if ($totalPages > 1): ?>
            <div class="pagination">

                <?php if ($page > 1): ?>
                    <a class="btn1"
                       href="?controller=client&action=dashboard/items&page=<?= $page - 1 ?>">
                        Prev
                    </a>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a class="btn1 <?= ($i == $page) ? 'btn-danger' : '' ?>"
                       href="?controller=client&action=dashboard/items&page=<?= $i ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <?php if ($page < $totalPages): ?>
                    <a class="btn1"
                       href="?controller=client&action=dashboard/items&page=<?= $page + 1 ?>">
                        Next
                    </a>
                <?php endif; ?>

            </div>
        <?php endif; ?>


        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Reusable function for click or initial check
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
                    const response = await fetch(url, { method: 'GET' });
                    if (!response.ok) throw new Error('Network error');

                    const result = await response.json();

                    // Toggle text & styles based on cart status
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

            // Loop through all cart buttons
            document.querySelectorAll('.add-to-cart').forEach(link => {
                // ✅ Check current state on page load
                updateCartButton(link);

                // ✅ Toggle when clicked
                link.addEventListener('click', (event) => updateCartButton(link, event, true));
            });
        });
    </script>





</body>

</html>
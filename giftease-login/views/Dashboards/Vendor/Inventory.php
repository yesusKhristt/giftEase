<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vendor Inventory</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="icon" href="resources/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'inventory';
        include 'views\commonElements/leftSidebar.php';
        ?>
        <div class="main-content">

            <?php
            $statusFilter = $_GET['status'] ?? 'all';
            $categoryFilter = isset($_GET['category']) ? (int) $_GET['category'] : 0;
            $categoryMap = [];
            foreach ($categories as $category) {
                $categoryMap[$category['id']] = $category['name'];
            }

            $buildInventoryUrl = function ($page = 1, $status = 'all', $categoryId = 0) {
                $params = [
                    'controller' => 'vendor',
                    'action' => 'dashboard/inventory',
                    'page' => $page,
                ];
                if ($status && $status !== 'all') {
                    $params['status'] = $status;
                }
                if ($categoryId) {
                    $params['category'] = $categoryId;
                }
                return '?' . http_build_query($params);
            };
            ?>

            <div class="page-header">
                <h1 class="title">Inventory Management</h1>
                <p class="subtitle">Manage your gift items and stock levels</p>
            </div>
            <!-- Filter Tabs -->
            <div class="filter-tabs">
                <select class="btn1" id="categoryFilter" aria-label="Filter by category">
                    <option value="0">All Categories</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= (int) $category['id'] ?>" <?= $categoryFilter === (int) $category['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <a href="?controller=vendor&action=dashboard/item/add" class="btn2">Add Item</a>
                <a class="btn2" href="?controller=vendor&action=dashboard/manageInventory">
                    Manage Inventory
                </a>
            </div>

            <!-- Inventory Grid -->
            <div class="inventory-grid">
                <?php
                foreach ($allProducts as $row) {
                ?>
                    <a class="inventory-item" data-status="<?= htmlspecialchars($row['status']) ?>" id="item"
                        href="?controller=vendor&action=dashboard/item/view/<?= $row['id'] ?>">
                        <img src="resources/uploads/vendor/products/<?= htmlspecialchars($row['displayImage'] ?? 'default.png') ?>"
                            class="item-image">

                        <div class="item-content">
                            <div class="item-header">
                                <div>
                                    <h3 class="item-name"><?= htmlspecialchars($row['name']) ?></h3>
                                    <?php if (! empty($categoryMap[$row['mainCategory'] ?? null])): ?>
                                        <p class="item-category"><?= htmlspecialchars($categoryMap[$row['mainCategory']]) ?></p>
                                    <?php endif; ?>
                                </div>
                                <span
                                    class="item-status status-<?= htmlspecialchars($row['status']) ?>"><?= htmlspecialchars($row['status']) ?></span>
                            </div>

                            <div class="item-details">
                                <div class="detail-item">
                                    <span class="detail-label">Price</span>
                                    <span class="detail-value">Rs.<?= htmlspecialchars($row['price']) ?></span>
                                </div>
                            </div>
                        </div>
                    </a>
                <?php
                }
                ?>
            </div>
            <?php if ($totalPages > 1): ?>
                <div class="pagination">


                    <?php if ($page > 1): ?>
                        <a class="page-arrow" href="<?= $buildInventoryUrl($page - 1, $statusFilter, $categoryFilter) ?>">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    <?php else: ?>
                        <span class="page-arrow disabled">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    <?php endif; ?>


                    <a class="page-num <?= $page == 1 ? 'active' : '' ?>"
                        href="<?= $buildInventoryUrl(1, $statusFilter, $categoryFilter) ?>">1</a>

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
                                href="<?= $buildInventoryUrl($i, $statusFilter, $categoryFilter) ?>"><?= $i ?></a>
                        <?php endfor; ?>


                        <?php if ($end < $totalPages - 1): ?>
                            <span class="page-dots">...</span>
                        <?php endif; ?>


                        <a class="page-num <?= $page == $totalPages ? 'active' : '' ?>"
                            href="<?= $buildInventoryUrl($totalPages, $statusFilter, $categoryFilter) ?>"><?= $totalPages ?></a>
                    <?php endif; ?>


                    <?php if ($page < $totalPages): ?>
                        <a class="page-arrow" href="<?= $buildInventoryUrl($page + 1, $statusFilter, $categoryFilter) ?>">
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
        const categorySelect = document.getElementById('categoryFilter');
        if (categorySelect) {
            categorySelect.addEventListener('change', () => {
                const status = <?= json_encode($statusFilter) ?>;
                const categoryId = categorySelect.value || 0;
                const params = new URLSearchParams({
                    controller: 'vendor',
                    action: 'dashboard/inventory'
                });
                if (status && status !== 'all') {
                    params.set('status', status);
                }
                if (categoryId && Number(categoryId) > 0) {
                    params.set('category', categoryId);
                }
                window.location.href = `?${params.toString()}`;
                //window.location.href = ?${params.toString()};
            });
        }
    </script>
</body>

</html>
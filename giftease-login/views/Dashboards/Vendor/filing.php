<?php
// ============================================================
// FILE: controllers/MainController.php  (add this method)
// ============================================================

public function handleProducts() {
    $filter = $_GET['category'] ?? 'all';

    if ($filter === 'all') {
        $products = $this->product->getAllProducts();
    } else {
        $products = $this->product->getProductsByCategory($filter);
    }

    $categories = $this->category->getAllCategories();

    require_once __DIR__ . '/../views/products/products.php';
}


// ============================================================
// FILE: models/Product.php  (add these methods)
// ============================================================

public function getAllProducts(): array {
    $stmt = $this->db->prepare("SELECT * FROM products");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getProductsByCategory(string $category): array {
    $stmt = $this->db->prepare("
        SELECT p.* FROM products p
        JOIN categories c ON p.category_id = c.id
        WHERE c.name = ?
    ");
    $stmt->execute([$category]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// ============================================================
// FILE: models/Category.php  (add this method)
// ============================================================

public function getAllCategories(): array {
    $stmt = $this->db->prepare("SELECT * FROM categories");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// ============================================================
// FILE: views/products/products.php  (full view file)
// ============================================================
?>

<?php $active = $_GET['category'] ?? 'all'; ?>

<!-- Filter Tabs -->
<div class="filter-tabs">
    <a href="?action=handleProducts&category=all"
       class="tab <?= $active === 'all' ? 'active' : '' ?>">
        All
    </a>
    <?php foreach ($categories as $cat): ?>
        <a href="?action=handleProducts&category=<?= urlencode($cat['name']) ?>"
           class="tab <?= $active === $cat['name'] ? 'active' : '' ?>">
            <?= htmlspecialchars($cat['name']) ?>
        </a>
    <?php endforeach; ?>
</div>

<!-- Products Grid -->
<div class="products-grid">
    <?php if (empty($products)): ?>
        <p>No products found.</p>
    <?php else: ?>
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <img src="<?= htmlspecialchars($product['image']) ?>"
                     alt="<?= htmlspecialchars($product['name']) ?>">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p>$<?= htmlspecialchars($product['price']) ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<style>
/* Filter Tabs */
.filter-tabs {
    display: flex;
    gap: 8px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}
.tab {
    padding: 8px 20px;
    border-radius: 20px;
    background: #eee;
    text-decoration: none;
    color: #333;
    transition: all 0.2s;
}
.tab.active {
    background: #4f46e5;
    color: white;
}
.tab:hover:not(.active) {
    background: #d1d5db;
}

/* Products Grid */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 20px;
}
.product-card {
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 12px;
    text-align: center;
    transition: box-shadow 0.2s;
}
.product-card:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}
.product-card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
    border-radius: 6px;
}
.product-card h3 {
    margin: 10px 0 5px;
    font-size: 16px;
}
.product-card p {
    color: #4f46e5;
    font-weight: bold;
}
</style>



<?php
// ============================================================
// FILE: controllers/MainController.php  (add this method)
// ============================================================

public function handleProducts() {
    $dateFrom = $_GET['date_from'] ?? null;
    $dateTo   = $_GET['date_to']   ?? null;
    $period   = $_GET['period']    ?? 'all';
    $category = $_GET['category']  ?? 'all';

    $products   = $this->product->getProductsFiltered($dateFrom, $dateTo, $period, $category);
    $categories = $this->category->getAllCategories();

    require_once __DIR__ . '/../views/products/products.php';
}


// ============================================================
// FILE: models/Product.php  (add these methods)
// ============================================================

public function getAllProducts(): array {
    $stmt = $this->db->prepare("SELECT * FROM products ORDER BY created_at DESC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function getProductsFiltered(
    ?string $dateFrom,
    ?string $dateTo,
    ?string $period,
    ?string $category
): array {
    $query  = "SELECT p.*, c.name as category_name
               FROM products p
               LEFT JOIN categories c ON p.category_id = c.id
               WHERE 1=1";
    $params = [];

    // Category filter
    if ($category && $category !== 'all') {
        $query   .= " AND c.name = ?";
        $params[] = $category;
    }

    // Date range filter
    if ($dateFrom) {
        $query   .= " AND p.created_at >= ?";
        $params[] = $dateFrom . ' 00:00:00';
    }
    if ($dateTo) {
        $query   .= " AND p.created_at <= ?";
        $params[] = $dateTo . ' 23:59:59';
    }

    // Period filter (only if no date range given)
    if (!$dateFrom && !$dateTo) {
        switch ($period) {
            case 'today':
                $query .= " AND DATE(p.created_at) = CURDATE()";
                break;
            case 'week':
                $query .= " AND p.created_at >= DATE_SUB(NOW(), INTERVAL 7 DAY)";
                break;
            case 'month':
                $query .= " AND MONTH(p.created_at) = MONTH(NOW())
                            AND YEAR(p.created_at)  = YEAR(NOW())";
                break;
        }
    }

    $query .= " ORDER BY p.created_at DESC";

    $stmt = $this->db->prepare($query);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// ============================================================
// FILE: models/Category.php  (add this method)
// ============================================================

public function getAllCategories(): array {
    $stmt = $this->db->prepare("SELECT * FROM categories ORDER BY name ASC");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// ============================================================
// FILE: views/products/products.php  (full view file)
// ============================================================
?>

<?php
$active   = $_GET['category']  ?? 'all';
$period   = $_GET['period']    ?? 'all';
$dateFrom = $_GET['date_from'] ?? '';
$dateTo   = $_GET['date_to']   ?? '';
?>

<div class="products-wrapper">

    <!-- ── Category Filter Tabs ── -->
    <div class="filter-tabs">
        <a href="?action=handleProducts&period=<?= $period ?>&category=all"
           class="tab <?= $active === 'all' ? 'active' : '' ?>">
            All
        </a>
        <?php foreach ($categories as $cat): ?>
            <a href="?action=handleProducts&period=<?= $period ?>&category=<?= urlencode($cat['name']) ?>"
               class="tab <?= $active === $cat['name'] ? 'active' : '' ?>">
                <?= htmlspecialchars($cat['name']) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- ── Period Filter Tabs ── -->
    <div class="filter-tabs period-tabs">
        <?php
        $periods = ['all' => 'All Time', 'today' => 'Today', 'week' => 'This Week', 'month' => 'This Month'];
        foreach ($periods as $value => $label):
        ?>
            <a href="?action=handleProducts&category=<?= $active ?>&period=<?= $value ?>"
               class="tab <?= $period === $value ? 'active' : '' ?>">
                <?= $label ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- ── Date Range Filter ── -->
    <form method="GET" class="date-filter">
        <input type="hidden" name="action"   value="handleProducts">
        <input type="hidden" name="category" value="<?= htmlspecialchars($active) ?>">
        <input type="hidden" name="period"   value="<?= htmlspecialchars($period) ?>">

        <label>From</label>
        <input type="date" name="date_from" value="<?= htmlspecialchars($dateFrom) ?>">

        <label>To</label>
        <input type="date" name="date_to"   value="<?= htmlspecialchars($dateTo) ?>">

        <button type="submit">Apply</button>
        <a href="?action=handleProducts" class="btn-clear">Clear</a>
    </form>

    <!-- ── Active Filters Summary ── -->
    <?php if ($dateFrom || $dateTo || $active !== 'all' || $period !== 'all'): ?>
        <div class="active-filters">
            <span>Filtering by:</span>
            <?php if ($active !== 'all'):  ?> <span class="badge">Category: <?= htmlspecialchars($active) ?></span> <?php endif; ?>
            <?php if ($period !== 'all'):  ?> <span class="badge">Period: <?= htmlspecialchars($period) ?></span>   <?php endif; ?>
            <?php if ($dateFrom):          ?> <span class="badge">From: <?= htmlspecialchars($dateFrom) ?></span>   <?php endif; ?>
            <?php if ($dateTo):            ?> <span class="badge">To: <?= htmlspecialchars($dateTo) ?></span>       <?php endif; ?>
            <a href="?action=handleProducts" class="clear-all">✕ Clear All</a>
        </div>
    <?php endif; ?>

    <!-- ── Products Grid ── -->
    <div class="products-grid">
        <?php if (empty($products)): ?>
            <p class="no-results">No products found.</p>
        <?php else: ?>
            <?php foreach ($products as $product): ?>
                <div class="product-card">
                    <img src="<?= htmlspecialchars($product['image'] ?? 'resources/img/placeholder.png') ?>"
                         alt="<?= htmlspecialchars($product['name']) ?>">
                    <div class="product-info">
                        <span class="product-category"><?= htmlspecialchars($product['category_name'] ?? '') ?></span>
                        <h3><?= htmlspecialchars($product['name']) ?></h3>
                        <p class="price">$<?= number_format($product['price'], 2) ?></p>
                        <p class="date">Added: <?= date('M d, Y', strtotime($product['created_at'])) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

</div>

<style>
/* ── Wrapper ── */
.products-wrapper { padding: 20px; }

/* ── Filter Tabs ── */
.filter-tabs {
    display: flex;
    gap: 8px;
    margin-bottom: 12px;
    flex-wrap: wrap;
}
.period-tabs { margin-top: -4px; }
.tab {
    padding: 8px 20px;
    border-radius: 20px;
    background: #eee;
    text-decoration: none;
    color: #333;
    font-size: 14px;
    transition: all 0.2s;
}
.tab.active        { background: #4f46e5; color: white; }
.tab:hover:not(.active) { background: #d1d5db; }

/* ── Date Filter ── */
.date-filter {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 16px;
    flex-wrap: wrap;
}
.date-filter input[type="date"] {
    padding: 8px 12px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
}
.date-filter button {
    padding: 8px 20px;
    background: #4f46e5;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}
.date-filter button:hover { background: #4338ca; }
.btn-clear {
    padding: 8px 16px;
    background: #eee;
    border-radius: 8px;
    text-decoration: none;
    color: #333;
    font-size: 14px;
}

/* ── Active Filters ── */
.active-filters {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 16px;
    flex-wrap: wrap;
    font-size: 13px;
}
.badge {
    background: #e0e7ff;
    color: #4f46e5;
    padding: 4px 10px;
    border-radius: 12px;
}
.clear-all {
    color: #ef4444;
    text-decoration: none;
    font-size: 13px;
}

/* ── Products Grid ── */
.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    gap: 20px;
}
.product-card {
    border: 1px solid #ddd;
    border-radius: 12px;
    overflow: hidden;
    transition: box-shadow 0.2s;
}
.product-card:hover { box-shadow: 0 4px 16px rgba(0,0,0,0.1); }
.product-card img {
    width: 100%;
    height: 160px;
    object-fit: cover;
}
.product-info       { padding: 12px; }
.product-category   { font-size: 12px; color: #888; text-transform: uppercase; }
.product-info h3    { margin: 6px 0 4px; font-size: 16px; }
.price              { color: #4f46e5; font-weight: bold; margin: 4px 0; }
.date               { font-size: 12px; color: #aaa; }
.no-results         { color: #888; grid-column: 1/-1; text-align: center; padding: 40px; }
</style>
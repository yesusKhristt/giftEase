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
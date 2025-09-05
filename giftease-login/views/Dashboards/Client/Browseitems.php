<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/Dilma/style.css" />
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
            <div class="filter-tabs">

                <select class="btn1" onchange="filterProducts('category', this.value)">
                    <option value="">All Categories</option>
                    <option value="electronics">Electronics</option>
                    <option value="accessories">Accessories</option>
                    <option value="computers">Computers</option>
                </select>
                <select class="btn1" onchange="filterProducts('price', this.value)">
                    <option value="">All Prices</option>
                    <option value="0-100">$0 - $100</option>
                    <option value="100-500">$100 - $500</option>
                    <option value="500+">$500+</option>
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
                <a class="inventory-item" data-status="${item.status}" id="item"
                    href="?action=dashboard&type=client&level=viewitem">

                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTTixlPtW5WdcCEXOMq8wbUJptdoi8Mk_cNqw&s"
                        class="item-image">

                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Chocolate</h3>

                            </div>

                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">$120</span>
                            </div>


                        </div>

                        <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">Discription</p>
                        <div class="item-actions">
                            <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Add to
                                cart</button>

                            <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Add to
                                wishlist</button>
                        </div>

                    </div>
                </a>
                <a class="inventory-item" data-status="${item.status}" id="item"
                    href="?action=dashboard&type=vendor&level=viewitem">

                    <img src="https://images.meesho.com/images/products/423581114/8bcfz_512.webp?width=512"
                        class="item-image">

                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Glass Rose Flower</h3>

                            </div>

                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">$200</span>
                            </div>


                        </div>

                        <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">Discription</p>

                        <div class="item-actions">
                            <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Add to
                                cart</button>

                            <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Add to
                                wishlist</button>
                        </div>
                    </div>
                </a>
                <a class="inventory-item" data-status="${item.status}" id="item"
                    href="?action=dashboard&type=vendor&level=viewitem">

                    <img src="https://m.media-amazon.com/images/I/61-DnBSho5L._UF1000,1000_QL80_.jpg"
                        class="item-image">

                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Cute Libiniah Bear Stuffed Toys</h3>

                            </div>

                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">$120</span>
                            </div>


                        </div>

                        <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">Discription</p>
                        <div class="item-actions">
                            <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Add to
                                cart</button>

                            <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Add to
                                wishlist</button>
                        </div>

                    </div>
                </a>

                <a class="inventory-item" data-status="${item.status}" id="item"
                    href="?action=dashboard&type=vendor&level=viewitem">

                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTrPIrGNpAYW5S2dqvyIS9v4ze5k3oRDVYmSg&s"
                        class="item-image">

                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">Men's watches|Swiss watch</h3>

                            </div>

                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">$120</span>
                            </div>


                        </div>

                        <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">Discription</p>
                        <div class="item-actions">
                            <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Add to
                                cart</button>

                            <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Add to
                                wishlist</button>
                        </div>

                    </div>
                </a>

                <a class="inventory-item" data-status="${item.status}" id="item"
                    href="?action=dashboard&type=vendor&level=viewitem">

                    <img src="https://img.drz.lazcdn.com/static/lk/p/3013f094949c0a6664c34a01d203b134.jpg_720x720q80.jpg"
                        class="item-image">

                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">I Love you with customized name gift mug cup</h3>

                            </div>

                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">$120</span>
                            </div>


                        </div>

                        <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">Discription</p>
                        <div class="item-actions">
                            <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Add to
                                cart</button>

                            <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Add to
                                wishlist</button>
                        </div>

                    </div>
                </a>

                  <a class="inventory-item" data-status="${item.status}" id="item"
                    href="?action=dashboard&type=vendor&level=viewitem">

                    <img src="https://img.drz.lazcdn.com/static/lk/p/3013f094949c0a6664c34a01d203b134.jpg_720x720q80.jpg"
                        class="item-image">

                    <div class="item-content">
                        <div class="item-header">
                            <div>
                                <h3 class="item-name">I Love you with customized name gift mug cup</h3>

                            </div>

                        </div>

                        <div class="item-details">
                            <div class="detail-item">
                                <span class="detail-label">Price</span>
                                <span class="detail-value">$120</span>
                            </div>


                        </div>

                        <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">Discription</p>
                        <div class="item-actions">
                            <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Add to
                                cart</button>

                            <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Add to
                                wishlist</button>
                        </div>

                    </div>
                </a>

            </div>

        </div>
    </div>

    <script>
        // Sample inventory data
        const inventoryData = [
            // Active Items
            {
                id: 1,
                name: "Premium Chocolate Box",
                category: "Chocolates",
                status: "active",
                price: 25.99,
                stock: 45,
                sold: 23,
                image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTLRtyCTThXyDDAvE_W1QvdKpMGrA1g8VOQTQ&s",
                description: "Assorted premium chocolates in elegant packaging"
            },
            {
                id: 2,
                name: "Rose Bouquet",
                category: "Flowers",
                status: "active",
                price: 35.00,
                stock: 12,
                sold: 18,
                image: "data:image/jpeg;base64,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",
                description: "Fresh red roses with decorative wrapping"
            },
            {
                id: 3,
                name: "Custom Gift Box",
                category: "Gift Boxes",
                status: "active",
                price: 45.50,
                stock: 8,
                sold: 15,
                image: "https://media.printables.com/media/prints/536965/images/4327660_217c45c8-ad59-428f-af95-daa08a430644/thumbs/inside/1280x960/jpg/img_0116.webp",
                description: "Personalized gift box with custom message"
            },
            {
                id: 4,
                name: "Teddy Bear",
                category: "Toys",
                status: "active",
                price: 18.99,
                stock: 25,
                sold: 12,
                image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTAz14yZGv__sFNLjommKBoB8jazdHJGkZdqg&s",
                description: "Soft plush teddy bear, perfect for any occasion"
            },
            {
                id: 5,
                name: "Wine & Cheese Set",
                category: "Gourmet",
                status: "active",
                price: 65.00,
                stock: 15,
                sold: 8,
                image: "https://cdn.thingiverse.com/assets/b5/45/32/1c/4a/large_display_bf9c6ec3-b421-4158-9d7a-eff0bb191c0a.jpg",
                description: "Premium wine paired with artisanal cheese selection"
            },

            // Paused Items
            {
                id: 9,
                name: "Seasonal Fruit Basket",
                category: "Food",
                status: "paused",
                price: 38.00,
                stock: 0,
                sold: 5,
                image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS43l3yrqp8rIunSniSB4MFmkJAWtAFpS_-9Q&s",
                description: "Fresh seasonal fruits in wicker basket"
            },
            {
                id: 10,
                name: "Perfume Gift Set",
                category: "Beauty",
                status: "paused",
                price: 55.00,
                stock: 0,
                sold: 3,
                image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTWDpfBgnkNL0Fhk6kPjVfqu2g2dUp9uTGcspRGFANxwUUXseVJLGZnYcOMKOke7j7U3sc&usqp=CAU",
                description: "Luxury perfume collection for special occasions"
            },
            {
                id: 11,
                name: "Coffee Mug Set",
                category: "Kitchenware",
                status: "paused",
                price: 22.50,
                stock: 0,
                sold: 9,
                image: "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQtL95JLknFyEBJXxiae1LTxcwiuKbIgS3Xkghy71tmAV_33GR0enzVzaMC6qBbl9rOPBk&usqp=CAU",
                description: "Set of 2 ceramic coffee mugs with custom design"
            },
            {
                id: 12,
                name: "Plant Pot Set",
                category: "Home Decor",
                status: "paused",
                price: 32.00,
                stock: 0,
                sold: 4,
                image: "https://i0.wp.com/conceptartworld.com/wp-content/uploads/2018/01/Horizon-Zero-Dawn-Concept-Art-Deathbringer-7-Miguel-Angel-Martinez.jpg",
                description: "Decorative plant pots with small succulents"
            }
        ];

        let currentFilter = 'all';

        // Initialize the page
        function init() {
            renderInventory();
            updateSummaryCards();
        }

        // Render inventory items
        function renderInventory() {
            const grid = document.getElementById('inventoryGrid');
            const filteredItems = currentFilter === 'all'
                ? inventoryData
                : inventoryData.filter(item => item.status === currentFilter);

            if (filteredItems.length === 0) {
                grid.innerHTML = `
                    <div class="empty-state">
                        <div class="empty-icon">📦</div>
                        <h3 class="empty-title">No items found</h3>
                        <p class="empty-description">
                            ${currentFilter === 'all'
                        ? 'No inventory items available.'
                        : No ${ currentFilter } items in your inventory.}
                        </p >
                    </div >
                `;
                return;
            }

            grid.innerHTML = filteredItems.map(item => `
                < a class="inventory-item" data - status="${item.status}" id = "item" href = "?action=dashboard&type=vendor&level=viewitem" >

                    <img src="${item.image}" class="item-image">

                        <div class="item-content">
                            <div class="item-header">
                                <div>
                                    <h3 class="item-name">${item.name}</h3>
                                    <p class="item-category">${item.category}</p>
                                </div>
                                <span class="item-status status-${item.status}">${item.status}</span>
                            </div>

                            <div class="item-details">
                                <div class="detail-item">
                                    <span class="detail-label">Price</span>
                                    <span class="detail-value">$${item.price}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Stock</span>
                                    <span class="detail-value ${item.stock <= 10 ? 'text-danger' : ''}">${item.stock}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Sold</span>
                                    <span class="detail-value">${item.sold}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Revenue</span>
                                    <span class="detail-value">$${(item.price * item.sold).toFixed(2)}</span>
                                </div>
                            </div>

                            <p style="font-size: 12px; color: #6b7280; margin-bottom: 16px;">${item.description}</p>

                            <div class="item-actions">
                                <button class="btn1 btn-outline btn-small" onclick="editItem(${item.id})">Edit</button>
                                <button class="btn1 ${item.status === 'active' ? 'btn-secondary' : 'btn-primary'} btn-small"
                                    onclick="toggleStatus(${item.id})">
                                    ${item.status === 'active' ? 'Pause' : 'Activate'}
                                </button>
                                <button class="btn1 btn-danger btn-small" onclick="deleteItem(${item.id})">Delete</button>
                            </div>
                        </div>
                    </a>
            `).join('');
        }

        // Filter items
        function filterItems(filter) {
            currentFilter = filter;

            // Update active tab
            document.querySelectorAll('.filter-tab').forEach(tab => {
                tab.classList.remove('active');
            });
            event.target.classList.add('active');

            // Re-render inventory
            renderInventory();
        }

        // Update summary cards
        function updateSummaryCards() {
            const totalItems = inventoryData.length;
            const activeItems = inventoryData.filter(item => item.status === 'active').length;
            const pausedItems = inventoryData.filter(item => item.status === 'paused').length;
            const lowStockItems = inventoryData.filter(item => item.stock <= 10 && item.status === 'active').length;

            document.getElementById('totalItems').textContent = totalItems;
            document.getElementById('activeItems').textContent = activeItems;
            document.getElementById('pausedItems').textContent = pausedItems;
            document.getElementById('lowStockItems').textContent = lowStockItems;
        }

        // Item actions
        function editItem(id) {
            const item = inventoryData.find(item => item.id === id);
            alert(Edit item: ${item.name}\n\nThis would open an edit form.);
        }

        function toggleStatus(id) {
            const item = inventoryData.find(item => item.id === id);
            item.status = item.status === 'active' ? 'paused' : 'active';

            // If activating, add some stock
            if (item.status === 'active' && item.stock === 0) {
                item.stock = 10;
            }
            // If pausing, set stock to 0
            if (item.status === 'paused') {
                item.stock = 0;
            }

            renderInventory();
            updateSummaryCards();
        }

        function deleteItem(id) {
            const item = inventoryData.find(item => item.id === id);
            if (confirm(Are you sure you want to delete "${item.name}"?)) {
                const index = inventoryData.findIndex(item => item.id === id);
                inventoryData.splice(index, 1);
                renderInventory();
                updateSummaryCards();
            }
        }

        function addNewItem() {
            alert('Add New Item\n\nThis would open a form to add a new inventory item.');
        }

        function exportInventory() {
            alert('Export Inventory\n\nThis would export the inventory data to CSV or PDF.');
        }

        // Navigation
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function (e) {
                if (this.getAttribute('href') === '#') {
                    e.preventDefault();
                }
                document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Initialize the page
        init();
    </script>
</body>

</html>
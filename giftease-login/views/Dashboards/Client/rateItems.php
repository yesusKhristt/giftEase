<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Order #<?= htmlspecialchars($order['id']) ?> - GiftEase</title>
    <link rel="stylesheet" href="public/client.css" />
    <link rel="stylesheet" href="public/sideTopBar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 10000;
            justify-content: center;
            align-items: center;
        }

        .overlay.active {
            display: flex;
        }

        .star-rating-picker {
            display: inline-flex;
            flex-direction: row-reverse;
            gap: 6px;
            font-size: 2.4rem;
        }

        .star-rating-picker input {
            display: none;
        }

        .star-rating-picker label {
            color: #ddd;
            cursor: pointer;
            transition: color 0.15s ease;
        }

        .star-rating-picker label:hover,
        .star-rating-picker label:hover~label {
            color: #d03c2e;
        }

        .star-rating-picker input:checked~label,
        .star-rating-picker input:checked+label {
            color: #d03c2e;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'orders';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>

        <div class="main-content">

            <?php if (empty($order)): ?>
                <div class="page-header">
                    <h1 class="title">Order Not Found</h1>
                    <p class="subtitle">This order doesn't exist or doesn't belong to you.</p>
                </div>
                <a href="?controller=client&action=dashboard/orders" class="btn1" style="width:fit-content;">
                    <i class="fas fa-arrow-left"></i> Back to Orders
                </a>

            <?php else:
                if ($order['is_delivered']) {
                    $sc = 'green';
                    $st = 'Delivered';
                } elseif ($order['is_wrapped']) {
                    $sc = 'blue';
                    $st = 'Wrapped';
                } elseif ($order['in_warehouse']) {
                    $sc = 'blue';
                    $st = 'In Warehouse';
                } elseif (strtotime($order['deliveryDate']) < time()) {
                    $sc = 'red';
                    $st = 'Overdue';
                } else {
                    $sc = 'blue';
                    $st = 'With Vendor';
                }
            ?>

                <div class="page-header">
                    <h1 class="title">Rate Order</h1>
                    <p class="subtitle">
                        For <?= htmlspecialchars($order['recipientName'] ?? 'N/A') ?>
                        <span class="badge <?= $sc ?>"><?= $st ?></span>
                    </p>
                </div>

                <div class="summary-grid">
                    <div class="card">
                        <p class="subtitle">Gift Wrapper</p>
                        <p style="margin-top:8px;"><?= htmlspecialchars($order['giftWrapperFName'] ?? 'N/A') ?> <?= htmlspecialchars($order['giftWrapperLName'] ?? 'N/A') ?></p>
                    </div>
                    <div class="card">
                        <p class="subtitle">Delivery</p>
                        <p style="margin-top:8px;"><?= htmlspecialchars($order['deliveryFName'] ?? 'N/A') ?> <?= htmlspecialchars($order['deliveryLName'] ?? 'N/A') ?></p>
                    </div>
                </div>

                <div class="card">
                    <h4>Items in This Order</h4>
                    <?php if (empty($orderItems)): ?>
                        <p class="subtitle">No items found for this order.</p>
                    <?php else: ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">Item</th>
                                    <th>Shop Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orderItems as $item): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($item['item_name']) ?></td>
                                        <td>
                                            <div class="product-cell">
                                                <img src="resources/uploads/vendor/products/<?= htmlspecialchars($item['item_image']) ?>" class="product-thumbnail">
                                            </div>
                                        </td>
                                        <td><?= $item['shopName'] ?></td>
                                        <td>
                                            <?php if ($item['alreadyRated']): ?>
                                                <span>Rated</span>
                                            <?php else: ?>
                                                <button
                                                    class="btn2 rate-btn"
                                                    data-order-id="<?= $order['id'] ?>"
                                                    data-product-id="<?= $item['product_ID'] ?>"
                                                    style="padding:6px 12px; font-size:12px;">
                                                    Rate
                                                </button>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>

                <div style="display:flex; gap:12px;">
                    <a href="?controller=client&action=dashboard/orders" class="btn1" style="width:fit-content;">
                        <i class="fas fa-arrow-left"></i> Back to Orders
                    </a>
                    <a href="?controller=client&action=dashboard/tracking/<?= $order['id'] ?>"
                        class="btn2" style="width:fit-content;">
                        <i class="fas fa-map-marker-alt"></i> Track Order
                    </a>
                </div>

            <?php endif; ?>

        </div>
    </div>

    <!-- Rating Modal -->
    <div id="ratingModal" class="overlay">
        <div class="popup" style="max-width: 480px; width: 90%;">

            <i class="fas fa-star" style="font-size:2rem; color:#d03c2e; margin-bottom:8px;"></i>
            <h2 style="margin-bottom:4px;">Rate Your Purchase</h2>
            <p class="subtitle" style="margin-bottom:24px;">Your feedback helps other customers</p>

            <form method="POST" id="ratingForm">
                <input type="hidden" name="order_id" id="orderIdInput">
                <input type="hidden" name="product_id" id="productIdInput">

                <div class="form-group" style="text-align:center;">
                    <label class="form-label" style="display:block; margin-bottom:12px;">
                        How would you rate this product?
                    </label>

                    <div class="star-rating-picker">
                        <?php for ($i = 5; $i >= 1; $i--): ?>
                            <input type="radio" name="rating" id="star<?= $i ?>"
                                value="<?= $i ?>" required>
                            <label for="star<?= $i ?>">★</label>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="form-group" style="text-align:left; margin-top:20px;">
                    <label class="form-label">Write a Review</label>
                    <textarea name="review" rows="4" class="form-input"
                        placeholder="What did you like or dislike about this product?"
                        required style="resize:vertical; width:100%;"></textarea>
                </div>

                <div style="display:flex; gap:12px; margin-top:16px;">
                    <button type="submit" class="btn2" style="flex:1;">
                        <i class="fas fa-check"></i> Submit
                    </button>
                    <button type="button" class="btn1" id="closeModal" style="flex:1;">
                        Cancel
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {

            const modal = document.getElementById("ratingModal");
            const form = document.getElementById("ratingForm");
            const orderInput = document.getElementById("orderIdInput");
            const productInput = document.getElementById("productIdInput");

            document.querySelectorAll(".rate-btn").forEach(btn => {
                btn.addEventListener("click", () => {
                    const orderId = btn.getAttribute("data-order-id");
                    const productId = btn.getAttribute("data-product-id");

                    orderInput.value = orderId;
                    productInput.value = productId;

                    form.action = `?controller=client&action=dashboard/rate/${orderId}`;

                    modal.classList.add("active");
                });
            });

            document.getElementById("closeModal").addEventListener("click", () => {
                modal.classList.remove("active");
            });

            // Also close when clicking the dark backdrop
            modal.addEventListener("click", (e) => {
                if (e.target === modal) {
                    modal.classList.remove("active");
                }
            });

        });
    </script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Wrapping Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="icon" type="image/png" href="resources/1.png">
    <link rel="profile" href="profile.php" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'service';
        include 'views\commonElements/leftSidebarJeshani.php';
        ?>
      
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Service Offerings</h1>
                <p class="subtitle">Manage your wrapping services and pricing</p>
            </div>

            <div class="card">
                <h3 class="title">Add New Service</h3>
                <form action="?controller=giftWrapper&action=dashboard/service/add" method="post" enctype="multipart/form-data">
                    <div class="summary-grid">
                        <div>
                            <label>Service Name</label>
                            <input type="text" name="name" placeholder="e.g., Premium Gift Wrap" required>
                        </div>
                        <div>
                            <label>Price (Rs)</label>
                            <input type="number" name="price" step="0.01" min="0" placeholder="0.00">
                        </div>
                        <div>
                            <label>Service Image (optional)</label>
                            <input type="file" name="image" accept="image/*">
                        </div>
                        <div>
                            <label>Description</label>
                            <textarea name="description" rows="3" placeholder="Describe your wrapping service" required></textarea>
                        </div>
                    </div>
                    <div class="button-section">
                        <button type="submit" class="btn1"><i class="fas fa-plus"></i>Add Service</button>
                    </div>
                </form>
            </div>

            <div class="card">
                <h3 class="title">Your Services</h3>
                <div class="inventory-grid">
                    <?php if (empty($services)) : ?>
                        <div class="inventory-item">
                            <div class="item-content">
                                <h3 class="item-name">No services yet</h3>
                                <p class="subtitle">Add your first service using the form above.</p>
                            </div>
                        </div>
                    <?php else : ?>
                        <?php foreach ($services as $service) : ?>
                            <div class="inventory-item" data-status="active">
                                <img src="<?= htmlspecialchars($service['image_path'] ?: 'resources/cards.jpg') ?>" class="item-image" alt="Service image">
                                <div class="item-content">
                                    <div class="item-header">
                                        <div>
                                            <h3 class="item-name"><?= htmlspecialchars($service['name']) ?></h3>
                                            <p class="subtitle"><?= htmlspecialchars($service['description']) ?></p>
                                        </div>
                                    </div>
                                    <div class="item-details">
                                        <div class="detail-item">
                                            <span class="detail-label">Price</span>
                                            <span class="detail-value">Rs<?= htmlspecialchars(number_format((float) $service['price'], 2)) ?></span>
                                        </div>
                                        <?php if ($service['rating'] !== null) : ?>
                                            <div class="detail-item">
                                                <span class="detail-label">Rating</span>
                                                <span class="detail-value"><?= htmlspecialchars(number_format((float) $service['rating'], 1)) ?>/5</span>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

</body>

</html>
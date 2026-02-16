<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Gift Wrapping Packages - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="icon" type="image/png" href="resources/1.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'giftWrapping';
        include 'views/commonElements/leftSidebarChathu.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Edit Gift Wrapping Packages</h1>
                <p class="subtitle">Manage your gift wrapping packages</p>
            </div>

            <?php if (empty($packages)): ?>
                <div class="card" style="text-align:center; padding:40px;">
                    <p>No gift wrapping packages found.</p>
                    <a href="?controller=admin&action=dashboard/addGiftWrappingPackages" class="btn1"
                        style="display:inline-block; margin-top:15px;">Add New Package</a>
                </div>
            <?php else: ?>
                <table class="table">
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Images</th>
                        <th>Actions</th>
                    </tr>
                    <?php foreach ($packages as $package):
                        $images = json_decode($package['images'], true) ?? [];
                    ?>
                        <tr>
                            <form method="POST"
                                action="?controller=admin&action=dashboard/editGiftWrappingPackages/edit/<?= htmlspecialchars($package['id']) ?>"
                                enctype="multipart/form-data" class="editPackageForm">
                                <td>
                                    <input type="text" name="title"
                                        value="<?= htmlspecialchars($package['title']) ?>" required>
                                </td>
                                <td>
                                    <textarea name="description" rows="4"
                                        cols="30"><?= htmlspecialchars($package['description']) ?></textarea>
                                </td>
                                <td>
                                    <input type="number" name="price"
                                        value="<?= htmlspecialchars($package['price']) ?>" min="1" required>
                                </td>
                                <td>
                                    <div style="display:flex; gap:5px; flex-wrap:wrap; margin-bottom:10px;">
                                        <?php foreach ($images as $img): ?>
                                            <img src="resources/uploads/admin/giftWrappingPackages/<?= htmlspecialchars($img) ?>"
                                                style="width:60px; height:60px; object-fit:cover; border-radius:5px;"
                                                alt="Package image">
                                        <?php endforeach; ?>
                                    </div>
                                    <input type="file" name="images[]" multiple accept="image/*">
                                    <small>Upload new images to replace existing ones (leave empty to keep current)</small>
                                </td>
                                <td>
                                    <div style="display:flex; gap:5px; flex-direction:column;">
                                        <button type="submit" class="btn1">Update</button>
                                        <a href="?controller=admin&action=dashboard/editGiftWrappingPackages/delete/<?= htmlspecialchars($package['id']) ?>"
                                            class="btn2"
                                            style="text-align:center;"
                                            onclick="return confirm('Are you sure you want to delete this package?')">Delete</a>
                                    </div>
                                </td>
                            </form>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>

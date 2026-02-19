<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

   
        <?php
        $activePage = 'category';
        include 'views/commonElements/leftSidebarChathu.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Edit Product Categories</h1>
                <p class="subtitle">Edit Product Categories for efficient searching</p>

            </div>
            <div style="display: grid; grid-template-columns: 2fr 3fr;">
                <div>
                    <h3 style="padding:20px">Categories</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Name
                                </th>
                                <th>

                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($categories as $row): ?>
                                <form method="post">
                                    <tr>
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                                        <td>
                                            <?= htmlspecialchars($row['id']) ?>
                                        </td>
                                        <td>
                                            <input type="text" name="name"
                                                placeholder="<?= htmlspecialchars($row['name']) ?>">
                                        </td>
                                        <td>
                                            <input type="submit"
                                                formaction="?controller=admin&action=dashboard/category/edit/category/update"
                                                value="Update">
                                        </td>
                                        <td>
                                            <input type="submit"
                                                formaction="?controller=admin&action=dashboard/category/edit/category/delete"
                                                value="Delete">
                                        </td>
                                    </tr>
                                </form>
                            <?php endforeach ?>
                        </tbody>

                    </table>
                </div>
                <div>
                    <h3 style="padding:20px">Subcategories</h3>
                    <div>
                        <table>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Name
                                </th>
                                <th colspan="3">
                                    Category
                                </th>
                                <th></th>
                                <th></th>
                            </tr>
                            <?php foreach ($subcategories as $row): ?>
                                <form method="post">

                                    <tr>
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
                                        <td>
                                            <?= htmlspecialchars($row['id']) ?>
                                        </td>
                                        <td>
                                            <input type="text" name="name"
                                                placeholder="<?= htmlspecialchars($row['name']) ?>">
                                        </td>
                                        <td colspan="3">
                                            <select name="category" style="width:80%">
                                                <?php foreach ($categories as $row2): ?>
                                                    <option value="<?= htmlspecialchars($row2['id']) ?>"
                                                        <?= ($row2['id'] == $row['category']) ? 'selected' : '' ?>>
                                                        <?= htmlspecialchars($row2['name']) ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="submit"
                                                formaction="?controller=admin&action=dashboard/category/edit/subcategory/update"
                                                value="Update">
                                        </td>
                                        <td>
                                            <input type="submit"
                                                formaction="?controller=admin&action=dashboard/category/edit/subcategory/delete"
                                                value="Delete">
                                        </td>
                                </form>
                            <?php endforeach ?>

                        </table>
                    </div>
                </div>
            </div>
        </div>
   
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
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
                <h1 class="title">Upload Image</h1>
            </div>
            <table class="table">
                <tr>
                    <th>Item</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Layer</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php foreach ($boxWrap as $row): ?>
                    <form method="POST">
                        <tr>
                            <td class="subtitle">Box Wrapping</td>
                            <td>
                                <input type="text" name="Name" value="<?= htmlspecialchars($row['name']) ?>">
                            </td>
                            <td>
                                <input type="number" name="Price" value="<?= htmlspecialchars($row['price']) ?>">
                            </td>
                            <td>
                                <input type="number" name="Layer" value="<?= htmlspecialchars($row['layer']) ?>">
                            </td>
                            <td>
                                <input type="submit"
                                    formaction="?controller=admin&action=dashboard/editGiftWrappingItems/update/boxWrap/<?= htmlspecialchars($row['id']) ?>"
                                    value="Update">
                            </td>
                            <td>
                                <input type="submit"
                                    formaction="?controller=admin&action=dashboard/editGiftWrappingItems/delete/boxWrap/<?= htmlspecialchars($row['id']) ?>"
                                    value="Delete">
                            </td>
                        </tr>
                    </form>
                <?php endforeach ?>
                <?php foreach ($boxRibbon as $row): ?>
                    <form method="POST" >
                        <tr>
                            <td class="subtitle">Box Ribbon</td>
                            <td>
                                <input type="text" name="Name" value="<?= htmlspecialchars($row['name']) ?>">
                            </td>
                            <td>
                                <input type="number" name="Price" value="<?= htmlspecialchars($row['price']) ?>">
                            </td>
                            <td>
                                <input type="number" name="Layer" value="<?= htmlspecialchars($row['layer']) ?>">
                            </td>
                            <td>
                                <input type="submit"
                                    formaction="?controller=admin&action=dashboard/editGiftWrappingItems/update/boxRibbon/<?= htmlspecialchars($row['id']) ?>"
                                    value="Update">
                            </td>
                            <td>
                                <input type="submit"
                                    formaction="?controller=admin&action=dashboard/editGiftWrappingItems/delete/boxRibbon/<?= htmlspecialchars($row['id']) ?>"
                                    value="Delete">
                            </td>

                        </tr>
                    </form>
                <?php endforeach ?>
                <?php foreach ($paperBag as $row): ?>
                    <form method="POST" >
                        <tr>
                            <td class="subtitle">Paper Bag</td>


                            <td>
                                <input type="text" name="Name" value="<?= htmlspecialchars($row['name']) ?>">
                            </td>
                            <td>
                                <input type="number" name="Price" value="<?= htmlspecialchars($row['price']) ?>">
                            </td>

                            <td>
                                <input type="number" name="Layer" value="<?= htmlspecialchars($row['layer']) ?>">
                            </td>

                            <td>
                                <input type="submit"
                                    formaction="?controller=admin&action=dashboard/editGiftWrappingItems/update/paperBag/<?= htmlspecialchars($row['id']) ?>"
                                    value="Update">
                            </td>
                            <td>
                                <input type="submit"
                                    formaction="?controller=admin&action=dashboard/editGiftWrappingItems/delete/paperBag/<?= htmlspecialchars($row['id']) ?>"
                                    value="Delete">
                            </td>

                        </tr>
                    </form>
                <?php endforeach ?>
                <?php foreach ($paperBagRibbon as $row): ?>
                    <form method="POST" >
                        <tr>
                            <td class="subtitle">Paper Bag Ribbon</td>


                            <td>
                                <input type="text" name="Name" value="<?= htmlspecialchars($row['name']) ?>">
                            </td>
                            <td>
                                <input type="number" name="Price" value="<?= htmlspecialchars($row['price']) ?>">
                            </td>

                            <td>
                                <input type="number" name="Layer" value="<?= htmlspecialchars($row['layer']) ?>">
                            </td>

                            <td>
                                <input type="submit"
                                    formaction="?controller=admin&action=dashboard/editGiftWrappingItems/update/paperBagRibbon/<?= htmlspecialchars($row['id']) ?>"
                                    value="Update">
                            </td>
                            <td>
                                <input type="submit"
                                    formaction="?controller=admin&action=dashboard/editGiftWrappingItems/delete/paperBagRibbon/<?= htmlspecialchars($row['id']) ?>"
                                    value="Delete">
                            </td>

                        </tr>
                    </form>
                <?php endforeach ?>
                <?php foreach ($chocolates as $row): ?>
                    <form method="POST" >
                        <tr>
                            <td class="subtitle">Chocolates</td>


                            <td>
                                <input type="text" name="Name" value="<?= htmlspecialchars($row['name']) ?>">
                            </td>
                            <td>
                                <input type="number" name="Price" value="<?= htmlspecialchars($row['price']) ?>">
                            </td>

                            <td>
                                <input type="number" name="Layer" value="<?= htmlspecialchars($row['layer']) ?>">
                            </td>

                            <td>
                                <input type="submit"
                                    formaction="?controller=admin&action=dashboard/editGiftWrappingItems/update/chocolates/<?= htmlspecialchars($row['id']) ?>"
                                    value="Update">
                            </td>
                            <td>
                                <input type="submit"
                                    formaction="?controller=admin&action=dashboard/editGiftWrappingItems/delete/chocolates/<?= htmlspecialchars($row['id']) ?>"
                                    value="Delete">
                            </td>

                        </tr>
                    </form>
                <?php endforeach ?>
                <?php foreach ($softToys as $row): ?>
                    <form method="POST" >
                        <tr>
                            <td class="subtitle">Cards</td>


                            <td>
                                <input type="text" name="Name" value="<?= htmlspecialchars($row['name']) ?>">
                            </td>
                            <td>
                                <input type="number" name="Price" value="<?= htmlspecialchars($row['price']) ?>">
                            </td>

                            <td>
                                <input type="number" name="Layer" value="<?= htmlspecialchars($row['layer']) ?>">
                            </td>
                            <td>
                                <input type="submit"
                                    formaction="?controller=admin&action=dashboard/editGiftWrappingItems/update/cards/<?= htmlspecialchars($row['id']) ?>"
                                    value="Update">
                            </td>
                            <td>
                                <input type="submit"
                                    formaction="?controller=admin&action=dashboard/editGiftWrappingItems/delete/cards/<?= htmlspecialchars($row['id']) ?>"
                                    value="Delete">
                            </td>

                        </tr>
                    </form>
                <?php endforeach ?>
                <?php foreach ($cards as $row): ?>
                    <form method="POST" >
                        <tr>
                            <td class="subtitle">Soft Toys</td>


                            <td>
                                <input type="text" name="Name" value="<?= htmlspecialchars($row['name']) ?>">
                            </td>
                            <td>
                                <input type="number" name="Price" value="<?= htmlspecialchars($row['price']) ?>">
                            </td>

                            <td>
                                <input type="number" name="Layer" value="<?= htmlspecialchars($row['layer']) ?>">
                            </td>
                            <td>
                                <input type="submit"
                                    formaction="?controller=admin&action=dashboard/editGiftWrappingItems/update/softToys/<?= htmlspecialchars($row['id']) ?>"
                                    value="Update">
                            </td>
                            <td>
                                <input type="submit"
                                    formaction="?controller=admin&action=dashboard/editGiftWrappingItems/delete/softToys/<?= htmlspecialchars($row['id']) ?>"
                                    value="Delete">
                            </td>

                        </tr>
                    </form>
                <?php endforeach ?>

            </table>

            
</body>

</html>
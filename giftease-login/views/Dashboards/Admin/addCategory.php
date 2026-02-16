<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="icon" type="image/png" href="resources/1.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'category';
        include 'views/commonElements/leftSidebarChathu.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Add Product Categories</h1>
                <p class="subtitle">Add Product Categories for efficient searching</p>

            </div>
            <form action="?controller=admin&action=dashboard/category/add/category" method="post">
                <h3>Categories</h3>
                <table class="table">
                    <tr>
                        <td style="width:15%" class="subtitle">Category Name</td>
                        <td colspan="2">
                            <input type="text" id="title" name="name" placeholder="Title">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div style="display: flex; justify-content: center;">
                                <input class="btn1" type="submit" style="width:200px">
                            </div>
                        </td>

                    </tr>
                </table>
            </form>
            <div style="padding: 20px;"></div>
            <form action="?controller=admin&action=dashboard/category/add/subcategory" method="post">
                <h3>Subcategories</h3>
                <table class="table">
                    <tr>
                        <td>Category</td>
                        <td colspan="2" style="text-align: center;">
                            <select id="category" name="category" style="width:80%">
                                <?php foreach($categories as $row):?>
                                <option value=<?=htmlspecialchars($row['id'])?>><?=htmlspecialchars($row['name'])?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td style="width:15%" class="subtitle">Subcategory Name</td>
                        <td colspan="2">
                            <input type="text" id="title" name="name" placeholder="Title">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div style="display: flex; justify-content: center;">
                                <input class="btn1" type="submit" style="width:200px">
                            </div>
                        </td>
                    </tr>
                </table>

            </form>




        </div>
    </div>
</body>

</html>
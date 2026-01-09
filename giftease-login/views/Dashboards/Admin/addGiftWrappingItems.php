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
                    <th>Preview Image</th>
                    <th>Display Image</th>
                    <th>Layer</th>
                    <th>Submit</th>
                </tr>
                <form action="?controller=admin&action=dashboard/addGiftWrappingItems/boxWrap" method="POST"
                    enctype="multipart/form-data">
                    <tr>
                        <td class="subtitle">Box Wrapping</td>


                        <td>
                            <input type="text" name="Name">
                        </td>
                        <td>
                            <input type="number" name="Price">
                        </td>
                        <td>
                            <input type="file" name="previewImage" style="display:none;" accept="image/*"
                                id="boxWrapPreview">

                            <div class="upload-area" id="uploadAreaBoxWrapPreview">
                                <h4 style="color:#4f42b5">Upload Here</h4>
                            </div>

                            <div id="preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:15px;">
                            </div>

                        </td>
                        <td>
                            <input type="file" name="displayImage" style="display:none;" accept="image/*"
                                id="boxWrapDisplay">

                            <div class="upload-area" id="uploadAreaBoxWrapDisplay">
                                <h4 style="color:#4f42b5">Upload Here</h4>
                            </div>

                            <div id="preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:15px;">
                            </div>

                        </td>
                        <td>
                            <input type="number" name="Layer">
                        </td>
                        <td><button type="submit" class="btn1">Submit</button></td>

                    </tr>
                </form>
                <form action="?controller=admin&action=dashboard/addGiftWrappingItems/boxRibbon" method="POST"
                    enctype="multipart/form-data">
                    <tr>
                        <td class="subtitle">Box Ribbon</td>


                        <td>
                            <input type="text" name="Name">
                        </td>
                        <td>
                            <input type="number" name="Price">
                        </td>
                        <td>
                            <input type="file" name="previewImage" style="display:none;" accept="image/*"
                                id="boxRibbonPreview">

                            <div class="upload-area" id="uploadAreaboxRibbonPreview">
                                <h4 style="color:#4f42b5">Upload Here</h4>
                            </div>

                            <div id="preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:15px;">
                            </div>

                        </td>
                        <td>
                            <input type="file" name="displayImage" style="display:none;" accept="image/*"
                                id="boxRibbonDisplay">

                            <div class="upload-area" id="uploadAreaboxRibbonDisplay">
                                <h4 style="color:#4f42b5">Upload Here</h4>
                            </div>

                            <div id="preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:15px;">
                            </div>

                        </td>
                        <td>
                            <input type="number" name="Layer">
                        </td>

                        <td><button type="submit" class="btn1">Submit</button></td>

                    </tr>
                </form>
                <form action="?controller=admin&action=dashboard/addGiftWrappingItems/paperBag" method="POST"
                    enctype="multipart/form-data">
                    <tr>
                        <td class="subtitle">Paper Bag</td>


                        <td>
                            <input type="text" name="Name">
                        </td>
                        <td>
                            <input type="number" name="Price">
                        </td>
                        <td>
                            <input type="file" name="previewImage" style="display:none;" accept="image/*"
                                id="paperBagPreview">

                            <div class="upload-area" id="uploadAreapaperBagPreview">
                                <h4 style="color:#4f42b5">Upload Here</h4>
                            </div>

                            <div id="preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:15px;">
                            </div>

                        </td>
                        <td>
                            <input type="file" name="displayImage" style="display:none;" accept="image/*"
                                id="paperBagDisplay">

                            <div class="upload-area" id="uploadAreapaperBagDisplay">
                                <h4 style="color:#4f42b5">Upload Here</h4>
                            </div>

                            <div id="preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:15px;">
                            </div>

                        </td>

                        <td>
                            <input type="number" name="Layer">
                        </td>

                        <td><button type="submit" class="btn1">Submit</button></td>

                    </tr>
                </form>
                <form action="?controller=admin&action=dashboard/addGiftWrappingItems/paperBagRibbon" method="POST"
                    enctype="multipart/form-data">
                    <tr>
                        <td class="subtitle">Paper Bag Ribbon</td>


                        <td>
                            <input type="text" name="Name">
                        </td>
                        <td>
                            <input type="number" name="Price">
                        </td>
                        <td>
                            <input type="file" name="previewImage" style="display:none;" accept="image/*"
                                id="paperBagRibbonPreview">

                            <div class="upload-area" id="uploadAreapaperBagRibbonPreview">
                                <h4 style="color:#4f42b5">Upload Here</h4>
                            </div>

                            <div id="preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:15px;">
                            </div>

                        </td>
                        <td>
                            <input type="file" name="displayImage" style="display:none;" accept="image/*"
                                id="paperBagRibbonDisplay">

                            <div class="upload-area" id="uploadAreapaperBagRibbonDisplay">
                                <h4 style="color:#4f42b5">Upload Here</h4>
                            </div>

                            <div id="preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:15px;">
                            </div>

                        </td>
                        <td>
                            <input type="number" name="Layer">
                        </td>

                        <td><button type="submit" class="btn1">Submit</button></td>

                    </tr>
                </form>
                <form action="?controller=admin&action=dashboard/addGiftWrappingItems/chocolates" method="POST"
                    enctype="multipart/form-data">
                    <tr>
                        <td class="subtitle">Chocolates</td>


                        <td>
                            <input type="text" name="Name">
                        </td>
                        <td>
                            <input type="number" name="Price">
                        </td>
                        <td>
                            <input type="file" name="previewImage" style="display:none;" accept="image/*"
                                id="chocolatesPreview">

                            <div class="upload-area" id="uploadAreachocolatesPreview">
                                <h4 style="color:#4f42b5">Upload Here</h4>
                            </div>

                            <div id="preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:15px;">
                            </div>

                        </td>
                        <td>
                            <input type="file" name="displayImage" style="display:none;" accept="image/*"
                                id="chocolatesDisplay">

                            <div class="upload-area" id="uploadAreachocolatesDisplay">
                                <h4 style="color:#4f42b5">Upload Here</h4>
                            </div>

                            <div id="preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:15px;">
                            </div>

                        </td>
                        <td>
                            <input type="number" name="Layer">
                        </td>

                        <td><button type="submit" class="btn1">Submit</button></td>

                    </tr>
                </form>
                <form action="?controller=admin&action=dashboard/addGiftWrappingItems/cards" method="POST"
                    enctype="multipart/form-data">
                    <tr>
                        <td class="subtitle">Cards</td>


                        <td>
                            <input type="text" name="Name">
                        </td>
                        <td>
                            <input type="number" name="Price">
                        </td>
                        <td>
                            <input type="file" name="previewImage" style="display:none;" accept="image/*"
                                id="cardsPreview">

                            <div class="upload-area" id="uploadAreacardsPreview">
                                <h4 style="color:#4f42b5">Upload Here</h4>
                            </div>

                            <div id="preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:15px;">
                            </div>

                        </td>
                        <td>
                            <input type="file" name="displayImage" style="display:none;" accept="image/*"
                                id="cardsDisplay">

                            <div class="upload-area" id="uploadAreacardsDisplay">
                                <h4 style="color:#4f42b5">Upload Here</h4>
                            </div>

                            <div id="preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:15px;">
                            </div>

                        </td>
                        <td>
                            <input type="number" name="Layer">
                        </td>

                        <td><button type="submit" class="btn1">Submit</button></td>

                    </tr>
                </form>
                <form action="?controller=admin&action=dashboard/addGiftWrappingItems/softToys" method="POST"
                    enctype="multipart/form-data">
                    <tr>
                        <td class="subtitle">Soft Toys</td>


                        <td>
                            <input type="text" name="Name">
                        </td>
                        <td>
                            <input type="number" name="Price">
                        </td>
                        <td>
                            <input type="file" name="previewImage" style="display:none;" accept="image/*"
                                id="softToysPreview">

                            <div class="upload-area" id="uploadAreasoftToysPreview">
                                <h4 style="color:#4f42b5">Upload Here</h4>
                            </div>

                            <div id="preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:15px;">
                            </div>

                        </td>
                        <td>
                            <input type="file" name="displayImage" style="display:none;" accept="image/*"
                                id="softToysDisplay">

                            <div class="upload-area" id="uploadAreasoftToysDisplay">
                                <h4 style="color:#4f42b5">Upload Here</h4>
                            </div>

                            <div id="preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:15px;">
                            </div>

                        </td>
                        <td>
                            <input type="number" name="Layer">
                        </td>

                        <td><button type="submit" class="btn1">Submit</button></td>

                    </tr>
                </form>

            </table>

            <script>
                document.getElementById('uploadAreaBoxWrapPreview').addEventListener('click', () => {
                    document.querySelector('input[id="boxWrapPreview"]').click();
                });
                document.getElementById('uploadAreaBoxWrapDisplay').addEventListener('click', () => {
                    document.querySelector('input[id="boxWrapDisplay"]').click();
                });

                document.getElementById('uploadAreaboxRibbonPreview').addEventListener('click', () => {
                    document.querySelector('input[id="boxRibbonPreview"]').click();
                });
                document.getElementById('uploadAreaboxRibbonDisplay').addEventListener('click', () => {
                    document.querySelector('input[id="boxRibbonDisplay"]').click();
                });

                document.getElementById('uploadAreapaperBagPreview').addEventListener('click', () => {
                    document.querySelector('input[id="paperBagPreview"]').click();
                });
                document.getElementById('uploadAreapaperBagDisplay').addEventListener('click', () => {
                    document.querySelector('input[id="paperBagDisplay"]').click();
                });

                document.getElementById('uploadAreapaperBagRibbonPreview').addEventListener('click', () => {
                    document.querySelector('input[id="paperBagRibbonPreview"]').click();
                });
                document.getElementById('uploadAreapaperBagRibbonDisplay').addEventListener('click', () => {
                    document.querySelector('input[id="paperBagRibbonDisplay"]').click();
                });

                document.getElementById('uploadAreachocolatesPreview').addEventListener('click', () => {
                    document.querySelector('input[id="chocolatesPreview"]').click();
                });
                document.getElementById('uploadAreachocolatesDisplay').addEventListener('click', () => {
                    document.querySelector('input[id="chocolatesDisplay"]').click();
                });

                document.getElementById('uploadAreacardsPreview').addEventListener('click', () => {
                    document.querySelector('input[id="cardsPreview"]').click();
                });
                document.getElementById('uploadAreacardsDisplay').addEventListener('click', () => {
                    document.querySelector('input[id="cardsDisplay"]').click();
                });

                document.getElementById('uploadAreasoftToysPreview').addEventListener('click', () => {
                    document.querySelector('input[id="softToysPreview"]').click();
                });
                document.getElementById('uploadAreasoftToysDisplay').addEventListener('click', () => {
                    document.querySelector('input[id="softToysDisplay"]').click();
                });

            </script>

</body>

</html>
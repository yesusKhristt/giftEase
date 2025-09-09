<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <style>
        .image-scroll {
            display: flex;
            overflow-x: hidden;
            overflow-y: hidden;
            /* horizontal scroll */

            scroll-behavior: smooth;
            /* prevents shrinking */
            width: 570px;
            /* width of each image box */
            height: 400px;
        }

        .image-item {
            flex: 0 0 auto;
            /* prevents shrinking */
            width: 560px;
            /* width of each image box */
            height: 390px;
            gap: 0px;
            /* space between images */
            padding: 0px 10px;
        }

        .image-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            /* maintain aspect ratio and fill box */
            border-radius: 8px;
        }
    </style>
    <link rel="stylesheet" href="public/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'inventory';
        include 'views\commonElements/leftSidebar.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">View Item</h1>
            </div>
            <div class="card">
                <div>
                    <div style="display:flex">
                        <button class = "btn1" id="scroll-left">◀</button>
                        <div class="image-scroll">
                            <?php
                            foreach ($productDetails['images'] as $image): ?>
                                <div class="image-item">
                                    <img src="resources/uploads/vendor/products/<?= htmlspecialchars($image['image_loc']) ?>"
                                        class="item-image">
                                </div>
                            <?php endforeach; ?>
                        </div>



                        <button id="scroll-right" class = "btn1">▶</button>



                        <div style="padding:10px;">
                            <h4><?= htmlspecialchars($productDetails['name']) ?></h4>
                            <p>
                                <?php
                                
                                require_once 'views/commonElements/rating.php';
                                $rating = 3.3;
                                echo render_stars($rating);
                                echo "<div class='rating-text'>$rating Rating</div>"
                                    ?>
                            <div class="title">Rs.<?= htmlspecialchars($productDetails['price']) ?></div>
                            <table class="table">
                                <tr>
                                    <td>Available Stock</td>
                                    <td>-not implemented-</td>
                                </tr>
                                <tr>
                                    <td>Quantity Sold</td>
                                    <td>80</td>
                                </tr>
                                <tr>
                                    <td>Impressions</td>
                                    <td>180</td>
                                </tr>
                                <tr>
                                    <td>Clicks</td>
                                    <td>7</td>
                                </tr>
                            </table>
                            </p>
                        </div>
                    </div>
                    <div class="card">
                        <p style="padding:30px">
                             <?= htmlspecialchars($productDetails['description']) ?>
                        </p>
                    </div>
                    <div class="card">
                        <h4>Review</h4>
                    </div>
                </div>

                <div class="actions">
                    <a class="btn1"
                        href="?controller=vendor&action=dashboard/item/edit/<?= htmlspecialchars($productDetails['id']) ?>">Edit
                        Item</a>
                    <a class="btn2">Delete Item</a>
                </div>

            </div>
        </div>
        <script>
            const container = document.querySelector('.image-scroll');
            document.getElementById('scroll-left').addEventListener('click', () => {
                container.scrollBy({ left: -570, behavior: 'smooth' });
            });
            document.getElementById('scroll-right').addEventListener('click', () => {
                container.scrollBy({ left: 570, behavior: 'smooth' });
            });
        </script>
</body>

</html>
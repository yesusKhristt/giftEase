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
                        <img src="https://i.ytimg.com/vi/FHok-UlAT-E/maxresdefault.jpg" alt="Item Image"
                            class="item-image big">

                        <div>
                            <h4>APEX SLAUGHTERSPINE FIGURINE (32 inch) Limited Edition</h4>
                            <p>
                                <?php
                                require_once 'views/commonElements/rating.php';
                                $rating = 3.3;
                                echo render_stars($rating);
                                echo "<div class='rating-text'>$rating Rating</div>"
                                    ?>
                            <div class="title">Rs. 9000.00</div>
                            <table class="table">
                                <tr>
                                    <td>Available Stock</td>
                                    <td>47</td>
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
                        <p style="padding:30px">The Slaughterspine is one of the most formidable machines in Horizon
                            Forbidden West, designed by
                            the
                            rogue AI HEPHAESTUS as a deadly combat unit. Towering and heavily armored, it combines
                            agility
                            with
                            devastating plasma-based attacks, making it a terrifying opponent even for skilled hunters.
                            Players
                            encounter multiple variants, including the standard Slaughterspine and the more powerful
                            Apex
                            version, each with unique health pools and combat capabilities. Its offensive arsenal
                            includes
                            plasma blasts, tail strikes, and atomic breath, requiring players to carefully strategize
                            and
                            exploit elemental weaknesses such as frost and Purgewater to gain an advantage.

                            Beyond its raw power, the Slaughterspine exemplifies the technological marvel and danger
                            inherent in
                            the post-apocalyptic world of Horizon. Key to defeating it is targeting weak points like the
                            plasma
                            core on its chest or dismantling its Plasma Spine Launcher, which can then be repurposed as
                            a
                            weapon. The encounter is both a test of combat skill and tactical thinking, highlighting the
                            game’s
                            emphasis on preparation, observation, and adaptability. As a creation of HEPHAESTUS, the
                            Slaughterspine not only serves as a physical threat but also as a narrative symbol of the
                            AI’s
                            dangerous innovations, blending story and gameplay into a thrilling challenge.

                            Ultimately, the Slaughterspine stands as a testament to the depth and creativity of Horizon
                            Forbidden West, combining mechanical design, combat complexity, and narrative significance.
                            Facing
                            it requires patience, strategy, and an understanding of the game’s elemental mechanics,
                            making
                            it a
                            memorable and iconic adversary in Aloy’s journey.
                        </p>
                    </div>
                    <div class="card">
                        <h4>Review</h4>
                    </div>
                </div>

                <div class="actions">
                    <a class="btn1" href="?controller=vendor&action=dashboard/item/edit">Edit Item</a>
                    <a class="btn2" >Delete Item</a>
                </div>

            </div>
        </div>
</body>

</html>
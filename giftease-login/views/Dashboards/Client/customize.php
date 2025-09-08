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
        $activePage = 'customize';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Customize Order</h1>
                <p class="subtitle">Personalize your products with custom options</p>

            </div>

           

            <!-- Cards -->
            <div style="gap: 20px; display: grid; grid-template-columns: repeat(3, 1fr);">

                <!-- Card 1 -->
                <div class="card" style="padding:0">
                    <div
                        style="text-align: center; font-size: 30px; margin-bottom: 10px;;height: 300px; display: flex; justify-content: center; align-items: center;">
                        <img src="https://img.icons8.com/color/48/chocolate.png">
                    </div>
                    <div class="card-body" style="padding-left: 40px;">
                        <h3>chocolate</h3>
                        <p style="color:green;font-size:15px;margin-bottom:10px">Starting at $24.99</p>
                        <p style="font-size:16px">Customization Options:</p>
                        <ul style="list-style-type: disc; padding-left: 20px;color:grey;">
                            <li>Custom text/logo</li>
                            <li>Multiple colors</li>
                            <li>Size selection</li>
                        </ul>
                    </div>
                    <div class="card-footer"
                        style="padding-left: 40px; padding-bottom: 20px;display: flex; gap: 10px;margin-top: 10px;">
                        <button class="btn1"><i class="fa fa-palette"></i> Customize</button>
                        <button class="btn1"><i class="fa fa-file"></i> Templates</button>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="card" style="padding:0">
                    <div
                        style="text-align: center; font-size: 30px; margin-bottom: 10px;height: 300px; display: flex; justify-content: center; align-items: center;">
                        
                    </div>
                    <div class="card-body" style="padding-left: 40px;">
                        <h3>chocolate</h3>
                        <p style="color:green;font-size:15px;margin-bottom:10px">Starting at $24.99</p>
                        <p style="font-size:16px">Customization Options:</p>
                        <ul style="list-style-type: disc; padding-left: 20px;color:grey;">
                            <li>Custom text/logo</li>
                            <li>Multiple colors</li>
                            <li>Size selection</li>
                        </ul>
                    </div>
                    <div class="card-footer"
                        style="padding-left: 40px; padding-bottom: 20px;display: flex; gap: 10px;margin-top: 10px;">
                        <button class="btn1"><i class="fa fa-palette"></i> Customize</button>
                        <button class="btn1"><i class="fa fa-file"></i> Templates</button>
                    </div>
                </div>


                <!-- Card 3 -->
                <div class="card" style="padding:0">
                    <div
                        style="text-align: center; font-size: 30px; margin-bottom: 10px;height: 300px; display: flex; justify-content: center; align-items: center;">
                        
                    </div>
                    <div class="card-body" style="padding-left: 40px;">
                        <h3>chocolate</h3>
                        <p style="color:green;font-size:15px;margin-bottom:10px">Starting at $24.99</p>
                        <p style="font-size:16px">Customization Options:</p>
                        <ul style="list-style-type: disc; padding-left: 20px;color:grey;">
                            <li>Custom text/logo</li>
                            <li>Multiple colors</li>
                            <li>Size selection</li>
                        </ul>
                    </div>
                    <div class="card-footer"
                        style="padding-left: 40px; padding-bottom: 20px;display: flex; gap: 10px;margin-top: 10px;">
                        <button class="btn1"><i class="fa fa-palette"></i> Customize</button>
                        <button class="btn1"><i class="fa fa-file"></i> Templates</button>
                    </div>
                </div>

        </div>
</body>

</html>
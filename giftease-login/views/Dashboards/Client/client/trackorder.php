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
        $activePage = 'tracking';
        include 'views/commonElements/leftSidebar.php';
        ?>
        
            <div class="main-content">
            <div class="page-header">
                <h1 class="title">Track Order</h1>
                <p class="subtitle">View delivery route and track your order in real-time.</p>
            </div>
            <div class="card">
                <div style="margin: 10px;">
                    <div style="display:flex; gap:10px; overflow:hidden;">
                        <!-- Item 1 -->
                        <img src="https://live.staticflickr.com/65535/40891976133_10a14b1ddf_h.jpg"
                            style="width:150px; height:120px; object-fit:cover; border-radius:10px;">
                        <!-- Item 2 -->
                        <img src="https://thevaultpublication.com/wp-content/uploads/2023/02/hzd-longleg.jpg?w=1024"
                            style="width:150px; height:120px; object-fit:cover; border-radius:10px;">
                        <!-- Item 3 -->
                        <img src="https://i.redd.it/what-machines-are-supposed-to-be-what-animal-v0-cz0ikfst04yb1.png?width=1200&format=png&auto=webp&s=657106090f33e5aa85ef33fe5520de3a79065df9"
                            style="width:150px; height:120px; object-fit:cover; border-radius:10px;">
                        <!-- Item 4 -->
                        <img src="https://qph.cf2.quoracdn.net/main-qimg-a2a868c97aa1d9822de78d42a47ab21a-lq"
                            style="width:150px; height:120px; object-fit:cover; border-radius:10px;">
                        <!-- Item 5 (Blurred to indicate more items) -->
                        <div style="position:relative;">
                            <img src="https://www.theloadout.com/wp-content/uploads/2022/02/horizon-forbidden-west-machines-19.jpg"
                                style="width:120px; height:120px; object-fit:cover; border-radius:10px; filter:blur(4px);">
                            <div style="position:absolute; top:0; left:0; width:100%; height:100%; 
                    display:flex; align-items:center; justify-content:center; 
                    font-size:20px; font-weight:bold; color:white; background:rgba(0,0,0,0.4); border-radius:10px;">
                                +3
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Tracking Status -->
                <div style="padding: 20px; background: #fafafa; border-radius: 10px; border: 1px solid #ddd;">
                    <h3 style="margin-top: 0; color: #555;">Order Status</h3>
                    <p style="margin: 10px 0; font-size: 15px; color: #333;">
                        <strong>Order ID:</strong> #12345 <br>
                        <strong>Status:</strong> Shipped <br>
                        <strong>Estimated Delivery:</strong> 24th August 2025
                    </p>
                </div>

                <iframe src="https://maps.google.com/maps?q=Colombo&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%"
                    height="400" frameborder="0" style="border:0; margin:10; padding:0;" allowfullscreen class="card">
                </iframe>

                <!-- Button -->
                <div style="text-align: center; margin-bottom: 30px;">
                    <button
                        style="background: #e91e63; color: white; padding: 12px 25px; border: none; border-radius: 25px; font-size: 16px; cursor: pointer;">
                        Track Order
                    </button>
                </div>
            </div>

            <div class="card">
                <div style="margin: 10px;">
                    <div style="display:flex; gap:10px; overflow:hidden;">
                        <!-- Item 1 -->
                        <img src="https://live.staticflickr.com/65535/40891976133_10a14b1ddf_h.jpg"
                            style="width:150px; height:120px; object-fit:cover; border-radius:10px;">
                        <!-- Item 2 -->
                        <img src="https://thevaultpublication.com/wp-content/uploads/2023/02/hzd-longleg.jpg?w=1024"
                            style="width:150px; height:120px; object-fit:cover; border-radius:10px;">
                        <!-- Item 3 -->
                        <img src="https://i.redd.it/what-machines-are-supposed-to-be-what-animal-v0-cz0ikfst04yb1.png?width=1200&format=png&auto=webp&s=657106090f33e5aa85ef33fe5520de3a79065df9"
                            style="width:150px; height:120px; object-fit:cover; border-radius:10px;">
                        <!-- Item 4 -->
                        <img src="https://qph.cf2.quoracdn.net/main-qimg-a2a868c97aa1d9822de78d42a47ab21a-lq"
                            style="width:150px; height:120px; object-fit:cover; border-radius:10px;">
                        <!-- Item 5 (Blurred to indicate more items) -->
                        <div style="position:relative;">
                            <img src="https://www.theloadout.com/wp-content/uploads/2022/02/horizon-forbidden-west-machines-19.jpg"
                                style="width:120px; height:120px; object-fit:cover; border-radius:10px; filter:blur(4px);">
                            <div style="position:absolute; top:0; left:0; width:100%; height:100%; 
                    display:flex; align-items:center; justify-content:center; 
                    font-size:20px; font-weight:bold; color:white; background:rgba(0,0,0,0.4); border-radius:10px;">
                                +3
                            </div>
                        </div>
                    </div>

                </div>
                <!-- Tracking Status -->
                <div style="padding: 20px; background: #fafafa; border-radius: 10px; border: 1px solid #ddd;">
                    <h3 style="margin-top: 0; color: #555;">Order Status</h3>
                    <p style="margin: 10px 0; font-size: 15px; color: #333;">
                        <strong>Order ID:</strong> #12345 <br>
                        <strong>Status:</strong> Delivered <br>
                        <strong>Estimated Delivery:</strong> 24th August 2025
                    </p>
                </div>

                <!-- Button -->
                <div style="text-align: center; margin-bottom: 30px;">
                    <button
                        style="background: #e91e63; color: white; padding: 12px 25px; border: none; border-radius: 25px; font-size: 16px; cursor: pointer;">
                        Track Order
                    </button>
                </div>
            </div>
        </div>
    
        </div>
</body>

</html>
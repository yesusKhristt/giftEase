<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/Dilma/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

    <div class="container">
        <?php
        $activePage = 'account';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Account</h1>
                <p class="subtitle">Manage your Personal Information</p>
            </div>

            <div class="cardColour">

                <div class="profile-section">
                    <a href="?controller=client&action=dashboard/updateProfilePicture">
                        <img src="<?php echo htmlspecialchars($user2['image_loc']) ?>" class="profile-picture" alt="+">
                    </a>
                    <div>
                        <h3><?php echo htmlspecialchars($user2['first_name']) . ' ' . htmlspecialchars($user2['last_name']); ?>
                        </h3>
                        <p>Member since <?php echo htmlspecialchars($joinData['join_month_year']); ?></p>
                    </div>
                </div>


            </div>

            <div class="card">
                <h4>Personal Information</h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label class="subtitle">Full Name</label>
                        <div type="text" class="form-input">
                            <?php echo htmlspecialchars($user2['first_name']); ?>
                            <?php echo htmlspecialchars($user2['last_name']); ?>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="subtitle">Email</label>
                        <div type="email" class="form-input">
                            <?php echo htmlspecialchars($user1['email']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="subtitle">Phone</label>
                        <div type="tel" class="form-input">
                            <?php echo htmlspecialchars($user2['phone']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="subtitle">Emergency Contact</label>
                        <div type="tel" class="form-input">
                            12918989261819
                        </div>
                    </div>
                </div>
                <div style="display: flex; gap: 15px;">
                    <a href="?controller=client&action=editProfile/primary" class="btn1">
                        Update Profile
                    </a>
                    <a href="?controller=client&action=deleteProfile" class="btn1">
                        Delete Profile
                    </a>
                </div>
            </div>
        </div>
</body>

</html>
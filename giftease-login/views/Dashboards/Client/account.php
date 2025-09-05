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
                    <i class="profile-picture"></i>
                    <div class="">
                        <h4>Thenuka Ranasinghe</h4>
                        <p>client • Member since Jan 2025</p>


                    </div>
                </div>


            </div>

            <div class="card">
                <h4>Personal Information</h4>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                    <div class="form-group">
                        <label class="subtitle">Full Name</label>
                        <input type="text" class="form-input" value="Saneth Tharushika" readonly />
                    </div>
                    <div class="form-group">
                        <label class="subtitle">Email</label>
                        <input type="email" class="form-input" value="sanethsiriwardhana@gmail.com" readonly />
                    </div>
                    <div class="form-group">
                        <label class="subtitle">Phone</label>
                        <input type="tel" class="form-input" value="+94 761694206" />
                    </div>
                    <div class="form-group">
                        <label class="subtitle">Emergency Contact</label>
                        <input type="tel" class="form-input" value="+94 761694206" />
                    </div>
                </div>
            </div>





            <div style="display: flex; gap: 15px;">
                <button class="btn1" onclick="updateProfile()">Update Profile</button>
                <button class="btn1" onclick="changePassword()">Change Password</button>
            </div>
        </div>


</body>

</html>
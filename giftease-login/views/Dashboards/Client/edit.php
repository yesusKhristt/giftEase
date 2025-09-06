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
                <h1 class="title">Edit Profile</h1>
                <p class="subtitle">Manage your personal information</p>
            </div>
            <div class="card">
                <form method="post">
                    <table class="table">
                        <tr>
                            <td class="subtitle">Profile Picture</td>
                            <td colspan="2">
                                <div style="display: flex; align-items: center; gap: 20px;">
                                    <img id="profilePreview" src="" alt="Profile Preview"
                                        style="width: 80px; height: 80px; object-fit: cover; border-radius: 50%; border: 1px solid #ccc; display: none;" />
                                    <input type="file" id="profilePicInput" name="profile_picture" accept="image/*"
                                        onchange="previewProfilePic(event)" />
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%" class="subtitle">
                                First Name
                            </td>
                            <td colspan="2">
                                <input type="text" id="first_name" name="first_name" placeholder="First Name">
                            </td>


                        </tr>
                        <tr>
                            <td class="subtitle">
                                Last Name
                            </td>
                            <td colspan="2">
                                <input type="text" id="last_name" name="last_name" placeholder="Last Name">
                            </td>
                        </tr>
                        <tr>
                            <td class="subtitle">Email</td>
                            <td colspan="2">
                                <input type="email" id="email" name="email" placeholder="Email">
                            </td>
                        </tr>
                        <tr>
                            <td class="subtitle">Mobile Phone number</td>
                            <td colspan="2">
                                <input type="tel" id="phone" name="phone" placeholder="Mobile Phone number">
                            </td>
                        </tr>
                        <tr>
                            <td class="subtitle">Current Password</td>
                            <td colspan="2">
                                <input type="password" id="current_password" name="current_password" placeholder="Current Password">
                            </td>
                        </tr>

                        <tr>
                            <td class="subtitle">New Password</td>
                            <td colspan="2">
                                <input type="password" id="new_password" name="new_password" placeholder="New Password">
                            </td>
                        </tr>

                    </table>



                    <div style="margin-top: 20px;">
                        <table>
                            <tr>
                                <td>
                                    <button class="btn1" type="submit" name="save">Save Changes</button>
                                    </td>
                                    <td>
                                    <button class="btn1" type="reset">Reset</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>

        <!-- <script>
function previewProfilePic(event) {
    const input = event.target;
    const preview = document.getElementById('profilePreview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.style.display = 'block';
        }
        reader.readAsDataURL(input.files[0]);
    } else {
        preview.src = '';
        preview.style.display = 'none';
    }
}
</script> -->
</body>

</html>
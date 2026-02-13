<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client Partner Dashboard - GiftEase</title>
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
                            <td style="width:15%" class="subtitle">
                                First Name
                            </td>
                            <td colspan="2">
                                <input type="text" id="first_name" name="first_name" placeholder="First Name"
                                    value="<?php echo htmlspecialchars($_SESSION['user']['first_name']); ?>">
                            </td>


                        </tr>
                        <tr>
                            <td class="subtitle">
                                Last Name
                            </td>
                            <td colspan="2">
                                <input type="text" id="last_name" name="last_name" placeholder="Last Name"
                                    value="<?php echo htmlspecialchars($_SESSION['user']['last_name']); ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="subtitle">Mobile Phone number</td>
                            <td colspan="2">
                                <input type="tel" id="phone" name="phone" placeholder="Mobile Phone number"
                                    value="<?php echo htmlspecialchars($_SESSION['user']['phone']); ?>">
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
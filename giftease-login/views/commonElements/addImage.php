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
    <form method="POST" action="?controller=client&action=dashboard/updateProfilePicture" id="uploadForm"
        enctype="multipart/form-data">
        <table class="table">
            <tr>
                <td class="subtitle">Upload Profile Picture</td>
                <td colspan="2">
                    <input type="file" name="profilePic" style="display:none;" accept="image/*">

                    <div class="upload-area" id="uploadArea">
                        <i class="fas fa-cloud-upload-alt" style="font-size:3rem; color:#3498db;"></i>
                        <h4>Drop files here or click to upload</h4>
                        <p>Supported formats: JPG, PNG (Max 10MB)</p>
                    </div>

                    <div id="preview" style="display:flex; gap:10px; flex-wrap:wrap; margin-top:15px;"></div>

                </td>
            </tr>

            <tr>
                <td><button type="submit" class="btn1">Submit</button></td>
                <td><button type="reset" class="btn2">Reset</button></td>
            </tr>
        </table>
    </form>
    <script>
        document.getElementById('uploadArea').addEventListener('click', () => {
            document.querySelector('input[name="profilePic"]').click();
        });
    </script>

</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Client Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/client.css" />
    <link rel="stylesheet" href="public/sideTopBar.css" />
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
                <h1 class="title">Update Profile Picture</h1>
                <p class="subtitle">Upload a new image for your client profile</p>
            </div>

            <div class="card">
                <form method="POST" action="?controller=client&action=dashboard/updateProfilePicture" id="uploadForm"
                    enctype="multipart/form-data">
                    <table class="table">
                        <tr>
                            <td class="subtitle" style="width: 35%;">Upload Profile Picture</td>
                            <td colspan="2">
                                <input type="file" id="profilePicInput" name="profilePic" style="display:none;" accept="image/*">

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
                            <td><button type="reset" class="btn1">Reset</button></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>

    <script>
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('profilePicInput');
        const preview = document.getElementById('preview');

        function showPreview(file) {
            if (!file || !file.type.startsWith('image/')) return;
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = '<img src="' + e.target.result + '" alt="Preview" style="width:120px;height:120px;object-fit:cover;border-radius:12px;border:1px solid #ddd;">';
            };
            reader.readAsDataURL(file);
        }

        uploadArea.addEventListener('click', function() {
            fileInput.click();
        });

        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            showPreview(file);
        });

        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', function() {
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            uploadArea.classList.remove('dragover');

            if (e.dataTransfer.files.length > 0) {
                fileInput.files = e.dataTransfer.files;
                showPreview(e.dataTransfer.files[0]);
            }
        });
    </script>
</body>

</html>

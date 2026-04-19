<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/backup/style.css" />
    <link rel="stylesheet" href="public/sideTopBar.css" />
    <link rel="icon" type="image/png" href="resources/1.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    
        <?php
        $activePage = 'profile';
        include 'views/commonElements/leftSidebarChathu.php';
        ?>

        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Update Profile Picture</h1>
                <p class="subtitle">Upload a new image for your admin profile</p>
            </div>

            <div class="card">
                <form method="POST" action="?controller=admin&action=dashboard/updateProfilePicture" id="uploadForm" enctype="multipart/form-data">
                    <table class="table">
                        <tr>
                            <td class="subtitle">Upload Profile Picture</td>
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
                            <td>
                                <button type="submit" class="btn1">Submit</button>
                            </td>
                            <td>
                                <button type="reset" class="btn2">Reset</button>
                            </td>
                            <td>
                                <a href="?controller=admin&action=dashboard/profile" class="btn2">Cancel</a>
                            </td>
                        </tr>
                    </table>
                </form>
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
                showPreview(fileInput.files[0]);
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
                const droppedFile = e.dataTransfer.files[0];
                if (!droppedFile) return;
                const dt = new DataTransfer();
                dt.items.add(droppedFile);
                fileInput.files = dt.files;
                showPreview(droppedFile);
            });

            document.getElementById('uploadForm').addEventListener('reset', function() {
                preview.innerHTML = '';
                uploadArea.classList.remove('dragover');
            });
        </script>
    
</body>

</html>

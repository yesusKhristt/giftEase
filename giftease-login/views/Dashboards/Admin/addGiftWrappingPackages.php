<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add Gift Wrapping Package - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'giftWrapping';
        include 'views/commonElements/leftSidebarChathu.php';
        ?>
        <div class="main-content">

            <div class="page-header">
                <h1 class="title">Add Gift Wrapping Package</h1>
                <p class="subtitle">Create a new gift wrapping package for customers</p>
            </div>
            <form method="POST" action="?controller=admin&action=dashboard/addGiftWrappingPackages" id="uploadForm"
                enctype="multipart/form-data">
                <table class="table">
                    <tr>
                        <td style="width:15%" class="subtitle">Package Title</td>
                        <td colspan="2">
                            <input type="text" id="title" name="title" placeholder="Enter package title" required>
                        </td>
                    </tr>

                    <tr>
                        <td class="subtitle">Price</td>
                        <td colspan="2">
                            <input type="number" id="price" name="price" placeholder="Price" min="1" required>
                        </td>
                    </tr>

                    <tr>
                        <td class="subtitle">Description</td>
                        <td colspan="2">
                            <textarea name="description" rows="10" cols="50"
                                placeholder="Enter package description" required></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td class="subtitle">Upload Images</td>
                        <td colspan="2">
                            <input type="file" id="fileInput" name="images[]" multiple style="display:none;"
                                accept="image/*">

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
        </div>
    </div>

    <script>
        let selectedFiles = [];

        // Open file dialog on click
        document.getElementById("uploadArea").addEventListener("click", () => {
            document.getElementById("fileInput").click();
        });

        // Handle file selection
        document.getElementById("fileInput").addEventListener("change", e => {
            selectedFiles = selectedFiles.concat(Array.from(e.target.files));
            updatePreview();
            e.target.value = "";
        });

        // Drag-and-drop functionality
        const uploadArea = document.getElementById("uploadArea");
        uploadArea.addEventListener("dragover", e => {
            e.preventDefault();
            uploadArea.style.border = "2px dashed #3498db";
        });
        uploadArea.addEventListener("dragleave", e => {
            e.preventDefault();
            uploadArea.style.border = "";
        });
        uploadArea.addEventListener("drop", e => {
            e.preventDefault();
            const files = Array.from(e.dataTransfer.files);
            selectedFiles = selectedFiles.concat(files);
            updatePreview();
        });

        // Update preview with drag-and-drop sorting
        function updatePreview() {
            const preview = document.getElementById("preview");
            preview.innerHTML = "";

            selectedFiles.forEach((file, index) => {
                const imgWrapper = document.createElement("div");
                imgWrapper.draggable = true;
                imgWrapper.style.position = "relative";

                const img = document.createElement("img");
                img.src = URL.createObjectURL(file);
                img.style.width = "100px";
                img.style.height = "100px";
                img.style.objectFit = "cover";
                imgWrapper.appendChild(img);

                if (index === 0) {
                    img.style.border = "3px solid #e91e63";
                    img.style.borderRadius = "10px";
                    const label = document.createElement("div");
                    label.className = "subtitle";
                    label.innerText = "Display Image";
                    imgWrapper.appendChild(label);
                } else {
                    img.style.border = "none";
                    img.style.borderRadius = "10px";
                }

                // Delete button
                const del = document.createElement("button");
                del.innerText = "×";
                del.style.position = "absolute";
                del.style.top = "0";
                del.style.right = "0";
                del.style.background = "red";
                del.style.color = "white";
                del.style.border = "none";
                del.style.cursor = "pointer";
                del.addEventListener("click", () => {
                    selectedFiles.splice(index, 1);
                    updatePreview();
                });
                imgWrapper.appendChild(del);

                // Drag events for reordering
                imgWrapper.addEventListener("dragstart", e => {
                    e.dataTransfer.setData("text/plain", index);
                });
                imgWrapper.addEventListener("dragover", e => e.preventDefault());
                imgWrapper.addEventListener("drop", e => {
                    e.preventDefault();
                    const fromIndex = e.dataTransfer.getData("text/plain");
                    const toIndex = index;
                    const movedItem = selectedFiles.splice(fromIndex, 1)[0];
                    selectedFiles.splice(toIndex, 0, movedItem);
                    updatePreview();
                });

                preview.appendChild(imgWrapper);
            });
        }

        // On submit, update hidden input to include reordered files
        document.getElementById("uploadForm").addEventListener("submit", e => {
            const fileInput = document.getElementById("fileInput");
            fileInput.files = new DataTransfer().files;
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            fileInput.files = dt.files;
        });
    </script>
</body>

</html>

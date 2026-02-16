<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/style.css" />
    <link rel="icon" type="image/png" href="resources/1.png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .radio-inline {
            display: inline-flex;
            align-items: center;
            margin-right: 15px;
            gap: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        $activePage = 'inventory';
        include 'views\commonElements/leftSidebar.php';
        ?>
        <div class="main-content">

            <div class="page-header">
                <h1 class="title">Add Item</h1>
                <p class="subtitle">Create your online store for clients to see</p>
            </div>
            <form method="POST" action="?controller=vendor&action=dashboard/item/<?php echo $parts[2] ?><?php if ($parts[2] == 'edit') {
                   echo "/$parts[3]";
               } ?>" id="uploadForm" enctype="multipart/form-data">
                <table class="table">
                    <tr>
                        <td style="width:15%" class="subtitle">Product Title</td>
                        <td colspan="2">
                            <input type="text" id="title" name="title" placeholder="Title"
                                value="<?php echo $parts[2] == 'edit' ? htmlspecialchars($productDetails['name']) : ''; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td class="subtitle">Product Category</td>
                        <td>
                            <div style="padding: 10px">
                                <select id="category" name="category" style="width:80%">
                                    <?php foreach ($categories as $row): ?>
                                        <option value="<?= htmlspecialchars($row['id']) ?>">
                                            <?= htmlspecialchars($row['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div style="padding: 10px">
                                <select id="subcategory" name="subcategory" style="width:80%">
                                    <option value="">-- Select a subcategory --</option>
                                </select>
                            </div>

                        </td>
                    </tr>

                    <tr>
                        <td class="subtitle">Price</td>
                        <td colspan="2">
                            <input type="number" id="price" name="price" placeholder="Price" min="1"
                                value="<?php echo $parts[2] == 'edit' ? htmlspecialchars($productDetails['price']) : ''; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td class="subtitle">Description</td>
                        <td colspan="2">
                            <textarea name="description" rows="10" cols="50"
                                placeholder="Enter Product Description"><?php echo $parts[2] == 'edit' ? htmlspecialchars($productDetails['description']) : ''; ?></textarea>
                        </td>
                    </tr>

                    <!-- <tr>
                <td class="subtitle">Upload Images</td>
                <td colspan="2">
                    <div class="upload-area" id="uploadArea" onclick="document.getElementById('fileInput').click()">
                        <i class="fas fa-cloud-upload-alt"
                            style="font-size: 3rem; color: #3498db; margin-bottom: 10px;"></i>
                        <h4>Drop files here or click to upload</h4>
                        <p>Supported formats: JPG, PNG (Max 10MB)</p>
                        <input type="file" id="fileInput" name="images[]" multiple style="display:none;"
                            accept="image/*">
                    </div>

                    <div id="preview" style="margin-top:15px; display:flex; gap:10px; flex-wrap:wrap;"></div>

                    <button type="button" onclick="document.getElementById('fileInput').click()"
                        style="margin-top:10px; padding:6px 12px; background:#3498db; color:white; border:none; border-radius:5px; cursor:pointer;">
                        + Add More
                    </button>
                </td>
            </tr> -->
                    <tr>
                        <td class="subtitle">Can be prepared in 24 hours</td>
                        <td colspan="2">
                            <label class="radio-inline">
                                <input type="radio" name="hours24" value="1"> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="hours24" value="0"> No
                            </label>
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
            e.target.value = ""; // allow re-selecting same files
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
                    label.innerText = "Public Display";

                    // Add the label below the image
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

                // Drag events
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

            // Reset input
            fileInput.files = new DataTransfer().files;

            // Add selectedFiles in order to DataTransfer
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            fileInput.files = dt.files;

            // Now the form will POST with reordered files
        });
        document.addEventListener('DOMContentLoaded', function () {
            const categorySelect = document.getElementById('category');
            const subcategorySelect = document.getElementById('subcategory');

            const savedCategoryId = "<?= htmlspecialchars($productDetails['category'] ?? '') ?>";
            const savedSubcategoryId = "<?= htmlspecialchars($productDetails['subcategory'] ?? '') ?>";
            const defaultCategoryId = <?= json_encode($categories[0]['id'] ?? null) ?>;

            function loadSubcategories(categoryId, selectedSubcategoryId = null) {
                if (!categoryId) return;

                subcategorySelect.innerHTML = '<option value="">Loading...</option>';

                fetch('?controller=vendor&action=dashboard/getCategory', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'category_id=' + encodeURIComponent(categoryId)
                })
                    .then(response => response.json())
                    .then(data => {
                        subcategorySelect.innerHTML = '';
                        if (data.length > 0) {
                            data.forEach(subcat => {
                                const opt = document.createElement('option');
                                opt.value = subcat.id;
                                opt.textContent = subcat.name;
                                if (subcat.id == selectedSubcategoryId) opt.selected = true;
                                subcategorySelect.appendChild(opt);
                            });
                        } else {
                            subcategorySelect.innerHTML = '<option value="">No subcategories found</option>';
                        }
                    })
                    .catch(err => {
                        console.error('Error fetching subcategories:', err);
                        subcategorySelect.innerHTML = '<option value="">Error loading subcategories</option>';
                    });
            }

            categorySelect.addEventListener('change', function () {
                loadSubcategories(this.value);
            });

            // Initialize on page load
            if (savedCategoryId) {
                categorySelect.value = savedCategoryId;
                loadSubcategories(savedCategoryId, savedSubcategoryId);
            } else if (defaultCategoryId) {
                categorySelect.value = defaultCategoryId;
                loadSubcategories(defaultCategoryId);
            }
        });



    </script>
</body>

</html>
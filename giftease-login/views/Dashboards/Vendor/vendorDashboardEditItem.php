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
        $activePage = 'inventory';
        include 'views/commonElements/leftSidebar.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">
                    <?php
                    if ($parts[2] == 'add') {
                        echo 'Add ';
                    } else if ($parts[2] == 'edit') {
                        echo 'Edit ';
                    }
                    ?>
                    Item
                </h1>
            </div>
            <div class="card">
                <form>
                    <table class="table">
                        <tr>
                            <td style="width:15%" class="subtitle">
                                Product Title
                            </td>
                            <td colspan="2">
                                <input type="text" id="title" name="title" placeholder="Title">
                            </td>
                        </tr>
                        <tr>
                            <td class="subtitle">Product Category</td>
                            <td><select id="fruit" name="category" style="width:80%">
                                    <option value="Electronics">Electronics</option>
                                    <option value="Fashion">Fashion</option>
                                    <option value="Home">Home</option>
                                    <option value="Beauty">Beauty</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Toys">Toys</option>
                                    <option value="Books">Books</option>
                                    <option value="Groceries">Groceries</option>
                                </select></td>
                            <td><select id="fruit" name="subcategory" style="width:80%">
                                    <option value="apple">Apple</option>
                                    <option value="banana">Banana</option>
                                    <option value="orange">Orange</option>
                                    <option value="mango">Mango</option>
                                </select></td>
                        </tr>
                        <tr>
                            <td class="subtitle">Price</td>
                            <td colspan="2">
                                <input type="number" id="price" name="price" placeholder="Price" min="1">
                            </td>
                        </tr>
                        <tr>
                            <td class="subtitle">Description</td>
                            <td colspan="2">
                                <textarea name="description" rows="6" cols="50"
                                    placeholder="Enter Product Description"></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="subtitle">Upload Images</td>
                            <td colspan="2">
                                <div class="upload-area" id="uploadArea"
                                    onclick="document.getElementById('fileInput').click()">
                                    <i class="fas fa-cloud-upload-alt"
                                        style="font-size: 3rem; color: #3498db; margin-bottom: 15px;"></i>
                                    <h4>Drop files here or click to upload</h4>
                                    <p>Supported formats: JPG, PNG, PDF (Max 10MB)</p>
                                    <input type="file" name="profile_pic" id="fileInput" multiple accept="image/*,.pdf"
                                        style="display: none;" onchange="handleFileUpload(event)" />
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
</body>

</html>
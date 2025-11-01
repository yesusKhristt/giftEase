<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Vendor Orders</title>
    <link rel="stylesheet" href="public/style.css">
    <link rel="icon" href="resources/icon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<body>
    <div class="container">
        <?php
        $activePage = 'inventory';
        include 'views\commonElements/leftSidebar.php';
        ?>
        <div class="main-content">

            <div class="page-header">
                <h1 class="title">Manage Inventory</h1>
                <p class="subtitle">Manage and track your current orders</p>
            </div>
            <div class="card">
                <h4>Manage Inventory</h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 80px;">ID</th>
                            <th>Product Name</th>
                            <th>Total Stock</th>
                            <th>Reserved Stock</th>
                            <th>Available Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['name']) ?></td>
                                <td>
                                    <div class="qty-control" style="display:flex;gap:6px;align-items:center;">
                                        <button class="btn1 btn-small openPopupSubTotal" data-id="<?= $row['id'] ?>"
                                            style="width: 40px;">-</button>
                                        <span><?= htmlspecialchars($row['totalStock']) ?></span>
                                        <button class="btn1 btn-small openPopupAddTotal" href="#" data-id="<?= $row['id'] ?>"
                                            style="width: 40px;">+</button>
                                    </div>
                                </td>
                                <td>
                                    <div class="qty-control" style="display:flex;gap:6px;align-items:center;">
                                        <button class="btn1 btn-small openPopupSubReserve" data-id="<?= $row['id'] ?>"
                                            style="width: 40px;">-</button>
                                        <span><?= htmlspecialchars($row['reservedStock']) ?></span>
                                        <button class="btn1 btn-small openPopupAddReserve" href="#" data-id="<?= $row['id'] ?>"
                                            style="width: 40px;">+</button>
                                    </div>
                                </td>
                                <td>
                                    <?= htmlspecialchars($row['totalStock']) - $row['reservedStock'] ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <!-- ADD POPUP -->
                <div id="popupOverlayAddTotal" class="overlay">
                    <div class="popup">
                        <h2>Select Quantity</h2>
                        <form action="?controller=vendor&action=dashboard/manageInventory/Total&state=add" method="post">
                            <input type="hidden" name="productId" id="productIdAddTotal">
                            <input type="number" name="quantity" required>
                            <input type="submit" value="Confirm" class="btn1">
                        </form>
                    </div>
                </div>

                <!-- REDUCE POPUP -->
                <div id="popupOverlaySubTotal" class="overlay">
                    <div class="popup">
                        <h2>Select Quantity</h2>
                        <form action="?controller=vendor&action=dashboard/manageInventory/Total&state=sub" method="post">
                            <input type="hidden" name="productId" id="productIdSubTotal">
                            <input type="number" name="quantity" required>
                            <input type="submit" value="Confirm" class="btn1">
                        </form>
                    </div>
                </div>

                <!-- ADD POPUP -->
                <div id="popupOverlayAddReserve" class="overlay">
                    <div class="popup">
                        <h2>Select Quantity</h2>
                        <form action="?controller=vendor&action=dashboard/manageInventory/Reserved&state=add" method="post">
                            <input type="hidden" name="productId" id="productIdAddReserve">
                            <input type="number" name="quantity" required>
                            <input type="submit" value="Confirm" class="btn1">
                        </form>
                    </div>
                </div>

                <!-- REDUCE POPUP -->
                <div id="popupOverlaySubReserve" class="overlay">
                    <div class="popup">
                        <h2>Select Quantity</h2>
                        <form action="?controller=vendor&action=dashboard/manageInventory/Reserved&state=sub" method="post">
                            <input type="hidden" name="productId" id="productIdSubReserve">
                            <input type="number" name="quantity" required>
                            <input type="submit" value="Confirm" class="btn1">
                        </form>
                    </div>
                </div>


            </div>
        </div>
        <script>
            const overlayAddTotal = document.getElementById('popupOverlayAddTotal');
            const overlaySubTotal = document.getElementById('popupOverlaySubTotal');
            const openAddButtonsTotal = document.querySelectorAll('.openPopupAddTotal');
            const openSubButtonsTotal = document.querySelectorAll('.openPopupSubTotal');
            const productIdAddTotal = document.getElementById('productIdAddTotal');
            const productIdSubTotal = document.getElementById('productIdSubTotal');
            const productIdAddReserve = document.getElementById('productIdAddReserve');
            const productIdSubReserve = document.getElementById('productIdSubReserve');


            // Add stock buttons
            openAddButtonsTotal.forEach(btn => {
                btn.addEventListener('click', e => {
                    e.preventDefault();
                    const productId = btn.dataset.id;
                    productIdAddTotal.value = productId; 
                    overlayAddTotal.classList.add('show');
                });
            });

            // Reduce stock buttons
            openSubButtonsTotal.forEach(btn => {
                btn.addEventListener('click', e => {
                    e.preventDefault();
                    const productId = btn.dataset.id;
                    productIdSubTotal.value = productId;  
                    overlaySubTotal.classList.add('show');
                });
            });

            // Click outside popup to close
            overlayAddTotal.addEventListener('click', e => {
                if (e.target === overlayAdd) overlayAddTotal.classList.remove('show');
            });
            overlaySubTotal.addEventListener('click', e => {
                if (e.target === overlaySub) overlaySubTotal.classList.remove('show');
            });

            const overlayAddReserve = document.getElementById('popupOverlayAddReserve');
            const overlaySubReserve = document.getElementById('popupOverlaySubReserve');
            const openAddButtonsReserve = document.querySelectorAll('.openPopupAddReserve');
            const openSubButtonsReserve = document.querySelectorAll('.openPopupSubReserve');

                        // Add Reserve buttons
            openAddButtonsReserve.forEach(btn => {
                btn.addEventListener('click', e => {
                    e.preventDefault();
                    const productId = btn.dataset.id;
                    productIdAddReserve.value = productId; 
                    overlayAddReserve.classList.add('show');
                });
            });

            // Reduce Reserve buttons
            openSubButtonsReserve.forEach(btn => {
                btn.addEventListener('click', e => {
                    e.preventDefault();
                    const productId = btn.dataset.id;
                    productIdSubReserve.value = productId;  // 👈 inject product ID into hidden input
                    overlaySubReserve.classList.add('show');
                });
            });

            // Click outside popup to close
            overlayAddReserve.addEventListener('click', e => {
                if (e.target === overlayAddReserve) overlayAddReserve.classList.remove('show');
            });
            overlaySubReserve.addEventListener('click', e => {
                if (e.target === overlaySubReserve) overlaySubReserve.classList.remove('show');
            });

        </script>
</body>

</html>
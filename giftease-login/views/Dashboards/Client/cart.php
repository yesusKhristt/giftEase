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
    $activePage = 'cart';
    include 'views/commonElements/leftSidebarDilma.php';


    ?>
    <div class="main-content">
      <div class="page-header">
        <h1 class="title">Cart</h1>
        <p class="subtitle">Manage your gift items in the cart</p>

      </div>

      <div class="cart-layout" style="display:grid;grid-template-columns:2fr 1fr;gap:20px;">

        <!-- Cart Items -->

        <table class="table">
          <thead>
            <tr>
              <th>Product</th>
              <th>Quantity</th>
              <th>Price</th>
              <th>Subtotal</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $subtotal = 0; // track total
            foreach ($cartItems as $row):
              $subtotal += $row['quantity'] * $row['price'];
              ?>
              <tr>
                <td>
                  <div class="product-cell">
                    <img src="resources/uploads/vendor/products/<?= htmlspecialchars($row['displayImage']) ?>"
                      alt="<?= htmlspecialchars($row['name']) ?>" class="product-thumbnail">
                    <div>
                      <div class="product-name"><?= htmlspecialchars($row['name']) ?></div>
                      <div class="product-category">-not implemented-</div>
                    </div>
                  </div>
                </td>
                <td>
                  <div class="qty-control" style="display:flex;gap:6px;align-items:center;">
                    <form action="?controller=client&action=dashboard/cart/<?= $row['id'] ?>/dec" method="post"
                      style="display:inline;">
                      <button type="submit" class="btn1 btn-small">−</button>
                    </form>
                    <span><?= htmlspecialchars($row['quantity']) ?></span>
                    <form action="?controller=client&action=dashboard/cart/<?= $row['id'] ?>/inc" method="post"
                      style="display:inline;">
                      <button type="submit" class="btn1 btn-small">+</button>
                    </form>
                  </div>
                </td>
                <td>Rs. <?= htmlspecialchars($row['price']) ?></td>
                <td>Rs. <?= htmlspecialchars($row['quantity'] * $row['price']) ?></td>
                <td>
                  <form action="?controller=client&action=dashboard/cart/<?= $row['id'] ?>/remove" method="post">
                    <button type="submit" class="btn1 btn-small">Remove</button>
                  </form>

                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>


        <!-- Order Summary -->
        <div class="cardColour">
          <h4>Order Summary</h4>
          <p class="summary-line">Subtotal: <strong>Rs. <?= htmlspecialchars($subtotal) ?></strong></p>
          <p class="summary-line">Shipping Fee: <strong>-not implemented-</strong></p>
          <p class="summary-line">Total: <strong>Rs. <?= htmlspecialchars($subtotal) ?></strong></p>

          <div style="margin:15px 0;">
            <input type="text" placeholder="Enter Voucher Code" style="width:70%;margin-bottom:10px;">
            <button class="btn1">Apply</button>
          </div>

          <a href="?controller=client&action=dashboard/wrap" class="btn2">Choose Wrapping</a>
        </div>
      </div>
    </div>
  </div>


</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Delivery Partner Dashboard - GiftEase</title>
    <link rel="stylesheet" href="public/Dilma/style.css" />
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
    <div class="card">
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
          <tr>
            <td>
              <div class="product-cell">
                <img src="images/gift1.jpg" alt="Gift 1" class="product-thumbnail">
                <div>
                  <div class="product-name">Rose Teddy</div>
                  <div class="product-category">Toys</div>
                </div>
              </div>
            </td>
            <td>
              <div class="qty-control" style="display:flex;gap:6px;align-items:center;">
                <button class="btn1 btn-small">-</button>
                <span>2</span>
                <button class="btn1 btn-small">+</button>
              </div>
            </td>
            <td>Rs. 1,250</td>
            <td>Rs. 2,500</td>
            <td><button class="view-btn">Remove</button></td>
          </tr>
          <tr>
            <td>
              <div class="product-cell">
                <img src="images/gift2.jpg" alt="Gift 2" class="product-thumbnail">
                <div>
                  <div class="product-name">Chocolate Box</div>
                  <div class="product-category">Sweets</div>
                </div>
              </div>
            </td>
            <td>
              <div class="qty-control" style="display:flex;gap:6px;align-items:center;">
                <button class="btn1 btn-small">-</button>
                <span>1</span>
                <button class="btn1 btn-small">+</button>
              </div>
            </td>
            <td>Rs. 890</td>
            <td>Rs. 890</td>
            <td><button class="view-btn">Remove</button></td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Order Summary -->
    <div class="cardColour">
      <h4>Order Summary</h4>
      <p class="summary-line">Subtotal: <strong>Rs. 3,390</strong></p>
      <p class="summary-line">Shipping Fee: <strong>Rs. 350</strong></p>
      <p class="summary-line">Total: <strong>Rs. 3,740</strong></p>

      <div style="margin:15px 0;">
        <input type="text" placeholder="Enter Voucher Code" style="width:70%;margin-bottom:10px;">
        <button class="btn1">Apply</button>
      </div>

      <a href="?controller=client&action=dashboard/Checkout" class="btn2">Proceed to Checkout</a>
    </div>

  </div>
           


    </div>
</body>

</html>
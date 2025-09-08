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
        $activePage = 'cart';
        include 'views/commonElements/leftSidebar.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Cart</h1>
                <p class="subtitle">Manage your gift items in the cart</p>

            </div>

            <div class="card">
                <div style="display:flex">
                    <div style="width: 70%">
                        <div style="display:flex" class="card">
                            <img src="https://i.ytimg.com/vi/FHok-UlAT-E/maxresdefault.jpg" alt="Item Image"
                                class="item-image" style="height: 250px; width: 250px; margin-right:50px">

                            <div>
                                <table>
                                    <tr>
                                        <td>Chocolate</td>

                                    </tr>
                                    <tr>
                                        <td>Quantity</td>
                                        <td><span>2</span>
                                            <button class="btn3" onclick="updateQuantity(this, -1)"> - </button>
                                            <button class="btn3" onclick="updateQuantity(this, 1)"> + </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td>$180</td>
                                    </tr>

                                </table>

                            </div>
                        </div>


                        <div style="display:flex" class="card">
                            <img src="https://i.ytimg.com/vi/FHok-UlAT-E/maxresdefault.jpg" alt="Item Image"
                                class="item-image" style="height: 250px; width: 250px; margin-right:50px">

                            <div>
                                <table>
                                    <tr>
                                        <td>Chocolate</td>

                                    </tr>
                                    <tr>
                                        <td>Quantity</td>
                                        <td><span>2</span>
                                            <button class="btn3" onclick="updateQuantity(this, -1)"> - </button>
                                            <button class="btn3" onclick="updateQuantity(this, 1)"> + </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td>$180</td>
                                    </tr>

                                </table>

                            </div>
                        </div>


                        <div style="display:flex" class="card">
                            <img src="https://i.ytimg.com/vi/FHok-UlAT-E/maxresdefault.jpg" alt="Item Image"
                                class="item-image" style="height: 250px; width: 250px; margin-right:50px">

                            <div>
                                <table>
                                    <tr>
                                        <td>Available Stock</td>
                                        <td>47</td>
                                    </tr>
                                    <tr>
                                        <td>Quantity</td>
                                        <td><span>2</span>
                                            <button class="btn3" onclick="updateQuantity(this, -1)"> - </button>
                                            <button class="btn3" onclick="updateQuantity(this, 1)"> + </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Price</td>
                                        <td>$180</td>
                                    </tr>

                                </table>

                            </div>
                        </div>
                    </div>



                    <div class="card">
                        <table>
                            <div>
                                <tr>
                                    <td><span>Subtotal:</span></td>
                                    <td><span>$379.97</span></td>
                                </tr>
                                <tr>
                                    <td><span>Tax:</span></td>
                                    <td><span>$30.40</span></td>
                                </tr>
                                <tr>
                                    <td><span>Total:</span></td>
                                    <td><span>$410.37</span></td>
                                </tr>
                            </div>
                        </table>


                        <div class="action-buttons" style="margin-top: 1rem;">
                            <button class="btn1" onclick="clearCart()">🗑️ Clear Cart</button>
                            <button class="btn1" style="flex: 1;" onclick="openCheckout()">🛒 Proceed to
                                Checkout</button>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
    </div>
</body>

</html>
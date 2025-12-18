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
        $activePage = 'history';
        include 'views/commonElements/leftSidebarDilma.php';
        ?>
        <div class="main-content">
            <div class="page-header">
                <h1 class="title">Order History</h1>
                <p class="subtitle">View your past orders</p>

            </div>

           <div class="filter-tabs">
        <div class="btn1">
          <label>Date Range:</label>
          <div class="date-range-picker">
            <input type="date" id="dateFrom" class="form-input" />
            <span>to</span>
            <input type="date" id="dateTo" class="form-input" />
          </div>
        </div>
        <div class="btn1">
          <label>Status:</label>
          <select id="statusFilter" class="form-select">
            <option value="all">All Status</option>
            <option value="delivered">Delivered</option>
            <option value="cancelled">Cancelled</option>
            <option value="returned">Returned</option>
          </select>
        </div>
       <div class="btn1">
        <lable>Customer;</lable>
        <input type="text" id="customerSearch" class="form-input" placeholder="Search customer..."/>
       </div>

        <button class="btn1" onclick="exportHistory()">
          <i class="fas fa-download"></i> Export
        </button>
        <button class="btn1" onclick="resetFilters()">
          <i class="fas fa-undo"></i> Reset
        </button>

      </div>

      <table class="table">
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Product</th>
            <th>Delivery Date</th>
            <th>Status</th>
            <th>Rating</th>
            
          </tr>
        </thead>
        <tbody id="historyTableBody">
          <tr>
            <td>DEL-098</td>
            
            <td>
              <div class="product-cell">
                <img src="/placeholder.svg?height=40&width=40" alt="Product" class="product-thumbnail" />
                <div>
                  <div class="product-name">Flower Bouquet</div>
                  <div class="product-category">Flowers</div>
                </div>
              </div>
            </td>
            <td>
              <div class="date-cell">
                <div class="delivery-date">Jan 15, 2024</div>
                
              </div>
            </td>
            <td><span class="order-status status-delivered">Delivered</span></td>
            
            <td>
              <div class="rating-cell">
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <div class="rating-score">5.0</div>
              </div>
            </td>
            
            
          </tr>
          <tr>
            <td>DEL-097</td>
            
            <td>
              <div class="product-cell">
                <img src="/placeholder.svg?height=40&width=40" alt="Product" class="product-thumbnail" />
                <div>
                  <div class="product-name">Gift Basket</div>
                  <div class="product-category">Gifts</div>
                </div>
              </div>
            </td>
            <td>
              <div class="date-cell">
                <div class="delivery-date">Jan 14, 2024</div>
                
              </div>
            </td>
            <td><span class="order-status status-delivered">Delivered</span></td>
           
            <td>
              <div class="rating-cell">
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <div class="rating-score">5.0</div>
              </div>
            </td>
            
           
          </tr>
          <tr>
            <td>DEL-096</td>
           
            <td>
              <div class="product-cell">
                <img src="/placeholder.svg?height=40&width=40" alt="Product" class="product-thumbnail" />
                <div>
                  <div class="product-name">Chocolate Box</div>
                  
                </div>
              </div>
            </td>
            <td>
              <div class="date-cell">
                <div class="delivery-date">Jan 13, 2024</div>
                
              </div>
            </td>
            <td><span class="order-status status-delivered">Delivered</span></td>
            
            <td>
              <div class="rating-cell">
                <div class="stars">⭐⭐⭐⭐</div>
                <div class="rating-score">4.0</div>
              </div>
            </td>
           
           
          </tr>
        </tbody>
      </table>

    </div>

        </div>
</body>

</html>
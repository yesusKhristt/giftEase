<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Vendor Analysis</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  <div class="container">
    <?php
    $activePage = 'items';
    include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarChathu.php';
    ?>
    <div class="main-content">
      <section id="items" class="page active" aria-labelledby="items-title">
        <div class="page-header">
          <div>
            <h3 id="items-title">Items</h3>
            <p class="muted">Inventory overview</p>
          </div>
          <button class="btn primary" disabled title="Demo">＋ Add Item</button>
        </div>

        <div class="table">
          <div class="table-controls">
            <div class="left-controls">
              <select id="itemsSort" class="select" aria-label="Sort items">
                <option value="date">Sort by Date</option>
                <option value="name">Sort by Name</option>
                <option value="sku">Sort by SKU</option>
              </select>
            </div>
            <div class="right-controls">
              <button class="btn outline btn-sm" disabled title="Demo">⬇️ Export</button>
              <button class="btn outline btn-sm" disabled title="Demo">🖨️ Print</button>
            </div>
          </div>
          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>SKU</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Stock</th>
                  <th>Updated</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>#ITM-001</td>
                  <td>Wrapping Paper</td>
                  <td>Supplies</td>
                  <td>320</td>
                  <td>2025-01-12</td>
                </tr>
                <tr>
                  <td>#ITM-002</td>
                  <td>Gift Box</td>
                  <td>Supplies</td>
                  <td>180</td>
                  <td>2025-01-10</td>
                </tr>
                <tr>
                  <td>#ITM-003</td>
                  <td>Ribbon</td>
                  <td>Supplies</td>
                  <td>540</td>
                  <td>2025-01-16</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>

</html>
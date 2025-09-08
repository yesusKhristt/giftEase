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
    $activePage = 'vendor';
    include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarChathu.php';
    ?>
    <div class="main-content">
      <section id="vendors" class="page active">
        <div class="page-header">
          <div>
            <h3>Vendors</h3>
            <p class="muted">Manage all your vendors and their items</p>
          </div>
          <button id="addVendorBtn" class="btn primary">＋ Add Vendor</button>
        </div>

        <div class="table">
          <div class="table-controls">
            <div class="left-controls">
              <select id="sortBy" class="select">
                <option value="date">Sort by Date</option>
                <option value="name">Sort by Name</option>
                <option value="id">Sort by Vendor ID</option>
                <option value="item">Sort by Item ID</option>
              </select>
              <button id="resetFilters" class="btn outline btn-sm">🔄 Reset</button>
            </div>
            <div class="right-controls">
              <button id="exportBtn" class="btn outline btn-sm">⬇️ Export</button>
              <button id="printBtn" class="btn outline btn-sm">🖨️ Print</button>
            </div>
          </div>

          <div class="table-wrap">
            <table class="vendor-table">
              <thead>
                <tr>
                  <th><input type="checkbox" /></th>
                  <th>vendor id</th>
                  <th>name</th>
                  <th>phone number</th>
                  <th>profile pic</th>
                  <th>item id</th>
                  <th>date</th>
                  <th>actions</th>
                </tr>
              </thead>
              <tbody id="vendorsTableBody">
                <!-- Filled dynamically -->
              </tbody>
            </table>
          </div>

          <div class="pagination">
            <div class="info">Showing <span id="showingStart">0</span> to <span id="showingEnd">0</span> of <span
                id="totalRecords">0</span></div>
            <div class="controls">
              <button id="prevPage" class="page-btn" disabled>◀️</button>
              <div id="paginationNumbers" class="numbers"></div>
              <button id="nextPage" class="page-btn">▶️</button>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="icon" href="resources/icon.png">
</head>
<body>
  <div class="sidebar">
    <h2>Wrapping Outlet Dashboard</h2>
    <ul>
      <li>Dashboard</li>
      <li>Received Orders</li>
      <li>Assigned Orders</li>
      <li>Wrapping History</li>
    </ul>
  </div>
  <div class="main">
    <div class="top-summary">
      <div class="summary-card blue">5 Orders Received</div>
      <div class="summary-card">2 Orders Wrapped</div>
      <div class="summary-card">3 Orders Pending Pickup</div>
      <div class="summary-card">1 Urgent Order</div>
    </div>

    <div class="orders">
      <h3>Assigned Orders</h3>
      <table>
        <thead>
          <tr>
            <th>Order ID</th>
            <th>Product</th>
            <th>Wrapper</th>
            <th>Due Time</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>#1008 <br/> Amina Silva</td>
            <td>Teddy Bear<br/>\"Amina payal Happy Birthday!\"</td>
            <td><img src=\"https://via.placeholder.com/40\" alt=\"Wrapper\" /><br/>Floral Pattern</td>
            <td>Today<br/>2:00 PM</td>
            <td class="actions">
              <button class="mark">Mark as Wrapped</button>
              <button class="proof">Upload Wrapping Proof</button>
            </td>
          </tr>
          <tr>
            <td>#1006 <br/> John Lee</td>
            <td>Wristwatch<br/>Cong/Glula...</td>
            <td>Blue paper<br/>Red</td>
            <td>Tomorrow<br/>10:00 AM</td>
            <td class="actions">
              <button class="mark">Mark as Wrapped</button>
              <button class="proof">Upload Wrapping Proof</button>
            </td>
          </tr>
          <tr>
            <td>#1004 <br/> David Perera</td>
            <td>Gift Basket<br/>Do sapadge</td>
            <td>Krap riobon<br/>Suipe</td>
            <td>Tomorrow<br/>10:00 AM</td>
            <td class="actions">
              <button class="repack">Request Repackaging</button>
            </td>
          </tr>
          <tr>
            <td>#1003 <br/> Mia Chen</td>
            <td>Photo Album<br/>Wrap carefully, item delicate</td>
            <td>Striped paper<br/>stripped</td>
            <td>Tomorrow<br/>10:00 AM</td>
            <td class="actions">
              <button class="mark">Mark as Wrapped</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="footer-buttons">
      <button>🖨️ Print Instructions</button>
      <button>🖨️ Print Label</button>
    </div>
  </div>
</body>
</html>


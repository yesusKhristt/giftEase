<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Welcome</title>
  <link rel="stylesheet" href="public/style.css">
</head>

<body>

  <!-- Sidebar -->
  <div class="sideBar">

    <h2 class="Heading blueT"><span class="orangeT">gift</span><b>Ease</b></h2>
    <ul>
      <li class="active">Orders</li>
      <li onclick="location.href='?action=dashboard&type=vendor&level=inventory'">Inventory</a>
      <li onclick="location.href='?action=dashboard&type=vendor&level=messeges'">Messages</a>
      <li onclick="location.href='?action=dashboard&type=vendor&level=analysis'">Analysis</a>
    </ul>
  </div>

  <!-- Main Content -->
  <div class="main">
    <div class="HeadingB blueT">Orders Dashboard</div>

    <div class="card">
      <h4 class="subHeadingB">Current Orders</h4>
      <table>
        <tr>
          <th>View</th>
          <th>Client</th>
          <th>Cost</th>
          <th>Order Received</th>
          <th>Order Due</th>
        </tr>
        <tr>
          <td><button class="view-btn">View</button></td>
          <td>Thenuka Ranasinghe</td>
          <td>$25.00</td>
          <td>2025-08-05</td>
          <td>2025-08-10</td>
        </tr>
        <tr>
          <td><button class="view-btn">View</button></td>
          <td>Umaya Perera</td>
          <td>$40.00</td>
          <td>2025-08-04</td>
          <td>2025-08-09</td>
        </tr>
      </table>
    </div>
  </div>

</body>

</html>
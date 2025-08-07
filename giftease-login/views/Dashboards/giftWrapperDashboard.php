<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Gift Wrapper</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="icon" href="resources/icon.png">
</head>
<body>
  <div class="login-container">
    <h1>✅ Welcome, <?= htmlspecialchars($user['name']) ?>!</h1>
    <p>You have successfully logged in to GiftEase as a Client.</p>
    <h1>Wrapping Dashboard..</h1>
    <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Wrapping Outlet Dashboard</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
  <div class="sidebar">
    <h2>Wrapping Outlet</h2>
    <ul>
      <li class="nav-item active" data-section="home">🏠 Home</li>
      <li class="nav-item" data-section="received-orders">📦 Received Orders</li>
      <li class="nav-item" data-section="assigned-orders">📦 Assigned Orders</li>
      <li class="nav-item" data-section="wrapping-history">📄 Wrapping History</li>
      <li class="nav-item" data-section="notifications">🔔 Notifications</li>
      <li class="nav-item" data-section="settings">⚙️ Settings</li>
    </ul>
  </div>

  <div class="main">
    <div id="home" class="section active">
      <h3>🏠 Home Overview</h3>
      <div class="summary">
        <div class="summary-card blue">5 Orders Received</div>
        <div class="summary-card green">2 Orders Wrapped</div>
        <div class="summary-card yellow">3 Orders Pending Pickup</div>
        <div class="summary-card red">1 Urgent Order</div>
      </div>
    </div>

    <div id="received-orders" class="section">
      <h3>📦 Received Orders</h3>
      <ul class="order-list">
        <li>Order #1010 - Flower Bouquet</li>
        <li>Order #1011 - Chocolate Box</li>
        <li>Order #1012 - Gift Hamper</li>
      </ul>
    </div>

    <div id="assigned-orders" class="section">
      <h3>📦 Assigned Orders</h3>
      <div class="card">
        <p><strong>Order #1008</strong> - Teddy Bear</p>
        <p>Wrapper: Floral Paper</p>
        <p>Due: Today, 2:00 PM</p>
        <button class="btn mark">Mark as Wrapped</button>
        <button class="btn upload">Upload Proof</button>
      </div>
      <div class="card">
        <p><strong>Order #1009</strong> - Book Set</p>
        <p>Wrapper: Blue Wrap</p>
        <p>Due: Today, 5:00 PM</p>
        <button class="btn mark">Mark as Wrapped</button>
      </div>
    </div>

    <div id="wrapping-history" class="section">
      <h3>📄 Wrapping History</h3>
      <ul>
        <li>Order #1001 - Delivered</li>
        <li>Order #1002 - Delivered</li>
      </ul>
    </div>

    <div id="notifications" class="section">
      <h3>🔔 Notifications</h3>
      <ul>
        <li>🔔 New urgent order assigned</li>
        <li>🔔 Reminder: Wrap Order #1010</li>
      </ul>
    </div>

    <div id="settings" class="section">
      <h3>⚙️ Settings</h3>
      <label>Name:</label>
      <input type="text" value="Wrapper User" />
      <label>Password:</label>
      <input type="password" />
      <button class="btn save">Save</button>
    </div>
  </div>

  <script>
    const navItems = document.querySelectorAll('.nav-item');
    const sections = document.querySelectorAll('.section');

    navItems.forEach(item => {
      item.addEventListener('click', () => {
        document.querySelector('.nav-item.active').classList.remove('active');
        item.classList.add('active');

        sections.forEach(section => section.classList.remove('active'));
        document.getElementById(item.dataset.section).classList.add('active');
      });
    });
  </script>
</body>
</html>

  </div>
</body>
</html>

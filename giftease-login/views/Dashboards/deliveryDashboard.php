<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Delivery Staff Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="public/style.css">
</head>
<body>
  <div class="login-container">
    <h1>✅ Welcome, <?= htmlspecialchars($user['name']) ?>!</h1>
    <p>You have successfully logged in to GiftEase as a Delivery.</p>
    <div class="sidebar">
    <h2>Delivery Dashboard</h2>
    <ul>
      <li class="nav-item" data-section="home">🏠 Home</li>
      <li class="nav-item active" data-section="assigned">📦 Assigned Orders</li>
      <li class="nav-item" data-section="route">🗺️ Route Map</li>
      <li class="nav-item" data-section="proof">📤 Upload Proof</li>
      <li class="nav-item" data-section="history">📋 History</li>
      <li class="nav-item" data-section="notifications">🔔 Notifications</li>
      <li class="nav-item" data-section="settings">⚙️ Settings</li>
    </ul>
  </div>

 <div class="main">
    <div id="home" class="section">
      <h3>Welcome to Delivery Dashboard</h3>
      <p>This is your central hub to manage your daily delivery tasks, track your route, upload delivery proofs, and stay updated with notifications. Use the sidebar to navigate through the system.</p>
      <div class="card">
        <h4>Quick Summary</h4>
        <ul>
          <li>📦 Orders Assigned: 3</li>
          <li>✅ Delivered Today: 1</li>
          <li>⚠️ Pending Deliveries: 2</li>
        </ul>
      </div>
    </div>

    <div id="assigned" class="section active">
      <h3>Assigned Orders</h3>
      <div class="card">
        <h4>Order #12345</h4>
        <p>Customer: John Doe</p>
        <p>Address: 123 Main St</p>
        <div class="status-btns">
          <button class="picked">Picked</button>
          <button class="out">Out for Delivery</button>
          <button class="delivered">Delivered</button>
        </div>
      </div>

      <div class="card">
        <h4>Order #67890</h4>
        <p>Customer: Jane Smith</p>
        <p>Address: 456 Elm St</p>
        <div class="status-btns">
          <button class="picked">Picked</button>
          <button class="out">Out for Delivery</button>
          <button class="delivered">Delivered</button>
        </div>
      </div>
    </div>

    <div id="route" class="section">
      <h3>Route Map</h3>
      <iframe src="https://maps.google.com/maps?q=Colombo&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen></iframe>
    </div>

    <div id="proof" class="section">
      <h3>Upload Delivery Proof</h3>
      <input type="file" /> <button class="save-btn">Upload</button>
    </div>

    <div id="history" class="section">
      <h3>Delivery History</h3>
      <div class="card">
        <h4>Order #11223</h4>
        <p>Delivered to: Kevin Silva</p>
        <p>Status: Delivered on 2025-08-01</p>
      </div>
    </div>

    <div id="notifications" class="section">
      <h3>Notifications</h3>
      <ul>
        <li>🔔 New Order Assigned: #12345</li>
        <li>⚠️ Delivery Delay Expected due to Weather</li>
      </ul>
    </div>

    <div id="settings" class="section">
      <h3>Settings</h3>
      <label>Name:</label>
      <input type="text" value="John Doe" />
      <label>Change Password:</label>
      <input type="password" />
      <button class="save-btn">Save</button>
    </div>
  </div>

  <script>
    const navItems = document.querySelectorAll('.nav-item');
    const sections = document.querySelectorAll('.section');

    navItems.forEach(item => {
      item.addEventListener('click', () => {
        document.querySelector('.nav-item.active')?.classList.remove('active');
        item.classList.add('active');

        sections.forEach(section => section.classList.remove('active'));
        document.getElementById(item.dataset.section).classList.add('active');
      });
    });
  </script>
  
</body>
</html>
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
    $activePage = 'settings';
    include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarChathu.php';
    ?>
    <div class="main-content">
      <section id="settings" class="page active" aria-labelledby="settings-title">
        <div class="page-header">
          <div>
            <h3 id="settings-title">Settings</h3>
            <p class="muted">Customize your dashboard</p>
          </div>
        </div>

        <div class="settings-grid">
          <div class="setting-card">
            <h4>Appearance</h4>
            <div class="theme-toggle" role="group" aria-label="Theme toggle">
              <button class="theme-btn active" data-theme="light">☀️ Light</button>
              <button class="theme-btn" data-theme="dark">🌙 Dark</button>
            </div>
          </div>

          <div class="setting-card">
            <h4>Notifications</h4>
            <div class="row">
              <label for="emailNotifications">Email Notifications</label>
              <label class="switch">
                <input type="checkbox" id="emailNotifications" checked />
                <span class="slider"></span>
              </label>
            </div>
            <div class="row">
              <label for="pushNotifications">Push Notifications</label>
              <label class="switch">
                <input type="checkbox" id="pushNotifications" checked />
                <span class="slider"></span>
              </label>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <!-- Theme toggle script -->
  <script>
    const themeButtons = document.querySelectorAll(".theme-btn");

    themeButtons.forEach(button => {
      button.addEventListener("click", () => {
        // Remove active class from all buttons
        themeButtons.forEach(btn => btn.classList.remove("active"));

        // Add active class to clicked button
        button.classList.add("active");

        // Toggle dark class on body
        const theme = button.getAttribute("data-theme");
        if (theme === "dark") {
          document.body.classList.add("dark");
        } else {
          document.body.classList.remove("dark");
        }
      });
    });
  </script>
</body>

</html>
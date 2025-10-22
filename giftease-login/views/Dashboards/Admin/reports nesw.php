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
    $activePage = 'reports';
    include 'C:\xampp\htdocs\giftEase\giftease-login\views\commonElements/leftSidebarChathu.php';
    ?>
    <div class="main-content">
  <div class="page-header">
                <h1 class="title">Account</h1>
                <p class="subtitle">Manage your Personal Information</p>
            </div>

      <!-- <section id="reports" class="page active" aria-labelledby="reports-title">
        <div class="page-header">
          <div>
            <h3 id="reports-title">Reports</h3>
            <p class="muted">Generate and download reports (demo)</p>
          </div>
        </div> -->
        <div class="cards">
          <button class="card press button-card">👔 Vendor Report</button>
          <button class="card press button-card">📦 Items Report</button>
          <button class="card press button-card">📅 Daily Summary</button>
          <button class="card press button-card">💲 Cost Analysis</button>
        </div>
      </section>
    </div>
  </div>
</body>

</html>
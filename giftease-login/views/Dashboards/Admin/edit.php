<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <link rel="icon" type="image/png" href="resources/1.png">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Dashboard - GiftEase</title>
  <link rel="stylesheet" href="public/backup/style.css">
  <link rel="stylesheet" href="public/sideTopBar.css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
  <?php
  $activePage = 'profile';
  include 'views/commonElements/leftSidebarChathu.php';
  $adminProfile = $adminProfile ?? [];
  ?>

  <div class="main-content">
    <div class="page-header">
      <h1 class="title">Edit Profile</h1>
      <p class="subtitle">Update your administrator account information</p>
    </div>

    <div class="card">
      <form method="post">
        <table class="table">
          <tr>
            <td style="width:15%" class="subtitle">First Name</td>
            <td colspan="2">
              <input type="text" id="first_name" name="first_name" placeholder="First Name" value="<?php echo htmlspecialchars($adminProfile['first_name'] ?? ''); ?>">
            </td>
          </tr>
          <tr>
            <td class="subtitle">Last Name</td>
            <td colspan="2">
              <input type="text" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo htmlspecialchars($adminProfile['last_name'] ?? ''); ?>">
            </td>
          </tr>
          <tr>
            <td class="subtitle">Email</td>
            <td colspan="2">
              <input type="email" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($adminProfile['email'] ?? ''); ?>" readonly>
            </td>
          </tr>
          <tr>
            <td class="subtitle">Phone</td>
            <td colspan="2">
              <input type="tel" id="phone" name="phone" placeholder="Phone" value="<?php echo htmlspecialchars($adminProfile['phone'] ?? ''); ?>">
            </td>
          </tr>
          <tr>
            <td class="subtitle">Designation</td>
            <td colspan="2">
              <input type="text" id="designation" name="designation" placeholder="Designation" value="<?php echo htmlspecialchars($adminProfile['designation'] ?? ''); ?>">
            </td>
          </tr>
          <tr>
            <td class="subtitle">Address</td>
            <td colspan="2">
              <input type="text" id="address" name="address" placeholder="Address" value="<?php echo htmlspecialchars($adminProfile['address'] ?? ''); ?>">
            </td>
          </tr>
        </table>

        <div style="margin-top: 20px; display: flex; gap: 10px;">
          <button class="btn1" type="submit" name="save">Save Changes</button>
          <button class="btn1" type="reset">Reset</button>
          <a class="btn2" href="?controller=admin&action=dashboard/profile">Cancel</a>
        </div>
      </form>
    </div>
  </div>
</body>

</html>

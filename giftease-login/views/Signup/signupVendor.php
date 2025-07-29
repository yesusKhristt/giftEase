<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>GiftEase Login</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="icon" href="resources/icon.png">
</head>

<body class="orange">
  <div class="container center">
    <div class="login-container">
      <p class="subHeading blueT">Vendor</p>
      <img src="resources/logoWP.png" height="100px" width="100px">
      <p class="Heading blueT"><span class="orangeT">gift</span><b>Ease</b><br>Sign In</p>
      <form method="POST" action="?type=vendor" class="center">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="passwordC" placeholder="Confirm Password" required>
        <button type="submit">Sign In</button>
        <a href="?type=staff" class="btn">Staff Sign In</a>
        <a href="?type=client" class="btn">Client Sign In</a>
      </form>
      <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>
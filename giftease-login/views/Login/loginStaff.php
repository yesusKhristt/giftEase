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
      <p class="subHeading blueT">Staff</p>
      <img src="resources/logoWP.png" height="100px" width="100px">
      <p class="Heading blueT"><span class="orangeT">gift</span><b>Ease</b> Login</p>
      <form method="POST" action="?type=staff" class="center">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <a href="?type=client" class="btn">Client Login</a>
        <a href="?type=vendor" class="btn">Vendor Login</a>
      </form>
      <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>
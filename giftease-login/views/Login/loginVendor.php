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
      <p class="Heading blueT"><span class="orangeT">gift</span><b>Ease</b> Login</p>
      <!--
      <form method="POST" action="?type=vendor&action=login" class="center">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <a href="?type=staff" class="btn">Staff Login</a>
        <a href="?type=client" class="btn">Client Login</a>
        <a href="?action=signup" class="btn">No acccount?sign up</a>

      </form>
-->
      <form method="POST" action="?type=vendor&action=login" class="center">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required
          class="<?= !empty($error) ? 'shake error' : '' ?>" id="passwordInput">
        <button type="submit">Login</button>
        <a href="?type=client" class="btn">Client Login</a>
        <a href="?type=staff" class="btn">Staff Login</a>
        <a href="?type=delivery" class="btn">Delivery Login</a>
        <a href="?action=signup&type=vendor" class="btn">No account? Sign up</a>
      </form>
      <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
        <script>
          const passwordInput = document.getElementById('passwordInput');
          passwordInput.classList.add('shake');

          // Remove the shake class after animation so it can be retriggered on next error
          setTimeout(() => {
            confirmPassword.classList.remove('shake');
          }, 300);
        </script>
      <?php endif; ?>
      <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>
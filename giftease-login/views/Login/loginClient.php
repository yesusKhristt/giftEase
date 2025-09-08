<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>GiftEase Login</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="icon" href="resources/icon.png">
</head>

<body
  style="display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background: #f6f6f6;">
  <div class="authContainer">
    <div class="logo">
      <img src="resources/ge5.png" class="logo_img">
      <div class="gift">
        gift<span class="Ease">Ease
        </span>
        <p>Login</p>
      </div>
    </div>
    <div>
      <form method="POST" action="?type=client&action=handleLogin" id="loginForm">
        <input type="email" name="email" placeholder="Email" class="textbox" required>
        <input type="password" name="password" placeholder="Password" class="textbox" required
          class="<?= !empty($error) ? 'shake error' : '' ?>" id="passwordInput">
        <button type="submit" class="btn2">Login</button>
        <a href="?action=handleSignup&type=client" class="btn1">No account? Sign up</a>
      </form>
    </div>
    <?php if (!empty($error)): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <script>
      const passwordInput = document.getElementById('passwordInput');
      const form = document.getElementById('loginForm');

      // Shake animation if error exists
      <?php if (!empty($error)): ?>
        passwordInput.classList.add('shake');
        setTimeout(() => {
          passwordInput.classList.remove('shake');
        }, 300);
      <?php endif; ?>

      // On clicking "Sign up", change action and submit form
    </script>
  </div>
</body>

</html>
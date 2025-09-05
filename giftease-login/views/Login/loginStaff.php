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
      <img src="resources/icon.png" class="logo_img">
      <div class="gift">
        gift<span class="Ease">Ease
        </span>
        <p>Staff Login</p>
      </div>
    </div>
    <div>
      <form method="POST" action="?type=admin&action=login" id="loginForm">
        <select name="role" id="roleSelect">
          <option value="vendor">Vendor</option>
          <option value="admin">Admin</option>
          <option value="delivery">Delivery</option>
          <option value="deliveryman">Delivery Man</option>
          <option value="giftWrapper">Gift Wrapper</option>
        </select>
        <input type="email" name="email" placeholder="Email" class="textbox" required>
        <input type="password" name="password" placeholder="Password" class="textbox" required
          class="<?= !empty($error) ? 'shake error' : '' ?>" id="passwordInput">
        <button type="submit" class="btn2">Login</button>
        <a href="?action=handleSignup&type=admin" id="signupLink" class="btn1">No account? Sign Up</a>
      </form>
    </div>
    <?php if (!empty($error)): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <script>
      const passwordInput = document.getElementById('passwordInput');
      const roleSelect = document.getElementById('roleSelect');
      const form = document.getElementById('loginForm');
      const signupLink = document.getElementById('signupLink');

      // Shake animation if error exists
      <?php if (!empty($error)): ?>
        passwordInput.classList.add('shake');
        setTimeout(() => {
          passwordInput.classList.remove('shake');
        }, 300);
      <?php endif; ?>

      // On login submit, update action to match selected role
      form.addEventListener('submit', function (e) {
        const selectedRole = roleSelect.value;
        form.action = `?type=${selectedRole}&action=handleLogin`;
      });

      // On clicking "Sign up", change action and submit form
      signupLink.addEventListener('click', function (e) {
        e.preventDefault();
        const selectedRole = roleSelect.value;
        form.action = `?type=${selectedRole}&action=handleSignup`;
        form.submit();
      });
    </script>
  </div>
</body>

</html>
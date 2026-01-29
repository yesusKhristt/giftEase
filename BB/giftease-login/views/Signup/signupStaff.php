<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>GiftEase Sign In</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="icon" href="resources/icon.png">
</head>

<body
  style="display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background: #f6f6f6;">
  <div class="authContainer">
    <div class="logo">
      <img src="resources/iconL.png" class="logo_img">
      <div class="gift">
        gift<span class="Ease">Ease</span>
        <p>Staff Sign Up</p>
      </div>
    </div>
    <div>
      <form method="POST" action="" id="signupForm">
        <select name="role" id="roleSelect">
          <option value="vendor">Vendor</option>
          <option value="admin">Admin</option>
          <option value="delivery">Delivery</option>
          <option value="deliveryman">Delivery Man</option>
          <option value="giftWrapper">Gift Wrapper</option>
        </select>
        <input type="text" name="name" placeholder="Name" class="textbox" required>
        <input type="email" name="email" placeholder="Email" class="textbox" required>
        <input type="password" name="password" id="password" placeholder="Password" class="textbox" required>
        <input type="password" name="passwordC" id="confirmPassword" placeholder="Confirm Password" class="textbox"
          required>
        <button type="submit" class="btn2">Sign Up</button>
        <a href="?action=handleLogin&type=admin" class="btn1" id="loginLink">Already have an account? Sign in</a>
      </form>
    </div>
    <script>
      const form = document.getElementById('signupForm');
      const password = document.getElementById('password');
      const confirmPassword = document.getElementById('confirmPassword');
      const roleSelect = document.getElementById('roleSelect');
      const loginLink = document.getElementById('loginLink');

      // Password validation
      form.addEventListener('submit', function (e) {
        if (password.value !== confirmPassword.value) {
          e.preventDefault();
          confirmPassword.classList.add('shake', 'error');
          setTimeout(() => {
            confirmPassword.classList.remove('shake');
          }, 300);
          return;
        }

        const selectedRole = roleSelect.value;
        form.action = `?type=${selectedRole}&action=handleSignup`;
      });

      // On clicking "Sign In" link
      loginLink.addEventListener('click', function (e) {
        e.preventDefault();
        const selectedRole = roleSelect.value;
        window.location.href = `?type=${selectedRole}&action=handleLogin`;
      });

      // Set default selected value
      window.addEventListener('DOMContentLoaded', () => {
        roleSelect.value = "vendor";
      });
    </script>

    <?php if (!empty($error)): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
</body>

</html>
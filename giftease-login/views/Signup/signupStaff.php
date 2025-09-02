<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>GiftEase Sign In</title>
  <link rel="stylesheet" href="public/style.css">
  <link rel="icon" href="resources/icon.png">
</head>

<body <div class="bg-blur">
  <img src="resources/background.jpg" class="background-image">
  <div class="authContainer">
    <div class="logo">
      <img src="resources/icon.png" class="logo_img">
      <div class="gift">
        gift<span class="Ease">Ease
        </span>
        <p>Staff Sign Up</p>
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
        <input type="text" name="name" placeholder="Name" class="textbox" required>
        <input type="email" name="email" placeholder="Email" class="textbox" required>
        <input type="password" name="password" id="password" placeholder="Password" class="textbox" required>
        <input type="password" name="passwordC" id="confirmPassword" placeholder="Confirm Password" class="textbox"
          required>
        <button type="submit" class="btn2">Sign Up</button>
        <a href="?action=login&type=admin" class="btn1" id="loginLink">Already have an account? Sign in</a>
      </form>
    </div>
    <script>
      const form = document.getElementById('signupForm');
      const password = document.getElementById('password');
      const confirmPassword = document.getElementById('confirmPassword');
      const roleSelect = document.getElementById('roleSelect');
      const loginLink = document.getElementById('loginLink'); // updated id

      // Password validation
      form.addEventListener('submit', function (e) {
        if (password.value !== confirmPassword.value) {
          e.preventDefault();
          confirmPassword.classList.add('shake', 'error');
          setTimeout(() => {
            confirmPassword.classList.remove('shake');
          }, 300);
          return; // stop here if passwords don't match
        }

        const selectedRole = roleSelect.value;
        form.action = `?type=${selectedRole}&action=signup`; // update action
      });

      // On clicking "Sign Up" link (navigation only)
      loginLink.addEventListener('click', function (e) {
        e.preventDefault();
        const selectedRole = roleSelect.value;
        window.location.href = `?type=${selectedRole}&action=login`;
      });

      // Set default selected value
      window.addEventListener('DOMContentLoaded', () => {
        roleSelect.value = "vendor";
      });
    </script>



    <?php if (!empty($error)): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

  </div>
  </div>

</body>

</html>
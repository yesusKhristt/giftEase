<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>GiftEase Login</title>
  <link rel="stylesheet" href="public/style2.css">
  <link rel="icon" href="resources/icon.png">
</head>

<body class="orange">
  <div class="container center">
    <div class="login-container">
      <img src="resources/logoWP.png" height="100px" width="100px">
      <p class="Heading blueT"><span class="orangeT">gift</span><b>Ease</b><br>Sign In</p>

      <form method="POST" action="?type=admin&action=login" class="center" id="signupForm">
        <select name="role" id="roleSelect">
          <option value="client">Client</option>
          <option value="vendor">Vendor</option>
          <option value="admin">Admin</option>
          <option value="delivery">Delivery</option>
          <option value="deliveryman">Delivery Man</option>
          <option value="giftWrapper">Gift Wrapper</option>
        </select>
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <input type="password" name="passwordC" id="confirmPassword" placeholder="Confirm Password" required>
        <button type="submit">Sign In</button>
        <a href="?action=login&type=admin" id="loginLink" class="btn">Already have an account? Sign in</a>
      </form>
      <script>
        const form = document.getElementById('signupForm');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');
        const roleSelect = document.getElementById('roleSelect');
        const signupLink = document.getElementById('signupLink'); // updated id

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
        signupLink.addEventListener('click', function (e) {
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
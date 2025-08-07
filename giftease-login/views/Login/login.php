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
      <p class="Heading blueT"><span class="orangeT">gift</span><b>Ease</b> Login</p>
      <form method="POST" action="?type=admin&action=login" class="center" id="loginForm">
        <select name="role" id="roleSelect">
          <option value="client">Client</option>
          <option value="vendor">Vendor</option>
          <option value="admin">Admin</option>
          <option value="delivery">Delivery</option>
          <option value="deliveryman">Delivery Man</option>
          <option value="giftWrapper">Gift Wrapper</option>
        </select>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required
          class="<?= !empty($error) ? 'shake error' : '' ?>" id="passwordInput">
        <button type="submit">Login</button>
        <a href="##" id="signupLink" class="btn">No account? bupSign up</a>
      </form>
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
          form.action = `?type=${selectedRole}&action=login`;
        });

        // On clicking "Sign up", change action and submit form
        signupLink.addEventListener('click', function (e) {
          e.preventDefault();
          const selectedRole = roleSelect.value;
          form.action = `?type=${selectedRole}&action=signup`;
          form.submit();
        });
      </script>


    </div>
  </div>
</body>

</html>
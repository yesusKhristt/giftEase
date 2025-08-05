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
      <p class="subHeading blueT">Client</p>
      <img src="resources/logoWP.png" height="100px" width="100px">
      <p class="Heading blueT"><span class="orangeT">gift</span><b>Ease</b><br>Sign In</p>
      <form method="POST" action="?type=client&action=signup" class="center" id="signupForm">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <input type="password" name="passwordC" id="confirmPassword" placeholder="Confirm Password" required>
        <button type="submit">Sign In</button>
        <a href="?action=signup&type=vendor" class="btn">Vendor Sign In</a>
        <a href="?action=signup&type=delivery" class="btn">Delivery Sign In</a>
        <a href="?action=signup&type=deliveryman" class="btn">Delivery Man Sign In</a>
        <a href="?action=signup&type=admin" class="btn">Admin Sign In</a>
        <a href="?action=signup&type=giftWrapper" class="btn">Gift Wrapper Sign In</a>
        <a href="?action=login&type=client" class="btn">Already have an account? Sign in</a>
      </form>
      <script>
        const form = document.getElementById('signupForm');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');

        form.addEventListener('submit', function (e) {
          if (password.value !== confirmPassword.value) {
            e.preventDefault(); // Stop form submission

            confirmPassword.classList.add('shake', 'error');

            // Remove the shake class after animation completes so it can be re-triggered
            setTimeout(() => {
              confirmPassword.classList.remove('shake');
            }, 300);
          }
        });
      </script>
      <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
      <?php endif; ?>
    </div>
  </div>
</body>

</html>
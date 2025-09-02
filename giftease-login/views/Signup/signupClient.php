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
        <p>Sign Up</p>
      </div>
    </div>
    <div>
      <form method="POST" action="?type=client&action=login" id="loginForm">
        <input type="text" name="name" placeholder="Name" class="textbox" required>
        <input type="email" name="email" placeholder="Email" class="textbox" required>
        <input type="password" name="password" id="password" placeholder="Password" class="textbox" required>
        <input type="password" name="passwordC" id="confirmPassword" placeholder="Confirm Password" class="textbox"
          required>
        <button type="submit" class="btn2">Sign Up</button>
        <a href="?action=login&type=client" class="btn1" id="loginLink">Already have an account? Sign in</a>
      </form>
    </div>
    <script>
      const form = document.getElementById('signupForm');
      const password = document.getElementById('password');
      const confirmPassword = document.getElementById('confirmPassword');

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
      });
    </script>



    <?php if (!empty($error)): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

  </div>
  </div>
</body>

</html>
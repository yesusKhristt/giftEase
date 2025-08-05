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
      <p class="Heading blueT"><span class="orangeT">gift</span><b>Ease</b><br>Sign In</p>
      <form method="POST" action="?type=staff&action=signup" class="center" id="signupForm">
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" id="password" placeholder="Password" required>
        <input type="password" name="passwordC" id="confirmPassword" placeholder="Confirm Password" required>
        <p>Select Role:</p>
        <label><input type="radio" name="staffType" value="deliverman" required> Delivery Man</label>
        <label><input type="radio" name="staffType" value="giftWrapper"> Gift Wrapper</label>
        <label><input type="radio" name="staffType" value="admin"> Admin</label>

        <button type="submit">Sign In</button>
        <a href="?action=signup&type=client" class="btn">Client Sign In</a>
        <a href="?action=signup&type=vendor" class="btn">Vendor Sign In</a>
        <a href="?action=login&type=staff" class="btn">Delivery Sign In</a>
        <a href="?action=login&type=staff" class="btn">Already have an account? Sign in</a>
      </form>
      <script>
        const form = document.getElementById('signupForm');
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('confirmPassword');

        form.addEventListener('submit', function (e) {
          const staffType = document.querySelector('input[name="staffType"]:checked');


          // Check password match
          if (password.value !== confirmPassword.value) {
            e.preventDefault();
            confirmPassword.classList.add('shake', 'error');
            setTimeout(() => {
              confirmPassword.classList.remove('shake');
            }, 300);
            return; // stop further execution
          }

          // Set form action dynamically
          if (staffType) {
            this.action = staffType;
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
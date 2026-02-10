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
      <img src="resources/ge5.png" class="logo_img">
      <div class="gift">
        gift<span class="Ease">Ease</span>
        <p>Staff Sign Up</p>
      </div>
    </div>
    <div>
      <form method="GET" action="" id="signupForm">
        <input type="hidden" name="action" value="handleSignup">
        <div class="select-placeholder" id="selectPlaceholder">Select Role</div>
          <option value="vendor">Vendor.</option>
          <option value="admin">Admin</option>
          <option value="delivery">Delivery</option>
          <option value="deliveryman">Delivery Man</option>
          <option value="giftWrapper">Gift Wrapper</option>
        </select>
        <button type="submit" class="btn2">Continue to Sign Up</button>
        <a href="?action=handleLogin&type=admin" class="btn1" id="loginLink">Already have an account? Sign in</a>
      </form>
    </div>
    <script>
      const roleSelect = document.getElementById('roleSelect');
      const loginLink = document.getElementById('loginLink');

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
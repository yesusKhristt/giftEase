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
        gift<span class="Ease">Ease</span>
        <p>
          <?php
          $type = $_GET['type'] ?? 'client';
          if ($type != 'client') {
            echo 'Staff ';
          }
          ?>Login
        </p>
      </div>
    </div>

    <div>
      <form method="POST" action="" id="loginForm">
        <?php
        $type = $_GET['type'] ?? 'client';
        if ($type != 'client') {
          echo '<select name="role" id="roleSelect">
                  <option value="vendor">Vendor</option>
                  <option value="admin">Admin</option>
                  <option value="delivery">Delivery</option>
                  <option value="deliveryman">Delivery Man</option>
                  <option value="giftWrapper">Gift Wrapper</option>
                </select>';
        } else {
          echo '<input type="hidden" name="role" value="client">';
        }
        ?>
        <input type="email" name="email" placeholder="Email" class="textbox" required>
        <input type="password" name="password" placeholder="Password"
          class="textbox <?= !empty($error) ? 'shake error' : '' ?>" id="passwordInput" required>

        <button type="submit" class="btn2">Login</button>
        <a href="?action=handleSignup&type=<?= htmlspecialchars($type) ?>" id="signupLink" class="btn1">No account? Sign
          Up</a>
      </form>
    </div>

    <?php if (!empty($error)): ?>
      <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <script>
      const passwordInput = document.getElementById('passwordInput');
      const signupLink = document.getElementById('signupLink');
      let roleSelect = document.getElementById('roleSelect');
      let selectedRole = "client"; // default

      if (roleSelect) {
        selectedRole = roleSelect.value;
      }

      form.addEventListener('submit', function (e) {
        form.action = `?type=${selectedRole}&action=handleSignup`;
      });

      // Shake animation if error exists
      <?php if (!empty($error)): ?>
        passwordInput.classList.add('shake');
        setTimeout(() => {
          passwordInput.classList.remove('shake');
        }, 300);
      <?php endif; ?>
    </script>
  </div>
</body>

</html>
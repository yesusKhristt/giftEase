<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>GiftEase Login</title>
  <link rel="stylesheet" href="public/signupstyle.css">
  <link rel="icon" href="resources/icon.png">
  <style>
    #giftWrapperGender { 
        display: flex; 
        gap: 12px; 
        align-items: center; 
        margin-bottom: 14px; 
    }
    
    .gender-option { 
        display: inline-flex; 
        align-items: center; 
        cursor: pointer; 
        border-radius: 999px; 
        padding: 6px 18px; 
        background: #fff; 
        border: 1px solid #e6e6e6; 
        transition: all .12s ease; 
        font-size: 14px; 
        color: #333; 
        gap: 8px;
    }
    
    /* HIDE the default browser radio button completely */
    .gender-option input[type="radio"] { 
        display: none;  /* ← THIS removes the default circle */
    }
    
    .gender-option span { 
        display: inline-block; 
        line-height: 1; 
        position: relative; 
        padding-left: 24px;
    }
    
    /* Custom circle */
    .gender-option span::before { 
        content: ''; 
        position: absolute; 
        left: 0; 
        top: 50%; 
        transform: translateY(-50%); 
        width: 16px; 
        height: 16px; 
        border-radius: 50%; 
        border: 2px solid #d1d5db; 
        background: #fff; 
        box-sizing: border-box; 
    }
    
    /* Selected state */
    .gender-option input[type="radio"]:checked + span::before { 
        border-color: #e91e63; 
        background: radial-gradient(circle at center, #e91e63 50%, transparent 51%); 
        box-shadow: 0 0 0 4px rgba(233,30,99,0.08); 
    }
    
    /* Hover effect */
    .gender-option:hover { 
        transform: translateY(-2px); 
        border-color: #e91e63; 
    }
</style>
</head>

<body
  style="display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background: #f6f6f6;">
  <div class="authContainer">
    <div class="logo">
      <img src="resources/iconL.png" class="logo_img">
      <div class="gift">
      gift<span class="Ease">Ease</span>
        <h6>
          <?php $type = $_GET['type'] ?? 'client';
          if ($type != 'client') {
            echo 'Staff ';
          }
          ?>Login
        </h6>
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
        <div id="giftWrapperGender" style="display:none; margin:8px 0;">
          <label class="gender-option"><input type="radio" name="gender" value="male"><span>Male</span></label>
          <label class="gender-option"><input type="radio" name="gender" value="female"><span>Female</span></label>
        </div>
        <input type="email" name="email" placeholder="Email" class="textbox" required>
        <!-- <input type="text" name="address" placeholder="Address (optional)" class="textbox"> -->
        <input type="password" name="password" placeholder="Password"
          class="textbox <?= !empty($error) ? 'shake error' : '' ?>" id="passwordInput" required>

        <button type="submit" class="btn-primary">Login</button>
        <a href="?action=handleSignup&type=<?= htmlspecialchars($type) ?>" id="signupLink" class="login-link">No account? Sign
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
      const genderBox = document.getElementById('giftWrapperGender');
      let selectedRole = "client"; // default

      if (roleSelect) {
        selectedRole = roleSelect.value;
      }

      function toggleGender() {
        if (!roleSelect || !genderBox) return;
        genderBox.style.display = roleSelect.value === 'giftWrapper' ? 'block' : 'none';
      }

      if (roleSelect) {
        roleSelect.addEventListener('change', () => {
          selectedRole = roleSelect.value;
          toggleGender();
        });
        // initial toggle
        toggleGender();
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
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>GiftEase Sign Up</title>
  <link rel="icon" href="resources/icon.png">
  <link rel="stylesheet" href="public/signupstyle.css">
</head>

<body
  style="display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background: #f6f6f6;">
  <div class="authContainer">
    <div class="logo">
      <img src="resources/iconL.png" class="logo_img">
      <div class="gift">
        gift<span class="Ease">Ease</span>
        <p>
          <?php $type = $_GET['type'] ?? 'client';
          if ($type != 'client') {
            echo 'Staff ';
          }
          ?>Sign Up
        </h6>
    </div>
  </div>

  <form method="POST" id="signupForm">

    <div class="step-indicator">
      <span id="s1" class="active">1</span>
      <span id="s2">2</span>
    </div>
    <div>
      <?php
      // Server-side: get submitted role (so after POST we can re-render same fields)
      $role = $_POST['role'] ?? ($_GET['type'] === 'client' ? 'client' : null);
      $type = $_GET['type'] ?? 'client';
      ?>
      <form method="POST" action="" id="signupForm">
        <?php if ($type != 'client'): ?>
          <select name="role" id="roleSelect" required>
            <option value="" selected>-- Select Role --</option>
            <option value="vendor">Vendor</option>
            <option value="admin">Admin</option>
            <option value="delivery">Delivery</option>
            <option value="deliveryman">Delivery Man</option>
            <option value="giftWrapper">Gift Wrapper</option>
          </select>

        <?php else: ?>
          <input type="hidden" name="role" value="client">
        <?php endif; ?>

        <!-- common fields -->
        <input type="text" name="f_name" placeholder="First Name" class="textbox" required
          value="<?= htmlspecialchars($_POST['f_name'] ?? '') ?>">
        <input type="text" name="l_name" placeholder="Last Name" class="textbox" required
          value="<?= htmlspecialchars($_POST['l_name'] ?? '') ?>">
        <input type="email" name="email" placeholder="Email" class="textbox" required
          value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        <input type="password" name="password" id="password" placeholder="Password" class="textbox" required>
        <input type="password" name="passwordC" id="confirmPassword" placeholder="Confirm Password" class="textbox"
          required>
        <input type="text" name="address" placeholder="Address" class="form-input" required
          value="<?= htmlspecialchars($_POST['address'] ?? '') ?>">
        <input type="text" name="phone" placeholder="Phone No" class="form-input" required
          value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">

        <!-- role-specific fields container (will be filled by JS AND server-side for POST) -->
        <div id="roleFields">
          <?php
          // Server-side rendering when form was submitted (so validation errors can show same fields)
          if (!empty($role)) {
            switch ($role) {
              case 'vendor':
                echo '<input type="text" name="shopName" placeholder="Shop Name" class="form-input" required value="' . htmlspecialchars($_POST['shopName'] ?? '') . '">';
                // if vendor also needs giftWrapper fields, you can add them here or break to avoid fallthrough
                echo '<!-- vendor-specific done -->';
                break;

              case 'giftWrapper':
                echo '<input type="number" name="years" placeholder="Years of Occupation" class="form-input" required value="' . htmlspecialchars($_POST['years'] ?? '') . '">';
                break;

              case 'delivery':
              case 'deliveryman':
                echo '<input type="text" name="vehiclePlate" placeholder="Vehicle Number Plate" class="form-input" required value="' . htmlspecialchars($_POST['vehiclePlate'] ?? '') . '">';
                break;

              case 'admin':
                echo '<input type="text" name="designation" placeholder="Designation" class="form-input" required value="' . htmlspecialchars($_POST['designation'] ?? '') . '">';
                break;
            }
          }
          ?>
        </div>

        <label>
          <input type="checkbox" name="terms" style="width: 20px" required <?= isset($_POST['terms']) ? 'checked' : '' ?>>
          I've read and agree to the <a href="terms.html" target="_blank">Terms and Conditions</a>.
        </label>

        <button type="submit" class="btn2">Sign Up</button>
        <a href="?action=handleLogin&type=admin" class="btn1" id="loginLink">Already have an account? Sign in</a>
      </form>

      <!-- Client-side JS to render fields instantly when role changes -->

    </div>

    <a href="?action=handleLogin&type=<?= $type ?>" class="login-link">
      Already have an account? Sign in
    </a>

  </form>
</div>

<script>
  const step1 = document.getElementById('step1');
  const step2 = document.getElementById('step2');
  const s1 = document.getElementById('s1');
  const s2 = document.getElementById('s2');
  const roleSelect = document.getElementById('roleSelect');
  const roleFields = document.getElementById('roleFields');
  const form = document.getElementById('signupForm');
  const password = document.getElementById('password');
  const confirmPassword = document.getElementById('confirmPassword');

  function goToStep2() {
    const fields = step1.querySelectorAll('input[required], select[required]');
    for (let f of fields) {
      if (!f.value.trim()) {
        alert("Please fill all required fields");
        f.focus();
        return;
      }
    }
    step1.classList.remove('active');
    step2.classList.add('active');
    s1.classList.remove('active');
    s2.classList.add('active');
  }

  function goToStep1() {
    step2.classList.remove('active');
    step1.classList.add('active');
    s2.classList.remove('active');
    s1.classList.add('active');
  }

  const templates = {
    vendor: `<input type="text" name="shopName" placeholder="Shop Name" required>`,
    giftWrapper: `<input type="number" name="years" placeholder="Years of Occupation" required>`,
    delivery: `<input type="text" name="vehiclePlate" placeholder="Vehicle Plate" required>`,
    deliveryman: `<input type="text" name="vehiclePlate" placeholder="Vehicle Plate" required>`,
    admin: `<input type="text" name="designation" placeholder="Designation" required>`
  };

  if (roleSelect) {
    roleSelect.addEventListener('change', () => {
      roleFields.innerHTML = templates[roleSelect.value] || '';
    });
  }

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
        form.action = `?type=${selectedRole}&action=handleSignup`;
      });

      // On clicking "Sign In" link
      loginLink.addEventListener('click', function (e) {
        e.preventDefault();
        window.location.href = `?type=${selectedRole}&action=handleLogin`;
      });

      // Set default selected value
      window.addEventListener('DOMContentLoaded', () => {
        roleSelect.value = "";
      });
      (function () {
        const roleSelect = document.getElementById('roleSelect');
        const roleFields = document.getElementById('roleFields');

        // Map role -> HTML to render (match the server-side names)
        const templates = {
          vendor: `
      <input type="text" name="shopName" placeholder="Shop Name" class="form-input" required>
    `,
          giftWrapper: `
      <input type="number" name="years" placeholder="Years of Occupation" class="form-input" required>
    `,
          delivery: `
      <input type="text" name="vehiclePlate" placeholder="Vehicle Number Plate" class="form-input" required>
    `,
          deliveryman: `
      <input type="text" name="vehiclePlate" placeholder="Vehicle Number Plate" class="form-input" required>
    `,
          admin: `
      <input type="text" name="designation" placeholder="Designation" class="form-input" required>
    `
        };

        function renderRoleFields(role) {
          if (!role || !templates[role]) {
            roleFields.innerHTML = ''; // clear
            return;
          }
          roleFields.innerHTML = templates[role];
        }

        // If roleSelect exists, wire up change listener
        if (roleSelect) {
          roleSelect.addEventListener('change', function (e) {
            renderRoleFields(e.target.value);
          });

          // render initial client-side view from server-selected role (if any)
          const initialRole = roleSelect.value;
          if (initialRole) renderRoleFields(initialRole);
        }
      })();
    </script>

</body>
</html>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>GiftEase Sign Up</title>
  <link rel="icon" href="resources/icon.png">
  <link rel="stylesheet" href="public/signupstyle.css">
</head>

<body>

<?php
$type = $_GET['type'] ?? 'client';
$role = $_POST['role'] ?? ($type === 'client' ? 'client' : '');
?>

<div class="authContainer">

  <div class="logo">
    <img src="resources/ge5.png">
    <div class="gift">
      gift<span class="Ease">Ease</span>
        <h6>
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

    <!-- STEP 1 -->
    <div class="step active" id="step1">

      <?php if ($type != 'client'): ?>
        <select name="role" id="roleSelect" required>
          <option value="">-- Select Role --</option>
          <option value="vendor">Vendor</option>
          <option value="admin">Admin</option>
          <option value="delivery">Delivery</option>
          <option value="deliveryman">Delivery Man</option>
          <option value="giftWrapper">Gift Wrapper</option>
        </select>
      <?php else: ?>
        <input type="hidden" name="role" value="client">
      <?php endif; ?>

      <input type="text" name="f_name" placeholder="First Name" required>
      <input type="text" name="l_name" placeholder="Last Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="phone" placeholder="Phone Number" required>
      <input type="text" name="address" placeholder="Address" required>

      <button type="button" class="btn-primary" onclick="goToStep2()">Next</button>
    </div>

    <!-- STEP 2 -->
    <div class="step" id="step2">

      <input type="password" id="password" name="password" placeholder="Password" required>
      <input type="password" id="confirmPassword" name="passwordC" placeholder="Confirm Password" required>

      <div id="roleFields"></div>

      <label>
        <input type="checkbox" required> I agree to the Terms & Conditions
      </label>

      <div class="step-actions">
        <button type="button" class="btn-secondary" onclick="goToStep1()">Back</button>
        <button type="submit" class="btn-primary">Sign Up</button>
      </div>
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

  form.addEventListener('submit', e => {
    if (password.value !== confirmPassword.value) {
      e.preventDefault();
      alert("Passwords do not match");
      return;
    }
    const role = roleSelect ? roleSelect.value : 'client';
    form.action = `?type=${role}&action=handleSignup`;
  });
</script>

</body>
</html>

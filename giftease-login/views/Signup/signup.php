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

  <form method="POST" id="signupForm" enctype="multipart/form-data">

    <div class="step-indicator">
      <span id="s1" class="active">1</span>
      <span id="s2">2</span>
      <?php if ($type != 'client'): ?>
        <span id="s3">3</span>
      <?php endif; ?>
    </div>

    <!-- STEP 1 -->
    <div class="step active" id="step1">

      <?php if ($type != 'client'): ?>
        <div class="select-wrapper">
        
          <select name="role" id="roleInput" class="role-select" required>
            <option value="__placeholder__" selected>Select Role</option>
            <option value="vendor">Vendor</option>
            <option value="admin">Admin</option>
            <option value="delivery">Delivery</option>
            <option value="deliveryman">Delivery Man</option>
            <option value="giftWrapper">Gift Wrapper</option>
          </select>
        </div>
      <?php else: ?>
        <input type="hidden" name="role" value="client">
      <?php endif; ?>

      <input type="text" name="f_name" placeholder="First Name" required>
      <input type="text" name="l_name" placeholder="Last Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="phone" placeholder="Phone Number" required>
      <input type="text" name="address" placeholder="Address" required>

      <!-- Role-specific fields -->
      <?php if ($type != 'client'): ?>
        <div id="vendorFields" style="display: none;">
          <input type="text" name="shopName" placeholder="Shop Name">
        </div>
        <div id="deliveryFields" style="display: none;">
          <select name="vehicleType">
            <option value="" selected>Select Vehicle Type</option>
            <option value="Motorcycle">Motorcycle</option>
            <option value="Car">Car</option>
            <option value="Van">Van</option>
            <option value="Bicycle">Bicycle</option>
          </select>
          <input type="text" name="vehiclePlate" placeholder="Vehicle Plate Number">
        </div>
        <div id="giftWrapperFields" style="display: none;">
          <input type="number" name="years" placeholder="Years of Experience" min="0">
        </div>
        <div id="adminFields" style="display: none;">
          <input type="text" name="designation" placeholder="Designation">
        </div>
      <?php endif; ?>

      <button type="button" class="btn-primary" onclick="goToStep2()">Next</button>
    </div>

    <!-- STEP 2 -->
    <div class="step" id="step2">

      <input type="password" id="password" name="password" placeholder="Password" required>
      <input type="password" id="confirmPassword" name="passwordC" placeholder="Confirm Password" required>

      <label>
        <input type="checkbox" required> I agree to the Terms & Conditions
      </label>

      <div class="step-actions">
        <button type="button" class="btn-secondary" onclick="goToStep1()">Back</button>
        <?php if ($type != 'client'): ?>
          <button type="button" class="btn-primary" onclick="handleStep2Next()">Next</button>
        <?php else: ?>
          <button type="submit" class="btn-primary">Sign Up</button>
        <?php endif; ?>
      </div>
    </div>

    <?php if ($type != 'client'): ?>
    <!-- STEP 3 - Documents based on role -->
    <div class="step" id="step3">
      <h3 class="doc-title" id="docTitle">Required Documentation</h3>
      <p class="doc-subtitle">Please upload the following required documents</p>

      <!-- Vendor Documents -->
      <div id="vendorDocs" style="display: none;">
        <div class="doc-upload-group">
          <label class="doc-label">Identity Proof (NIC / Passport)</label>
          <input type="file" name="identity_doc" class="file-input" accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <div class="doc-upload-group">
          <label class="doc-label">Business Registration Certificate</label>
          <input type="file" name="business_cert" class="file-input" accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <div class="doc-upload-group">
          <label class="doc-label">Tax Identification Number (TIN)</label>
          <input type="file" name="tin_doc" class="file-input" accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <div class="doc-upload-group">
          <label class="doc-label">Address Proof (Utility Bill / Shop Lease)</label>
          <input type="file" name="address_proof" class="file-input" accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <div class="doc-upload-group">
          <label class="doc-label">Bank Account Details</label>
          <input type="file" name="bank_details" class="file-input" accept=".pdf,.jpg,.jpeg,.png">
        </div>
      </div>

      <!-- Delivery Partner Documents -->
      <div id="deliveryDocs" style="display: none;">
        <div class="doc-upload-group">
          <label class="doc-label">Identity Proof (NIC / Passport)</label>
          <input type="file" name="delivery_identity" class="file-input" accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <div class="doc-upload-group">
          <label class="doc-label">Driving License</label>
          <input type="file" name="driving_license" class="file-input" accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <div class="doc-upload-group">
          <label class="doc-label">Vehicle Registration</label>
          <input type="file" name="vehicle_registration" class="file-input" accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <div class="doc-upload-group">
          <label class="doc-label">Vehicle Insurance</label>
          <input type="file" name="vehicle_insurance" class="file-input" accept=".pdf,.jpg,.jpeg,.png">
        </div>
      </div>

      <!-- Gift Wrapper Documents -->
      <div id="giftWrapperDocs" style="display: none;">
        <div class="doc-upload-group">
          <label class="doc-label">Identity Proof (NIC)</label>
          <input type="file" name="wrapper_identity" class="file-input" accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <div class="doc-upload-group">
          <label class="doc-label">Address Proof (Utility Bill)</label>
          <input type="file" name="wrapper_address" class="file-input" accept=".pdf,.jpg,.jpeg,.png">
        </div>

        <div class="doc-upload-group">
          <label class="doc-label">Portfolio / Sample Images</label>
          <input type="file" name="portfolio" class="file-input" accept=".pdf,.jpg,.jpeg,.png" multiple>
          <small style="color: #666; font-size: 12px;">You can upload multiple images</small>
        </div>
      </div>

      <div class="step-actions">
        <button type="button" class="btn-secondary" onclick="goToStep2()">Back</button>
        <button type="submit" class="btn-primary">Submit Application</button>
      </div>
    </div> 
    <?php endif; ?>

    <a href="?action=handleLogin&type=<?= $type ?>" class="login-link">
      Already have an account? Sign in
    </a>

  </form>
</div>

<script>
  const step1 = document.getElementById('step1');
  const step2 = document.getElementById('step2');
  const step3 = document.getElementById('step3');
  const s1 = document.getElementById('s1');
  const s2 = document.getElementById('s2');
  const s3 = document.getElementById('s3');
  const form = document.getElementById('signupForm');
  const password = document.getElementById('password');
  const confirmPassword = document.getElementById('confirmPassword');

  const isVendor = <?= $type != 'client' ? 'true' : 'false' ?>;

  // Show appropriate document section based on role
  const roleInput = document.getElementById('roleInput');
  const selectPlaceholder = document.getElementById('selectPlaceholder');
  
  if (roleInput) {
    // Handle placeholder visibility
    function updatePlaceholder() {
      if (!selectPlaceholder) return;
      if (roleInput.value === '') {
        selectPlaceholder.classList.remove('hidden');
      } else {
        selectPlaceholder.classList.add('hidden');
      }
    }

    roleInput.addEventListener('change', function() {
      updatePlaceholder();
      updateRoleSpecificFields();
    });

    // Initial state
    updatePlaceholder();
    function updateRoleSpecificFields() {
      const role = roleInput.value === '__placeholder__' ? '' : roleInput.value;
      
      // Hide all role-specific field groups
      const vendorFields = document.getElementById('vendorFields');
      const deliveryFields = document.getElementById('deliveryFields');
      const giftWrapperFields = document.getElementById('giftWrapperFields');
      const adminFields = document.getElementById('adminFields');

      if (vendorFields) {
        vendorFields.style.display = 'none';
        vendorFields.querySelectorAll('input').forEach(i => {
          i.removeAttribute('required');
          i.value = '';
        });
      }
      if (deliveryFields) {
        deliveryFields.style.display = 'none';
        deliveryFields.querySelectorAll('input, select').forEach(i => {
          i.removeAttribute('required');
          i.value = '';
        });
      }
      if (giftWrapperFields) {
        giftWrapperFields.style.display = 'none';
        giftWrapperFields.querySelectorAll('input').forEach(i => {
          i.removeAttribute('required');
          i.value = '';
        });
      }
      if (adminFields) {
        adminFields.style.display = 'none';
        adminFields.querySelectorAll('input').forEach(i => {
          i.removeAttribute('required');
          i.value = '';
        });
      }

      // Show and require fields based on role
      if (role === 'vendor' && vendorFields) {
        vendorFields.style.display = 'block';
        vendorFields.querySelectorAll('input').forEach(i => i.setAttribute('required', 'required'));
      } else if ((role === 'delivery' || role === 'deliveryman') && deliveryFields) {
        deliveryFields.style.display = 'block';
        deliveryFields.querySelectorAll('input, select').forEach(i => i.setAttribute('required', 'required'));
      } else if (role === 'giftWrapper' && giftWrapperFields) {
        giftWrapperFields.style.display = 'block';
        giftWrapperFields.querySelectorAll('input').forEach(i => i.setAttribute('required', 'required'));
      } else if (role === 'admin' && adminFields) {
        adminFields.style.display = 'block';
        adminFields.querySelectorAll('input').forEach(i => i.setAttribute('required', 'required'));
      }

      updateDocumentSection();
    }

    function updateDocumentSection() {
      const role = roleInput.value === '__placeholder__' ? '' : roleInput.value;
      const vendorDocs = document.getElementById('vendorDocs');
      const deliveryDocs = document.getElementById('deliveryDocs');
      const giftWrapperDocs = document.getElementById('giftWrapperDocs');
      const docTitle = document.getElementById('docTitle');

      // Hide all document sections
      if (vendorDocs) vendorDocs.style.display = 'none';
      if (deliveryDocs) deliveryDocs.style.display = 'none';
      if (giftWrapperDocs) giftWrapperDocs.style.display = 'none';

      // Clear required attribute from all file inputs
      document.querySelectorAll('.file-input').forEach(input => {
        input.removeAttribute('required');
      });

      // Show relevant section and set required
      if (role === 'vendor' && vendorDocs) {
        vendorDocs.style.display = 'block';
        if (docTitle) docTitle.textContent = 'Business Documentation';
        vendorDocs.querySelectorAll('.file-input').forEach(input => {
          input.setAttribute('required', 'required');
        });
      } else if ((role === 'delivery' || role === 'deliveryman') && deliveryDocs) {
        deliveryDocs.style.display = 'block';
        if (docTitle) docTitle.textContent = 'Delivery Partner Documentation';
        deliveryDocs.querySelectorAll('.file-input').forEach(input => {
          input.setAttribute('required', 'required');
        });
      } else if (role === 'giftWrapper' && giftWrapperDocs) {
        giftWrapperDocs.style.display = 'block';
        if (docTitle) docTitle.textContent = 'Gift Wrapper Documentation';
        giftWrapperDocs.querySelectorAll('.file-input').forEach(input => {
          input.setAttribute('required', 'required');
        });
      }
    }

    // Update on role change
    roleInput.addEventListener('change', updateRoleSpecificFields);
    
    // Set initial state based on URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    const urlType = urlParams.get('type');
    if (urlType && urlType !== 'client') {
      const optionMatch = roleInput.querySelector(`option[value="${urlType}"]`);
      if (optionMatch) {
        roleInput.value = urlType;
        updateRoleSpecificFields();
      }
    }
  }

  function goToStep2() {
    if (roleInput && roleInput.value === '__placeholder__') {
      alert("Please select a role");
      roleInput.focus();
      return;
    }
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

  function handleStep2Next() {
    if (password.value !== confirmPassword.value) {
      alert("Passwords do not match");
      return;
    }
    if (roleInput && roleInput.value === '__placeholder__') {
      alert("Please select a role");
      roleInput.focus();
      return;
    }
    const fields = step2.querySelectorAll('input[required]:not([type="checkbox"]), select[required]');
    for (let f of fields) {
      if (!f.value.trim()) {
        alert("Please fill all required fields");
        f.focus();
        return;
      }
    }
    const checkbox = step2.querySelector('input[type="checkbox"]');
    if (!checkbox.checked) {
      alert("Please agree to the Terms & Conditions");
      return;
    }
    
    if (isVendor && step3) {
      if (roleInput) {
        updateDocumentSection();
      }
      step2.classList.remove('active');
      step3.classList.add('active');
      s2.classList.remove('active');
      s3.classList.add('active');
    }
  }

  function goToStep2FromStep3() {
    if (step3) {
      step3.classList.remove('active');
      step2.classList.add('active');
      s3.classList.remove('active');
      s2.classList.add('active');
    }
  }

  form.addEventListener('submit', e => {
    if (password.value !== confirmPassword.value) {
      e.preventDefault();
      alert("Passwords do not match");
      return;
    }
    const role = isVendor ? (roleInput ? roleInput.value : 'vendor') : 'client';
    form.action = `?type=${role}&action=handleSignup`;
  });
</script>

</body>
</html>

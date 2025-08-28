<div class="permbar">
  <div class="left_sidebar">
    <!-- Logo -->
    <div class="logo">
      <img src="resources/icon.png" class="logo_img">
      <div class="gift">
        gift<span class="Ease">Ease
        </span>
      </div>
    </div>
    <?php
    function isActive($pageName, $activePage)
    {
      return $pageName === $activePage ? 'active' : '';
    }
    ?>
    <a href="?action=dashboard&type=admin&level=front" class="nav-item <?= isActive('front', $activePage) ?>">
      Front
    </a>
    <a href="?action=dashboard&type=admin&level=customer" class="nav-item <?= isActive('customer', $activePage) ?>">
      Customer
    </a>
    <a href="?action=dashboard&type=admin&level=delivery" class="nav-item <?= isActive('delivery', $activePage) ?>">
      Delivery
    </a>
    <a href="?action=dashboard&type=admin&level=vendor" class="nav-item <?= isActive('vendor', $activePage) ?>">
      Vendor
    </a>
    <a href="?action=dashboard&type=admin&level=items" class="nav-item <?= isActive('items', $activePage) ?>">
      Items
    </a>
    <a href="?action=dashboard&type=admin&level=reports" class="nav-item <?= isActive('reports', $activePage) ?>">
      Reports
    </a>
    </nav>
    <div class="button-section">
      <a href="#logout" class="btn1">
        <i class="fas fa-sign-out-alt"></i>
        Log Out
      </a>
    </div>
  </div>
  <div class="topbar-container">
    <!-- Search Bar -->
    <div class="search-bar">
      <input type="text" class="search-input" placeholder="Search..." />
    </div>

    <div class="gift">
      gift<span class="Ease">Ease
      </span>
    </div>

    <!-- Right Side Links/Buttons -->
    <nav class="topbar-actions">
      <a href="?action=dashboard&type=admin&level=settings"
        class="settings-btn <?= isActive('settings', $activePage) ?>">
        <i class="fas fa-cog"></i>
      </a>
      <a href="?action=dashboard&type=admin&level=profile" class="settings-btn <?= isActive('profile', $activePage) ?>">
        <i class="fas fa-user"></i>
      </a>
    </nav>
  </div>
</div>
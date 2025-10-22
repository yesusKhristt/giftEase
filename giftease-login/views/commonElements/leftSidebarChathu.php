<div class="permbar">
  <div class="left_sidebar">
    <!-- Logo -->
    <div class="logo">
      <img src="resources/ge5.png" class="logo_img">
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
    <a href="?controller=admin&action=dashboard/front" class="nav-item <?= isActive('front', $activePage) ?>">
      Front
    </a>
    <a href="?controller=admin&action=dashboard/customer" class="nav-item <?= isActive('customer', $activePage) ?>">
      Customer
    </a>
    <a href="?controller=admin&action=dashboard/delivery" class="nav-item <?= isActive('delivery', $activePage) ?>">
      Delivery
    </a>
    <a href="?controller=admin&action=dashboard/vendor" class="nav-item <?= isActive('vendor', $activePage) ?>">
      Vendor
    </a>
    <a href="?controller=admin&action=dashboard/items" class="nav-item <?= isActive('items', $activePage) ?>">
      Items
    </a>
    <a href="?controller=admin&action=dashboard/giftWrapping" class="nav-item <?= isActive('giftWrapping', $activePage) ?>">
      Gift Wrapping
    </a>
    <a href="?controller=admin&action=dashboard/category" class="nav-item <?= isActive('category', $activePage) ?>">
      Category
    </a>
    <a href="?controller=admin&action=dashboard/reports" class="nav-item <?= isActive('reports', $activePage) ?>">
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
      <a href="?controller=admin&action=dashboard/settings"
        class="settings-btn <?= isActive('settings', $activePage) ?>">
        <i class="fas fa-cog"></i>
      </a>
      <a href="?controller=admin&action=dashboard/profile" class="settings-btn <?= isActive('profile', $activePage) ?>">
        <i class="fas fa-user"></i>
      </a>
    </nav>
  </div>
</div>
<div class="permbar">
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
      <a href="?controller=vendor&action=dashboard/settings"
        class="settings-btn <?= isActive('settings', $activePage) ?>">
        <i class="fas fa-cog"></i>
      </a>
      <a href="?controller=vendor&action=dashboard/profile"
        class="settings-btn <?= isActive('profile', $activePage) ?>">
        <i class="fas fa-user"></i>
      </a>
    </nav>
  </div>
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
    <nav class="nav-section">
      <a href="?controller=vendor&action=dashboard/orders" class="nav-item <?= isActive('orders', $activePage) ?>">
        Orders
      </a>
      <a href="?controller=vendor&action=dashboard/inventory"
        class="nav-item <?= isActive('inventory', $activePage) ?>">
        Inventory
      </a>
      <a href="?controller=vendor&action=dashboard/analysis" class="nav-item <?= isActive('analysis', $activePage) ?>">
        Analysis
      </a>
      <a href="?controller=vendor&action=dashboard/messages" class="nav-item <?= isActive('messages', $activePage) ?>">
        Messages
      </a>
      <a href="?controller=vendor&action=dashboard/history" class="nav-item <?= isActive('history', $activePage) ?>">
        History
      </a>
    </nav>
    <div class="button-section">
      <a href="?controller=vendor&action=handleLogout" class="btn1">
        <i class="fas fa-sign-out-alt"></i>
        Log Out
      </a>
    </div>
  </div>
</div>
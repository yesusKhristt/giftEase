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
    <nav class="nav-section">
      <a href="?controller=delivery&action=dashboard/home" class="nav-item <?= isActive('home', $activePage) ?>">
        Home
      </a>
      <a href="?controller=delivery&action=dashboard/allOrder"
        class="nav-item <?= isActive('allOrder', $activePage) ?>">
        All Orders
      </a>
      <a href="?controller=delivery&action=dashboard/assignedOrder" class="nav-item <?= isActive('assignedOrder', $activePage) ?>">
        Assigned Order
      </a>
      <a href="?controller=delivery&action=dashboard/map" class="nav-item <?= isActive('map', $activePage) ?>">
        Map
      </a>
      <a href="?controller=delivery&action=dashboard/history" class="nav-item <?= isActive('history', $activePage) ?>">
        History
      </a>
      <a href="?controller=delivery&action=dashboard/proof" class="nav-item <?= isActive('proof', $activePage) ?>">
        Proof
      </a>
    </nav>
    <div class="button-section">
      <a href="?controller=delivery&action=handleLogout" class="btn1">
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
      <a href="?controller=delivery&action=dashboard/settings"
        class="settings-btn <?= isActive('settings', $activePage) ?>">
        <i class="fas fa-cog"></i>
      </a>
      <a href="?controller=delivery&action=dashboard/profile" class="settings-btn <?= isActive('profile', $activePage) ?>">
        <i class="fas fa-user"></i>
      </a>
    </nav>
  </div>
</div>
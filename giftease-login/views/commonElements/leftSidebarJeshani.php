<div class="permbar">
  <div class="left_sidebar">
    <!-- Logo -->
    <div class="logo">
      <img src="resources/iconL.png" class="logo_img">
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
      <a href="?controller=giftWrapper&action=dashboard/overview"
        class="nav-item <?= isActive('overview', $activePage) ?>">
        Overview
      </a>
      <a href="?controller=giftWrapper&action=dashboard/allOrder"
        class="nav-item <?= isActive('allOrder', $activePage) ?>">
        All Orders
      </a>
      <a href="?controller=giftWrapper&action=dashboard/assignedOrder"
        class="nav-item <?= isActive('assignedOrder', $activePage) ?>">
        Assigned Order
      </a>
      <a href="?controller=giftWrapper&action=dashboard/service"
        class="nav-item <?= isActive('service', $activePage) ?>">
        Service
      </a>
      
      <a href="?controller=giftWrapper&action=dashboard/history"
        class="nav-item <?= isActive('history', $activePage) ?>">
        History
      </a>
      

    </nav>
    <div class="button-section">
      <a href="?controller=giftWrapper&action=handleLogout" class="btn1">
        <i class="fas fa-sign-out-alt"></i>
        Log Out
      </a>
    </div>
  </div>
  <div class="topbar-container">
    <div class="gift-fall-layer"></div>
    <div class="topbar-ui">
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
        <a href="?controller=giftWrapper&action=dashboard/settings"
          class="settings-btn <?= isActive('settings', $activePage) ?>">
          <i class="fas fa-cog"></i>
        </a>
        <a href="?controller=giftWrapper&action=dashboard/profile"
          class="settings-btn <?= isActive('profile', $activePage) ?>">
          <i class="fas fa-user"></i>
        </a>
      </nav>
    </div>
  </div>
  <script src="public/main.js"></script>
</div>
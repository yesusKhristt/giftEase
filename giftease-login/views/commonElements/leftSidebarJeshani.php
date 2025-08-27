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
    <nav class="nav-section">
      <a href="?action=dashboard&type=giftWrapper&level=analytics"
        class="nav-item <?= isActive('analytics', $activePage) ?>">
        Analytics
      </a>
      <a href="?action=dashboard&type=giftWrapper&level=earnings"
        class="nav-item <?= isActive('earnings', $activePage) ?>">
        Earning
      </a>
      <a href="?action=dashboard&type=giftWrapper&level=order" class="nav-item <?= isActive('order', $activePage) ?>">
        Order
      </a>
      <a href="?action=dashboard&type=giftWrapper&level=overview"
        class="nav-item <?= isActive('overview', $activePage) ?>">
        Overview
      </a>
      <a href="?action=dashboard&type=giftWrapper&level=portfolio"
        class="nav-item <?= isActive('portfolio', $activePage) ?>">
        Portfolio
      </a>
      <a href="?action=dashboard&type=giftWrapper&level=service"
        class="nav-item <?= isActive('service', $activePage) ?>">
        Service
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
      <a href="?action=dashboard&type=giftWrapper&level=settings"
        class="settings-btn <?= isActive('settings', $activePage) ?>">
        <i class="fas fa-cog"></i>
      </a>
      <a href="?action=dashboard&type=giftWrapper&level=profile"
        class="settings-btn <?= isActive('profile', $activePage) ?>">
        <i class="fas fa-user"></i>
      </a>
    </nav>
  </div>
</div>
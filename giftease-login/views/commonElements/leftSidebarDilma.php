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
      <a href="?controller=client&action=dashboard/items" class="nav-item <?= isActive('items', $activePage) ?>">
        Browse Items
      </a>
      <a href="?controller=client&action=dashboard/cart" class="nav-item <?= isActive('cart', $activePage) ?>">
        Cart
      </a>
      <a href="?controller=client&action=dashboard/wishlist" class="nav-item <?= isActive('whishlist', $activePage) ?>">
        Wishlist
      </a>
      <a href="?controller=client&action=dashboard/tracking" class="nav-item <?= isActive('tracking', $activePage) ?>">
        Track Order
      </a>
      <a href="?controller=client&action=dashboard/history" class="nav-item <?= isActive('history', $activePage) ?>">
        Order History
      </a>
      <a href="?controller=client&action=dashboard/customize"
        class="nav-item <?= isActive('customize', $activePage) ?>">
        Customize Items
      </a>
      <a href="?controller=client&action=dashboard/payment" class="nav-item <?= isActive('payment', $activePage) ?>">
        Payment
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
      <a href="?controller=client&action=dashboard/settings"
        class="settings-btn <?= isActive('settings', $activePage) ?>">
        <i class="fas fa-cog"></i>
      </a>
      <a href="?controller=client&action=dashboard/account" class="settings-btn <?= isActive('account', $activePage) ?>">
        <i class="fas fa-user"></i>
      </a>
    </nav>
  </div>
</div>
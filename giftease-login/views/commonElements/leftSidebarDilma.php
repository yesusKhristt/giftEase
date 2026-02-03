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
    function isActive($pageName, $activePage) {
      return $pageName === $activePage ? 'active' : '';
    }
    ?>
    <nav class="nav-section">
      <a href="?controller=client&action=dashboard/items" class="nav-item <?= isActive('items', $activePage) ?>">
        Browse Items
      </a>
      <a href="?controller=client&action=dashboard/messeges/vendor/view" class="nav-item <?= isActive('messeges', $activePage) ?>">
        Messeges
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
      <a href="?controller=client&action=dashboard/payment" class="nav-item <?= isActive('payment', $activePage) ?>">
        Payment
      </a>
    </nav>
    <div class="button-section">
      <a href="?controller=client&action=handleLogout" class="btn1">
        <i class="fas fa-sign-out-alt"></i>
        Log Out
      </a>
    </div>
  </div>

  <div class="topbar-container">
    <div class="falling-gifts">
    </div>
    <!-- Search Bar -->
    <div class="search-bar">
      <input type="text" class="search-input" placeholder="Search...." />
    </div>

    <div class="gift">
      gift<span class="Ease">Ease
      </span>
    </div>

    <!-- Right Side Links/Buttons -->
    <nav class="topbar-actions">
      <a href="?controller=client&action=dashboard/cart"
        class="settings-btn <?= isActive('cart', $activePage) ?>">
        <i class="fas fa-shopping-cart"></i>
      </a>
      <a href="?controller=client&action=dashboard/notifications"
        class="settings-btn <?= isActive('settings', $activePage) ?>">
        <i class="fas fa-bell"></i>
      </a>
      <a href="?controller=client&action=dashboard/account"
        class="settings-btn <?= isActive('account', $activePage) ?>">
        <i class="fas fa-user"></i>
      </a>
    </nav>
  </div>
</div>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    console.log("✓ main.js loaded");

    const giftLayer = document.querySelector(".falling-gifts");
    if (!giftLayer) return;

    const giftImages = [
      "resources/1.png",
      "resources/2.png",
      "resources/3.png",
      "resources/4.png",
      "resources/5.png"
    ];

    setInterval(() => {
      const gift = document.createElement("img");
      gift.className = "gift-emoji";
      gift.src = giftImages[Math.floor(Math.random() * giftImages.length)];
      gift.alt = "Gift";

      gift.style.left = Math.random() * 100 + "%";
      gift.style.width = Math.random() * 35 + 25 + "px";
      gift.style.height = "auto";
      gift.style.animationDuration = Math.random() * 10 + "s";

      // 🎯 RANDOM START ROTATION
      const startRotation = Math.random() * 360;
      gift.style.setProperty("--start-rot", `${startRotation}deg`);

      giftLayer.appendChild(gift);

      gift.addEventListener("animationend", () => gift.remove());
    }, 500);
  });
</script>
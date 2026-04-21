<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<div class="permbar">
  <div class="left_sidebar">
    <div class="logo">
      <img src="resources/iconL.png" class="logo_img">
      <div class="gift">
        gift<span class="Ease">Ease
        </span>
      </div>
    </div>

    <?php
    function isActiveDeliveryman($pageName, $activePage)
    {
      return $pageName === $activePage ? 'active' : '';
    }
    ?>

    <nav class="nav-section">
      <a href="?controller=deliveryman&action=dashboard/home" class="nav-item <?= isActiveDeliveryman('home', $activePage) ?>">
        Home
      </a>
      <a href="?controller=deliveryman&action=dashboard/available" class="nav-item <?= isActiveDeliveryman('available', $activePage) ?>">
        Available Tasks
      </a>
      <a href="?controller=deliveryman&action=dashboard/myTasks" class="nav-item <?= isActiveDeliveryman('myTasks', $activePage) ?>">
        My Tasks
      </a>
      <a href="?controller=deliveryman&action=dashboard/history" class="nav-item <?= isActiveDeliveryman('history', $activePage) ?>">
        History
      </a>
    </nav>

    <div class="button-section">
      <a href="?controller=deliveryman&action=handleLogout" class="btn1">
        <i class="fas fa-sign-out-alt"></i>
        Log Out
      </a>
    </div>
  </div>

  <div class="topbar-container">
    <div class="gift-fall-layer"></div>


    <div class="gift">
      gift<span class="Ease">Ease
      </span>
    </div>

    <nav class="topbar-actions">
      <a href="?controller=deliveryman&action=dashboard/profile" class="settings-btn <?= isActiveDeliveryman('profile', $activePage) ?>">
        <i class="fas fa-user"></i>
      </a>
    </nav>
  
  </div>
</div>
<script src="public/main.js"></script>

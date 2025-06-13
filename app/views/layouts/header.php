<!-- Header CSS -->
<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/header.css?v=<?= time() ?>">
<header class="header">
  <nav class="navbar">
    <div class="navbar-container">
      <!-- Logo diamond -->
      <div class="navbar-brand">
        <a href="<?= $this->configs->config['basePath'] ?>">
          <img src="<?= $this->configs->config['pathAssets'] ?>icon/diamond_logo_small.png" alt="Diamond Hotel">
        </a>
      </div>

      <!-- content  chính -->
      <div class="navbar-menu">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="<?= $this->configs->config['basePath'] ?>" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="<?= $this->configs->config['basePath'] ?>listroom" class="nav-link">Rooms</a>
          </li>
          <li class="nav-item">
            <a href="<?= $this->configs->config['basePath'] ?>about" class="nav-link">Our services</a>
          </li>
          <li class="nav-item">
            <a href="<?= $this->configs->config['basePath'] ?>contact" class="nav-link">Contact us</a>
          </li>
        </ul>
      </div>

      <!-- Phần đăng nhập-->
      <div class="btn btn-login">
        <img class='user_icon' src="<?= $this->configs->config['pathAssets'] ?>icon/User.png" alt="Diamond Hotel">
        <a class='content_btn' href="<?= $this->configs->config['basePath'] ?>login">LOGIN</a>
      </div>
    </div>
  </nav>
</header>

<!-- Header JS -->
<script src="<?= $this->configs->config['pathAssets'] ?>js/header.js?v=<?= time() ?>"></script>
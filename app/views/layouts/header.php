<!-- Header CSS -->
<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/header.css?v=<?= time() ?>">
<header class="header">
    <nav class="navbar">
        <div class="navbar-container">
            <!-- Logo diamond -->
            <div class="navbar-brand">
                <a href="<?= $this->configs->config['basePath'] ?>">
                    <img src="<?= $this->configs->config['pathAssets'] ?>icon/diamond_logo_small.png"
                        alt="Diamond Hotel">
                </a>
            </div>

            <!-- content  chính -->
            <div class="navbar-menu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="<?= $this->configs->config['basePath'] ?>" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $this->configs->config['basePath'] ?>/listroom" class="nav-link">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $this->configs->config['basePath'] ?>/services" class="nav-link">Our services</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $this->configs->config['basePath'] ?>/contact" class="nav-link">Contact us</a>
                    </li>
                </ul>
            </div>


            <!-- Phần đăng nhập-->
            <div class="btn btn-login">
                <img class='user_icon' src="<?= $this->configs->config['pathAssets'] ?>icon/User.png"
                    alt="Diamond Hotel">
                <a class='content_btn'
                    href="<?= $this->configs->config['basePath'] ?>/login"><?php echo isset($_SESSION["user_name"]) ? $_SESSION['user_name'] : 'LOGIN' ?></a>
            </div>
        </div>
    </nav>
</header>

<!-- Popup Login -->
<div id="loginPopup" class="login-popup" style="display:none;">
    <div class="login-popup-content">
        <div class="login-popup-header">
            <?php if (isset($_SESSION["user_id"])) { ?>
                <div class="login-popup-avatar"
                    style="background-image: url('<?= $this->configs->config['pathAssets'] ?>/img/user/avatar.jpg')"></div>
            <?php } ?>
            <button class="login-popup-close" id="closeLoginPopup">&times;</button>
            <?php if (!isset($_SESSION["user_id"])) { ?>
                <a href="<?= $this->configs->config['basePath'] ?>/login" class="login-popup-signup nav-link">LOGIN</a>
            <?php } ?>
            <?php if (!isset($_SESSION["user_id"])) { ?>
                <div class="login-popup-login-link">
                    Don't have an account?
                    <a href="<?= $this->configs->config['basePath'] ?>/regis" id="registerLink">sign up</a>
                </div>
            <?php } ?>
            <?php if (isset($_SESSION["user_id"])) { ?>
                <div class="login-popup-info">
                    <div class="login-popup-username">
                        <?= htmlspecialchars($_SESSION["user_name"] ?? '') ?>
                    </div>
                    <div class="login-popup-email">
                        <?= htmlspecialchars($_SESSION["user_email"] ?? '') ?>
                    </div>
                </div>
            <?php } ?>

        </div>
        <div class="login-popup-menu">
            <div class="login-popup-item"> <img src="<?= $this->configs->config['pathAssets'] ?>icon/popup-user.png"
                    alt="Diamond Hotel">
                <a href="<?= $this->configs->config['basePath'] ?>/user" class="nav-link-btn">
                    User
                </a>
            </div>
            <div class="login-popup-item"> <img
                    src="<?= $this->configs->config['pathAssets'] ?>icon/popup-transaction.png" alt="Diamond Hotel">
                <a href="<?= $this->configs->config['basePath'] ?>/user/transactions" class="nav-link-btn">
                    Transaction
                </a>
            </div>
            <div class="login-popup-item"> <img
                    src="<?= $this->configs->config['pathAssets'] ?>icon/popup-reservation.png" alt="Diamond Hotel">
                <a href="<?= $this->configs->config['basePath'] ?>/user/reservations" class="nav-link-btn">
                    My reservation
                </a>
            </div>
            <div class="login-popup-item"> <img src="<?= $this->configs->config['pathAssets'] ?>icon/popup-history.png"
                    alt="Diamond Hotel">
                <a href="<?= $this->configs->config['basePath'] ?>/user/histories" class="nav-link-btn">
                    My booking history
                </a>
            </div>
            <?php if (isset($_SESSION["user_id"])) { ?>
                <a class="login-popup-item" href="<?= $this->configs->config['basePath'] ?>/logout">
                    <img src="<?= $this->configs->config['pathAssets'] ?>icon/popup-logout.png" alt="Diamond Hotel">Log out
                </a>
            <?php } ?>
        </div>

    </div>

</div>



<!-- End Popup Login -->

<!-- Header JS -->
<script src="<?= $this->configs->config['pathAssets'] ?>js/header.js?v=<?= time() ?>"></script>
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
                        <a href="<?= $this->configs->config['basePath'] ?>listroom" class="nav-link">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $this->configs->config['basePath'] ?>" class="nav-link">Our services</a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $this->configs->config['basePath'] ?>contact" class="nav-link">Contact us</a>
                    </li>
                </ul>
            </div>


            <<<<<<< HEAD <!-- Phần đăng nhập-->
                <div class="btn btn-login">
                    <img class='user_icon' src="<?= $this->configs->config['pathAssets'] ?>icon/User.png"
                        alt="Diamond Hotel">
                    <a class='content_btn'
                        href="<?= $this->configs->config['basePath'] ?>/login"><?php echo isset($_SESSION["user_name"]) ? $_SESSION['user_name'] : 'LOGIN' ?></a>
                    =======
                    <!-- Phần đăng nhập-->
                    >>>>>>> 7cf17bbdc098cf5473fbec5a757026561927fd68

                    <div class="btn btn-login">
                        <img class='user_icon' src="<?= $this->configs->config['pathAssets'] ?>icon/User.png"
                            alt="Diamond Hotel">
                        <a class='content_btn'
                            href="<?= $this->configs->config['basePath'] ?>login"><?php echo isset($_SESSION["user_name"]) ? $_SESSION['user_name'] : 'LOGIN' ?></a>

                    </div>
                </div>
    </nav>
</header>

<!-- Popup Login -->
<div id="loginPopup" class="login-popup" style="display:none;">

    <div class="login-popup-content">
        <div class="login-popup-header">
            <?php if (isset($_SESSION["user_token"])) { ?>
            <div class="login-popup-avatar"
                style="background-image: url('<?= $this->configs->config['pathAssets'] ?>/img/user/avatar.jpg')"></div>
            <?php } ?>
            <?php if (!isset($_SESSION["user_token"])) { ?>
            <button class="login-popup-close" id="closeLoginPopup">&times;</button>
            <a href="<?= $this->configs->config['basePath'] ?>/login" class="login-popup-signup nav-link">LOGIN</a>
            <?php } ?>
            <?php if (!isset($_SESSION["user_token"])) { ?>
            <div class="login-popup-login-link">
                Don't have an account?
                <a href="<?= $this->configs->config['basePath'] ?>/regis" id="registerLink">sign up</a>
            </div>
            <?php } ?>
            <?php if (isset($_SESSION["user_token"])) { ?>
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
                    alt="Diamond Hotel"> User</div>
            <div class="login-popup-item"> <img
                    src="<?= $this->configs->config['pathAssets'] ?>icon/popup-transaction.png" alt="Diamond Hotel">
                Transaction</div>
            <div class="login-popup-item"> <img
                    src="<?= $this->configs->config['pathAssets'] ?>icon/popup-reservation.png" alt="Diamond Hotel"> My
                reservation</div>
            <div class="login-popup-item"> <img src="<?= $this->configs->config['pathAssets'] ?>icon/popup-history.png"
                    alt="Diamond Hotel"> My booking history</div>
            <?php if (isset($_SESSION["user_token"])) { ?>
            <a class="login-popup-item" href="<?= $this->configs->config['basePath'] ?>/logout">
                <img src="<?= $this->configs->config['pathAssets'] ?>icon/popup-logout.png" alt="Diamond Hotel">Log out
            </a>
            <?php } ?>
        </div>

    </div>
    <div class="login-popup-menu">
        <div class="login-popup-item"> <img src="<?= $this->configs->config['pathAssets'] ?>icon/popup-user.png"
                alt="Diamond Hotel"> User</div>
        <div class="login-popup-item"> <img src="<?= $this->configs->config['pathAssets'] ?>icon/popup-transaction.png"
                alt="Diamond Hotel">
            Transaction</div>
        <div class="login-popup-item"> <img src="<?= $this->configs->config['pathAssets'] ?>icon/popup-reservation.png"
                alt="Diamond Hotel"> My
            reservation</div>
        <div class="login-popup-item"> <img src="<?= $this->configs->config['pathAssets'] ?>icon/popup-history.png"
                alt="Diamond Hotel"> My booking history</div>
        <?php if (isset($_SESSION["user_token"])) { ?>
        <a class="login-popup-item" href="<?= $this->configs->config['basePath'] ?>logout">
            <img src="<?= $this->configs->config['pathAssets'] ?>icon/popup-logout.png" alt="Diamond Hotel">Log out
        </a>
        <?php } ?>
    </div>
</div>
</div>


<!-- End Popup Login -->

<!-- Header JS -->
<script src="<?= $this->configs->config['pathAssets'] ?>js/header.js?v=<?= time() ?>"></script>
<?php if (isset($_SESSION["timer"])) {

    $path  = $this->configs->config['basePath'];
    $leftTime = $_SESSION["timer"] - time();

    $leftTime = max(0, ($leftTime - 120) * 1000);
    if ($leftTime > 0) {
        echo " <script>
   setTimeout(function() { 
   checktokenTimer('{$path}')
                            }, " . $leftTime . ")</script>";
    }
} ?>
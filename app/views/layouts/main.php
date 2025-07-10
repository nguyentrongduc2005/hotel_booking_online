<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/hotel_booking_online/public/assets/icon/diamond_logo_small.png" sizes="32x32"
        type="image/png">
    <title>Diamond Hotel</title>
    <link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/style.css?v=<?= time() ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300..700;1,300..700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>

    <!-- <?php
            // Chỉ hiện preloader ở homepage
            $isHome = $_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/hotel_booking_online/public/';
            if ($isHome):
            ?>
        <!-- <div id="preloader" style="background: #111;">
            <div class="preloader-content">
                <div class="preloader-left-text preloader-animate-text">Welcome to<br> our Hotel</div>
                <div class="preloader-bar-wrap">
                    <div class="preloader-bar"></div>
                </div>
                <div class="preloader-right-text preloader-animate-text">Diamond <br> Hotel</div>
            </div>
        </div> -->
<?php endif; ?> -->

<div id="khung">
    <?= $this->renderPartial('layouts/header'); ?>
    <div id="main">
        <?= $content; ?>
    </div>
    <?= $this->renderPartial('layouts/footer'); ?>
</div>
<script src="<?= $this->configs->config['pathAssets'] ?>js/homepage.js?v=<?= time() ?>"></script>
<?php if (isset($_SESSION["timer"])) {

    $path  = $this->configs->config['basePath'];
    $leftTime = $_SESSION["timer"] - time();

    $leftTime = max(0, ($leftTime - 300) * 1000);
    if ($leftTime > 0) {
        echo " <script>
            setTimeout(function() { 
        checktokenTimer('{$path}')
                            }, " . $leftTime . ")</script>";
    }
} ?>
<script>
    window.addEventListener('load', function() {
        const preloader = document.getElementById('preloader');
        // Bắt đầu: text tách ra hai bên
        setTimeout(() => {
            if (preloader) preloader.classList.add('split');
        }, 500);

        // Khi gần hết loading: text thu về giữa và mờ dần
        setTimeout(() => {
            if (preloader) {
                preloader.classList.remove('split');
                preloader.classList.add('unsplit');
            }
        }, 1400);

        // Sau 1.4s: fade out preloader
        setTimeout(() => {
            if (preloader) preloader.classList.add('fadeout');
        }, 1600);

        // Sau 2.2s: ẩn hẳn preloader
        setTimeout(() => {
            if (preloader) preloader.style.display = 'none';
        }, 2400);
    });
</script>

</body>


</html>
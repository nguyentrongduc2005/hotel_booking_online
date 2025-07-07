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

    <?php
    // Chỉ hiện preloader ở homepage
    $isHome = $_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/hotel_booking_online/public/';
    if ($isHome):
    ?>
        <div id="preloader">
            <div class="preloader-capsule">
                <span class="preloader-text">Diamond Hotel</span>
                <div class="preloader-bar"></div>
            </div>
            <div class="preloader-desc">
                Bringing you comfort, joy, and memorable experiences at Diamond Hotel.
            </div>
        </div>
    <?php endif; ?>

    <div id="khung">
        <?= $this->renderPartial('layouts/header'); ?>
        <div id="main">
            <?= $content; ?>
        </div>

        <!-- Hide footer on payment page (do bug quá) -->
        <?php if (!str_contains($_SERVER['REQUEST_URI'], 'payment')): ?>
            <div id="footer">
                <?= $this->renderPartial('layouts/footer'); ?>
            </div>
        <?php endif; ?>
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
        window.addEventListener('DOMContentLoaded', function() {
            const bar = document.querySelector('.preloader-bar');
            const capsule = document.querySelector('.preloader-capsule');
            const text = document.querySelector('.preloader-text');
            const desc = document.querySelector('.preloader-desc');
            const preloader = document.getElementById('preloader');

            if (bar) {
                setTimeout(() => {
                    bar.style.width = '50%';
                }, 200);

                setTimeout(() => {
                    bar.style.width = '100%';
                }, 1100);

                setTimeout(() => {
                    if (capsule) capsule.classList.add('animate-out');
                    if (text) text.classList.add('animate-out');
                    if (desc) desc.classList.add('animate-out');
                    if (preloader) preloader.classList.add('animate-out');
                }, 2000);

                setTimeout(() => {
                    if (preloader) preloader.style.display = 'none';
                }, 3200);
            }
        });
    </script>

</body>


</html>
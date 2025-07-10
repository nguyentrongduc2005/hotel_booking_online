<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/error.css?v=<?= time() ?>" />
</head>

<body>
    <?php
    if ($data['message']) {
        $message = $data['message'];
    } else {
        $message = "Đã xảy ra lỗi không xác định. Vui lòng thử lại sau.";
    }
    ?>
    <div class="error-container">
        <h1>⚠️ An Error Occurred</h1>
        <div class="animation-container">
            <div aria-label="Orange and tan hamster running in a metal wheel" role="img" class="wheel-and-hamster">
                <div class="wheel"></div>
                <div class="hamster">
                    <div class="hamster__body">
                        <div class="hamster__head">
                            <div class="hamster__ear"></div>
                            <div class="hamster__eye"></div>
                            <div class="hamster__nose"></div>
                        </div>
                        <div class="hamster__limb hamster__limb--fr"></div>
                        <div class="hamster__limb hamster__limb--fl"></div>
                        <div class="hamster__limb hamster__limb--br"></div>
                        <div class="hamster__limb hamster__limb--bl"></div>
                        <div class="hamster__tail"></div>
                    </div>
                </div>
                <div class="spoke"></div>
            </div>
        </div>
        <p class="info-error"><?= $message ?></p>
        <p>Go back to the homepage after changing <span class="countdown"><?= $timeout ?></span> seconds...</p>
        <button onclick="redirectNow()">Back</button>
        <div class="sidebar-home">
            <a href="<?= $this->configs->config['basePath'] ?>/" class="sidebar-home-link">

                Về trang chủ
            </a>
        </div>
    </div>

    <script>
        let seconds = <?= $timeout ?>;
        const countdownElem = document.querySelector(".countdown");
        const redirectUrl = "<?= $next ?>";
        console.log(redirectUrl);
        const timer = setInterval(() => {
            seconds--;
            countdownElem.textContent = seconds;
            if (seconds <= 0) {
                clearInterval(timer);
                window.location.href = redirectUrl;
            }
        }, 1000);

        function redirectNow() {
            window.location.href = redirectUrl;
        }
    </script>


</body>

</html>
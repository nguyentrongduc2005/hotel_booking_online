<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Thông báo lỗi</title>
    <style>
        body {
            background-color: #f8d7da;
            color: #721c24;
            font-family: Arial, sans-serif;
            padding: 40px;
            align-items: center;
        }

        .error-box {

            background-color: #f5c6cb;
            padding: 30px;
            border-radius: 10px;
            border: 1px solid #f1aeb5;
            display: inline-block;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 2em;
            margin-bottom: 15px;
        }

        .countdown {
            font-weight: bold;
            color: #721c24;
            font-size: 1.2em;
        }

        button {
            background-color: #721c24;
            color: #fff;
            padding: 10px 20px;
            border: none;
            margin-top: 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #501217;
        }
    </style>
</head>

<body <?php
        if ($data['message']) {
            $message = $data['message'];
        } else {
            $message = "Đã xảy ra lỗi không xác định. Vui lòng thử lại sau.";
        }
        ?> <div class="error-box">
    <h1>⚠️ An Error Occurred</h1>
    <p><?= $message ?></p>
    <p>Trang sẽ chuyển sau <span class="countdown"><?= $timeout ?></span>seconds...</p>
    <button onclick="redirectNow()">Back</button>
    </div>

    <script>
        let seconds = <?= $timeout ?>;
        const countdownElem = document.querySelector(".countdown");
        const redirectUrl = "<?= $next ?>";

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
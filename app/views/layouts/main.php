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

</body>

</html>
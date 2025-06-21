<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amdin</title>
    <link rel="icon" href="/hotel_booking_online/public/assets/icon/diamond_logo_small.png" sizes="32x32">
</head>

<body>
    <?= $this->renderPartial('Adminlayouts/header'); ?>

    <?= $content ?>
    <?= $this->renderPartial('Adminlayouts/sidebar'); ?>
</body>

</html>
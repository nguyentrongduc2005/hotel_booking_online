<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" href="/hotel_booking_online/public/assets/icon/diamond_logo_small.png" sizes="32x32">
</head>

<body>
    <div class="admin-layout">
        <?php $this->renderPartial('AdminLayouts/sidebar'); ?>
        <div class="admin-main">
            <?php $this->renderPartial('AdminLayouts/header'); ?>
            <?= $content ?>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/style.css">
</head>

<body>

    <div id="khung">
        <?= $this->renderPartial('layouts/header'); ?>
        <?= $content; ?>
        <?= $this->renderPartial('layouts/footer'); ?>

    </div>
    <script src="<?= $this->configs->config['pathAssets'] ?>js/home.js"></script>

</body>

</html>
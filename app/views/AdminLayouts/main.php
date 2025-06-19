<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?= $this->renderPartial('Adminlayouts/header'); ?>

    <?= $content ?>
    <?= $this->renderPartial('Adminlayouts/sidebar'); ?>
</body>

</html>
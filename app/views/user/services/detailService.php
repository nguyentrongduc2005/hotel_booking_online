<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/detailServicesRoom.css?v=<?= time() ?>" />=
<div class="gap-after-navbar"></div>
<div class="main-container">
    <div class="center-wrapper">
        <?php if (!empty($data)): ?>
            <img class="ser-pic" src="<?= $this->configs->config['pathAssets'] . $data['Path_img'] ?>" alt="<?= htmlspecialchars($data['name']) ?>">
            <div class="text-container">
                <h1><?= htmlspecialchars($data['name']) ?></h1>
                <p><?= htmlspecialchars($data['description']) ?></p>
            </div>
        <?php else: ?>
            <div class="text-container">
                <h1>Service Not Found</h1>
                <p>The requested service could not be found.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
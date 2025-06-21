<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/services.css?v=<?= time() ?>" />
    <div class="services-container">
        <!-- Grid layout 3x2 -->
        <div class="services-grid">
            <?php if (!empty($data)): ?>
                <?php foreach ($data as $service): ?>
                    <div class="service-item">
                        <a href="/hotel_booking_online/public/services/<?= $service['slug']?>" class="service-link">
                            <div class="service-image-container">
                                <img src="<?= $this->configs->config['pathAssets'] . $service['Path_img'] ?>" alt="<?= htmlspecialchars($service['name']) ?>" class="service-image">
                            </div>
                            <div class="service-info">
                                <h3><?= htmlspecialchars($service['name']) ?></h3>
                                <p><?= htmlspecialchars($service['description']) ?></p>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No services available at the moment.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>

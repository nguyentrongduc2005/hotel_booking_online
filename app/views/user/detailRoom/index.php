    <link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/detailRoom.css?v=<?= time() ?>" />
    <main class="room-details">
        <div class="left-info">

            <div class="main-image placeholder-16-9">
                <img src="<?= $this->configs->config['pathAssets'] . $data['thumb'] ?>"
                    alt="<?= $data['name_type_room'] ?>" />
            </div>
            <h1><?= $data['name'] ?></h1>
            <p class="desc">
                <?= $data['description'] ?>
                <?= $data['description_room_type'] ?>

            <h3>About this property</h3>
            <?php if (!empty($data['amenities'])): ?>
                <?php foreach ($data['amenities'] as $amenity): ?>

                    <li><span> <?= $amenity['description'] ?></span></li>

                <?php endforeach; ?>
            <?php endif; ?>
            </p>

        </div>
        <div class="right-info">
            <div class="image-gallery">
                <?php
                $images = !empty($data['images']) ? $data['images'] : [];
                $num_images = count($images);

                for ($i = 1; $i < 5; $i++) {
                ?>
                    <div class="gallery-img placeholder-1-1 <?= ($i < $num_images) ? '' : 'gallery-empty'; ?>">
                        <?php if ($i < $num_images): ?>
                            <img src="<?= $this->configs->config['pathAssets'] . $images[$i] ?>" alt="Room image">
                        <?php endif; ?>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="price-book">
                <p>From <strong>$<?= number_format($data['price'], 2) ?>/night</strong></p>
                <button class="book-btn">BOOK NOW</button>
            </div>
            <p> <?php $data['description']  ?> </p>
            <div class="amenities">
                <h1>Amenities</h1>
                <ul>
                    <?php if (!empty($data['amenities'])): ?>
                        <?php foreach ($data['amenities'] as $amenity): ?>
                            <li> <i class="icon-amenity"></i> <?= $amenity['name'] ?></li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </main>
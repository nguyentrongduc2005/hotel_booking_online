<div style="padding-top: 200px;">
  <button>123434444555121321</button>
<h2>Danh sách phòng</h2>
<?php foreach ($rooms as $rooms): ?>
    <div style="border: 1px solid #ccc; margin-bottom: 10px; padding: 10px;">
        <h3><?= $room['name'] ?> (<?= $room['name_type_room'] ?>)</h3>
        <p>Giá: <?= $room['price'] ?> USD</p>
        <p>Mô tả: <?= $room['description'] ?></p>
    </div>
<?php endforeach; ?>

</div>
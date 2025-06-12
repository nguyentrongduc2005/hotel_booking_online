<div id="right">exp</div>
<div id="center">content</div>
<h2>Danh sách các phòng</h2>

<?php if (!empty($rooms)) : ?>
    <ul>
        <?php foreach ($rooms as $room) : ?>
            <li>
                <a href="?controller=detailroom&action=detail&id=<?= $room['id_room'] ?>">
                    <?= htmlspecialchars($room['name']) ?> - <?= number_format($room['price']) ?> VND
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>Không có phòng nào.</p>
<?php endif; ?>

<?php if (!empty($roomDetail)) : ?>
    <h3>Chi tiết phòng: <?= htmlspecialchars($roomDetail['name']) ?></h3>
    <p>Giá: <?= number_format($roomDetail['price']) ?> VND</p>
    <p>Sức chứa: <?= $roomDetail['capacity'] ?></p>
    <p>Mô tả: <?= htmlspecialchars($roomDetail['description']) ?></p>
<?php endif; ?>

<p>footer</p>



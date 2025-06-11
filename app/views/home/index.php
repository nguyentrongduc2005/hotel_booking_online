<div id="right">exp</div>
<div id="center">content</div>

<h2>Danh sách phòng</h2>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Tên phòng</th>
        <th>Slug</th>
        <th>Sức chứa</th>
        <th>Số giường</th>
        <th>Giá</th>
        <th>Tầng</th>
        <th>Trạng thái</th>
        <th>Ngày tạo</th>
        <th>Mô tả</th>
        <th>Diện tích</th>
        <th>ID Loại phòng</th>
    </tr>
    <?php foreach ($rooms as $room): ?>
        <tr>
            <td><?= $room['id_room'] ?></td>
            <td><?= $room['name'] ?></td>
            <td><?= $room['slug'] ?></td>
            <td><?= $room['capacity'] ?></td>
            <td><?= $room['amount_bed'] ?></td>
            <td><?= $room['price'] ?> VND</td>
            <td><?= $room['floor_number'] ?></td>
            <td><?= $room['status'] ?></td>
            <td><?= $room['created_at'] ?></td>
            <td><?= $room['description'] ?></td>
            <td><?= $room['area'] ?> m²</td>
            <td><?= $room['id_room_type'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

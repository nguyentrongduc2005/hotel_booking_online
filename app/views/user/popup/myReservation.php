<style>
.center-form {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 200px;
}
</style>

<div class="center-form">
    <form action="/hotel_booking_online/public/user/reservations" method="POST">
        <label for="cccd">CCCD:</label>
        <input type="text" id="cccd" name="cccd" required pattern="\d{12}" maxlength="12" placeholder="Nhập số CCCD">
        <button type="submit">Gửi</button>
    </form>
</div>


<?php if (!empty($data) && is_array($data)): ?>
<div style="margin-top: 30px;">
    <h3>Thông tin đặt phòng</h3>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>ID Đặt phòng</th>
                <th>Phòng</th>
                <th>Ngày nhận</th>
                <th>Ngày trả</th>
                <th>Trạng thái nhận</th>
                <th>Trạng thái trả</th>
                <th>Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data as $reservation): ?>
            <tr>
                <td><?php echo htmlspecialchars($reservation['id_booking']); ?></td>
                <td><?php echo htmlspecialchars($reservation['name']); ?></td>
                <td><?php echo htmlspecialchars($reservation['check_in']); ?></td>
                <td><?php echo htmlspecialchars($reservation['check_out']); ?></td>
                <td><?php echo htmlspecialchars($reservation['status_checkin']); ?></td>
                <td><?php echo htmlspecialchars($reservation['status_checkout']); ?></td>
                <td><?php echo htmlspecialchars($reservation['status']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php elseif (isset($data)): ?>
<div style="margin-top: 30px; color: red;">Không tìm thấy thông tin đặt phòng.</div>
<?php endif; ?>
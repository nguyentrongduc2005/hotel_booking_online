<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/dashboard.css?v=<?= time() ?>">

<div class="dashboard-container">
  <div class="dashboard-checkin-bookings">
        <div class="dashboard-title">Check-in</div>
        <div class="dashboard-table-wrapper">
          <table class="dashboard-table">
            <thead>
              <tr>
                <th>Guest Name</th>
                <th>ID Room</th>
                <th>Room</th>
                <th>Estimated Check-in</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php if (!empty($checkinToday)): ?>
                <?php foreach ($checkinToday as $booking): ?>
                  <tr data-id-booking="<?= htmlspecialchars($booking['id_booking']) ?>">
                    <td>
                      <?= htmlspecialchars($booking['full_name_user'] ?? $booking['full_name_guest'] ?? 'Unknown') ?>
                    </td>
                    <td><?= htmlspecialchars($booking['id_room'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($booking['room_slug'] ?? '-') ?></td>
                    <td><?= htmlspecialchars(date('d/m/Y', strtotime($booking['check_in']))) ?></td>
                    <td>
                      <button class="btn-action-checkin" data-id="<?= htmlspecialchars($booking['id_booking']) ?>">Confirm</button>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php else: ?>
                <tr>
                  <td colspan="5" style="text-align: center; color: #888;">No check-ins scheduled for today</td>
                </tr>
              <?php endif; ?>
            </tbody>
          </table>
        </div>
      </div>
</div>

<script>
  window.BASE_PATH = '<?= $this->configs->config["basePath"] ?? "" ?>';
</script>
<script src="<?= $this->configs->config['pathAssets'] ?>js/checkin.js?v=<?= time() ?>"></script>

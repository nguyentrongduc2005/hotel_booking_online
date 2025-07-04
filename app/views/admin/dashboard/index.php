<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/dashboard.css?v=<?= time() ?>">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="dashboard-container">
    <div class="dashboard-status-row">
      <div class="dashboard-status-card">
        <div class="dashboard-status-number" style="color:#b08d4a;"><?= $total ?? 0 ?></div>
        <div class="dashboard-status-label">Totals</div>
      </div>
      <div class="dashboard-status-card">
        <div class="dashboard-status-number" style="color:#b06a7a;"><?= $maintenance ?? 0 ?></div>
        <div class="dashboard-status-label">Blocked</div>
      </div>
      <div class="dashboard-status-card">
        <div class="dashboard-status-number" style="color:#3a8d5c;"><?= $available ?? 0 ?></div>
        <div class="dashboard-status-label">Available</div>
      </div>
      <div class="dashboard-status-card dashboard-status-flow">
        <div class="dashboard-status-flow-title">Guest Flow Today</div>
        <div class="dashboard-status-flow-boxes">
          <div class="dashboard-status-flow-box">
            <div class="dashboard-status-flow-label">Check-in</div>
            <div class="dashboard-status-flow-number"><?= $checkin ?? 0 ?></div>
          </div>
          <div class="dashboard-status-flow-box">
            <div class="dashboard-status-flow-label">Check-out</div>
            <div class="dashboard-status-flow-number"><?= $checkout ?? 0 ?></div>
          </div>
        </div>
      </div>
      <div class="dashboard-status-card dashboard-status-booking">
        <div class="dashboard-status-booking-title">Booking</div>
        <div class="dashboard-status-flow-box">
          <div class="dashboard-status-flow-label">Total Bookings Today</div>
          <div class="dashboard-status-flow-number"><?= $bookingToday ?? 0 ?></div>
        </div>
      </div>
    </div>

    <!-- Latest Bookings -->
    <div class="dashboard-pendingbookings">
      <div class="dashboard-title">Pending Bookings</div>
      <div class="dashboard-table-wrapper">
        <table class="dashboard-table">
          <thead>
            <tr>
              <th>Guest Name</th>
              <th>ID Room</th>
              <th>Check-in</th>
              <th>Check-out</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($listBooking as $booking): ?>
              <tr data-id-booking="<?= htmlspecialchars($booking['id_booking']) ?>">
                <td>
                  <?= htmlspecialchars($booking['full_name_user'] ?? $booking['full_name_guest'] ?? 'Unknown') ?>
                </td>
                <td><?= htmlspecialchars($booking['id_room'] ?? '-') ?></td>
                <td><?= htmlspecialchars(date('d/m/Y', strtotime($booking['check_in']))) ?></td>
                <td><?= htmlspecialchars(date('d/m/Y', strtotime($booking['check_out']))) ?></td>
                <td>
                  <span class="dashboard-action dashboard-action-accept"><i class="fa fa-check"></i></span>
                  <span class="dashboard-action dashboard-action-reject"><i class="fa fa-times"></i></span>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
</div>

<script>window.BASE_PATH = '<?= $this->configs->config["basePath"] ?? "" ?>';</script>
<script src="<?= $this->configs->config['pathAssets'] ?>js/dashboard.js?v=<?= time() ?>"></script>


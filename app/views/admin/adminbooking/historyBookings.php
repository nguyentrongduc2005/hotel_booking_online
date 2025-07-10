<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/dashboard.css?v=<?= time() ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


<div class="dashboard-container">
  <div class="dashboard-all-bookings">
    <div class="dashboard-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
      <div class="dashboard-title">History Bookings</div>
      <div class="dashboard-actions" style="display: flex; gap: 8px; align-items: center;">
        <!-- search bar căn phải nhỏ nhỏ vì t chỉnh width cho dài ra giống trong figma nhưng mà css qua lại nó vẫn lệch nên để nhỏ nha-->
        <form class="search-bar" method="get" style="display: flex; align-items: center;">
          <input type="text" class="search-bar" name="guest_name" placeholder="Search by guest name..." value="<?= htmlspecialchars($_GET['guest_name'] ?? '') ?>">
          <button type="submit" style="background: none; border: none; cursor: pointer; margin-left: 4px;"><i class="fa fa-search"></i></button>
        </form>
        <button class="filter-btn" style="background: none; border: none; cursor: pointer; font-size: 18px;" title="Filter" onclick="openFilterModal()">
          <i class="fa fa-filter"></i>
        </button>
      </div>
    </div>
    <div class="dashboard-table-wrapper">
      <table class="dashboard-table">
        <thead>
          <tr>
            <th>Booking ID</th>
            <th>Name</th>
            <th>Room ID</th>
            <th>Room</th>
            <th>Check-in</th>
            <th>Check-out</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (!empty($historyBookings)): ?>
            <?php foreach ($historyBookings as $booking): ?>
              <tr>
                <td><?= htmlspecialchars($booking['id_booking'] ?? $booking['id_history'] ?? '') ?></td>
                <td><?php
                  $name = $booking['user_name'] ?? null;
                  if (empty($name)) $name = $booking['guest_name'] ?? '';
                  if (empty($name) && !empty($booking['user_name'])) $name = $booking['user_name'];
                  echo htmlspecialchars($name);
                ?></td>
                <td><?= htmlspecialchars($booking['id_room'] ?? '') ?></td>
                <td><?= htmlspecialchars($booking['room_name'] ?? '') ?></td>
                <td><?= htmlspecialchars($booking['check_in'] ?? $booking['checkin'] ?? '') ?></td>
                <td><?= htmlspecialchars($booking['check_out'] ?? $booking['checkout'] ?? '') ?></td>
                <td>
                  <?php
                    $status = $booking['status'] ?? '';
                    if ($status === 'pending') {
                      echo '<p style="color: gray;">Pending</p>';
                    } elseif ($status === 'confirmed') {
                      echo '<p style="color: green;">Confirmed</p>';
                    } elseif ($status === 'cancelled') {
                      echo '<p style="color: red;">Cancelled</p>';
                    } elseif ($status === 'completed') {
                      echo '<p style="color: darkgreen;">Completed</p>';
                    } else {
                      echo htmlspecialchars($status);
                    }
                  ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="8" style="text-align:center;">No bookings found.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Popup Filter Modal    -->
<div id="filterModal" class="modal-filter" style="display:none;">
  <div class="modal-filter-content">
    <span class="close-filter" onclick="closeFilterModal()">&times;</span>
    <h3 class="filter-title">Filter Bookings</h3>
    <form method="get" class="filter-form">
      <div class="form-group">
        <label class="form-filter">Guest Name</label>
        <input type="text" name="guest_name" value="<?= htmlspecialchars($_GET['guest_name'] ?? '') ?>">
      </div>
      <div class="form-group">
        <label class="form-filter">Room ID</label>
        <input type="text" name="room_id" value="<?= htmlspecialchars($_GET['room_id'] ?? '') ?>">
      </div>
      <div class="form-group">
        <label class="form-filter">Room Number</label>
        <input type="text" name="room_number" value="<?= htmlspecialchars($_GET['room_number'] ?? '') ?>">
      </div>
      <div class="form-group">
        <label class="form-filter">Check-in Date</label>
        <input type="date" name="check_in" value="<?= htmlspecialchars($_GET['check_in'] ?? '') ?>">
      </div>
      <div class="form-group">
        <label class="form-filter">Check-out Date</label>
        <input type="date" name="check_out" value="<?= htmlspecialchars($_GET['check_out'] ?? '') ?>">
      </div>
      <div style="margin-top: 16px; text-align: center;">
        <button type="submit" class="btn btn-filter">Filter</button>
      </div>
    </form>
  </div>
</div>

<script>
  function openFilterModal() {
    document.getElementById('filterModal').style.display = 'flex';
  }
  function closeFilterModal() {
    document.getElementById('filterModal').style.display = 'none';
  }
  window.BASE_PATH = '<?= $this->configs->config["basePath"] ?? "" ?>';
</script>

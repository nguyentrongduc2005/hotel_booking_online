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
              <tr>
                <td>John Doe</td>
                <td>101</td>
                <td>Deluxe Room</td>
                <td>2025-07-01</td>
                <td><button class="btn-action-checkin">Confirm</button></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
</div>

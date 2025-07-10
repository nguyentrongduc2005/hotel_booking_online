<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/dashboard.css?v=<?= time() ?>">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="dashboard-container">
  <div class="dashboard-all-bookings">
    <div class="dashboard-header"
      style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px;">
      <div class="dashboard-title">All Transactions</div>
      <div class="dashboard-actions" style="display: flex; gap: 8px; align-items: center;">
        <form class="dashboard-search-form" method="get"
          action="<?= $this->configs->config['basePath'] ?? '' ?>/admin/transactions"
          style="display: flex; align-items: center;">
          <div class="search-bar-wrapper">
            <span class="search-icon"><i class="fa fa-search"></i></span>
            <input type="text" class="dashboard-search-input" name="search"
              placeholder="Search by name..." value="<?= htmlspecialchars($search ?? '') ?>">
          </div>
        </form>
      </div>
    </div>
    <div class="dashboard-table-wrapper">
      <table class="dashboard-table">
        <thead>
          <tr>
            <th>Transaction ID</th>
            <th>Booking ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Total</th>
            <th>Payment Method</th>
            <th>Payment Status</th>
          </tr>
        </thead>
        <tbody>

          <?php if (!empty($transactions)): ?>
            <?php foreach ($transactions as $tran): ?>
              <?php if (!empty($tran['id_booking'])): ?>
                <tr>
                  <td><?= htmlspecialchars($tran['transaction_id'] ?? '') ?></td>
                  <td><?= htmlspecialchars($tran['id_booking'] ?? '') ?></td>
                  <td><?= htmlspecialchars($tran['user']['name'] ?? '') ?></td>
                  <td><?= htmlspecialchars($tran['user']['email'] ?? '') ?></td>
                  <td><?= htmlspecialchars($tran['total_amount'] ?? '') ?></td>
                  <td><?= htmlspecialchars($tran['payment_method'] ?? '') ?></td>
                  <td>
                    <?php
                      $status = $tran['payment_status'] ?? '';
                      if ($status === 'pending') {
                        echo '<p style="color: gray;">Pending</p>';
                      } elseif ($status === 'refunded') {
                        echo '<p style="color: orange;">Refunded</p>';
                      } elseif ($status === 'cancelled') {
                        echo '<p style="color: red;">Cancelled</p>';
                      } elseif ($status === 'completed') {
                        echo '<p style="color: darkgreen;">Completed</p>';
                      } elseif ($status == 'failed') {
                        echo '<p style="color: red;">Failed</p>';
                      } else {
                        echo htmlspecialchars($status);
                      }
                    ?>
                  </td>
                </tr>
              <?php endif; ?>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" style="text-align:center;">No transactions.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
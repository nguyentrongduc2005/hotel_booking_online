<?php
// Đảm bảo biến $transactions nhận dữ liệu từ backend (tương thích với renderPartial)
if (!isset($transactions) && isset($data)) {
  $transactions = $data;
} elseif (!isset($transactions)) {
  $transactions = [];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Transaction Popup</title>
  <link rel="stylesheet"
    href="<?php echo $this->configs->config['pathAssets']; ?>css/transaction.css?v=<?php echo time(); ?>" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />

</head>

<body>
  <div class="container" id="main-content">
    <div class="header">
      <div class="header-left">
        <div class="back-button"></div>
      </div>
      <div class="header-right">
        <span class="user-name">
          <?php if (isset($user) && isset($user['full_name']))
            echo htmlspecialchars($user['full_name']);
          else
            echo 'User'; ?>
        </span>
        <a href="<?php echo $this->configs->config['basePath']; ?>/user">
          <div class="avatar"></div>
        </a>
      </div>
    </div>

    <div class="content">
      <div class="sidebar">
        <div class="sidebar-top">
          <div class="sidebar-title">Transaction</div>

          <div class="sidebar-menu">
            <a href="<?php echo $this->configs->config['basePath']; ?>/user" class="menu-item">
              <div class="menu-icon">
                <img src="icon/popup-user.svg" alt="User" />
              </div>
              <span>User</span>
            </a>
            <div class="menu-item active">
              <div class="menu-icon">
                <img src="icon/popup-transaction.svg" alt="Transaction" />
              </div>
              <span>Transaction</span>
            </div>
            <a href="<?php echo $this->configs->config['basePath']; ?>/user/reservations" class="menu-item">
              <div class="menu-icon">
                <img src="icon/popup-reservation.svg" alt="My Reservation" />
              </div>
              <span>My Reservation</span>
            </a>
            <a href="<?php echo $this->configs->config['basePath']; ?>/user/histories" class="menu-item">
              <div class="menu-icon">
                <img src="icon/popup-history.svg" alt="My History Booking" />
              </div>
              <span>My History Booking</span>
            </a>
          </div>
        </div>

        <a href="<?php echo $this->configs->config['basePath']; ?>/logout" class="sidebar-logout">
          <div class="logout-icon">
            <img src="icon/logout.svg" alt="Logout" />
          </div>
          <span>Logout</span>
        </a>
      </div>
      <div class="main">
        <form action="your-target-page.html" method="GET" class="search-form">
          <div class="search-bar custom-search">
            <img src="icon/find.svg" alt="Search" class="search-icon" />
            <input type="text" id="search-input" name="citizenId"
              placeholder="Enter Citizen ID to find your reservation" required />
            <div class="clear-btn" id="clear-btn">
              <img src="icon/x.svg" alt="Clear" />
            </div>
          </div>
        </form>

        <?php if (!empty($transactions)): ?>
          <?php foreach ($transactions as $tran): ?>
            <div class="card">
              <div class="card-left">
                <div class="hotel-name">Transaction ID:
                  <?= isset($tran['transaction_id']) ? htmlspecialchars($tran['transaction_id']) : '' ?>
                </div>
                <div class="transaction-line">Method:
                  <?= isset($tran['method']) ? htmlspecialchars($tran['method']) : (isset($tran['payment_method']) ? htmlspecialchars($tran['payment_method']) : 'N/A') ?>
                </div>
                <div class="transaction-line">
                  <?= isset($tran['created_at']) ? htmlspecialchars($tran['created_at']) : (isset($tran['date']) ? htmlspecialchars($tran['date']) : '') ?>
                </div>
                <div class="status"
                  data-status="<?= isset($tran['payment_status']) ? htmlspecialchars(strtolower($tran['payment_status'])) : '' ?>">
                  <?= isset($tran['payment_status']) ? htmlspecialchars($tran['payment_status']) : '' ?>
                </div>
              </div>
              <div class="price">
                $<?= isset($tran['total_amount']) ? htmlspecialchars($tran['total_amount']) : (isset($tran['amount']) ? htmlspecialchars($tran['amount']) : '0.00') ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div style="padding: 20px; color: #888;">No transactions found.</div>
        <?php endif; ?>

      </div>
    </div>

</body>

</html>
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
        <span class="user-name"><?= isset($user['full_name']) ? $user['full_name'] : '' ?></span>
        <div class="avatar"
          style="background-image: url('<?= $this->configs->config['pathAssets'] ?>/img/user/avatar.jpg');">
        </div>
      </div>
    </div>
    <div class="content">
      <div class="sidebar">
        <div class="sidebar-top">
          <div class="sidebar-title">Transaction</div>

          <div class="sidebar-menu">
            <div class="menu-item" data-href="<?= $this->configs->config['basePath'] ?>/user/">
              <div class="menu-icon"><img src="<?= $this->configs->config['pathAssets'] ?>/icon/popup-user.svg"
                  alt="Logout" /></div>
              <span>User</span>
            </div>
            <div class="menu-item active" data-href="<?= $this->configs->config['basePath'] ?>/user/transactions">
              <div class="menu-icon" style="color: black;"><img
                  src="<?= $this->configs->config['pathAssets'] ?>/icon/popup-transaction.svg" alt="Logout" /></div>
              <span>Transaction</span>
            </div>
            <div class="menu-item" data-href="<?= $this->configs->config['basePath'] ?>/user/reservations">
              <div class="menu-icon"><img src="<?= $this->configs->config['pathAssets'] ?>/icon/popup-reservation.svg"
                  alt="Logout" /></div>
              <span>My Reservation</span>
            </div>
            <div class="menu-item" data-href="<?= $this->configs->config['basePath'] ?>/user/histories">
              <div class="menu-icon">
                <img src="<?= $this->configs->config['pathAssets'] ?>/icon/popup-history.svg" alt="Logout" />
              </div>
              <span>My History Booking</span>
            </div>
          </div>
        </div>

        <div class="sidebar-logout">
          <a href="<?= $this->configs->config['basePath'] ?>/logout" class="sidebar-logout">
            <img src="<?= $this->configs->config['pathAssets'] ?>/icon/logout.svg" alt="Logout"
              class="logout-icon" />Logout</a>

        </div>
      </div>
      <div class="main">
        <form action="your-target-page.html" method="GET" class="search-form" id="search-form">
          <div class="search-bar custom-search">
            <img src="<?= $this->configs->config['pathAssets'] ?>/icon/find.svg" alt="Search" id="find-btn"
              style="cursor: pointer;" />
            <input type="text" id="search-input" name="citizenId"
              placeholder="Enter Citizen ID to find your reservation" required />
            <div class="clear-btn" id="clear-btn">
              <img src="<?= $this->configs->config['pathAssets'] ?>/icon/x.svg" alt="Clear" />
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
                <?= isset($tran['total_amount']) ? htmlspecialchars($tran['total_amount']) : (isset($tran['amount']) ? htmlspecialchars($tran['amount']) : '0.00') ?>
              </div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div style="padding: 20px; color: #888;">No transactions found.</div>
        <?php endif; ?>
      </div>
    </div>
    <script src="<?= $this->configs->config['pathAssets'] ?>/js/transaction.js?v=<?= time() ?>"></script>

</body>

</html>
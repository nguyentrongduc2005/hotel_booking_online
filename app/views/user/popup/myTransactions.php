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
        <span class="user-name">Tran Le Duy Minh</span>
        <a href="user.html">
          <div class="avatar"></div>
        </a>
      </div>
    </div>

    <div class="content">
      <div class="sidebar">
        <div class="sidebar-top">
          <div class="sidebar-title">Transaction</div>

          <div class="sidebar-menu">
            <a href="user.html" class="menu-item">
              <div class="menu-icon">
                <img src="icon/user.svg" alt="User" />
              </div>
              <span>User</span>
            </a>
            <div class="menu-item active">
              <div class="menu-icon">
                <img src="icon/pay.svg" alt="Transaction" />
              </div>
              <span>Transaction</span>
            </div>
            <a href="reservation.html" class="menu-item">
              <div class="menu-icon">
                <img src="icon/rev.svg" alt="My Reservation" />
              </div>
              <span>My Reservation</span>
            </a>
            <a href="historybooking.html" class="menu-item">
              <div class="menu-icon">
                <img src="icon/history.svg" alt="My History Booking" />
              </div>
              <span>My History Booking</span>
            </a>
          </div>
        </div>

        <a href="guest.html" class="sidebar-logout">
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
          <?php foreach ($transactions as $data): ?>
            <div class="card">
              <div class="card-left">
                <div class="hotel-name">Transaction ID: <?= htmlspecialchars($data['id']) ?></div>
                <div class="transaction-line">Method: <?= htmlspecialchars($data['method']) ?></div>
                <div class="transaction-line"><?= htmlspecialchars($data['date']) ?></div>
                <div class="status" data-status="<?= htmlspecialchars(strtolower($data['status'])) ?>">
                  <?= htmlspecialchars($data['status']) ?>
                </div>
              </div>
              <div class="price">$<?= htmlspecialchars($data['amount']) ?></div>
            </div>
          <?php endforeach; ?>
        <?php else: ?>
          <div style="padding: 20px; color: #888;">No transactions found.</div>
        <?php endif; ?>
      </div>
    </div>
    <script src="main.js"></script>
</body>

</html>
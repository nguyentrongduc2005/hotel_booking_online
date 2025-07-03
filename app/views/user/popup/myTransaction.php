<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Transaction Popup</title>
    <link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/transaction.css?v=<?= time() ?>" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="container" id="main-content">
        <div class="header">
            <div class="header-left">
                <div class="back-button"></div>
            </div>
            <div class="header-right">
                <span class="user-name"><?= isset($_SESSION['user_name']) ? $_SESSION['user_name'] : '' ?></span>
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
                                <img src="<?= $this->configs->config['pathAssets'] ?>icon/popup-user.png" alt="User" />
                            </div>
                            <span>User</span>
                        </a>
                        <div class="menu-item active">
                            <div class="menu-icon">
                                <img src="<?= $this->configs->config['pathAssets'] ?>icon/popup-transaction.png"
                                    alt="Transaction" />
                            </div>
                            <span>Transaction</span>
                        </div>
                        <a href="reservation.html" class="menu-item">
                            <div class="menu-icon">
                                <img src="<?= $this->configs->config['pathAssets'] ?>icon/popup-reservation.png"
                                    alt="My Reservation" />
                            </div>
                            <span>My Reservation</span>
                        </a>
                        <a href="historybooking.html" class="menu-item">
                            <div class="menu-icon">
                                <img src="<?= $this->configs->config['pathAssets'] ?>icon/popup-history.png"
                                    alt="My History Booking" />
                            </div>
                            <span>My History Booking</span>
                        </a>
                    </div>
                </div>

                <a href="guest.html" class="sidebar-logout">
                    <div class="logout-icon">
                        <img src="<?= $this->configs->config['pathAssets'] ?>icon/logout.jpg" alt="Logout" />
                    </div>
                    <span>Logout</span>
                </a>
            </div>
            <div class="main">
                <!-- <div class="search-bar custom-search">
            <img src="icon/find.svg" alt="Search" class="search-icon" />
            <input
              type="text"
              id="search-input"
              placeholder="Enter Citizen ID to find your reservation"
            />
            <div class="clear-btn" id="clear-btn">
              <img src="icon/x.svg" alt="Clear" />
            </div>
          </div> -->
                <?php if (empty($data)): ?>
                <div class="no-results">
                    <h3>không có data</h3>
                    <p>không có data</p>
                </div>
                <?php else: ?>
                <?php foreach ($data as $item): ?>
                <div class="card">
                    <div class="card-left">
                        <div class="hotel-name">transaction: <?= $item['transaction_id'] ?></div>
                        <div class="transaction-line">Method: <?= $item['payment_method'] ?></div>
                        <div class="transaction-line"><?= $item['created_at'] ?></div>
                        <div class="status"><?= $item['payment_status'] ?></div>
                    </div>
                    <div class="price">$ <?= $item['total_amount'] ?> </div>
                </div>
                <?php endforeach; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <script src="main.js"></script>
</body>

</html>
<?php $isLoggedIn = isset($user); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>History Booking Popup</title>
    <link rel="icon" href="/hotel_booking_online/public/assets/icon/diamond_logo_small.png" sizes="32x32"
        type="image/png">
    <link rel="stylesheet"
        href="<?php echo $this->configs->config['pathAssets']; ?>css/history.css?v=<?php echo time(); ?>" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
</head>

<body>
    <div class="container" id="main-content">
        <div class="header">
            <div class="header-left">
                <div class="back-button">
                    <a href="<?= $this->configs->config['basePath'] ?>/" class="back-link">
                        <img src="<?= $this->configs->config['pathAssets'] ?>/icon/button back.svg" alt="Back"
                            class="back-icon" />
                    </a>
                </div>
            </div>
            <div class="header-right">
                <span class="user-name"><?= isset($user['full_name']) ? $user['full_name'] : '' ?></span>
                <div class="avatar" style="
              background-image: url('<?= $this->configs->config['pathAssets'] ?>/img/user/avatar.jpg');
            "></div>
            </div>
        </div>
        <div class="content">
            <div class="sidebar">
                <div class="sidebar-top">
                    <div class="sidebar-title">History Booking</div>
                    <div class="sidebar-menu">
                        <div class="menu-item" data-href="<?= $this->configs->config['basePath'] ?>/user/">
                            <div class="menu-icon">
                                <img src="<?= $this->configs->config['pathAssets'] ?>/icon/popup-user.svg" alt="User" />
                            </div>
                            <span>User</span>
                        </div>
                        <div class="menu-item" data-href="<?= $this->configs->config['basePath'] ?>/user/transactions">
                            <div class="menu-icon" style="color: black">
                                <img src="<?= $this->configs->config['pathAssets'] ?>/icon/popup-transaction.svg"
                                    alt="Transaction" />
                            </div>
                            <span>Transaction</span>
                        </div>
                        <div class="menu-item" data-href="<?= $this->configs->config['basePath'] ?>/user/reservations">
                            <div class="menu-icon">
                                <img src="<?= $this->configs->config['pathAssets'] ?>/icon/popup-reservation.svg"
                                    alt="Reservation" />
                            </div>
                            <span>My Reservation</span>
                        </div>
                        <div class="menu-item active"
                            data-href="<?= $this->configs->config['basePath'] ?>/user/histories">
                            <div class="menu-icon">
                                <img src="<?= $this->configs->config['pathAssets'] ?>/icon/popup-history.svg"
                                    alt="History" />
                            </div>
                            <span>My History Booking</span>
                        </div>
                    </div>
                </div>
                <div class="sidebar-logout <?php if (!$isLoggedIn)
                    echo 'hidden'; ?>">
                    <a href="<?= $this->configs->config['basePath'] ?>/logout" class="sidebar-logout">
                        <img src="<?= $this->configs->config['pathAssets'] ?>/icon/logout.svg" alt="Logout"
                            class="logout-icon" />
                        Logout
                    </a>
                </div>

            </div>
            <div class="main">
                <?php if (!$isLoggedIn): ?>
                    <form action="your-target-page.php" method="GET" class="search-form" id="search-form">
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
                <?php endif; ?>
                <?php if (!empty($history)): ?>
                    <?php foreach ($history as $booking): ?>
                        <div class="card">
                            <div class="card-left">
                                <div class="card-row">
                                    <div class="hotel-name">
                                        <?= htmlspecialchars($booking['name'] ?? 'N/A') ?>
                                    </div>
                                </div>
                                <div class="transaction-line">
                                    Booking ID:
                                    <?= htmlspecialchars($booking['id_history'] ?? '-') ?>
                                    / Room:
                                    <?= htmlspecialchars($booking['slug'] ?? '-') ?>
                                </div>
                                <div class="transaction-line">
                                    <?= isset($booking['check_in']) && isset($booking['check_out'])
                                        ? date('d/m/Y', strtotime($booking['check_in'])) . ' - ' . date('d/m/Y', strtotime($booking['check_out']))
                                        : '' ?>
                                </div>
                            </div>
                            <div class="status <?= strtolower($booking['status'] ?? 'completed') ?>">
                                <?= htmlspecialchars($booking['status'] ?? 'Completed') ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div style="padding: 20px; color: #888;">No transactions found.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <script src="<?= $this->configs->config['pathAssets'] ?>/js/history.js?v=<?= time() ?>"></script>
</body>

</html>
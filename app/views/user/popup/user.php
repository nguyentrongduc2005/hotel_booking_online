<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Popup</title>
    <link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/user.css?v=<?= time() ?>" />
</head>


<body>
    <div class="container">
        <div class="header">
            <div class="header-left">
                <div class="back-button"></div>
            </div>
            <div class="header-right">
                <span class="user-name"><?= isset($data['full_name']) ? $data['full_name'] : '' ?></span>
                <div class="avatar"></div>
            </div>
        </div>

        <div class="content">
            <div class="sidebar">
                <div class="sidebar-top">
                    <div class="sidebar-title">User Profile</div>

                    <div class="sidebar-menu">
                        <div class="menu-item active">
                            <div class="menu-icon"><img src="<?= $this->configs->config['pathAssets'] ?>/icon/user.svg"
                                    alt="Logout" /></div>
                            <span>User</span>
                        </div>
                        <div class="menu-item">
                            <div class="menu-icon" style="color: black;"><img
                                    src="<?= $this->configs->config['pathAssets'] ?>/icon/popup-transaction.png"
                                    alt="Logout" /></div>
                            <span>Transaction</span>
                        </div>
                        <div class="menu-item">
                            <div class="menu-icon"><img
                                    src="<?= $this->configs->config['pathAssets'] ?>/icon/popup-reservation.png"
                                    alt="Logout" /></div>
                            <span>My Reservation</span>
                        </div>
                        <div class="menu-item">
                            <div class="menu-icon">
                                <img src="<?= $this->configs->config['pathAssets'] ?>/icon/popup-history.png"
                                    alt="Logout" />
                            </div>
                            <span>My History Booking</span>
                        </div>
                    </div>
                </div>

                <div class="sidebar-logout">
                    <div class="logout-icon">
                        <img src="<?= $this->configs->config['pathAssets'] ?>/icon/logout.jpg" alt="Logout" />
                    </div>
                    <a href="<?= $this->configs->config['basePath'] ?>/logout">Logout</a>
                </div>
            </div>


            <div class="main">
                <div class="profile-avatar-name">
                    <div class="avatar-wrapper">
                        <div class="main-avatar">
                            <img src="<?= $this->configs->config['pathAssets'] ?>/img/user/avatar.jpg"
                                alt="AvatarEDIT" />
                        </div>
                    </div>
                    <div class="profile-name"><?= isset($data['full_name']) ? $data['full_name'] : '' ?></div>
                </div>

                <form class="profile-form" action="<?= $this->configs->config['basePath'] ?>/user" method="POST">
                    <div class="form-row">
                        <label>Full Name</label>
                        <input type="text" name='full_name'
                            value="<?= isset($data['full_name']) ? $data['full_name'] : '' ?>" />
                    </div>
                    <div class="form-row">
                        <label>Citizen ID</label>
                        <input type="text" name='cccd' value="<?= isset($data['cccd']) ? $data['cccd'] : '' ?>" />
                    </div>
                    <div class="form-row">
                        <label>Email</label>
                        <input type="email" name='email' value="<?= isset($data['email']) ? $data['email'] : '' ?>" />
                    </div>
                    <div class="form-row">
                        <label>Phone</label>
                        <input type="tel" name='sdt' value="<?= isset($data['sdt']) ? $data['sdt'] : '' ?>" />
                    </div>
                    <div class="profile-actions">
                        <div class="change-password">Change password</div>
                        <div class="action-buttons">
                            <input type="submit" class="save-btn" value="Save">
                            <button onclick="history.back()" class="cancel-btn">Cancel</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
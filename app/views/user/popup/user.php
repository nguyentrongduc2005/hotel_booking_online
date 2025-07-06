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
                <div class="avatar"
                    style="background-image: url('<?= $this->configs->config['pathAssets'] ?>/img/user/avatar.jpg');">
                </div>

            </div>
        </div>

        <div class="content">
            <div class="sidebar">
                <div class="sidebar-top">
                    <div class="sidebar-title">User Profile</div>

                    <div class="sidebar-menu">
                        <div class="menu-item active">
                            <div class="menu-icon"><img
                                    src="<?= $this->configs->config['pathAssets'] ?>/icon/popup-user.svg"
                                    alt="Logout" /></div>
                            <span>User</span>
                        </div>
                        <div class="menu-item">
                            <div class="menu-icon" style="color: black;"><img
                                    src="<?= $this->configs->config['pathAssets'] ?>/icon/popup-transaction.svg"
                                    alt="Logout" /></div>
                            <span>Transaction</span>
                        </div>
                        <div class="menu-item">
                            <div class="menu-icon"><img
                                    src="<?= $this->configs->config['pathAssets'] ?>/icon/popup-reservation.svg"
                                    alt="Logout" /></div>
                            <span>My Reservation</span>
                        </div>
                        <div class="menu-item">
                            <div class="menu-icon">
                                <img src="<?= $this->configs->config['pathAssets'] ?>/icon/popup-history.svg"
                                    alt="Logout" />
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
                        <span id="open-popup" class="change-password">Change Password</span>
                        <div class="action-buttons">
                            <input type="submit" class="save-btn" value="Save">
                            <button onclick="history.back()" class="cancel-btn">Cancel</button>
                        </div>
                    </div>


                </form>
                <div class="popup-overlay" id="popup">
                    <div class="popup-box">
                        <h3 class="popup-title">Change Password</h3>
                        <div id="change-password-form">
                            <div class="popup-field">
                                <label for="old">Old Password</label>
                                <input type="password" id="old" name="old_password" required />
                            </div>

                            <div class="popup-field">
                                <label for="new">New Password</label>
                                <input type="password" id="new" name="new_password" required />
                            </div>

                            <div class="popup-field">
                                <label for="confirm">Confirm Password</label>
                                <input type="password" id="confirm" name="confirm_password" required />
                            </div>

                            <div class="popup-actions">
                                <button class="popup-save">Save</button>
                                <button type="button" class="popup-cancel" id="close-popup">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="<?= $this->configs->config['pathAssets'] ?>js/changepassword.js?v=<?= time() ?>"></script>
</body>

</html>
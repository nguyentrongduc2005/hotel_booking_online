<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/adminSideBar.css?v=<?= time() ?>">
<aside class="sidebar">
  <div class="sidebar-logo">
    <img src="<?= $this->configs->config['pathAssets'] ?>icon/diamond_logo_small.png" alt="Diamond Hotel Logo">
    <span class="sidebar-brand">DIAMOND<br />HOTEL</span>
  </div>
  <nav class="sidebar-nav">
    <ul class="sidebar-menu">
      <li class="sidebar-item sidebar-dashboard">
        <a href="<?= $this->configs->config['basePath'] ?>/dashboard" style="text-decoration: none; color: #fff;">Dashboard</a>
        <ul class="sidebar-submenu">
          <li class="sidebar-subitem"><a href="<?= $this->configs->config['basePath'] ?>/dashboard/checkin">Check-in</a></li>
          <li class="sidebar-subitem"><a href="<?= $this->configs->config['basePath'] ?>/dashboard/checkout">Check-out</a></li>
        </ul>
      </li>
      <li class="sidebar-item sidebar-bookings">
        Booking
        <ul class="sidebar-submenu">
          <li class="sidebar-subitem"><a href="<?= $this->configs->config['basePath'] ?>/bookings/allBookings">All Bookings</a></li>
          <li class="sidebar-subitem"><a href="<?= $this->configs->config['basePath'] ?>/bookings/historyBookings">History Booking</a></li>
        </ul>
      </li>
      <li class="sidebar-item sidebar-rooms">
        <a href="<?= $this->configs->config['basePath'] ?>/admin/rooms" style="text-decoration: none; color: #fff;">Rooms</a>
        <ul class="sidebar-submenu">
          <li class="sidebar-subitem"><a href="<?= $this->configs->config['basePath'] ?>/admin/roomtypes">Room Types</a></li>
          <li class="sidebar-subitem"><a href="<?= $this->configs->config['basePath'] ?>/admin/amenities">Amenities</a></li>
        </ul>
      </li>
      <li class="sidebar-item sidebar-services">Services</li>
      <li class="sidebar-item sidebar-customers">Customers
        <ul class="sidebar-submenu">
          <li class="sidebar-subitem"><a href="">Guests</a></li>
          <li class="sidebar-subitem"><a href="">Users</a></li>
        </ul>
      </li>
      <li class="sidebar-item sidebar-transactions">Transactions</li>
    </ul>
  </nav>
</aside>
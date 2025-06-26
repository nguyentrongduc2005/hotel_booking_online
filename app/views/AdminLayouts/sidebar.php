<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/adminSideBar.css?v=<?= time() ?>">
<aside class="sidebar">
  <div class="sidebar-logo">
    <img src="<?= $this->configs->config['pathAssets'] ?>icon/diamond_logo_small.png" alt="Diamond Hotel Logo">
    <span class="sidebar-brand">DIAMOND<br />HOTEL</span>
  </div>
  <nav class="sidebar-nav">
    <ul class="sidebar-menu">
      <li class="sidebar-item sidebar-dashboard">
        Dashboard
        <ul class="sidebar-submenu">
          <li class="sidebar-subitem"><a href="">Confirmed Booking</a></li>
          <li class="sidebar-subitem"><a href="">Check-in</a></li>
          <li class="sidebar-subitem"><a href="">Check-out</a></li>
        </ul>
      </li>
      <li class="sidebar-item sidebar-bookings">
        Booking
        <ul class="sidebar-submenu">
          <li class="sidebar-subitem"><a href="">All Bookings</a></li>
          <li class="sidebar-subitem"><a href="">History Booking</a></li>
        </ul>
      </li>
      <li class="sidebar-item sidebar-rooms">Rooms</li>
      <li class="sidebar-item sidebar-services">Services</li>
      <li class="sidebar-item sidebar-customers">Customers</li>
      <li class="sidebar-item sidebar-transactions">Transactions</li>
    </ul>
  </nav>
</aside>
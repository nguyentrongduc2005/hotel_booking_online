<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/homepage.css?v=<?= time() ?>">
<div class="homepage-container">
  <div class="hero-section">
    <div class="hero-logo">
      <img src="<?= $this->configs->config['pathAssets'] ?>icon/diamond_logo_small.png" alt="Diamond Logo">
    </div>
    <h1 class="hero-title">DIAMOND HOTEL</h1>
    <form class="search-bar" action="/hotel_booking_online/public/rooms" method="get">
      <div class="search-group">
        <label>Check In<br><span class="search-date">Wed, June 18</span></label>
      </div>
      <div class="search-group">
        <label>Check out<br><span class="search-date">Wed, June 18</span></label>
      </div>
      <div class="search-group">
        <label>Room/Guest<br><span class="search-date">1 room, 1 guest</span></label>
      </div>
      <button type="submit" class="search-btn">
        <span class="search-icon"></span> Search Rooms
      </button>
    </form>
  </div>
  <div class="welcome-container">
    <div class="welcome-hotel">
      <div class="welcome-text">
        <h1>Welcome to <br><strong>Diamond Hotel</strong></h1>

        <div class="description">
          <p>Diamond Hotel is a cozy hideaway in the heart of the city, where comfort meets charm. With just 40 rooms
            for
            solo guests to small groups (1–4 people), we offer a quiet, personal retreat.</p>
          <p>Every guest is treated like a gem — unique, valued, and warmly welcomed. Whether you're here for work or a
            quick getaway, our friendly team is always ready to help, from local tips to midnight snacks.</p>
        </div>

      </div>


      <div class="welcome-image">
        <img src="<?= $this->configs->config['pathAssets'] ?>img/welcome_hotel.png" alt="welcome hotel">
      </div>
    </div>
  </div>

</div>
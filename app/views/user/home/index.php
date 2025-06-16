<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/homepage.css?v=<?= time() ?>">









<div id="homepage-container">
  <div id="hero-section">
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
          <p>Diamond Hotel is a cozy hideaway in the heart of the city, where comfort meets charm. With just
            40 rooms
            for
            solo guests to small groups (1–4 people), we offer a quiet, personal retreat.</p>
          <p>Every guest is treated like a gem — unique, valued, and warmly welcomed. Whether you're here for
            work or a
            quick getaway, our friendly team is always ready to help, from local tips to midnight snacks.
          </p>
        </div>

      </div>
      <div class="welcome-image">
        <img src="<?= $this->configs->config['pathAssets'] ?>img/welcome_hotel.png" alt="welcome hotel">
      </div>
    </div>
  </div>
  <div id="our-services">
    <h2>Our Services</h2>
    <div class="services-wrapper">
      <?php foreach ($services as $service): ?>
      <div class="service-box"
        style="background-image: url('<?= $this->configs->config['pathAssets'] . $service['Path_img'] ?>')">
        <div class="service-text">
          <strong><?= htmlspecialchars($service['name']) ?></strong>
          <span><?= htmlspecialchars($service['description'] ?? '') ?></span>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
    <div id="btn-explore" class="btn-explore1"><span>EXPLORE ALL</span></div>
  </div>
  <div id="rooms-section">
    <!-- Section Header -->
    <div class="section-header">
      <h2 class="section-title">Rooms Designed for You</h2>
      <p class="section-subtitle">Choose the room that suits your journey</p>
    </div>

    <!-- Rooms Container -->
    <div class="room-container">
      <!-- Navigation Arrows -->
      <button class="prev-btn nav-arrow nav-arrow-left">
        <span class="arrow-icon">&lt;</span>
      </button>
      <button class="next-btn nav-arrow nav-arrow-right">
        <span class="arrow-icon">&gt;</span>
      </button>

      <!-- Rooms Grid -->
      <div class="rooms-grid">
        <?php foreach ($rooms as $room): ?>
        <div class="room-card"
          style="background-image: url('<?= $this->configs->config['pathAssets'] . $room['thumb'] ?>')">
          <div class="room-content">
            <a href="/hotel_booking_online/public/detailroom/<?= htmlspecialchars($room['slug']) ?>"
              class="btn-view-detail">View Details</a>
            <h3 class="room-title"><?= htmlspecialchars($room['name']) ?></h3>
            <p class="room-price">$<?= number_format($room['price'], 2) ?>/night</p>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div id="btn-explore"><span>EXPLORE ALL</span></div>
  </div>

  <div id="testimonials-section">
    <div class="guest-say">
      <div class="title">
        <h2>What Our Guests Say</h2>
      </div>
      <div class="comments-container">
        <!-- Comment Card 1 -->
        <div class="comment-card comment-card-1"
          style="background-image: url('<?= $this->configs->config['pathAssets'] ?>/img/ourservice/bg-card.png')">
          <div class="comment-content">
            <h3 class="comment-title">A very good place!</h3>
            <p class="comment-text">Lorem ipsum dolor sit amet, nam quis nostrud exercitation ullamco
              laboris nisi ut
              aliquip ex ea commodo consequat.</p>
            <div class="comment-author">
              <span class="author-name">Taylor Swift</span>
              <span class="author-role">An Artist</span>
            </div>
          </div>
        </div>

        <!-- Comment Card 2 -->
        <div class="comment-card comment-card-2"
          style="background-image: url('<?= $this->configs->config['pathAssets'] ?>/img/ourservice/bg-card.png')">

          <div class="comment-content">
            <h3 class="comment-title">A very good place!</h3>
            <p class="comment-text">Lorem ipsum dolor sit amet, nam quis nostrud exercitation ullamco
              laboris nisi ut
              aliquip ex ea commodo consequat.</p>
            <div class="comment-author">
              <span class="author-name">Taylor Swift</span>
              <span class="author-role">An Artist</span>
            </div>
          </div>
        </div>


        <!-- Comment Card 3 -->
        <div class="comment-card comment-card-3"
          style="background-image: url('<?= $this->configs->config['pathAssets'] ?>/img/ourservice/bg-card.png')">

          <div class="comment-content">
            <h3 class="comment-title">A very good place!</h3>
            <p class="comment-text">Lorem ipsum dolor sit amet, nam quis nostrud exercitation ullamco
              laboris nisi ut
              aliquip ex ea commodo consequat.</p>
            <div class="comment-author">
              <span class="author-name">Taylor Swift</span>
              <span class="author-role">An Artist</span>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <div id="ig-container">

    <div id="ig-section">
      <!-- DIV 1: TITLE CARD SECTION -->
      <div class="title-card">
        <h1 class="main-title">Stay Connected With Us</h1>

        <div class="gallery-container">
          <div class="gallery-item"
            style="background-image: url('<?= $this->configs->config['pathAssets'] ?>/img/ourservice/card-ig.png')">

          </div>

          <div class="gallery-item instagram"
            style="background-image: url('<?= $this->configs->config['pathAssets'] ?>/img/ourservice/card-ig01.png')">

          </div>
          <div class="gallery-item"
            style="background-image: url('<?= $this->configs->config['pathAssets'] ?>/img/ourservice/card-ig02.png')">

          </div>
        </div>

        <div class="view-gallery">View Gallery</div>
      </div>

      <!-- DIV 2: CONTENT & BOOK NOW SECTION -->
      <div class="content-section">
        <h2 class="content-title">Make your stay unforgettable</h2>
        <p class="content-description">
          Book your stay at Diamond Hotel – comfort, style, and service await.
        </p>
        <button class="book-now-btn">
          <a href="<?= $this->configs->config['basePath'] ?>listroom">Start now </a>
        </button>
      </div>
    </div>
  </div>
</div>

<script src="<?= $this->configs->config['pathAssets'] ?>js/main.js"></script>
</body>

</html>
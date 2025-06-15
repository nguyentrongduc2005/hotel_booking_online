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
  <div id="our-services">
    <h2>Our Services</h2>
    <div class="services-wrapper">
      <div class="service-box1">
        <img src="<?= $this->configs->config['pathAssets'] ?>img/ourservice/gym.png" alt="Gym">
        <div class="service-text">
          <strong>Gym</strong>
          <span>Fitness Center Access</span>
        </div>
      </div>
      <div class="service-box2">
        <img src="<?= $this->configs->config['pathAssets'] ?>img/ourservice/laundry.jpg" alt="Laundry">
        <div class="service-text">
          <strong>Laundry</strong>
          <span>Daily Laundry Service</span>
        </div>
      </div>
      <div class="service-box3">
        <img src="<?= $this->configs->config['pathAssets'] ?>img/ourservice/pool.png" alt="Pool">
        <div class="service-text">
          <strong>Pool</strong>
          <span>Rooftop Swimming Pool</span>
        </div>
      </div>
      <div class="service-box4">
        <img src="<?= $this->configs->config['pathAssets'] ?>img/ourservice/buffet.png" alt="Buffet">
        <div class="service-text">
          <strong>Buffet</strong>
          <span>All-Day Dining</span>
        </div>
      </div>
      <div class="service-box5">
        <img src="<?= $this->configs->config['pathAssets'] ?>img/ourservice/wedding.png" alt="Wedding">
        <div class="service-text">
          <strong>Wedding/Event</strong>
          <span>Private Events & Weddings</span>
        </div>
      </div>
      <div class="service-box6">
        <img src="<?= $this->configs->config['pathAssets'] ?>img/ourservice/spa.png" alt="Spa">
        <div class="service-text">
          <strong>Spa</strong>
          <span>In-room Spa Treatments</span>
        </div>
      </div>
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
    <div class="rooms-container">
      <!-- Navigation Arrows -->
      <button class="nav-arrow nav-arrow-left">
        <span class="arrow-icon">&lt;</span>
      </button>
      <button class="nav-arrow nav-arrow-right">
        <span class="arrow-icon">&gt;</span>
      </button>

      <!-- Rooms Grid -->
      <div class="rooms-grid">
        <!-- Room Card 1 - Standard Room -->
        <div class="room-card room-card-standard">
          <img src="<?= $this->configs->config['pathAssets'] ?>img/ourservice/Mock_list_card_home_page.png"
            alt="Standard Room">
          <div class="room-content">
            <button class="btn-view-detail">View Details</button>
            <h3 class="room-title">Standard Room</h3>
            <p class="room-price">$55/night</p>
          </div>
        </div>

        <!-- Room Card 2 - Family Room -->
        <div class="room-card room-card-family">
          <img src="<?= $this->configs->config['pathAssets'] ?>img/ourservice/Mock_list_card_home_page.png"
            alt="Family Room">
          <div class="room-content">
            <button class="btn-view-detail">View Details</button>
            <h3 class="room-title">Family Room</h3>
            <p class="room-price">$85/night</p>
          </div>
        </div>

        <!-- Room Card 3 - Deluxe Room -->
        <div class="room-card room-card-deluxe">
          <img src="<?= $this->configs->config['pathAssets'] ?>img/ourservice/Mock_list_card_home_page.png"
            alt="Deluxe Room">
          <div class="room-content">
            <button class="btn-view-detail">View Details</button>
            <h3 class="room-title">Deluxe Room</h3>
            <p class="room-price">$150/night</p>
          </div>
        </div>

        <!-- Room Card 4 - Superior Room -->
        <div class="room-card room-card-superior">
          <img src="<?= $this->configs->config['pathAssets'] ?>img/ourservice/Mock_list_card_home_page.png"
            alt="Superior Room">
          <div class="room-content">
            <button class="btn-view-detail">View Details</button>
            <h3 class="room-title">Superior Room</h3>
            <p class="room-price">$250/night</p>
          </div>
        </div>
      </div>
    </div>

    <div id="btn-explore"><span>EXPLORE ALL</span></div>
  </div>

  <div id="testimonials-section">
    <img class="testimonials-bg" src="<?= $this->configs->config['pathAssets'] ?>img/guestsay/bg.png"
      alt="Testimonials Background">
    <div class="guest-say">
      <div class="title">
        <h2>What Our Guests Say</h2>
      </div>
      <div class="comments-container">
        <!-- Comment Card 1 -->
        <div class="comment-card comment-card-1">
          <img src="<?= $this->configs->config['pathAssets'] ?>img/ourservice/bg-card.png"
            alt="Comment Card Background">
          <div class="comment-content">
            <h3 class="comment-title">A very good place!</h3>
            <p class="comment-text">Lorem ipsum dolor sit amet, nam quis nostrud exercitation ullamco laboris nisi ut
              aliquip ex ea commodo consequat.</p>
            <div class="comment-author">
              <span class="author-name">Taylor Swift</span>
              <span class="author-role">An Artist</span>
            </div>
          </div>
        </div>

        <!-- Comment Card 2 -->
        <div class="comment-card comment-card-2">
          <img src="<?= $this->configs->config['pathAssets'] ?>img/ourservice/bg-card.png"
            alt="Comment Card Background">
          <div class="comment-content">
            <h3 class="comment-title">A very good place!</h3>
            <p class="comment-text">Lorem ipsum dolor sit amet, nam quis nostrud exercitation ullamco laboris nisi ut
              aliquip ex ea commodo consequat.</p>
            <div class="comment-author">
              <span class="author-name">Taylor Swift</span>
              <span class="author-role">An Artist</span>
            </div>
          </div>
        </div>

        <!-- Comment Card 3 -->
        <div class="comment-card comment-card-3">
          <img src="<?= $this->configs->config['pathAssets'] ?>img/ourservice/bg-card.png"
            alt="Comment Card Background">
          <div class="comment-content">
            <h3 class="comment-title">A very good place!</h3>
            <p class="comment-text">Lorem ipsum dolor sit amet, nam quis nostrud exercitation ullamco laboris nisi ut
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
          <div class="gallery-item">
            <img src="<?= $this->configs->config['pathAssets'] ?>img/ourservice/card-ig.png" alt="Gallery 1">
          </div>
          <div class="gallery-item instagram">
            <img src="<?= $this->configs->config['pathAssets'] ?>img/ourservice/card-ig.png" alt="Gallery 2">
          </div>
          <div class="gallery-item">

            <img src="<?= $this->configs->config['pathAssets'] ?>img/ourservice/card-ig.png" alt="Gallery 3">
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
        <button class="book-now-btn">Book Now</button>
      </div>
    </div>
  </div>
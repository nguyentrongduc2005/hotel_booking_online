<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/homepage.css?v=<?= time() ?>"><?php date_default_timezone_set('Asia/Ho_Chi_Minh');
                                                                                                            $datePresent = date('Y-m-d');
                                                                                                            $nextDate = date('Y-m-d', strtotime($datePresent . ' +1 day'));
                                                                                                            ?>

<div id="homepage-container">
    <div id="hero-section">
        <div class="hero-logo">
            <img src="<?= $this->configs->config['pathAssets'] ?>icon/diamond_logo_small.png" alt="Diamond Logo">
        </div>
        <h1 class="hero-title">DIAMOND HOTEL</h1>
        <form class="search-bar" action="<?= $this->configs->config['basePath'] ?>/listroom" method="get">
            <div class="search-group">
                <label class="title">Check In
                </label>
                <input type="date" name="check_in" id="check_in" class="search-date" value="<?= $datePresent ?>" required>
            </div>
            <div class="search-group">
                <label class="title">Check out</label>
                <input type="date" name="check_out" id="check_out" class="search-date" value="<?= $nextDate ?>" required>
            </div>
            <div class="search-group">
                <label class="title1" for="room_count_select">Room/Guest</label>
                <select name="guest" id="room_count_select" class="room-select">
                    <option value="1">1 Guest</option>
                    <option value="2">2 Guests</option>
                    <option value="3">3 Guests</option>
                    <option value="4">4 Guests</option>
                </select>
            </div>
            <button type="submit" class="search-btn">
                <span class="search-icon">Search Rooms</span>
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
        <div class="service-video">
            <video class="ser-video" width="1083" height="598" autoplay loop muted>
                <source src="<?= $this->configs->config['pathAssets'] ?>video/ser-video.mp4" type="video/mp4">
            </video>
        </div>
        <div class="service-img">
            <div class="ser-img-container">
                <img src="<?= $this->configs->config['pathAssets'] ?>img/service/RoomService.jpg">
                <img src="<?= $this->configs->config['pathAssets'] ?>img/service/SpaService.jpg">
            </div>
        </div>
        <div class="ser-content" style="text-align: left; color: white;">
            <h2>Our Services</h2>
            <p>We deliver tailored solutions designed to meet your needs — from concept to execution.
            Whether you're looking to elevate your brand, streamline operations, or&nbsp;create meaningful
            digital experiences, our team is here to help you grow with&nbsp;purpose.</p>
        </div>
    </div>
      
    </div>
    <div id="rooms-section">
        <div class="section-header">
            <h2 class="section-title">Rooms Designed for You</h2>
            <p class="section-subtitle">Choose the room that suits your journey</p>
        </div>
        <div class="room-container">
            <button class="prev-btn nav-arrow nav-arrow-left">
                <span class="arrow-icon">&lt;</span>
            </button>
            <button class="next-btn nav-arrow nav-arrow-right">
                <span class="arrow-icon">&gt;</span>
            </button>
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

        <a href="<?= $this->configs->config['basePath'] ?>/listroom" class="nav-link-btn">
            <div id="btn-explore" class="btn-explore1">
                <span>EXPLORE ALL</span>
                <div class="icon">
                    <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z" fill="currentColor"></path>
                    </svg>
                </div>
            </div>
        </a>
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
            <div class="content-section">
                <h2 class="content-title">Make your stay unforgettable</h2>
                <p class="content-description">
                    Book your stay at Diamond Hotel – comfort, style, and service await.
                </p>
                <a href="<?= $this->configs->config['basePath'] ?>/listroom" class="nav-link-btn">
                    <button id="book-now-btn" class="book-now-btn button-87">Book Now</button>
                </a>
            </div>
        </div>
    </div>
</div>

<script src="<?= $this->configs->config['pathAssets'] ?>js/homepage.js"></script>
<script>
    document.getElementById('explore-services').onclick = function() {
        window.location.href = "<?= $this->configs->config['basePath'] ?>/services";
    };
    document.getElementById('explore-rooms').onclick = function() {
        window.location.href = "<?= $this->configs->config['basePath'] ?>/listroom";
    };
    document.getElementById('book-now-btn').onclick = function() {
        window.location.href = "<?= $this->configs->config['basePath'] ?>/listroom";
    };
</script>
</body>

</html>
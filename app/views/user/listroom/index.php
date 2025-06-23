
<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/listroom.css?v=<?= time() ?>" />


<div id="listroom-container">
  <div class="listroom-search">
    <form class="search-bar" action="<?= $this->configs->config['basePath'] ?>/listroom" method="get">
      <div class="search-group">
        <label class="title">Check In
        </label>
        <input type="date" name="Picker_search" id="checkin " class="search-date" value="2024-06-18" required>
      </div>
      <div class="search-group">
        <label class="title">Check out</label>
        <input type="date" name="Picker_search" id="checkin " class="search-date" value="2024-06-19" required>
      </div>
      <div class="search-group">
        <label class="title1" for="room_count_select">Room/Guest</label>
        <select name="room_count" id="room_count_select" class="room-select">
          <option value="1">1 people</option>
          <option value="2">2 peoples</option>
          <option value="3">3 peoples</option>
          <option value="4">4 peoples</option>
        </select>
      </div>
      <button type="submit" class="search-btn">
        <span class="search-icon">Search Rooms</span>
      </button>
    </form>
  </div>
  <div class="listroom-content">
    <div class="listroom-left">
      <div class="filter-box">
        <div class="filter-title">Custom Filter <span class="clear-filter">Clear All</span></div>
        <div class="filter-section">
          <div class="filter-label">Property Price</div>
          <input type="range" id="priceRange" min="0" max="250" value="100" step="10">
          <div id="priceRangeLabels" class="price-range-labels">
            <span id="priceValueMin">$0</span>
            <span id="priceValue">$100</span>
            <span id="priceValueMax">$250</span>
          </div>
        </div>
        <div class="filter-section">
          <div class="filter-label">Property Rooms </div>
          <div class="filter-tag-group">
            <span class="filter-tag">2 Bedroom</span>
            <span class="filter-tag active">1 Bedroom</span>
          </div>
        </div>
      </div>
    </div>
    <div class="listroom-right">
      <div class="room-list">
        <!-- Mock data room card -->
        <?php for ($i = 0; $i < 6; $i++): ?>
          <div class="room-card">
            <div class="room-img">
              <img src="<?= $this->configs->config['pathAssets'] ?>img/bg-card_listrooms.png" alt="Deluxe Room">
            </div>
            <div class="room-info">
              <div class="room-header">
                <span class="room-title">Deluxe Room</span>
                <span class="room-best">Best Price</span>
              </div>
              <div class="room-desc">Modern space with city view, comfy bed, full in-room amenities, work desk, high-speed Wi-Fi, and a relaxing atmosphere for both business and leisure travelers</div>
              <div class="room-meta">
                <span>2 Beds</span> | <span>32m²</span> | <span>Max 3 guests</span>
              </div>
              <div class="room-footer">
                <div class="room-price">
                  <span class="room-old-price">$320</span>
                  <span class="room-new-price">$290</span>
                </div>
                <button class="room-detail-btn">View Details</button>
              </div>
            </div>
          </div>
        <?php endfor; ?>
      </div>
    </div>
  </div>
</div>
<script>
  const slider = document.getElementById("priceRange");
  const priceText = document.getElementById("priceValue");


  slider.addEventListener("input", () => {
    priceText.textContent = `$${slider.value}`;
  });
</script>
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
  <div class="listroom-content">
    <div class="listroom-left">
      <div class="filter-box">
        <div class="filter-title">Custom Filter <span class="clear-filter">Clear All</span></div>
        <div class="filter-section">
          <div class="filter-label">Range Price</div>
          <div class="slider-container">
            <input type="range" min="10" max="250" value="60" id="rangeMin" class="slider">
            <input type="range" min="10" max="250" value="200" id="rangeMax" class="slider">
            <span id="minValue" class="slider-value">60</span>
            <span id="maxValue" class="slider-value">200</span>
          </div>
        </div>
        <div class="filter-section">
          <div class="filter-label">Property Rooms </div>
          <div class="filter-tag-group">
            <span class="filter-tag">2 Bedroom</span>
            <span class="filter-tag active">1 Bedroom</span>
          </div>
        </div>
        <div class="filter-section">
          <div class="filter-label">Area</div>
          <input type="range" id="priceRangeArea" min="15" max="100" value="40" step="5">
          <div id="priceRangeLabels" class="price-range-labels">
            <span id="priceValueMin">15m²</span>
            <span id="priceValueArea" class="ValueInputRange">40²m</span>
            <span id="priceValueMax">100m²</span>
          </div>
        </div>
      </div>
    </div>
    <div class="listroom-right">
      <div class="room-list">
        <!-- Mock data room card để làm giao diện chưa gán động -->
        <?php for ($i = 0; $i < 10; $i++): ?>
          <div class="room-card">
            <div class="room-img">
              <img src="<?= $this->configs->config['pathAssets'] ?>img/bg-card_listrooms.png" alt="Deluxe Room">
            </div>
            <div class="content-card-left">
              <div class="room-title">Deluxe Room</div>
              <div class="room-desc">Modern space with city view, comfy bed, full in-room amenities, work desk, high-speed Wi-Fi, and a relaxing atmosphere for both business and leisure travelers</div>
              <div class="room-utilities">
              <?php for ($j = 0; $j < 7; $j++): ?>
                <div class="utility-item">32m²</div>
              <?php endfor; ?>
              </div>
            </div>
            <div class="content-card-right">
              <div class="room-best"> Best Price</div>
              <div class="room-price">
                <span class="room-old-price">$320</span>
                <span class="room-new-price">$290</span>
              </div>
              <button class="room-detail-btn">View Details</button>
            </div>
          </div>
        <?php endfor; ?>
      </div>
    </div>
  </div>
</div>
<script>
  const rangeMin = document.getElementById('rangeMin');
  const rangeMax = document.getElementById('rangeMax');
  const minValue = document.getElementById('minValue');
  const maxValue = document.getElementById('maxValue');
  const sliderContainer = document.querySelector('.slider-container');


  function getPercent(val, min, max) {
    return ((val - min) / (max - min)) * 100;
  }


  function updateSlider() {
    let min = parseInt(rangeMin.value);
    let max = parseInt(rangeMax.value);
    if (min > max - 10) {
      rangeMin.value = max - 10;
      min = max - 10;
    }
    if (max < min + 10) {
      rangeMax.value = min + 10;
      max = min + 10;
    }
    minValue.textContent = `$${min}`;
    maxValue.textContent = `$${max}`;


    // Tính vị trí left cho value
    const minPercent = getPercent(min, 10, 250);
    const maxPercent = getPercent(max, 10, 250);


    minValue.style.left = `calc(${minPercent}% - 20px)`;
    maxValue.style.left = `calc(${maxPercent}% - 20px)`;
  }
  rangeMin.addEventListener('input', updateSlider);
  rangeMax.addEventListener('input', updateSlider);
  updateSlider();


  //
  const sliderArea = document.getElementById("priceRangeArea");
  const priceTextArea = document.getElementById("priceValueArea");
  sliderArea.addEventListener("input", () => {
    priceTextArea.textContent = `${sliderArea.value}m²`;
  });
</script>



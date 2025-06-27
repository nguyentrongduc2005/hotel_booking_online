<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/listroom.css?v=<?= time() ?>" />




<div id="listroom-container">
  <div class="listroom-search">
    <form class="search-bar" action="<?= $this->configs->config['basePath'] ?>/listroom" method="get">
      <div class="search-group">
        <label class="title">Check In
        </label>
        <input type="date" name="checkin" id="checkin" class="search-date" value="<?= isset($filters['checkin']) ? $filters['checkin'] : '2024-06-18' ?>" required>
      </div>
      <div class="search-group">
        <label class="title">Check out</label>
        <input type="date" name="checkout" id="checkout" class="search-date" value="<?= isset($filters['checkout']) ? $filters['checkout'] : '2024-06-19' ?>" required>
      </div>
      <div class="search-group">
        <label class="title1" for="room_count_select">Room/Guest</label>
        <select name="guest" id="room_count_select" class="room-select">
          <option value="1" <?= (isset($filters['guest_count']) && $filters['guest_count'] == 1) ? 'selected' : '' ?>>1 Guest</option>
          <option value="2" <?= (isset($filters['guest_count']) && $filters['guest_count'] == 2) ? 'selected' : '' ?>>2 Guests</option>
          <option value="3" <?= (isset($filters['guest_count']) && $filters['guest_count'] == 3) ? 'selected' : '' ?>>3 Guests</option>
          <option value="4" <?= (isset($filters['guest_count']) && $filters['guest_count'] == 4) ? 'selected' : '' ?>>4 Guests</option>
        </select>
      </div>

      <!-- Hidden inputs cho các filter -->
      <input type="hidden" name="price_range" id="price_range_input" value="<?= isset($filters['price_range']) ? $filters['price_range'] : '60-200' ?>">
      <input type="hidden" name="area_range" id="area_range_input" value="<?= isset($filters['area_range']) ? $filters['area_range'] : '15-100' ?>">
      <input type="hidden" name="bed_count" id="bed_count_input" value="<?= isset($filters['bed_count']) ? $filters['bed_count'] : '' ?>">

      <button type="submit" class="search-btn">
        <span class="search-icon">Search Rooms</span>
      </button>
    </form>
  </div>
  <div class="listroom-content">
    <div class="listroom-left">
      <div class="filter-box">
        <div class="filter-title">Custom Filter <span class="clear-filter" onclick="clearAllFilters()">Clear All</span></div>
        <div class="filter-section">
          <div class="filter-label">Range Price</div>
          <div class="slider-container">
            <input type="range" min="10" max="250" value="<?= isset($filters['price_range']) ? explode('-', $filters['price_range'])[0] : '60' ?>" id="rangeMin" class="slider">
            <input type="range" min="10" max="250" value="<?= isset($filters['price_range']) ? explode('-', $filters['price_range'])[1] : '200' ?>" id="rangeMax" class="slider">
            <span id="minValue" class="slider-value"><?= isset($filters['price_range']) ? explode('-', $filters['price_range'])[0] : '60' ?></span>
            <span id="maxValue" class="slider-value"><?= isset($filters['price_range']) ? explode('-', $filters['price_range'])[1] : '200' ?></span>
          </div>
        </div>
        <div class="filter-section">
          <div class="filter-label">Property Rooms </div>
          <div class="filter-tag-group">
            <span class="filter-tag <?= (isset($filters['bed_count']) && $filters['bed_count'] == 2) ? 'active' : '' ?>" onclick="toggleBedFilter(2)">2 Bedroom</span>
            <span class="filter-tag <?= (isset($filters['bed_count']) && $filters['bed_count'] == 1) ? 'active' : '' ?>" onclick="toggleBedFilter(1)">1 Bedroom</span>
          </div>
        </div>
        <div class="filter-section">
          <div class="filter-label">Area</div>
          <input type="range" id="priceRangeArea" min="15" max="100" value="<?= isset($filters['area_range']) ? explode('-', $filters['area_range'])[1] : '40' ?>" step="5">
          <div id="priceRangeLabels" class="price-range-labels">
            <span id="priceValueMin">15m²</span>
            <span id="priceValueArea" class="ValueInputRange"><?= isset($filters['area_range']) ? explode('-', $filters['area_range'])[1] : '40' ?>m²</span>
            <span id="priceValueMax">100m²</span>
          </div>
        </div>
      </div>
    </div>
    <div class="listroom-right">
      <div class="room-list">
        <?php if (empty($rooms)): ?>
          <div class="no-results">
            <h3>Không tìm thấy phòng phù hợp</h3>
            <p>Vui lòng thử lại với các tiêu chí khác hoặc thay đổi ngày đặt phòng.</p>
          </div>
        <?php else: ?>
          <?php foreach ($rooms as $room): ?>
            <div class="room-card">
              <div class="room-img">
                <img src="<?= $this->configs->config['pathAssets'] . $room['thumb'] ?>" alt="<?= htmlspecialchars($room['name_type_room']) ?>">
              </div>
              <div class="content-card-left">
                <div class="room-title"><?= htmlspecialchars($room['name_type_room']) ?></div>
                <div class="room-desc"><?= htmlspecialchars($room['description']) ?></div>
                <div class="room-utilities">
                  <div class="utility-item"><?= $room['amount_bed'] ?> Bedroom</div>
                  <div class="utility-item"><?= $room['capacity'] ?> Guests</div>
                  <div class="utility-item"><?= $room['area'] ?>m²</div>
                </div>
              </div>
              <div class="content-card-right">
                <div class="room-best">Best Price</div>
                <div class="room-price">
                  <span class="room-new-price">$<?= number_format($room['price']) ?></span>
                </div>
                <a href="<?= $this->configs->config['basePath'] ?>/detailroom/<?= htmlspecialchars($room['slug']) ?>"
                  class="btn-view-detail"><button class="room-detail-btn">View Details</button></a>
              </div>
            </div>
          <?php endforeach; ?>
        <?php endif; ?>
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
  const priceRangeInput = document.getElementById('price_range_input');
  const areaRangeInput = document.getElementById('area_range_input');
  const bedCountInput = document.getElementById('bed_count_input');
  const priceRangeArea = document.getElementById('priceRangeArea');
  const priceTextArea = document.getElementById('priceValueArea');

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

    // Cập nhật hidden input
    priceRangeInput.value = `${min}-${max}`;

    // Tính vị trí left cho value
    const minPercent = getPercent(min, 10, 250);
    const maxPercent = getPercent(max, 10, 250);

    minValue.style.left = `calc(${minPercent}% - 20px)`;
    maxValue.style.left = `calc(${maxPercent}% - 20px)`;
  }

  function updateAreaSlider() {
    const areaValue = priceRangeArea.value;
    priceTextArea.textContent = `${areaValue}m²`;
    areaRangeInput.value = `15-${areaValue}`;
  }

  function toggleBedFilter(bedCount) {
    const tags = document.querySelectorAll('.filter-tag');
    tags.forEach(tag => tag.classList.remove('active'));

    if (bedCountInput.value == bedCount) {
      bedCountInput.value = '';
    } else {
      bedCountInput.value = bedCount;
      event.target.classList.add('active');
    }

    // Auto submit sau khi thay đổi bed filter
    debouncedSubmit();
  }

  function clearAllFilters() {
    // Reset price range
    rangeMin.value = 60;
    rangeMax.value = 200;
    priceRangeInput.value = '60-200';

    // Reset area
    priceRangeArea.value = 40;
    areaRangeInput.value = '15-100';

    // Reset bed count
    bedCountInput.value = '';
    document.querySelectorAll('.filter-tag').forEach(tag => tag.classList.remove('active'));

    // Reset guest count
    document.getElementById('room_count_select').value = '1';

    // Update display
    updateSlider();
    updateAreaSlider();

    // Auto submit sau khi clear
    debouncedSubmit();
  }

  // Event listeners
  rangeMin.addEventListener('input', updateSlider);
  rangeMax.addEventListener('input', updateSlider);
  priceRangeArea.addEventListener("input", updateAreaSlider);

  // Auto submit form when filters change
  function autoSubmitForm() {
    const form = document.querySelector('.search-bar');
    const submitBtn = form.querySelector('.search-btn');

    // Thêm loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="search-icon">Searching...</span>';

    form.submit();
  }

  // Thêm debounce để tránh submit quá nhiều
  let submitTimeout;

  function debouncedSubmit() {
    clearTimeout(submitTimeout);
    submitTimeout = setTimeout(autoSubmitForm, 500);
  }

  // Auto submit khi thay đổi filter
  rangeMin.addEventListener('change', debouncedSubmit);
  rangeMax.addEventListener('change', debouncedSubmit);
  priceRangeArea.addEventListener('change', debouncedSubmit);

  // Submit form khi thay đổi guest count
  document.getElementById('room_count_select').addEventListener('change', function() {
    debouncedSubmit();
  });

  // Submit form khi thay đổi ngày
  document.getElementById('checkin').addEventListener('change', function() {
    debouncedSubmit();
  });

  document.getElementById('checkout').addEventListener('change', function() {
    debouncedSubmit();
  });

  // Initialize
  updateSlider();
  updateAreaSlider();
</script>
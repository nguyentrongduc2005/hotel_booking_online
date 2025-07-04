<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/listroom.css?v=<?= time() ?>" />
<?php date_default_timezone_set('Asia/Ho_Chi_Minh');
$datePresent = date('Y-m-d');
$nextDate = date('Y-m-d', strtotime($datePresent . ' +1 day'));
?>
<!-- lấy từ cơ chế listroom qua thôi lấy này hôm nay và ngày mai gán mặc định  -->
<div id="listroom-container">
  <div class="listroom-search">
    <form class="search-bar" action="<?= $this->configs->config['basePath'] ?>/listroom" method="get">
      <div class="search-group">
        <label class="title">Check In
        </label>
        <input type="date" name="check_in" id="check_in" class="search-date" value="<?= isset($filters['check_in']) ? $filters['check_in'] : $datePresent ?>" required>
      </div>
      <div class="search-group">
        <label class="title">Check out</label>
        <input type="date" name="check_out" id="check_out" class="search-date" value="<?= isset($filters['check_out']) ? $filters['check_out'] : $nextDate ?>" required>
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
      <input type="hidden" name="price_range" id="price_range_input" value="<?= isset($filters['price_range']) ? $filters['price_range'] : '15-150' ?>">
      <input type="hidden" name="area_range" id="area_range_input" value="<?= isset($filters['area_range']) ? $filters['area_range'] : '15-80' ?>">
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
            <input type="range" min="10" max="140" value="<?= isset($filters['price_range']) ? explode('-', $filters['price_range'])[0] : '15' ?>" id="rangeMin" class="slider">
            <input type="range" min="20" max="150" value="<?= isset($filters['price_range']) ? explode('-', $filters['price_range'])[1] : '100' ?>" id="rangeMax" class="slider">
            <span id="minValue" class="slider-value"><?= isset($filters['price_range']) ? explode('-', $filters['price_range'])[0] : '15' ?></span>
            <span id="maxValue" class="slider-value"><?= isset($filters['price_range']) ? explode('-', $filters['price_range'])[1] : '100' ?></span>
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
          <div class="slider-container">
            <input type="range" min="15" max="80" value="<?= isset($filters['area_range']) ? explode('-', $filters['area_range'])[0] : '15' ?>" id="areaMin" class="slider">
            <input type="range" min="20" max="80" value="<?= isset($filters['area_range']) ? explode('-', $filters['area_range'])[1] : '70' ?>" id="areaMax" class="slider">
            <span id="areaMinValue" class="slider-value"><?= isset($filters['area_range']) ? explode('-', $filters['area_range'])[0] : '15' ?></span>
            <span id="areaMaxValue" class="slider-value"><?= isset($filters['area_range']) ? explode('-', $filters['area_range'])[1] : '70' ?></span>
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
<script src="<?= $this->configs->config['pathAssets'] ?>js/listrooms.js?v=<?= time() ?>"></script>
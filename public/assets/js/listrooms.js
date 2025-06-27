
  const rangeMin = document.getElementById('rangeMin');
  const rangeMax = document.getElementById('rangeMax');
  const minValue = document.getElementById('minValue');
  const maxValue = document.getElementById('maxValue');
  const sliderContainer = document.querySelector('.slider-container');
  const priceRangeInput = document.getElementById('price_range_input');
  const areaRangeInput = document.getElementById('area_range_input');
  const bedCountInput = document.getElementById('bed_count_input');
  const areaMin = document.getElementById('areaMin');
  const areaMax = document.getElementById('areaMax');
  const areaMinValue = document.getElementById('areaMinValue');
  const areaMaxValue = document.getElementById('areaMaxValue');

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
    const minPercent = getPercent(min, 10, 150);
    const maxPercent = getPercent(max, 10, 150);

    minValue.style.left = `calc(${minPercent}% - 20px)`;
    maxValue.style.left = `calc(${maxPercent}% - 20px)`;
  }

  function updateAreaSlider() {
    let min = parseInt(areaMin.value);
    let max = parseInt(areaMax.value);
    if (min > max - 5) {
      areaMin.value = max - 5;
      min = max - 5;
    }
    if (max < min + 5) {
      areaMax.value = min + 5;
      max = min + 5;
    }
    areaMinValue.textContent = `${min}m²`;
    areaMaxValue.textContent = `${max}m²`;
    areaRangeInput.value = `${min}-${max}`;

    // Tính vị trí left cho value (nếu muốn đẹp)
    const minPercent = ((min - 15) / (100 - 15)) * 100;
    const maxPercent = ((max - 15) / (100 - 15)) * 100;
    areaMinValue.style.left = `calc(${minPercent}% - 20px)`;
    areaMaxValue.style.left = `calc(${maxPercent}% - 20px)`;
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
    rangeMin.value = 10;
    rangeMax.value = 120;
    priceRangeInput.value = '10-120';

    // Reset area
    areaMin.value = 15;
    areaMax.value = 60;
    areaRangeInput.value = '15-60';

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
  areaMin.addEventListener('input', updateAreaSlider);
  areaMax.addEventListener('input', updateAreaSlider);

  // Auto submit form when filters change
  function autoSubmitForm() {
    const form = document.querySelector('.search-bar');
    const submitBtn = form.querySelector('.search-btn');

    // Thêm loading state
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="search-icon loading">Searching...</span>';

    form.submit();
  }

  // Thêm debounce để tránh submit quá nhiều
  let submitTimeout;

  function debouncedSubmit() {
    clearTimeout(submitTimeout);
    submitTimeout = setTimeout(autoSubmitForm, 1000);
  }

  // Auto submit khi thay đổi filter
  rangeMin.addEventListener('change', debouncedSubmit);
  rangeMax.addEventListener('change', debouncedSubmit);
  areaMin.addEventListener('change', debouncedSubmit);
  areaMax.addEventListener('change', debouncedSubmit);

  // Submit form khi thay đổi guest count
  document.getElementById('room_count_select').addEventListener('change', function() {
    debouncedSubmit();
  });

  // Submit form khi thay đổi ngày
  document.getElementById('check_in').addEventListener('change', function() {
    debouncedSubmit();
  });

  document.getElementById('check_out').addEventListener('change', function() {
    debouncedSubmit();
  });

  // Initialize
  updateSlider();
  updateAreaSlider();
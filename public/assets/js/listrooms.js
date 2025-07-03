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
const checkIn = document.getElementById('check_in');
const checkOut = document.getElementById('check_out');

// Tạo biến ngày hôm nay (yyyy-mm-dd)
function getToday() {
  const today = new Date();
  const yyyy = today.getFullYear();
  const mm = String(today.getMonth() + 1).padStart(2, '0');
  const dd = String(today.getDate()).padStart(2, '0');
  return `${yyyy}-${mm}-${dd}`;
}

// Tạo biến ngày mai (yyyy-mm-dd)
function getTomorrow() {
  const tomorrow = new Date();
  tomorrow.setDate(tomorrow.getDate() + 1);
  const yyyy = tomorrow.getFullYear();
  const mm = String(tomorrow.getMonth() + 1).padStart(2, '0');
  const dd = String(tomorrow.getDate()).padStart(2, '0');
  return `${yyyy}-${mm}-${dd}`;
}

const datePresent = getToday();
const nextDate = getTomorrow();
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

  const checkInValue = checkIn.value;
  const checkOutValue = checkOut.value;

  if (!checkInValue || !checkOutValue) {
    setTimeout(() => {
      alert("Oops! Don't forget to pick both check-in and check-out dates.");
    }, 3000);
    // set timeout 5s để hiển thị alert
    return;
  }
  // Convert về Date object để so sánh ngày
  function parseDateFromInput(dateStr) {
    const [yyyy, mm, dd] = dateStr.split('-').map(Number);
    return new Date(yyyy, mm - 1, dd); // tháng -1 vì JS tính từ 0
  }

  const checkInDate = parseDateFromInput(checkInValue);
  const checkOutDate = parseDateFromInput(checkOutValue);
  // Check ngày checkout phải sau checkin
  const diffDays = (checkOutDate - checkInDate) / (1000 * 60 * 60 * 24);
  // Lấy lại giá trị ngày hôm nay và mai cho search 
  if (diffDays < 1) {
    setTimeout(() => {
      checkIn.value = datePresent;
      checkOut.value = nextDate;
      alert("Check-out date must be at least 1 day after check-in date.");
      return;
    }, 1500);
    // Set lại giá trị cho input cho thanh search như bên home page
    checkInDate
    return;
  }
  // validate 
  // trước khi đưa vào sessionSt
  // Lưu dữ liệu đã submit vào sessionStorage trước khi submit form
  sessionStorage.setItem('lastSearch', JSON.stringify({
    checkIn: checkInValue,
    checkOut: checkOutValue,
    diffDays: getDiffDays(checkInValue, checkOutValue),
  }));
  // Thêm loading state

  form.submit();
  // log ra console để kiểm tra
  // console.log('Form submitted with filters:', {
  //   checkIn: document.getElementById('check_in').value,
  //   checkOut: document.getElementById('check_out').value
  // });
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
document.getElementById('room_count_select').addEventListener('change', function () {
  debouncedSubmit();
});

// Submit form khi thay đổi ngày
document.getElementById('check_in').addEventListener('change', function () {
  debouncedSubmit();
});

document.getElementById('check_out').addEventListener('change', function () {
  debouncedSubmit();
});

// Khi vào trang listroom, nếu chưa có lastSearch thì set mặc định hôm nay và ngày mai
if (!sessionStorage.getItem('lastSearch')) {
  sessionStorage.setItem('lastSearch', JSON.stringify({
    checkIn: getToday(),
    checkOut: getTomorrow(),
    diffDays: getDiffDays(getToday(), getTomorrow())
  }));
}

// Initialize
updateSlider();
updateAreaSlider();

// lấy ra ngầy để vô sessionStorage
function getDiffDays(checkInValue, checkOutValue) {
  // checkInValue và checkOutValue là chuỗi dạng 'yyyy-mm-dd'
  const [yyyy1, mm1, dd1] = checkInValue.split('-').map(Number);
  const [yyyy2, mm2, dd2] = checkOutValue.split('-').map(Number);
  const checkInDate = new Date(yyyy1, mm1 - 1, dd1);
  const checkOutDate = new Date(yyyy2, mm2 - 1, dd2);
  const diffTime = checkOutDate - checkInDate;
  const diffDays = Math.round(diffTime / (1000 * 60 * 60 * 24));
  return diffDays;
}

// console.log(getDiffDays('2024-06-01', '2024-06-05'));




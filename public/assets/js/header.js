// Xử lý popup đăng nhập

document.addEventListener('DOMContentLoaded', function() {
  const loginBtn = document.querySelector('.btn-login');
  const popup = document.getElementById('loginPopup');
  const closeBtn = document.getElementById('closeLoginPopup');

  // Hiện popup khi bấm LOGIN
  if (loginBtn) {
    loginBtn.addEventListener('click', function(e) {
      e.preventDefault();
      popup.style.display = 'flex';
      console.log('popup');
    });
  }

  // Đóng popup khi bấm nút đóng
  if (closeBtn) {
    closeBtn.addEventListener('click', function() {
      popup.style.display = 'none';
    });
  }

  // Đóng popup khi bấm ra ngoài nội dung popup
  window.addEventListener('click', function(event) {
    if (event.target === popup) {
      popup.style.display = 'none';
    }
  });
}); 
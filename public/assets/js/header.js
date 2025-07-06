// Xử lý popup đăng nhập và navigation active state

document.addEventListener('DOMContentLoaded', function () {
  const loginBtn = document.querySelector('.btn-login');
  const popup = document.getElementById('loginPopup');
  const closeBtn = document.getElementById('closeLoginPopup');
  const navLinks = document.querySelectorAll('.nav-link');

  // Xử lý active state cho navigation
  function setActiveNavLink() {
    const currentPath = window.location.pathname;
    navLinks.forEach(link => {
      link.classList.remove('active');
      if (link.getAttribute('href') === currentPath || 
          (currentPath === '/' && link.getAttribute('href') === '/') ||
          (currentPath.includes('/listroom') && link.getAttribute('href').includes('/listroom')) ||
          (currentPath.includes('/services') && link.getAttribute('href').includes('/services')) ||
          (currentPath.includes('/contact') && link.getAttribute('href').includes('/contact'))) {
        link.classList.add('active');
      }
    });
  }

  // Gọi function khi trang load
  setActiveNavLink();

  // Xử lý focus cho nav links
  navLinks.forEach(link => {
    link.addEventListener('focus', function() {
      this.classList.add('active');
    });
    
    link.addEventListener('blur', function() {
      // Chỉ remove active nếu không phải trang hiện tại
      const currentPath = window.location.pathname;
      if (this.getAttribute('href') !== currentPath) {
        this.classList.remove('active');
      }
    });
  });

  // Hiện popup khi bấm LOGIN
  if (loginBtn) {
    loginBtn.addEventListener('click', function (e) {
      e.preventDefault();
      popup.style.display = 'flex';
    });
  } else {
    popup.style.display = 'none';
  }

  // Đóng popup khi bấm nút đóng
  if (closeBtn) {
    closeBtn.addEventListener('click', function () {
      popup.style.display = 'none';
    });
  }

  // Đóng popup khi bấm ra ngoài nội dung popup
  popup.addEventListener('click', function (event) {
    if (!event.target.closest('.login-popup-content')) {
      popup.style.display = 'none';
      console.log('close');
    }
  });
});



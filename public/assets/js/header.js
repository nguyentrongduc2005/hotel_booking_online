// Xử lý popup đăng nhập

document.addEventListener('DOMContentLoaded', function () {
  const loginBtn = document.querySelector('.btn-login');
  const popup = document.getElementById('loginPopup');
  const closeBtn = document.getElementById('closeLoginPopup');

  // Hiện popup khi bấm LOGIN
  if (loginBtn) {
    loginBtn.addEventListener('click', function (e) {
      e.preventDefault();
      popup.style.display = 'flex';
    });
  }else{
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

function checktokenTimer(access) {

  let confirmExtend = confirm("Phiên của bạn sẽ hết hạn sau vài phút. Bấm OK để tiếp tục phiên.");
  if (confirmExtend) {
    fetch(access + "/refeshToken", { credentials: 'include' })
      .then(res => {

        if (res.status === 401) {
          alert("Phiên đã hết hạn. Vui lòng đăng nhập lại.");
          window.location.href = access + "/login";
        } else {
          return res.json();
        }
      })
      .then(data => {
        if (data.refreshToken) {
          alert("Phiên làm việc đã được gia hạn.");
        }
      })
      .catch(() => {
        alert("Lỗi khi gia hạn phiên. Vui lòng thử lại.");
        window.location.href = access + "/login";
      });

  }
}

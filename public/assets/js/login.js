// Hiệu ứng timeout chuyển trang sau khi đăng nhập thành công
function redirectAfterLogin(url) {
    setTimeout(function () {
        window.location.href = url;
    }, 3000); // 3 giây
}

// Nếu có phần tử thông báo thành công, tự động chuyển hướng
window.addEventListener('DOMContentLoaded', function () {
    var successMsg = document.querySelector('.login-message');
    if (successMsg && successMsg.textContent.includes('Đăng nhập thành công')) {
        // Thay đổi đường dẫn dưới đây thành trang bạn muốn chuyển hướng tới sau đăng nhập
        redirectAfterLogin('/');
    }
}); 
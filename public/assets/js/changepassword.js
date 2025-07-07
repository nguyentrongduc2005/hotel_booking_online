// Popup change password
// Lấy các phần tử HTML cần thiết
const openPopup = document.getElementById("open-popup"); // Nút mở popup
const popupOverlay = document.querySelector(".popup-overlay"); // Lớp phủ popup
const closePopup = document.getElementById("close-popup"); // Nút đóng popup
const mainContent = document.getElementById("main-content"); // Nội dung chính của trang
const changePasswordForm = document.getElementById("change-password-form"); // Form đổi mật khẩu
const oldPasswordInput = document.getElementById("old"); // Input mật khẩu cũ
const newPasswordInput = document.getElementById("new"); // Input mật khẩu mới
const confirmPasswordInput = document.getElementById("confirm"); // Input xác nhận mật khẩu mới
const saveButton = document.querySelector(".popup-save"); // Nút lưu thay đổi

// Đảm bảo tất cả các phần tử đều tồn tại trước khi thêm sự kiện
// Xử lý khi nhấp vào nút mở popup
openPopup.addEventListener("click", () => {
  popupOverlay.style.display = "flex"; // Hiển thị popup
  document.body.style.overflow = "hidden"; // Ngăn cuộn trang chính
  popupOverlay.classList.add("show"); // Làm mờ nội dung chính
});

// Xử lý khi nhấp vào nút đóng popup
closePopup.addEventListener("click", () => {
  popupOverlay.style.display = "none"; // Ẩn popup
  document.body.style.overflow = "auto"; // Cho phép cuộn trang chính
  popupOverlay.classList.remove("show"); // Bỏ làm mờ
});

// Xử lý khi nhấp vào vùng ngoài của popup
popupOverlay.addEventListener("click", (e) => {
  if (e.target === popupOverlay) {
    // Nếu click đúng vào lớp phủ, không phải nội dung popup
    popupOverlay.style.display = "none"; // Ẩn popup
    document.body.style.overflow = "auto"; // Cho phép cuộn trang chính
  }
});
function changePassword(oldPass, newPass) {
  fetch("/hotel_booking_online/public/user/changePass", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    credentials: "same-origin",
    body: JSON.stringify({
      pass_old: oldPass,
      pass_new: newPass,
    }),
  })
    .then((response) => response.json())
    .then((data) => {
      console.log("Kết quả từ API:", data);
      if (data.statusApi === true) {
        // Thành công: chuyển hướng về trang user
        window.location.href = "/hotel_booking_online/public/user";
      } else {
        // Thất bại: hiện thông báo lỗi
        alert("Mật khẩu cũ không đúng hoặc có lỗi xảy ra!");
      }
    })
    .catch((error) => {
      console.error("Lỗi khi gọi API:", error);
      alert("Đã xảy ra lỗi khi kết nối đến server.");
    });
}
// const oldPasswordInput = document.getElementById("old"); // Input mật khẩu cũ
// const newPasswordInput = document.getElementById("new"); // Input mật khẩu mới
// const confirmPasswordInput = document.getElementById("confirm"); // Input xác nhận mật khẩu mới
// const saveButton = document.querySelector(".popup-save"); // Nút lưu thay đổi
saveButton.addEventListener("click", () => {
  const oldPassword = oldPasswordInput.value.trim();
  const newPassword = newPasswordInput.value.trim();
  const confirmPassword = confirmPasswordInput.value.trim();

  // Kiểm tra các trường nhập liệu
  if (!oldPassword || !newPassword || !confirmPassword) {
    alert("Vui lòng điền đầy đủ thông tin.");
    return;
  }

  if (newPassword !== confirmPassword) {
    alert("Mật khẩu mới và xác nhận mật khẩu không khớp.");
    return;
  }

  // Gọi hàm đổi mật khẩu
  changePassword(oldPassword, newPassword);
  //click sidebar
  const menuItems = document.querySelectorAll(".sidebar .menu-item");
  menuItems.forEach((item) => {
    item.addEventListener("click", () => {
      const targetUrl = item.getAttribute("data-href");
      if (targetUrl) {
        window.location.href = targetUrl;
      }
    });
  });
});
//click sidebar
document.addEventListener("DOMContentLoaded", () => {
  const menuItems = document.querySelectorAll(".sidebar .menu-item");

  menuItems.forEach((item) => {
    item.addEventListener("click", () => {
      const targetUrl = item.getAttribute("data-href");
      if (targetUrl) {
        window.location.href = targetUrl;
      }
    });
  });
});

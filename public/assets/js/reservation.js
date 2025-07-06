// reservation.js - Basic JS for reservation page

document.addEventListener("DOMContentLoaded", function () {
  // Example: Handle reservation form submission
  const form = document.getElementById("reservationForm");
  if (form) {
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      // Collect form data
      const formData = new FormData(form);
      // Simple validation example
      if (!formData.get("name") || !formData.get("date")) {
        alert("Vui lòng nhập đầy đủ thông tin!");
        return;
      }
      // Simulate sending data
      alert("Đặt phòng thành công!\nCảm ơn bạn đã đặt phòng.");
      form.reset();
    });
  }
});

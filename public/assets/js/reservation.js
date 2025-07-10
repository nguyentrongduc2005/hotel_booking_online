document.addEventListener("DOMContentLoaded", () => {
  const searchForm = document.getElementById("search-form");
  const searchInput = document.getElementById("search-input");
  const clearBtn = document.getElementById("clear-btn");
  const findBtn = document.getElementById("find-btn");
  const basePath = "<?= $this->getConfig('basePath') ?>";
  if (searchInput && clearBtn && findBtn && searchForm) {
    clearBtn.style.display = searchInput.value.trim() ? "flex" : "none";

    searchInput.addEventListener("input", () => {
      clearBtn.style.display = searchInput.value.trim() ? "flex" : "none";
    });

    clearBtn.addEventListener("mousedown", (e) => {
      e.preventDefault();
      searchInput.value = "";
      clearBtn.style.display = "none";
      setTimeout(() => searchInput.focus(), 0);
    });

    findBtn.addEventListener("click", (e) => {
      if (e.target === searchInput || clearBtn.contains(e.target)) return;
      searchInput.value.trim() ? searchForm.submit() : searchInput.focus();
    });
  }

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
// Cancel reservation
document.addEventListener("DOMContentLoaded", function () {
  const cancelButtons = document.querySelectorAll(".cancel-btn");

  cancelButtons.forEach((btn) => {
    btn.addEventListener("click", function (e) {
      e.preventDefault();

      const bookingId = btn.dataset.bookingId;
      const card = btn.closest(".card");

      if (!bookingId) return;

      if (confirm("Bạn có chắc chắn muốn huỷ booking này không?")) {
        fetch(`/hotel_booking_online/public/user/reservations/cancel`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ id_booking: bookingId }),
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.statusApi) {
              card.style.transition = "all 0.5s ease";
              card.style.opacity = "0";
              setTimeout(() => card.remove(), 500);
            } else {
              alert("Không thể huỷ booking. Vui lòng thử lại.");
            }
          })
          .catch(() => {
            alert("Có lỗi kết nối đến máy chủ.");
          });
      }
    });
  });
});

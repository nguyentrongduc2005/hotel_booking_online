document.addEventListener("DOMContentLoaded", () => {
  // console.log("JS Loaded");
  //search
  const searchForm = document.getElementById("search-form");
  const searchInput = document.getElementById("search-input");
  const clearBtn = document.getElementById("clear-btn");
  const findBtn = document.getElementById("find-btn");

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
  // Cancel reservation
  const cancelButtons = document.querySelectorAll(".cancel-btn");

  cancelButtons.forEach((button) => {
    button.addEventListener("click", function (e) {
      e.preventDefault();

      const card = this.closest(".card");
      const bookingId = this.dataset.bookingId;

      if (!bookingId) {
        alert("Booking ID not found.");
        return;
      }

      if (confirm("Are you sure you want to cancel this booking?")) {
        fetch("/user/reservations/cancel", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: `id_booking=${encodeURIComponent(bookingId)}`,
        })
          .then((response) => response.json())
          .then((data) => {
            if (data.statusApi) {
              card.style.transition = "all 0.5s ease";
              card.style.transform = "translateY(-100%)";
              card.style.opacity = "0";
              setTimeout(() => {
                card.remove();
              }, 500);
            } else {
              alert("Failed to cancel the booking. Please try again.");
            }
          })
          .catch((error) => {
            console.error("Error sending cancellation request:", error);
            alert("An error occurred. Please try again later.");
          });
      }
    });
  });
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

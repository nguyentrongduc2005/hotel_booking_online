//Automatically refocus if input loses focus while being hovered
function autoRefocusOnHover(inputId) {
  const input = document.getElementById(inputId);
  if (!input) return;

  input.addEventListener("blur", () => {
    setTimeout(() => {
      if (input.matches(":hover")) {
        input.focus();
      }
    }, 10);
  });
}

// Automatically capitalize the first letter in the input
function capitalizeFirstLetterOnInput(inputId) {
  const input = document.getElementById(inputId);
  if (!input) return;

  input.addEventListener("input", () => {
    const val = input.value;
    input.value = val.charAt(0).toUpperCase() + val.slice(1);
  });
}

//Apply to all relevant input fields
function initSearchBehavior() {
  autoRefocusOnHover("search-input");
  capitalizeFirstLetterOnInput("search-input");

  const clearBtn = document.getElementById("clear-btn");
  const searchInput = document.getElementById("search-input");

  if (clearBtn && searchInput) {
    clearBtn.addEventListener("click", () => {
      searchInput.value = "";
      searchInput.focus();
    });
  }
}

// Call the initialization function when the DOM is fully loaded
document.addEventListener("DOMContentLoaded", function () {
  initSearchBehavior();

  //back button functionality
  const backBtn = document.querySelector(".back-button");
  if (backBtn) {
    backBtn.addEventListener("click", function () {
      window.history.back();
    });
  }

  // //delete booking
  const cancelButtons = document.querySelectorAll(".cancel-btn");
  if (cancelButtons.length === 0) {
    console.warn("Không tìm thấy .cancel-btn nào.");
    return;
  }

  cancelButtons.forEach((btn) => {
    btn.addEventListener("click", function () {
      const card = this.closest(".card");
      if (card) {
        card.style.display = "none";
        // card.remove(); delete
        // card.style.display = 'none'; hide
        // card.style.display = "flex"; show
      }
    });
  });
  document.addEventListener("DOMContentLoaded", function () {
    // Change status on click
    const statusButtons = document.querySelectorAll(".status.clickable");

    statusButtons.forEach((btn) => {
      btn.addEventListener("click", function () {
        const isCompleted = this.classList.toggle("completed");
        this.textContent = isCompleted ? "Completed" : "Pending";

        // Optional: You can handle additional styles via JS if needed
        // But it's cleaner to do it via CSS with .completed class
      });
    });

    // Change timeline bar colors on click
    const timelineBars = document.querySelectorAll(".timeline-bar.clickable");

    timelineBars.forEach((bar) => {
      bar.addEventListener("click", function () {
        const left = this.querySelector(".timeline-left");
        const right = this.querySelector(".timeline-right");

        const checkedOut = window
          .getComputedStyle(right)
          .backgroundColor.includes("220, 53, 69"); // rgb(220, 53, 69) is red

        if (checkedOut) {
          right.style.backgroundColor = "#e0e0e0";
          left.style.backgroundColor = "#7FCA8F";
        } else {
          right.style.backgroundColor = "#DC3545";
          left.style.backgroundColor = "#e0e0e0";
        }
      });
    });

    // Optional: Clear search input
    const clearBtn = document.getElementById("clear-btn");
    const searchInput = document.getElementById("search-input");
    if (clearBtn && searchInput) {
      clearBtn.addEventListener("click", () => {
        searchInput.value = "";
      });
    }

    // Popup change password
    const openPopup = document.getElementById("open-popup");
    const popupOverlay = document.getElementById("popup");
    const closePopup = document.getElementById("close-popup");
    const mainContent = document.getElementById("main-content");

    if (openPopup && popupOverlay && closePopup && mainContent) {
      openPopup.addEventListener("click", () => {
        popupOverlay.style.display = "flex";
        document.body.style.overflow = "hidden";
        mainContent.classList.add("blur");
      });

      closePopup.addEventListener("click", () => {
        popupOverlay.style.display = "none";
        document.body.style.overflow = "auto";
        mainContent.classList.remove("blur");
      });

      popupOverlay.addEventListener("click", (e) => {
        if (e.target === popupOverlay) {
          popupOverlay.style.display = "none";
          document.body.style.overflow = "auto";
          mainContent.classList.remove("blur");
        }
      });
    }
  });
  // Cập nhật trạng thái booking và
  document.addEventListener("DOMContentLoaded", function () {
    const bookings = [
      {
        id: 2,
        room: "105",
        status: "Confirmed", // "Pending" or "Confirmed"
        checkin: "03/06/2025",
        checkout: "05/06/2025",
        timeline: "full", // "partial" or "full"
      },
    ];

    bookings.forEach((booking) => {
      // Tìm thẻ card theo Booking ID (nằm trong .transaction-line)
      const card = Array.from(document.querySelectorAll(".card")).find((el) =>
        el.innerHTML.includes(`Booking ID: ${booking.id}`)
      );

      if (!card) return;

      // Cập nhật trạng thái
      const statusEl = card.querySelector(".status");
      if (statusEl) {
        statusEl.textContent = booking.status;
        statusEl.classList.remove("pending", "confirmed");

        if (booking.status === "Confirmed") {
          statusEl.classList.add("confirmed");
          statusEl.style.backgroundColor = "#e0ffe0";
          statusEl.style.borderColor = "#7FCA8F";
          statusEl.style.color = "#317752";
        } else {
          statusEl.classList.add("pending");
          statusEl.style.backgroundColor = "#fff8e1";
          statusEl.style.borderColor = "#f4ce5a";
          statusEl.style.color = "#b89b2b";
        }
      }

      // Cập nhật timeline
      const timeline = card.querySelector(".timeline-bar");
      const left = timeline.querySelector(".timeline-left");
      const right = timeline.querySelector(".timeline-right");

      if (booking.timeline === "full") {
        left.style.backgroundColor = "#7FCA8F"; // đã checkin
        right.style.backgroundColor = "#7FCA8F"; // đã checkout
      } else {
        left.style.backgroundColor = "#7FCA8F"; // đã checkin
        right.style.backgroundColor = "#DC3545"; // chưa checkout
      }
    });
  });
  // Cập nhật trạng thái giao dịch ở transaction
  document.addEventListener("DOMContentLoaded", function () {
    // Ví dụ: dữ liệu backend trả về
    const transactionData = [
      {
        transactionId: 1,
        method: "Momo",
        date: "01/06/2025",
        price: "$45.00",
        status: "confirm", // hoặc "pending", "failed", ...
      },
      // Có thể có nhiều giao dịch khác
    ];

    const cards = document.querySelectorAll(".card");

    cards.forEach((card, index) => {
      const statusElement = card.querySelector(".status");
      if (!statusElement || !transactionData[index]) return;

      const backendStatus = transactionData[index].status.toLowerCase();

      // Gắn text
      statusElement.textContent =
        backendStatus.charAt(0).toUpperCase() + backendStatus.slice(1);

      // Cập nhật CSS theo status
      switch (backendStatus) {
        case "confirm":
          statusElement.style.backgroundColor = "#e0ffe0";
          statusElement.style.color = "#317752";
          statusElement.style.border = "1px solid #7FCA8F";
          break;
        case "pending":
          statusElement.style.backgroundColor = "#fff8e1";
          statusElement.style.color = "#b89b2b";
          statusElement.style.border = "1px solid #f4ce5a";
          break;
        case "failed":
          statusElement.style.backgroundColor = "#fcebea";
          statusElement.style.color = "#dc3545";
          statusElement.style.border = "1px solid #dc3545";
          break;
      }
    });
  });
});

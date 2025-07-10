document.addEventListener("DOMContentLoaded", () => {
  //  Tìm kiếm

  const searchForm = document.getElementById("search-form");
  const searchInput = document.getElementById("search-input");
  const clearBtn = document.getElementById("clear-btn");
  const findBtn = document.getElementById("find-btn");

  if (searchInput && clearBtn && findBtn && searchForm) {
    // Hiển thị nút clear đúng trạng thái khi load
    clearBtn.style.display = searchInput.value.trim() ? "flex" : "none";

    // Khi nhập vào input thì show/hide nút clear
    searchInput.addEventListener("input", () => {
      clearBtn.style.display = searchInput.value.trim() ? "flex" : "none";
    });

    // Khi click nút clear thì xóa input, focus lại, ẩn nút clear
    clearBtn.addEventListener("mousedown", (e) => {
      e.preventDefault();
      searchInput.value = "";
      clearBtn.style.display = "none";
      setTimeout(() => searchInput.focus(), 0);
    });

    // Khi click vùng tìm kiếm (find-btn) thì submit nếu có nội dung
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

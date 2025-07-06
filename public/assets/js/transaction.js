document.addEventListener("DOMContentLoaded", () => {
  // 1. Đổi class trạng thái
  document.querySelectorAll(".status").forEach((el) => {
    const status = el.dataset.status?.toLowerCase();
    el.classList.remove("completed", "pending", "failed");
    if (["completed", "pending", "failed"].includes(status)) {
      el.classList.add(status);
    }
  });

  // 2. Format giá tiền
  document.querySelectorAll(".price").forEach((el) => {
    const num = parseFloat(el.textContent.replace(/[^\d.]/g, ""));
    if (!isNaN(num)) {
      el.textContent = num.toLocaleString("en-US", {
        style: "currency",
        currency: "USD",
        minimumFractionDigits: 2,
      });
    }
  });

  // 5. Fetch danh sách giao dịch
  const fetchTransactions = () => {
    fetch("/api/myTransaction.php")
      .then((res) => res.json())
      .then(renderTransactions)
      .catch(() => {
        document.getElementById("transaction-list").innerHTML =
          '<div class="text-danger">Không thể tải dữ liệu giao dịch.</div>';
      });
  };

  // 6. Render danh sách giao dịch
  const renderTransactions = (transactions) => {
    const list = document.getElementById("transaction-list");
    if (!list) return;

    list.innerHTML = transactions?.length
      ? ""
      : "<div>Không có giao dịch nào.</div>";

    transactions?.forEach((tran) => {
      const card = document.createElement("div");
      card.className = "card mb-3";
      card.style.display = "flex";
      card.dataset.tranId = tran.id;
      card.innerHTML = `
        <div class="card-body d-flex flex-column flex-md-row align-items-md-center">
          <div class="hotel-name flex-grow-1">${tran.hotel_name}</div>
          <div class="price mx-3">${tran.amount}</div>
          <div class="status" data-status="${tran.status}">${
        tran.status_text || tran.status
      }</div>
          <button class="btn btn-sm btn-outline-primary mx-2 view-detail" data-id="${
            tran.id
          }">Chi tiết</button>
          ${
            tran.status === "pending"
              ? `<button class="btn btn-sm btn-danger cancel-btn" data-id="${tran.id}">Hủy</button>`
              : ""
          }
        </div>`;
      list.appendChild(card);
    });

    // Format lại giá
    document.querySelectorAll(".price").forEach((el) => {
      const num = parseFloat(el.textContent.replace(/[^\d.]/g, ""));
      if (!isNaN(num)) {
        el.textContent = num
          .toLocaleString("en-US", {
            style: "currency",
            currency: "VND",
            minimumFractionDigits: 0,
          })
          .replace("VND", "₫");
      }
    });

    // Xem chi tiết
    document.querySelectorAll(".view-detail").forEach((btn) => {
      btn.addEventListener("click", (e) => {
        e.stopPropagation();
        window.location.href = `/transaction-detail.php?id=${btn.dataset.id}`;
      });
    });
  };

  if (document.getElementById("transaction-list")) fetchTransactions();

  // 7. Tìm kiếm
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
});

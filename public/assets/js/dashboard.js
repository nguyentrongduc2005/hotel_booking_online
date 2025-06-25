document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.dashboard-action-accept').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var row = btn.closest('tr');
        var bookingId = row.getAttribute('data-id-booking');
        if (!bookingId) return;
        var url = (window.BASE_PATH || '') + '/dashboard/confirm';
        fetch(url, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          credentials: 'same-origin',
          body: JSON.stringify({ id: bookingId })
        })
        .then(res => {
          if (!res.ok) throw new Error('Network response was not ok');
          return res.json();
        })
        .then(data => {
          if (data.statusApi === 'true') {
            row.remove();
            alert('Xác nhận thành công!');
          } else {
            alert('Xác nhận thất bại!');
          }
        })
        .catch((err) => {
          alert('Có lỗi xảy ra!\n' + err);
        });
      });
    });
  });
// document.addEventListener('DOMContentLoaded', function () {
document.querySelectorAll('.dashboard-action-accept').forEach(function (btn) {
  btn.addEventListener('click', function () {
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
      body: JSON.stringify({
        id: bookingId,
        status: "confirmed"
      })
    })
      .then(res => {
        if (!res.ok) throw new Error('Network response was not ok');
        return res.json();
      })
      .then(data => {
        if (data.statusApi === 'true') {
          row.remove();
          alert(' Confirmation successful!');
        } else {
          alert('Confirmation failed!');
        }
      })
      .catch((err) => {
        alert('An error occurred.\n' + err);
      });
  });
});


document.querySelectorAll('.dashboard-action-reject').forEach(function (btn) {
  btn.addEventListener('click', function () {
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
      body: JSON.stringify({
        id: bookingId,
        status: "cancelled"
      })
    })
      .then(res => {
        if (!res.ok) throw new Error('Network response was not ok');
        return res.json();
      })
      .then(data => {
        if (data.statusApi === 'true') {
          row.remove();
          alert('Booking cancellation successful!');
        } else {
          alert('Booking cancellation failed!');
        }
      })
      .catch((err) => {
        alert('An error occurred!\n' + err);
      });
  });
});
// });


function checktokenTimer(access) {

  let confirmExtend = confirm("Your session will expire in a few minutes. Click OK to continue your session.");
  if (confirmExtend) {
    fetch(access + "/refeshToken", { credentials: 'include' })
      .then(res => {

        if (res.status === 401) {
          alert("Session has expired. Please log in again.");
          window.location.href = access + "/login";
        } else {
          return res.json();
        }
      })
      .then(data => {
        if (data.refreshToken) {
          alert("Session has been extended.");
        }
      })
      .catch(() => {
        alert(" Failed to extend the session. Please try again.");
        window.location.href = access + "/login";
      });

  }
}
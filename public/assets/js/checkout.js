// Check-out actions
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.btn-action-checkout').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var bookingId = this.getAttribute('data-id');
      var row = this.closest('tr');
      // Disable button to prevent double click
      this.disabled = true;
      this.textContent = 'Processing...';

      fetch(window.BASE_PATH + '/dashboard/checkout', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        credentials: 'same-origin',
        body: JSON.stringify({
          id: bookingId
        })
      })

      .then(res => {
        if (!res.ok) throw new Error('Network response was not ok');
        return res.json();
      })

      .then(data => {
        if (data.statusApi === 'true') {
          row.remove();
          alert('Check-out successful!');
        } else {
          btn.disabled = false;
          btn.textContent = 'Check-out';
          alert('Check-out failed!');
        }
      })
      .catch((err) => {
        btn.disabled = false;
        btn.textContent = 'Check-out';
        alert('An error occurred.\n' + err);
      });
    });
  });
});

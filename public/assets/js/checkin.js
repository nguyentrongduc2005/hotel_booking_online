// Check-in actions
document.addEventListener('DOMContentLoaded', function() {
  document.querySelectorAll('.btn-action-checkin').forEach(function(btn) {
    btn.addEventListener('click', function() {
      var bookingId = this.getAttribute('data-id');
      var row = this.closest('tr');
      
      this.disabled = true;
      this.textContent = 'Processing...';

      fetch(window.BASE_PATH + '/dashboard/checkin', {
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
          // Remove the row when check-in is successful
          row.remove();
          alert('Check-in successful!');
        } else {
          // Re-enable button if failed
          btn.disabled = false;
          btn.textContent = 'Confirm';
          alert('Check-in failed!');
        }
      })
      
      .catch((err) => {
        // Re-enable button if error
        btn.disabled = false;
        btn.textContent = 'Confirm';
        alert('An error occurred.\n' + err);
      });
    });
  });
});

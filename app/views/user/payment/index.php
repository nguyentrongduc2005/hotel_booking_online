    <link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/payment.css?v=<?= time() ?>" />
    <div class="payment-wrapper">
        <div class="container-payment">
            <div class="background-overlay"></div>
            <div class="content-wrapper">
                <div class="progress-bar">
                    <div class="progress-line"></div>
                    <div class="progress-item active">
                        <div class="step-circle">1</div>
                        <div class="step-name">Booking Info</div>
                    </div>
                    <div class="progress-item">
                        <div class="step-circle">2</div>
                        <div class="step-name">Payment</div>
                    </div>
                </div>

                <div class="main-content">
                    <div class="booking-form-container">
                        <div class="booking-form">
                            <h1>Enter your details</h1>
                            <form>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="full-name">Full name <span class="required">*</span></label>
                                        <input type="text" id="full-name" name="full_name" value="<?= htmlspecialchars($data['user']['full_name'] ?? '') ?>" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Address <span class="required">*</span></label>
                                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($data['user']['email'] ?? '') ?>" required />
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group">
                                        <label for="phone">Phone number <span class="required">*</span></label>
                                        <input type="tel" id="phone" name="sdt" value="<?= htmlspecialchars($data['user']['sdt'] ?? '') ?>" required />
                                    </div>
                                    <div class="form-group">
                                        <label for="national-id">National ID <span class="required">*</span></label>
                                        <input type="text" id="national-id" name="cccd" value="<?= htmlspecialchars($data['user']['cccd'] ?? '') ?>" required />
                                    </div>
                                </div>

                                <h2>Who are you booking for?</h2>
                                <div class="radio-group">
                                    <label class="radio-label">
                                        <input type="radio" name="booking_for" checked />
                                        I'm the main the guest
                                    </label>
                                    <label class="radio-label">
                                        <input type="radio" name="booking_for" />
                                        I'm booking for someone else
                                    </label>
                                </div>

                                <button type="submit" class="btn-next">Next: Payment Method</button>
                                <p class="form-note">
                                    Your contact info will be used to send confirmation and updates.
                                    Make sure your phone number is active to receive booking details.
                                </p>
                            </form>
                        </div>
                    </div>

                    <?php
                    $room = $data['room'];
                    $discount = isset($data['discount']) ? $data['discount'] : "0%";
                    ?>

                    <div class="trip-summary-container">
                        <div class="trip-summary">
                            <img src="<?= $this->configs->config['pathAssets'] . $room['thumb'] ?>" alt="<?= $room['name_type_room']  ?>" />
                            <div class="summary-details">
                                <h2>Your trip summary</h2>
                                <div class="summary-item">
                                    <span>Check in</span>
                                    <span class="bold" id="js-checkin">--</span>
                                </div>
                                <div class="summary-item">
                                    <span>Check out</span>
                                    <span class="bold" id="js-checkout">--</span>
                                </div>
                                <div class="summary-item">
                                    <span>Guests</span>
                                    <span class="bold"><?= $room['capacity']  ?></span>
                                </div>
                                <hr />
                                <div class="summary-item total">
                                    <span class="bold"><?= $room['price'] . '$ ' ?> <span id="js-trip-nights" class="bold"></span></span>
                                    <span class="bold" id="js-total">
                                    </span>
                                </div>
                                <div class="summary-item">
                                    <span>Discount</span>
                                    <span class="bold"><?= $discount ?></span>
                                </div>
                                <hr class="total-hr" />
                                <div class="summary-item grand-total">
                                    <span>Total</span>
                                    <span class="bold"> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var lastSearch = JSON.parse(sessionStorage.getItem('lastSearch') || '{}');
            // Định dạng lại ngày nếu cần (ví dụ yyyy-mm-dd -> dd/mm/yyyy)
            function formatDate(dateStr) {
                if (!dateStr) return '--';
                var parts = dateStr.split('-');
                return `${parts[2]}/${parts[1]}/${parts[0]}`;
            }
            document.getElementById('js-checkin').textContent = formatDate(lastSearch.checkIn);
            document.getElementById('js-checkout').textContent = formatDate(lastSearch.checkOut);
            var nights = lastSearch.diffDays || 1;
            var price = parseFloat(<?= json_encode($room['price']) ?>);
            // console.log(discount);
            var total = price * nights;
            document.getElementById('js-total').textContent = ` ${total}$`;
            document.getElementById('js-trip-nights').textContent = `x  ${nights} nights`;
        });
    </script>
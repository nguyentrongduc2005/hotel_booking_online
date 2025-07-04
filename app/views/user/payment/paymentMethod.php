    <link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/paymentMethod.css?v=<?= time() ?>" />
    <div class="payment-wrapper">
        <div class="container-payment">
            <div class="background-overlay"></div>
            <div class="content-wrapper">
                <div class="progress-bar">
                    <div class="progress-line"></div>
                    <div class="progress-item active">
                        <div class="step-circle">&#10003;</div>
                        <div class="step-name">Booking Info</div>
                    </div>
                    <div class="progress-item active">
                        <div class="step-circle">2</div>
                        <div class="step-name">Payment</div>
                    </div>
                </div>
                <?php $room = $data['room']; ?>
                <div class="main-content">
                    <div class="booking-form-container">
                        <div class="booking-form">
                            <h1>Payment Method</h1>
                            <form action="<?= $this->configs->config['basePath'] ?>/paymentMethod/<?= htmlspecialchars($room['slug']) ?>" method="POST">
                                <label class="payment-option">
                                    <span class="payment-logos">
                                        <img src="<?= $this->configs->config['pathAssets'] ?>img/paymentMethod/paypal.png" alt="Paypal" />
                                    </span>
                                    <span class="payment-label">Paypal</span>
                                    <input type="radio" name="method" value="ZaloPay" checked>
                                    <span class="custom-radio"></span>
                                </label>
                                <label class="payment-option">
                                    <span class="payment-logos">
                                        <img src="<?= $this->configs->config['pathAssets'] ?>img/paymentMethod/momo.png" alt="Momo" />
                                        <img src="<?= $this->configs->config['pathAssets'] ?>img/paymentMethod/vnpay.png" alt="VNPAY" />
                                    </span>
                                    <span class="payment-label">E-Wallet</span>
                                    <input type="radio" name="method" value="Momo">
                                    <span class="custom-radio"></span>
                                </label>
                                <label class="payment-option">
                                    <span class="payment-logos">
                                        <img src="<?= $this->configs->config['pathAssets'] ?>img/paymentMethod/visa.png" alt="Visa" />
                                        <img src="<?= $this->configs->config['pathAssets'] ?>img/paymentMethod/master.png" alt="Mastercard" />
                                    </span>
                                    <span class="payment-label">Card Payment</span>
                                    <input type="radio" name="method" value="credit card">
                                    <span class="custom-radio"></span>
                                </label>
                                <label class="payment-option">
                                    <span class="payment-logos">
                                        <img src="<?= $this->configs->config['pathAssets'] ?>img/paymentMethod/bank.png" alt="Bank Transfer" />
                                    </span>
                                    <span class="payment-label">Bank Transfer</span>
                                    <input type="radio" name="method" value="bank transfer">
                                    <span class="custom-radio"></span>
                                </label>
                                <button type="submit" class="btn-paynow">Pay now</button>
                                <input type="hidden" id="id_transaction" name="id_transaction"
                                    value="<?= htmlspecialchars($data['id_transaction'] ?? '') ?>" />
                            </form>
                        </div>
                    </div>

                    <?php
                    $room = $data['room'];
                    $discount = isset($data['discount']) ? $data['discount'] : 0;
                    $discountRender = $discount;
                    if ($discountRender != 0) {
                        $discountRender = ($discountRender * 100) . "%";
                    }
                    ?>

                    <div class="trip-summary-container">
                        <div class="trip-summary">
                            <img src="<?= $this->configs->config['pathAssets'] . $room['thumb'] ?>"
                                alt="<?= $room['name_type_room']  ?>" />
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
                                    <span class="bold"><?= $room['price'] . '$ ' ?> <span id="js-trip-nights"
                                            class="bold"></span></span>
                                    <span class="bold" id="js-total">
                                    </span>
                                </div>
                                <div class="summary-item">
                                    <span>Discount</span>
                                    <span class="bold"><?= $discountRender ?></span>
                                </div>
                                <hr class="total-hr" />
                                <div class="summary-item grand-total">
                                    <span>Total</span>
                                    <span class="bold" id="js-totalAll"></span>
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
            var discount = parseFloat(<?= json_encode($discount) ?>);
            // Gán giá trị check_in/check_out vào input hidden
            document.getElementById('check_in').value = lastSearch.checkIn || '';
            document.getElementById('check_out').value = lastSearch.checkOut || '';
            var total = price * nights;
            var totalAll = total - (total * discount);
            document.getElementById('js-total').textContent = ` ${total}$`;
            document.getElementById('js-totalAll').textContent = ` ${totalAll}$`;
            document.getElementById('js-trip-nights').textContent = `x  ${nights} nights`;
            document.getElementById('total_amount').value = totalAll;
        });
    </script>
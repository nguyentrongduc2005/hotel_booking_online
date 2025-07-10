<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/payment.css?v=<?= time() ?>" />
<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/paymentMethod.css?v=<?= time() ?>" />
<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/success.css?v=<?= time() ?>" />
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
                    <div class="step-circle">&#10003;</div>
                    <div class="step-name">Payment</div>
                </div>
            </div>
            <div class="main-content" style="justify-content: center; align-items: center; min-height: 300px;">
                <div class="glass-success">
                    <h1>Thank you for your booking!</h1>
                    <p>Your payment has been successfully processed.</p>
                    <p style="margin-top: 16px; color: #fff; font-size: 1.1rem;">Please check your email for booking details.</p>
                    <div class="success-actions">
                        <a href="<?= $this->configs->config['basePath'] ?>listroom" class="btn-success-nav">Continue Booking</a>
                        <a href="<?= $this->configs->config['basePath'] ?>user/transactions" class="btn-success-nav transaction-btn">View My Transactions</a>
                    </div>
                    <div class="success-social">
                        <div class="success-social-title">Let's connect!</div>
                        <div class="success-social-list">
                            <div class="success-social-item" title="Facebook">
                                <span></span><span></span><span></span>
                                <img src="<?= $this->configs->config['pathAssets'] ?>img/success/facebook.png" alt="Facebook" />
                                <div class="text">Facebook</div>
                            </div>
                            <div class="success-social-item" title="Instagram">
                                <span></span><span></span><span></span>
                                <img src="<?= $this->configs->config['pathAssets'] ?>img/success/social.png" alt="Instagram" />
                                <div class="text">Instagram</div>
                            </div>
                            <div class="success-social-item" title="Line">
                                <span></span><span></span><span></span>
                                <img src="<?= $this->configs->config['pathAssets'] ?>img/success/line.png" alt="Line" />
                                <div class="text">Line</div>
                            </div>
                            <div class="success-social-item" title="LinkedIn">
                                <span></span><span></span><span></span>
                                <img src="<?= $this->configs->config['pathAssets'] ?>img/success/linkedin.png" alt="LinkedIn" />
                                <div class="text">LinkedIn</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/contactUs.css?v=<?= time() ?>" />
<div class="contact-page">
    <div class="main-container">
        <!-- Contact Form Section -->
        <div class="contact-form-container" id="contactFormContainer" >
            <div class="contact-form" style="padding: 10px 35px;">
                <div class="form-header">
                    <h1>Contact Us</h1>
                    <p>We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
                </div>
                
                <form id="contactForm">
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="fullName" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="contactNumber">Contact Number</label>
                        <input type="tel" id="contactNumber" name="contactNumber" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Tell us how we can help you..." required></textarea>
                    </div>
                    
                    <button type="submit" class="send-button">Send Message</button>
                </form>
            </div>
        </div>

        <!-- Thank You Section -->
        <div class="thank-you-container" id="thankYouContainer">
            <h2>Thank You!</h2>
            <p>Your message has been sent successfully. We'll get back to you as soon as possible.</p>
            <button class="back-button" onclick="showContactForm()">Send Another Message</button>
        </div>
    </div>
</div>

<script>
    document.getElementById('contactForm').addEventListener('submit', function(e) {
        e.preventDefault();
        showThankYou();
    });

    function showThankYou() {
        document.getElementById('contactFormContainer').style.display = 'none';
        document.getElementById('thankYouContainer').style.display = 'block';
        window.scrollTo(0, 0);
    }

    function showContactForm() {
        document.getElementById('thankYouContainer').style.display = 'none';
        document.getElementById('contactFormContainer').style.display = 'block';
        document.getElementById('contactForm').reset();
    }
</script> 
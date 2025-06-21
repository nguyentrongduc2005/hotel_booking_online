<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/regis.css?v=<?= time() ?>">

<link rel="icon" href="/hotel_booking_online/public/assets/icon/diamond_logo_small.png" sizes="32x32">
<title>Sign Up</title>
<div class="regis-bg-overlay">
  <div class="regis-main-container">
    <div class="regis-right"
      style="background-image: url('<?= $this->configs->config['pathAssets'] ?>/img/bg-regis.png')"></div>
    <div class="regis-left">
      <div class="regis-title">CREATE YOUR ACCOUNT</div>
      <form class="regis-form" method="post" action="<?= $this->configs->config['basePath'] ?>regis">
        <input type="text" name="full_name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <div class="regis-row-flex">
          <input type="text" name="sdt" placeholder="Phone Number" required>
          <input type="text" name="cccd" placeholder="ID" required>
        </div>
        <input type="password" name="pass" placeholder="Password" required>
        <button type="submit" class="regis-submit-btn">Create account</button>
        <?php if (!empty($message)): ?>
          <div class="regis-message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
      </form>
      <?php if (isset($access)) {
        echo "  <script>
        setTimeout(function() {
            window.location.href = '$access'
        },1000)
        </script>";
      } ?>
      <div class="regis-bottom-link">
        Already you have an account?
        <a href="<?= $this->configs->config['basePath'] ?>login" class="regis-login-link">Login</a>
      </div>
    </div>
  </div>
</div>
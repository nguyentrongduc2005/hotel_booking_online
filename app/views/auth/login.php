<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/login.css?v=<?= time() ?>">

<?php
$errors = $errors ?? [];
$email = $email ?? '';
$password = $password ?? '';
?>
<link rel="icon" href="/hotel_booking_online/public/assets/icon/diamond_logo_small.png" sizes="32x32">
<title>Login</title>

<div class="login-bg-overlay">
  <div class="login-main-container">
    <div class="login-left">
      <button class="login-signup-btn"
        onclick="window.location.href='<?= $this->configs->config['basePath'] ?>/regis'">Sign up</button>
      <div class="login-title">WELCOME TO DIAMOND!</div>
      <div class="login-sub">Sign in your account</div>
      <!-- Social Login Buttons -->
      <div class="login-social-row">
        <button type="button" class="login-social-btn login-google-btn">
          <img src="<?= $this->configs->config['pathAssets'] ?>img/success/google.png" alt="Google" class="login-social-icon"> Google
        </button>
        <button type="button" class="login-social-btn login-facebook-btn">
          <img src="<?= $this->configs->config['pathAssets'] ?>img/success/facebook.png" alt="Facebook" class="login-social-icon"> Facebook
        </button>
      </div>
      <div class="login-divider-row">
        <span class="login-divider-line"></span>
        <span class="login-divider-text">or</span>
        <span class="login-divider-line"></span>
      </div>
      <form class="login-form" method="post" action="<?= $this->configs->config['basePath'] ?>/login">
        <label for="email">Your Email</label>
        <input type="email" id="email" name="email" required value="<?= htmlspecialchars($email) ?>">
        <?php if (!empty($errors['email'])): ?>
          <div class="error"></div>
          <?= implode('<br>', array_map('htmlspecialchars', $errors['email'])) ?>
    </div>
  <?php endif; ?>

  <label for="password">Password</label>
  <div class="login-password-row">
    <input type="password" id="password" name="password" required>

  </div>
  <?php if (!empty($errors['password'])): ?>
    <div class=" error">
      <?= implode('<br>', array_map('htmlspecialchars', $errors['password'])) ?>
    </div>
  <?php endif; ?>

  <div class="login-form-row">
    <label class="login-remember"><input type="checkbox" name="remember" id="remember"> Remember me</label>
    <a href="#" class="login-forgot">Forgot password?</a>
  </div>
  <button type="submit" class="login-submit-btn">Login</button>
  <?php if (!empty($message)): ?>
    <div class="login-message"><?= htmlspecialchars($message) ?></div>
  <?php endif; ?>
  <?php if (isset($access)) {
    echo "  <script>
        setTimeout(function() {
            window.location.href = '$access'
        },1000)
        </script>";
  } ?>
  </form>
  
  </div>
  <div class="login-right"
    style="background-image: url('<?= $this->configs->config['pathAssets'] ?>/img/bg-login.png')"></div>
</div>
<?php
  
?>

<script src="<?= $this->configs->config['pathAssets'] ?>js/login.js?v=<?= time() ?>"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const loginRight = document.querySelector('.login-right');
    const loginLeft = document.querySelector('.login-left');
    if (loginRight && loginLeft) {
      loginRight.addEventListener('animationend', function() {
        loginLeft.classList.add('show');
      });
    }
  });


</script>
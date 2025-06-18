<!-- Link CSS riêng cho login -->
<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/login.css?v=<?= time() ?>">

<?php
// Hiển thị lỗi nếu có
$errors = $errors ?? [];
$email = $email ?? '';
$password = $password ?? '';
?>

<div class="login-bg-overlay">
  <div class="login-main-container">
    <div class="login-left">
      <button class="login-signup-btn" onclick="window.location.href='<?= $this->configs->config['basePath'] ?>regis'">Sign up</button>
      <div class="login-title">WELCOME TO DIAMOND!</div>
      <div class="login-sub">Sign in your account</div>
      <form class="login-form" method="post" action="">
        <label for="email">Your Email</label>
        <input type="email" id="email" name="email"  required value="<?= htmlspecialchars($email) ?>">
        <?php if (!empty($errors['email'])): ?>
          <div class="error">
            <?= implode('<br>', array_map('htmlspecialchars', $errors['email'])) ?>
          </div>
        <?php endif; ?>

        <label for="password">Password</label>
        <div class="login-password-row">
          <input type="password" id="password" name="password"  required>
          
        </div>
        <?php if (!empty($errors['password'])): ?>
          <div class="error">
            <?= implode('<br>', array_map('htmlspecialchars', $errors['password'])) ?>
          </div>
        <?php endif; ?>

        <div class="login-form-row">
          <label class="login-remember"><input type="checkbox" name="remember"> Remember me</label>
          <a href="#" class="login-forgot">Forgot password?</a>
        </div>
        <button type="submit" class="login-submit-btn">Login</button>
      </form>
    </div>
    <div class="login-right" style="background-image: url('<?= $this->configs->config['pathAssets'] ?>/img/bg-login.png')"></div>
  </div>
</div>
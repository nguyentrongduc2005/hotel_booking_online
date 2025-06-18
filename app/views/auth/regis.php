<!-- Link CSS riêng cho regis -->
<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/regis.css?v=<?= time() ?>">

<div class="regis-bg-overlay">
  <div class="regis-main-container">
    <div class="regis-right" style="background-image: url('<?= $this->configs->config['pathAssets'] ?>/img/bg-regis.png')"></div>
    <div class="regis-left">
      <div class="regis-title">CREATE YOUR ACCOUNT</div>
      <form class="regis-form" method="post" action="">
        <input type="text" name="fullname" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <div class="regis-row-flex">
          <input type="text" name="phone" placeholder="Phone Number" required>
          <input type="text" name="id" placeholder="ID" required>
        </div>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="regis-submit-btn">Create account</button>
      </form>
      <div class="regis-bottom-link">
        Already you have an account?
        <a href="<?= $this->configs->config['basePath'] ?>login" class="regis-login-link">Login</a>
      </div>
    </div>
  </div>
</div>
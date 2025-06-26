<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?= $this->configs->config['pathAssets'] ?>css/adminHeader.css?v=<?= time() ?>">
<header class="admin-header">
    <div class="admin-header-right">
        <i class="fa fa-user-circle" style="font-size:2rem;color:black;"></i>
    </div>
</header>
<script src="<?= $this->configs->config['pathAssets'] ?>js/dashboard.js?v=<?= time() ?>"></script>
<?php if (isset($_SESSION["timer"])) {

  $path  = $this->configs->config['basePath'];
  $leftTime = $_SESSION["timer"] - time();

  $leftTime = max(0, ($leftTime - 120) * 1000);
  if ($leftTime > 0) {
    echo " <script>
   setTimeout(function() { 
   checktokenTimer('{$path}')
                            }, " . $leftTime . ")</script>";
  }
} ?>
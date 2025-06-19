<?php
$Request = require_once __DIR__ . '../../app/core/Request.php';

// if (file_exists($Request) && !is_dir($Request)) {
//     return false;
// }

require_once __DIR__ . '../../app/core/App.php';
$config = require_once __DIR__ . '../../config/main.php';

session_start();
$app = new App($config);
$app->run();

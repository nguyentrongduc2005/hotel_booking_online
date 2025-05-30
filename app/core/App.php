<?php

// require_once __DIR__ . '../../controllers/HomeController.php';
require_once __DIR__ . '/Autoload.php';

use app\core\Registry;


class App
{
    private $router;


    function __construct($config)
    {

        new Autoload($config);
        // Initialize the application

        $this->router = new Router();
        Registry::getInstance()->config = $config;
    }


    function run()
    {

        // Your application logic here
        $this->router->run();
    }
}

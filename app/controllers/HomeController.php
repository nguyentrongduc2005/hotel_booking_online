<?php

namespace app\controllers;

use app\core\Controller;
use app\models\Room;


class HomeController extends Controller
{
    
    function __construct()
    {
        parent::__construct();
    }

    function show($req, $res)
    {
        $this->render('index');
    }
    
}

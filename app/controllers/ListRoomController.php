<?php

namespace app\controllers;

use app\core\Controller;

class ListRoomController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function show($req, $res)
    {
        $this->render('index');
    }

    function index()
    {
        echo 'method index is runing';
    }
}
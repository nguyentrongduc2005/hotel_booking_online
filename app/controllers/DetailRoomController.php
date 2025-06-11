<?php

namespace app\controllers;

use app\core\Controller;
use app\models\DetailRoomModel;

class DetailRoomController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function show($req, $res)
    {
        $this->render('show');
    }

    function index($req, $res)
    {
        return $res->error('user isnt exits')->send();
    }
}

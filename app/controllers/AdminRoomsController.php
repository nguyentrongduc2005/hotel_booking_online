<?php

namespace app\controllers;

use app\core\Controller;
use app\models\AdminRoomsModel;


class AdminRoomsController extends Controller
{
    private $model;
    function __construct()
    {
        parent::__construct();
        $this->model = new AdminRoomsModel();
    }


    function roomsShow($req, $res)
    {
        $data = $this->model->getAllRooms();

        $this->render('rooms', $data);
    }
    function roomFilter($req, $res) {}
    function roomAdd($req, $res) {}
    function roomEdit($req, $res) {}
    function roomDelete($req, $res) {}
}

<?php

namespace app\controllers;

use app\core\Controller;
use app\models\HomeModel;


class HomeController extends Controller
{
    private $model;
    function __construct()
    {
        parent::__construct();
        $this->model = new HomeModel();
    }

    function show($req, $res)
    {

        $data = ["rooms" => $this->model->getDataRooms(), "services" => $this->model->getDataServices()];
        $this->render('index', $data);
    }
}

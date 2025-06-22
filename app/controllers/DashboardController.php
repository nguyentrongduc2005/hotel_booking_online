<?php

namespace app\controllers;

use app\core\Controller;
use app\models\DashboardModel;

class DashboardController extends Controller
{
    private  $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new DashboardModel();
    }


    public function show($req, $res)
    {

        // $this->setLayout('Adminlayouts/main');
        $this->render('index');
    }
}

<?php

namespace app\controllers;

use app\core\Controller;
use app\models\ServiceModel;

class ServicesController extends Controller
{
    private  $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ServiceModel();
    }

    public function show($req, $res)
    {
        $data = $this->model->getAllServices();
        $this->render('index',  $data);
    }

    public function detail($req, $res)
    {
        $slug = $req->params()['slug'];
        $service = $this->model->getOneService($slug);
        $this->render('detailService', $service);
    }
}

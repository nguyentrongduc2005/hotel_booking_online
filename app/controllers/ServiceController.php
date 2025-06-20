<?php

namespace app\controllers;

use app\core\Controller;
use app\models\ServiceModel;

class ServiceController extends Controller
{
    private  $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ServiceModel();
    }
    public function index($req, $res)
    {
        $services = $this->model->getAllServices();
        $this->render('index', ['services' => $services]);
    }
    public function show($req, $res)
    {
        $data = $this->model->getAllServices();
        if (!$data) {
            $res->setStatusCode(404);
            echo "Không tìm thấy dịch vụ";
            return;
        }

        echo "<pre>";
        print_r($data);
        // $this->render('index', ['services' => $data]);
    }
}
<?php

namespace app\controllers;

use app\core\Controller;
use app\models\AdminServicesModel;

class AdminServicesController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new AdminServicesModel();
    }

    public function index($req, $res)
    {
        $services = $this->model->getAllServices();

        return $this->render('index', [
            'services' => $services
        ]);
    }
}

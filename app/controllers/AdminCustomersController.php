<?php

namespace app\controllers;

use app\core\Controller;
use app\models\AdminCustomersModel;

class AdminCustomersController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new AdminCustomersModel();
    }

    public function index($req, $res)
    {
        $customers = $this->model->getAllCustomers();

        return $this->render('index', [
            'customers' => $customers
        ]);
    }
}

<?php

namespace app\controllers;

use app\core\Controller;
use app\models\PaymentModel;

class PaymentController extends Controller
{

    private  $model;
    function __construct()
    {
        parent::__construct();
        $this->model = new PaymentModel();
    }

    public function show($req, $res)
    {
        $this->render('index', []);
    }
}

<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Registry;
use app\models\AdminTransactionsModel;


class AdminTransactionsController extends Controller
{
    private $model;
    function __construct()
    {
        parent::__construct();
        $this->model = new AdminTransactionsModel();
    }
}

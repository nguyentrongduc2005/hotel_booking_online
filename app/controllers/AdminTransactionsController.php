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

    function transactionsShow($req, $res)
    {
        $data = $this->model->getAllTransactions();
        $this->render('index', $data);
    }


    function transactionFilter($req, $res)
    {
        $filter = $req->post();
        $data = $this->model->transactionFilter($filter);
        $this->render('index', $data);
    }
}

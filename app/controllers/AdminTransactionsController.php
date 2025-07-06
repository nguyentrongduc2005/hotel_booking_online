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
        // Set viewpathComponent to /admin for admin controllers
        self::setcomponent('/admin');
        self::setLayout('AdminLayouts/main');
    }

    function transactionsShow($req, $res)
    {
        $transactions = $this->model->getAllTransactions();
        $this->render('index', ['transactions' => $transactions]);
    }


    function transactionFilter($req, $res)
    {
        $filter = $req->post();
        $transactions = $this->model->transactionFilter($filter);
        $this->render('index', ['transactions' => $transactions]);
    }
}

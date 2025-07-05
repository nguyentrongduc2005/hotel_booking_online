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

    public function index()
    {
        $guests = $this->model->getGuests();
        $users = $this->model->getUsers();

        return $this->render('index', [
            'guests' => $guests,
            'users' => $users
        ]);
    }
}

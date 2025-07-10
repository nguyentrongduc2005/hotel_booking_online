<?php

namespace app\controllers;

use app\core\Controller;
use app\models\AdminAccountModel;

class AdminAccountController extends Controller
{
    private $model;

    public  function __construct()
    {
        parent::__construct();
        $this->model = new AdminAccountModel();
        // Set viewpathComponent to /admin for admin controllers
        self::setcomponent('/admin');
    }

    public function index($req, $res)
    {
        $admins = $this->model->getAllAdmins();

        return $this->render('index', [
            'admins' => $admins
        ]);
    }

    public function privateAdmin($req, $res)
    {
        $admin = $this->model->getAdminProfile();

        return $this->render('private', [
            'admin' => $admin
        ]);
    }
}

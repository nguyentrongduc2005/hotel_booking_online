<?php

namespace app\controllers;

use app\core\Controller;
use app\models\DetailRoomModel;

class DetailRoomController extends Controller
{
    private  $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new DetailRoomModel();
    }


    public function index($req, $res)
    {
        $slug = $req->params()['slug'];


        $data =  $this->model->getRoomBySlug($slug);
        $this->render('index', $data);
    }
}

<?php

namespace app\controllers;

use app\core\Controller;
use app\models\DetailRoomModel;

class DetailRoomController extends Controller
{
    private DetailRoomModel $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new DetailRoomModel();
    }

    public function show($req, $res)
    {
        $id = $req->get('id'); 
        $rooms = $this->model->getAllRooms();
        $roomDetail = null;

        if ($id && is_numeric($id)) {
            $roomDetail = $this->model->getRoomById((int)$id);
        }

        return $res->view('show', [
            'rooms' => $rooms,
            'roomDetail' => $roomDetail
        ]);
    }

    public function index($req, $res)
    {
        return $res->error('User does not exist')->send();
    }
}

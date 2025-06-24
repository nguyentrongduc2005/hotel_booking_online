<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Registry;
use app\models\AdminRoomsModel;


class AdminRoomsController extends Controller
{
    private $model;
    function __construct()
    {
        parent::__construct();
        $this->model = new AdminRoomsModel();
    }


    function roomsShow($req, $res)
    {

        $data = $this->model->getAllRooms();
        $nameRoomTypes = $this->model->getNameRoomTypes();
        $data['nameRoomTypes'] = $nameRoomTypes;
        $amenities = $this->model->getAllAmenities();
        $data['amenities'] = $amenities;
        $this->render('rooms', $data);
    }

    function roomFilter($req, $res)
    {

        // echo "<pre>";
        // print_r($req->file('images'));
        // echo "<pre>";

        // $requestData = $req->post();
        // $data = $this->model->getDataByFilter($requestData);
        // $nameRoomTypes = $this->model->getNameRoomTypes();
        // $data['nameRoomTypes'] = $nameRoomTypes;

        // $amenities = $this->model->getAllAmenities();
        // $data['amenities'] = $amenities;
        // $this->render('rooms', $data);
    }
    function roomAdd($req, $res)
    {
        $requestData = $req->post();
        $requestData['images'] = $req->file('images');
        $this->model->addRoom($requestData);
        $this->redirect(Registry::getInstance()->config['basePath'] . '/admin/rooms');
    }


    function roomEdit($req, $res) {}
    function roomDelete($req, $res) {}
}

<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\ListRoomModel;

class ListRoomController extends Controller
{
    private listRoomModel $model;
    function __construct()
    {
        parent::__construct();
        $this->model = new ListRoomModel();
    }

    function show($req, $res)
    {


        $this->render('index');
    }

    function index(Request $req, $res)
    {
        // lấy query string 

        $page = $req->Query('page',1);
        $roomType = $req->Query('room_type');
        $priceMin =$req->Query('price_min');
        $priceMax = $req->Query('price_max');
    
        //lấy danh sách phòng theo lọc
        $rooms = $this->model->getRooms([
            'page' => $page,
            'room_type' => $roomType,
            'price_min' => $priceMin,
            'price_max' => $priceMax
        ]);
        $roomType= $this->model->getAllRoomTypes();
        // ra view
        $this->render('index',[
            'rooms'=>$rooms,
            'filters' => [
                'page' => $page,
                'room_type' => $roomType,
                'price_min' => $priceMin,
                'price_max' => $priceMax
            ]

            ]);
    }
}

<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\ListRoomModel;

class ListRoomController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new ListRoomModel();
    }

    public function index(Request $req, $res)
    {
        // Lấy dữ liệu bộ lọc từ query string
        $filters = [
            'price_range' => $req->query('price_range'),
            'room_type'   => $req->query('room_type'),
            'checkin'     => $req->query('checkin'),
            'checkout'    => $req->query('checkout'),
            'guest_count' => $req->query('guest'),
            'area_range'  => $req->query('area_range'),
            'bed_count'   => $req->query('bed_count'),
        ];

        // Xử lý ngày check-in và check-out
        if (!empty($filters['checkin'])) {
            $filters['check_in'] = $filters['checkin'];
        }
        if (!empty($filters['checkout'])) {
            $filters['check_out'] = $filters['checkout'];
        }

        $rooms = $this->model->getFilteredRooms($filters);

        // Debug (có thể comment lại khi hoàn thành)
        // echo "<pre>";
        // print_r($filters);
        // print_r($rooms);
        // echo "</pre>";

        // Trả về view 
        $this->render('index', [
            'rooms' => $rooms,
            'filters' => $filters
        ]);
    }
}

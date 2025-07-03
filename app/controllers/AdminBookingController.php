<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\AdminBookingModel;

class AdminBookingController extends Controller
{
    private AdminBookingModel $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new AdminBookingModel();
    }

    public function allBookings(Request $req, $res)
    {
        $filters = [
            'name' => $req->query('name'),
            'id_room' => $req->query('id_room'),
            'check_in' => $req->query('check_in'),
            'check_out' => $req->query('check_out'),
        ];

        $bookings = $this->model->getAllBookings($filters);
        
        //test
        echo "<pre>";
        print_r($bookings);
        echo "</pre>";

        // return $this->render('admin/bookings/all', [
        //     'bookings' => $bookings,
        //     'filters' => $filters,
        // ]);
    }

    public function historyBookings(Request $req, $res)
    {
        $filters = [
            'name' => $req->query('name'),
            'id_room' => $req->query('id_room'),
            'check_in' => $req->query('check_in'),
            'check_out' => $req->query('check_out'),
        ];

        $bookings = $this->model->getHistoryBookings($filters);
        
        //test
        echo "<pre>";
        print_r($bookings);
        echo "</pre>";

        // return $this->render('admin/bookings/history', [
        //     'bookings' => $bookings,
        //     'filters' => $filters,
        // ]);
    }
}

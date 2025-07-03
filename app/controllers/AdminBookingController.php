<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\AdminBookingModel;

class AdminBookingController extends Controller
{
    private $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new AdminBookingModel();
    }

    //danh sách booking hiện tại
    public function AllIndex(Request $req, $res)
    {
        $filters = [
            'guest_name' => $req->query('guest_name'),
            'room_code'  => $req->query('room_code'),
            'check_in'   => $req->query('check_in'),
            'check_out'  => $req->query('check_out')
        ];

        $bookings = $this->model->bookingFilter($filters, false);

        return $this->render('admin/bookings/index', [
            'bookings' => $bookings,
            'filters' => $filters
        ]);
    }

    //  lịch sử booking 
    public function historyIndex(Request $req, $res)
    {
        $filters = [
            'guest_name' => $req->query('guest_name'),
            'room_code'  => $req->query('room_code'),
            'check_in'   => $req->query('check_in'),
            'check_out'  => $req->query('check_out')
        ];

        $bookings = $this->model->bookingFilter($filters, true);

        return $this->render('admin/bookings/history', [
            'bookings' => $bookings,
            'filters' => $filters
        ]);
    }
     
    public function bookingIndex(Request $req, $res)
    {
        return $this->render('admin/bookings/index', [
            'bookings' => $this->model->getAllBookings(),
            'history' => $this->model->getHistoryBookings()
        ]);
    }
}

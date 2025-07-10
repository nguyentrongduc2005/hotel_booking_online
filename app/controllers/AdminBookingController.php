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
        self::setcomponent('/admin'); 
    }

    // Hiển thị danh sách booking hiện tại
    public function allIndex(Request $req, $res)
    {
        $filters = [
            'guest_name' => $req->query('guest_name'),
            'user_name'  => $req->query('user_name'), 
            'id_room'    => $req->query('id_room'),
            'check_in'   => $req->query('check_in'),
            'check_out'  => $req->query('check_out'),
            'status_not' => 'Cancelled',
        ];

        $bookings = $this->model->bookingFilter('booking', $filters);
        // echo '<pre>';
        // print_r($bookings);
        // echo '</pre>';

        return $this->render('allBookings', [
            'bookings' => $bookings,
            'filters' => $filters
        ]);
    }

    // Hiển thị danh sách lịch sử booking
    public function historyIndex(Request $req, $res)
    {
        $filters = [
            'guest_name' => $req->query('guest_name'),
            'user_name'  => $req->query('user_name'), 
            'id_room'    => $req->query('id_room'),
            'check_in'   => $req->query('check_in'),
            'check_out'  => $req->query('check_out'),
            'status_not'  => 'Pending',
        ];

        $historyBookings = $this->model->bookingFilter('historybooking', $filters);
        // echo '<pre>';
        // print_r($historyBookings);  
        // echo '</pre>';

        return $this->render('historyBookings', [
            'historyBookings' =>$historyBookings,
            'filters' => $filters
        ]);
    }
}

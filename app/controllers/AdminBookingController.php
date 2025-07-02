<?php

namespace app\controllers;

use app\core\Controller;
use app\models\AdminBookingModel;

class AdminBookingController extends Controller
{
    private $model;
    function __construct()
    {
        parent::__construct();
        $this->model = new AdminBookingModel();
    }
        

    public function allBookingsIndex($req, $res)
    {
        $filter = [
            'guest_name'    => $_GET['guest_name']    ?? null,
            'room_id'       => $_GET['room_id']       ?? null,
            'room_number'   => $_GET['room_number']   ?? null,
            'check_in'      => $_GET['check_in']      ?? null,
            'check_out'     => $_GET['check_out']     ?? null,
        ];

        $bookings = $this->model->getDataByFilter($filter, 'all');

        $this->render('allBookings', [
            'bookings' => $bookings
        ]);
    }

    public function historyBookingsIndex($req, $res)
    {
        $filter = [
            'guest_name'    => $_GET['guest_name']    ?? null,
            'room_id'       => $_GET['room_id']       ?? null,
            'room_number'   => $_GET['room_number']   ?? null,
            'checkin_date'  => $_GET['checkin_date']  ?? null,
            'checkout_date' => $_GET['checkout_date'] ?? null,
            'status'        => $_GET['status']        ?? null //hiển thị trạng thái
        ];

        $records = $this->model->getDataByFilter($filter, 'history');

        $this->render('historyBookings', [
            'title'   => 'History Bookings',
            'filter'  => $filter,
            'records' => $records
        ]);
    }
}

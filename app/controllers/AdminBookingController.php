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
            'guest_name'    => $req->get('guest_name'),
            'room_id'       => $req->get('room_id'),
            'room_number'   => $req->get('room_number'),
            'checkin_date'  => $req->get('checkin_date'),
            'checkout_date' => $req->get('checkout_date'),
        ];

        $bookings = $this->model->getDataByFilter($filter, 'all');

        echo '<pre>';
        var_dump($bookings);
        echo '</pre>';
        exit;
        
        // return $res->render('/bookings/allBookingsIndex', [
        //     'title'   => 'All Bookings',
        //     'filter'  => $filter,
        //     'records' => $bookings
        // ]);
    }

    public function historyBookingsIndex($req, $res)
    {
        $filter = [
            'guest_name'    => $req->get('guest_name'),
            'room_id'       => $req->get('room_id'),
            'room_number'   => $req->get('room_number'),
            'checkin_date'  => $req->get('checkin_date'),
            'checkout_date' => $req->get('checkout_date'),
            'status'        => $req->get('status') //hiển thị trạng thái
        ];

        $records = $this->model->getDataByFilter($filter, 'history');
        
        echo '<pre>';
        var_dump($records);
        echo '</pre>';
        exit;

        // return $res->render('/bookings/historyBookingsIndex', [
        //     'title'   => 'History Bookings',
        //     'filter'  => $filter,
        //     'records' => $records
        // ]);
    }
}

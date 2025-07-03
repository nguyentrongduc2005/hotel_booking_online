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


    public function allBookingsIndex($req, $res)
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
        $records = $this->model->getDataByFilter($filter, 'history');

        echo '<pre>';
        var_dump($records);
        echo '</pre>';
        exit;

        // return $this->render('admin/bookings/history', [
        //     'bookings' => $bookings,
        //     'filters' => $filters,
        // ]);
    }
}

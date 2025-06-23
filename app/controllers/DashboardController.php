<?php

namespace app\controllers;

use app\core\Controller;
use app\models\DashboardModel;

class DashboardController extends Controller
{
    private  $model;

    public function __construct()
    {
        parent::__construct();
        $this->model = new DashboardModel();
    }


    public function show($req, $res)
    {
        $data = [];
        $data['listBooking'] = $this->model->getListBookingPending();
        $data['maintenance']  = $this->model->getMaintenance();
        $data['available']  = $this->model->getAvailable();
        $data['total']  = $this->model->getTotal();
        $data['checkin']  = $this->model->getNcheckin();
        $data['checkout']  = $this->model->getNcheckout();
        $data['bookingToday']  = $this->model->getNBookingToday();
        echo '<pre>';
        print_r($data);




        // $this->render('index');
    }
}

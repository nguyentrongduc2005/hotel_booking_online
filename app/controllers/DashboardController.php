<?php

namespace app\controllers;

use app\core\Controller;
use app\models\DashboardModel;
// use app\core\AppException;

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
        // echo '<pre>';
        // print_r($data);




        $this->render('index', $data);
    }
    public function bookingConfirm($req, $res)
    {
        // echo '<pre>';
        // print_r($req->payload());
        $id =  $req->payload()["id"];
        $status =  $req->payload()["status"]; //confirrmed or cancelled
        $data = "false";
        $check = $this->model->updataConformBooking("id_booking = $id",  $status);
        if ($status == "cancelled") {
            $check = $this->model->updateDataHistory($id, "cancelled");
        }
        if ($check) {
            $data = [
                "statusApi" => "true"
            ];
        } else {
            $data = [
                "statusApi" => "false"
            ];
        }
        $res->json($data)->send();
    }

    public function checkinShow($req, $res)
    {
        $data = [];
        $data['checkinToday'] = $this->model->getListCheckinToday();
        $data['maintenance']  = $this->model->getMaintenance();
        $data['available']  = $this->model->getAvailable();
        $data['total']  = $this->model->getTotal();
        $data['checkin']  = $this->model->getNcheckin();
        $data['checkout']  = $this->model->getNcheckout();
        $data['bookingToday']  = $this->model->getNBookingToday();
        // echo '<pre>';
        // print_r($data);




        $this->render('checkin', $data);
    }
    public function checkinHandler($req, $res)
    {
        $id =  $req->payload()["id"];
        $data = "false";
        $check = $this->model->updateCheckinBooking("id_booking = $id");
        if ($check) {
            $data = [
                "statusApi" => "true"
            ];
        }
        $res->json($data)->send();
    }



    public function checkoutShow($req, $res)
    {
        $data = [];
        $data['checkoutToday'] = $this->model->getListCheckoutToday();
        $data['maintenance']  = $this->model->getMaintenance();
        $data['available']  = $this->model->getAvailable();
        $data['total']  = $this->model->getTotal();
        $data['checkin']  = $this->model->getNcheckin();
        $data['checkout']  = $this->model->getNcheckout();
        $data['bookingToday']  = $this->model->getNBookingToday();
        // echo '<pre>';
        // print_r($data);




        $this->render('checkout', $data);
    }
    public function checkoutHandler($req, $res)
    {
        $id =  $req->payload()["id"];
        $data = ["statusApi" => "false"];
        
        // Debug: Log booking ID
        error_log("Checkout attempt for booking ID: " . $id);
        
        // Cập nhật status_checkout = done
        $check = $this->model->updateCheckoutBooking("id_booking = $id");
        
        if ($check) {
            error_log("Checkout update successful for booking ID: " . $id);
            // Chuyển booking vào history
            $historyCheck = $this->model->updateDataHistory($id, "completed");
            if ($historyCheck) {
                error_log("History update successful for booking ID: " . $id);
                $data = [
                    "statusApi" => "true"
                ];
            } else {
                error_log("History update failed for booking ID: " . $id);
                // Nếu không chuyển được vào history, vẫn coi như thành công
                $data = [
                    "statusApi" => "true"
                ];
            }
        } else {
            error_log("Checkout update failed for booking ID: " . $id);
        }
        
        $res->json($data)->send();
    }
}

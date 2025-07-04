<?php

namespace app\controllers;

use app\core\Controller;
use app\models\PaymentModel;
use app\core\AppException;

class PaymentController extends Controller
{

    private  $model;
    function __construct()
    {
        parent::__construct();
        $this->model = new PaymentModel();
    }
    //submit từ trang list room
    public function formInfo($req, $res)
    {
        // $requestData = $req->post(); //này checkin, checkout, 
        $room = $this->model->getRoomInfo($req->params()["slug"]);
        if (!$room) {
            // Xử lý khi không tìm thấy phòng
            throw new AppException("Room not found", 400, $this->getConfig("basePath"));
            // $this->renderPartial('error/index', ['message' => 'Room not found', 'next' => $this->getConfig("basePath"), 'timeout' => 5]);
        }
        if (isset($_SESSION['user_token']) && isset($_SESSION['user_name'])) {
            // Người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
            $user = $this->model->getUserbyId($_SESSION['user_id']);
            $data["user"] = $user;
        } else {
            // Người dùng chưa đăng nhập, chuyển hướng đến trang đăng nhập
            $data["user"] = [
                'full_name' => '',
                'email' => '',
                'sdt' => '',
                'cccd' => ''
            ];
        }

        $data["room"]  = $room;
        if (!empty($_SESSION['level'])) {
            if ($_SESSION['level'] == "diamond") {
                $data['discount'] = 0.15;
            } else if ($_SESSION['level'] == "gold") {
                $data['discount'] = 0.1;
            } else {
                $data['discount'] = 0.05;
            }
        }
        // echo "<pre>";
        // print_r($data);

        // echo "</pre>";

        $this->render('index', $data);
    }

    function formInfoHandler($req, $res)
    {
        $requestData = $req->post(); //này checkin, checkout, username, email, phone,cccd
        $slug = $req->params()["slug"] ?? "";
        $room = $this->model->getRoomInfo($slug);
        $idroom = $room['id_room'];
        if (!$idroom) {
            // Xử lý khi không tìm thấy phòng
            throw new AppException("Room not found", 400, $this->getConfig("basePath") . '/detailroom/' . $slug);
            // $this->renderPartial('error/index', ['message' => 'Room not found', 'next' => $this->getConfig("basePath") . '/detailroom/' . $slug, 'timeout' => 5]);
        }
        //xử lý phòng có bị trung lịch không
        $check = $this->model->checkRoomBooked($idroom, $requestData['check_in'], $requestData['check_out']);
        if ($check) {
            $meta = $requestData;
            $meta['room'] = $room;
            $meta['message'] = "Phòng đã được đặt trong khoảng thời gian này";
            // Xử lý khi phòng đã được đặt
            // $this->render('index', $meta);
        }

        //xử lý người dùng là guest or user
        $customer = "";
        if (!isset($_SESSION['user_token']) || !isset($_SESSION['user_name']) || !isset($_SESSION['user_id'])) {
            //insert vào bảng guest
            $guestData = [
                'full_name' => $requestData['full_name'],
                'email' => $requestData['email'],
                'sdt' => $requestData['sdt'],
                'cccd' => $requestData['cccd']
            ];
            $customer = $this->model->insertGuest($guestData);
        } else {
            //lấy id user từ session
            $customer = $_SESSION['user_id'];
        }
        //insert bảng transaction
        $idTransaction = $this->model->insertTransaction([
            'total_amount' => $requestData['total_amount'],
        ]);
        if (!$idTransaction) {
            // Xử lý khi không tìm thấy phòng
            throw new AppException("Transaction not found, please call support", 404, $this->getConfig("basePath") . '/detailroom/' . $slug);

            // $this->renderPartial('error/index', ['message' => 'Transaction not found, please call support.', 'next' => $this->getConfig("basePath") . '/detailroom/' . $slug, 'timeout' => 5]);
        }
        //insert bảng booking
        $data = [
            'id_room' => $idroom,
            'check_in' => $requestData['check_in'],
            'check_out' => $requestData['check_out'],
            'customer' => $customer,
            'id_transaction' => $idTransaction
        ];
        $id_booking = $this->model->insertBooking($data);
        if (!$id_booking) {
            // Xử lý khi không tìm thấy phòng
            throw new AppException("Booking not found, please call support", 404, $this->getConfig("basePath") . '/detailroom/' . $slug);

            // $this->renderPartial('error/index', ['message' => 'Booking not found, please call support.', 'next' => $this->getConfig("basePath") . '/detailroom/' . $slug, 'timeout' => 5]);
        }


        $payload = [
            'room' => $room,
            'check_in' => $requestData['check_in'],
            'check_out' => $requestData['check_out'],
            'total_amount' => $requestData['total_amount'],
            "id_transaction" => $idTransaction,
            "id_booking" => $id_booking,
        ];

        if (!empty($_SESSION['level'])) {
            if ($_SESSION['level'] == "diamond") {
                $payload['discount'] = 0.15;
            } else if ($_SESSION['level'] == "gold") {
                $payload['discount'] = 0.1;
            } else {
                $payload['discount'] = 0.05;
            }
        }

        $_SESSION['transaction'] = $payload;

        // echo "<pre>";
        // print_r($payload);
        // echo "</pre>";
        // $this->redirect($this->getConfig('basePath') . '/paymentMethod/' . $slug);
        $this->render('paymentMethod', $payload);
    }
    //submit từ trang form
    public function getMethod($req, $res)
    {
        if (isset($_SESSION['transaction']))
            $this->render('paymentMethod', $_SESSION['transaction']);
        else
            throw new AppException('bad request', 400, $this->getConfig('basePath'));
    }


    //submit từ trang paymentMethod
    public function paymentMethodHandler($req, $res)
    {
        // echo '<pre>';
        // print_r($_SESSION);
        // echo '</pre>';
        // echo '<pre>';
        // print_r($req->post());
        // echo '</pre>';
        // die();
        $requestData = $req->post()['method'] ?? '';
        // echo $requestData;
        $id_transaction = $req->post()['id_transaction'] ?? "";
        // echo $id_transaction;
        $id =  $this->model->updateMethod(['payment_method' => $requestData], "transaction_id = $id_transaction");
        if (!$id) {
            // Xử lý khi không tìm thấy phòng

            throw new AppException("Payment method update failed, please call support", 400, $this->getConfig("basePath") . '/detailroom/' .  $req->params()["slug"] ?? "");
            // $this->renderPartial('error/index', ['message' => 'Payment method update failed, please call support.', 'next' => $this->getConfig("basePath") . '/detailroom/' . $req->params()["slug"], 'timeout' => 5]);
        }
        if (isset($_SESSION['user_id'])) {
            $row =  $this->model->updataDiscount($_SESSION['user_id']);
            if (!$row) {
                throw new AppException("discount failed update failed, please call support", 400, $this->getConfig("basePath") . '/detailroom/' .  $req->params()["slug"] ?? "");
            }
        }
        // unset($_SESSION['transaction']);

        $this->redirect($this->getConfig('basePath') . '/payment/success');
        // echo '<pre>';
        // print_r($req->post());
        // echo '</pre>';
        // die();
        // $this->render("success", []);
    }


    function success($req, $res)
    {
        $this->render("success", []);
    }
}

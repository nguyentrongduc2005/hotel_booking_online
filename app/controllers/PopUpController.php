<?php

namespace app\controllers;

use app\core\Controller;
use app\models\PopUpModel;
use app\core\AppException;

class PopUpController extends Controller
{
    private $model;
    function __construct()
    {
        parent::__construct();
        $this->model = new PopUpModel();
    }

    function showUser($req, $res)
    {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect($this->getConfig('basePath') . "/login");
        }
        $id = $_SESSION['user_id'];

        $user = $this->model->getInfoUser($id);
        if (!$user) {
            throw new AppException('bad request!!', 400, $this->getConfig('basePath'));
        }

        $this->renderPartial('user/popup/user', $user);
    }

    function handlerEditUser($req, $res)
    {
        if (!isset($_SESSION['user_id']))
            return;
        $data = $req->post() ?? [];

        $row = $this->model->updateUser($data, $_SESSION['user_id']);


        $this->redirect($this->getConfig('basePath') . "/user");
    }

    function changePasswordUser($req, $res)
    {
        $data = false;
        if (!$_SESSION)

            $data = false;
        $id = $_SESSION['user_id'];

        $payload = $req->payload();
        if (!isset($payload))
            $data = false;
        $check = $this->model->checkUpdatePass([
            'pass_old' => $payload["pass_old"],
            'pass_new' => $payload["pass_new"],

        ], $id);
        $data = [
            "statusApi" => $check
        ];
        $res->json($data)->send();
    }


    function myReservationHandler($req, $res)
    {
        $data = [];
        if (isset($_SESSION['user_id'])) {
            $data = $this->model->getMyReservation(['user_id' => $_SESSION['user_id']], 'user');
        } else {
            if (isset($req->post()['cccd'])) {
                $cccd = $req->post()['cccd'];

                $data = $this->model->getMyReservation(['cccd' => $cccd], 'guest');
            } else {
                $this->render('myReservation', []);
            }
        }

        $this->renderPartial('user/popup/my', $data);
    }
    function myReservationCancel($req, $res)
    {
        if (!isset($req->post()['id_booking'])) {
            throw new AppException("Bad request", 400, $this->getConfig('basePath') . "/user/reservations");
        }

        $id_booking = $req->post()['id_booking'];
        $check = $this->model->cancelBooking($id_booking);

        $data = [
            "statusApi" => $check
        ];
        $res->json($data)->send();
    }

    function historyHandler($req, $res)
    {
        $data = [];
        if (isset($_SESSION['user_id'])) {
            $data = $this->model->getHistories(['user_id' => $_SESSION['user_id']], 'user');
        } else if (isset($req->post()['cccd'])) {
            $cccd = $req->post()['cccd'];

            $data = $this->model->getHistories(['cccd' => $cccd], 'guest');
        } else {
            // $this->render('myReservation', []);
        }
        // $this->render('myReservation',$data);
        echo "<pre>";
        print_r($data);
    }


    function getTransaction($req, $res)
    {
        $transactions = [];
        $user = null;

        if (isset($_SESSION['user_id'])) {
            // Lấy dữ liệu giao dịch
            $transactions = $this->model->getTransaction(['user_id' => $_SESSION['user_id']], 'user');

            // Lấy thông tin người dùng
            $user = $this->model->getInfoUser($_SESSION['user_id']);
        } else if (isset($req->post()['cccd'])) {
            $cccd = $req->post()['cccd'];
            $transactions = $this->model->getTransaction(['cccd' => $cccd], 'guest');
            // Guest không có thông tin user
            $user = null;
        } else {
            // Nếu không có dữ liệu gì hết, load trang rỗng
            $this->render('myTransaction', []);
            return;
        }

        // Truyền cả giao dịch + user vào view
        $this->renderPartial('user/popup/myTransaction', [
            'transactions' => $transactions,
            'user' => $user
        ]);
    }



}

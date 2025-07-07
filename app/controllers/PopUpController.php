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
        $check = false;
        if (!isset($_SESSION['user_id']))
            $check = false;
        $id = $_SESSION['user_id'];

        $payload = $req->payload();
        if (!isset($payload))
            $data = false;

        $check = $this->model->checkUpdatePass([
            'pass_old' => $payload["pass_old"],
            'pass_new' => $payload["pass_new"],

        ], $id);
        $check = true;
        $data = [
            "statusApi" => $check
        ];
        $res->json($data)->send();
    }


    function myReservationHandler($req, $res)
    {
        $data = [];
        $user = NULL;
        if (isset($_SESSION['user_id'])) {
            $data = $this->model->getMyReservation(['user_id' => $_SESSION['user_id']], 'user');
            $user = $this->model->getInfoUser($_SESSION['user_id']);
        } else {
            if (isset($req->post()['cccd'])) {
                $cccd = $req->post()['cccd'];
                $data = $this->model->getMyReservation(['cccd' => $cccd], 'guest');
                $user = NULL;
            } else {
                $this->renderPartial('user/popup/myReservation', []);
                return;
            }
        }

        $this->renderPartial('user/popup/myReservation', [
            'reservations' => $data,
            'user' => $user
        ]);
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
        $user = null;
        if (isset($_SESSION['user_id'])) {
            $data = $this->model->getHistories(['user_id' => $_SESSION['user_id']], 'user');
            $user = $this->model->getInfoUser($_SESSION['user_id']);
        } else if (isset($req->post()['cccd'])) {
            $cccd = $req->post()['cccd'];
            $data = $this->model->getHistories(['cccd' => $cccd], 'guest');
            $user = null;
        } else {
            // $this->render('history', []);
        }
        $this->renderPartial('/user/popup/history', [
            'history' => $data,
            'user' => $user
        ]);
        // echo "<pre>";
        // print_r($data);

    }


    function getTransaction($req, $res)
    {
        $data = [];
        $user = null;

        if (isset($_SESSION['user_id'])) {
            $data = $this->model->getTransaction(['user_id' => $_SESSION['user_id']], 'user');

            $user = $this->model->getInfoUser($_SESSION['user_id']);
        } else if (isset($req->post()['cccd'])) {
            $cccd = $req->post()['cccd'];
            $data = $this->model->getTransaction(['cccd' => $cccd], 'guest');
            $user = null;
        } else {
            $this->renderPartial('user/popup/myTransaction', []);
            return;
        }
        $this->renderPartial('user/popup/myTransaction', [
            'transactions' => $data,
            'user' => $user
        ]);
    }
}

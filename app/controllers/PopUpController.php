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
        if (!isset($_SESSION['user_id'])) return;
        $data = $req->post() ?? [];

        $row = $this->model->updateUser($data, $_SESSION['user_id']);


        $this->redirect($this->getConfig('basePath') . "/user");
    }

    function changePasswordUser($req, $res)
    {
        if (!$_SESSION) return false;
        $id = $_SESSION['user_id'];

        $payload = $req->payload();
        if (!isset($payload)) return false;
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

        $this->render('myReservation', $data);
    }
}

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

    function show($req, $res)
    {
        $id = $_SESSION['user_id'];
        $user = $this->model->getInfoUser($id);
        if (!$user) {
            throw new AppException('bad request!!', 400, $this->getConfig('basePath'));
        }

        $this->render('user', $user);
    }

    function handlerEdit($req, $res)
    {
        $data = $req->post() ?? [];
        $row = $this->model->updateUser($data);

        if (!$row) {
            throw new AppException('bad request', 400, $this->getConfig('basePath') . "/user");
        }
        $this->redirect($this->getConfig('basePath') . "/user");
    }

    function changePassword($req, $res)
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
}

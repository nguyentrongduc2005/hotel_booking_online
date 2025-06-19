<?php

namespace app\controllers;

use app\core\Controller;
use app\models\AuthenModel;


class AuthenController extends Controller
{
    private $model;
    function __construct()
    {
        parent::__construct();
        $this->model = new AuthenModel();
    }

    function login($req, $res)
    {
        $this->renderPartial('auth/login');
    }
    function regis($req, $res)
    {

        $this->renderPartial('auth/regis');
    }
    function loginHandler($req, $res)
    {
        $email = $req->post()['email'];
        $password = $req->post()['password'];
        $user =  $this->model->findUserbyEmail($email);
        //xác thực tài khoản mật khẩu
        if (!$user) {
            $this->renderPartial('auth/login', ['message' => 'Invalid email or password.', 'email' => '', "password" => '']);
            return;
        }
        if ($user['pass'] !== $password) {
            $this->renderPartial('auth/login', ['message' => 'Invalid email or password.', 'email' => '', "password" => '']);
            return;
        }
        if ($this->model->findTokenbyId($user["user_id"])) {
            $this->renderPartial('auth/login', ['message' => "This account is already logged in on another device.", 'email' => '', "password" => '']);
            return;
        }

        //tạo token và lưu vào db
        $idtoken = $this->model->generateAndInsertToken($user["user_id"]);
        if (!$idtoken) {
            $this->renderPartial('auth/login', ['message' => "Something went wrong. Please try again.", 'email' => '', "password" => '']);
            return;
        }
        //lưu vào token session để client có thể request
        $token = $this->model->findTokenbyId($idtoken);
        if ($token) {
            $_SESSION['user_token'] = $token['token'];
        }


        $this->renderPartial('auth/login', ['message' => "Login successful. Redirecting...", 'email' => $email, "password" => $password, 'access' => true]);


        // session_unset();     // Xoá tất cả biến session
        // session_destroy();
    }
    function regisHandler($req, $res)
    {

        // xác thực các thông tin chưa tồn tại trong db
        $user  = $req->post();

        if ($this->model->findUserbyEmail($user['email'])) {
            $user['email'] = "";
            $user['message'] = "This email address is already in use.";
            // $this->render('regis', $user);
            return;
        }

        if ($this->model->findUserbySDT($user['sdt'])) {
            $user['sdt'] = "";
            $user['message'] = "This phone number is already linked to another account.";
            $this->renderPartial('auth/regis', $user);
            return;
        }

        if ($this->model->findUserbyCCCD($user['cccd'])) {
            $user['cccd'] = "";
            $user['message'] = "This ID card number has already been registered.";
            $this->renderPartial('auth/regis', $user);
            return;
        }

        //lưu thông tin người tài khoản vào db user
        $idUser = $this->model->insertUser($user);
        if (!$idUser) {
            $user['message'] = "Something went wrong. Please try again.";
            $this->renderPartial('auth/regis', $user);
            return;
        }

        //lưu token vào db user và session để điều hướng trang qua trang home
        $idtoken = $this->model->generateAndInsertToken($idUser);
        if (!$idtoken) {
            $user['message'] = "Something went wrong. Please try again.";
            $this->renderPartial('auth/regis', $user);
            return;
        }
        $token = $this->model->findTokenbyId($idtoken);
        if ($token) {
            $_SESSION['user_token'] = $token['token'];
        }
        $user['message'] = "Register successful. Redirecting... ";
        $this->renderPartial('auth/regis', $user);
    }
}

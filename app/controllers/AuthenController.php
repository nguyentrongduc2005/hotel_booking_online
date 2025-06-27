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
        // password_verify( $password, $user['pass'])
        if (!password_verify($password, $user['pass'])) {
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
        $token = $this->model->findTokenByidToken($idtoken);
        if ($token) {
            $_SESSION['user_token'] = $token['token'];
            $now = time();               // thời gian hiện tại (timestamp)
            $after30Min = $now + 1800;
            $_SESSION['timer'] = $after30Min;
        }


        $this->renderPartial('auth/login', [
            'message' => "Login successful. Redirecting...",
            'email' => $email,
            "password" => $password,
            "access" => $user['role'] == 'admin' ? $this->getConfig('basePath') . '/dashboard' : $this->getConfig('basePath') . '/'
        ]);


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
        $user['pass'] = $hashedPassword = password_hash($user['pass'], PASSWORD_DEFAULT);
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
        $token = $this->model->findTokenByidToken($idtoken);
        if ($token) {
            $_SESSION['user_token'] = $token['token'];
            $now = time();               // thời gian hiện tại (timestamp)
            $after30Min = $now + 1800;
            $_SESSION['timer'] = $after30Min;
        }
        $user['message'] = "Register successful. Redirecting... ";
        $user['access'] =  $this->getConfig('basePath');
        $this->renderPartial('auth/regis', $user);
    }


    function logoutHandler($req, $res)
    {
        if (isset($_SESSION["user_token"])) {
            $id_token = $this->model->findTokenByToken($_SESSION["user_token"]);
            if ($id_token) {
                if ($this->model->deleteToken($id_token['id_token'])) {
                    session_unset();
                    session_destroy();
                    $this->redirect($this->getConfig('basePath') . "/login");
                }
            } else {

                $this->redirect($this->getConfig('basePath') . "/login");
            }
        } else {
            // $this->renderPartial('auth/login', ['email' => '', 'password' => '', 'message' => '']);
            $this->redirect($this->getConfig('basePath'));
        }
    }


    function refeshToken($req, $res)
    {

        if (isset($_SESSION['timer'])) {

            if ($_SESSION['timer'] < time()) {
                return $res->json(['refreshToken' => false], 401)->send();
            }
            $now = time();               // thời gian hiện tại (timestamp)
            $after30Min = $now + 1800;
            $_SESSION['timer'] = $after30Min;
            return $res->json(['refreshToken' => true], 200)->send();
        }
    }
}

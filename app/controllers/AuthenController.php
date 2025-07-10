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
        if (isset($_COOKIE['user_id'])) {
            $this->redirect($this->getConfig('basePath'));
        } else {
            $this->renderPartial('auth/login');
        }
    }
    function regis($req, $res)
    {
        if (isset($_COOKIE['user_id'])) {
            $this->redirect($this->getConfig('basePath'));
        } else {
            $this->renderPartial('auth/regis');
        }
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
        // if ($this->model->findTokenbyId($user["user_id"])) {
        //     $this->renderPartial('auth/login', ['message' => "This account is already logged in on another device.", 'email' => '', "password" => '']);
        //     return;
        // }
        $_SESSION['user_id'] = $user['user_id'];
        $secret = $this->getConfig("YOUR_SECRET_KEY");
        $hash = hash_hmac('sha256', $user['user_id'], $secret);
        $value = base64_encode($user['user_id'] . "|" . $hash);

        setcookie("user_id", $value, time() + 86400 * 7, "/", "", false, true);



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


        $_SESSION['user_id'] = $user['user_id'];
        $secret = $this->getConfig("YOUR_SECRET_KEY");
        $hash = hash_hmac('sha256', $user['user_id'], $secret);
        $value = base64_encode($user['user_id'] . "|" . $hash);
        setcookie("user_id", $value, time() + 86400 * 7, "/", "", false, true);

        $user['message'] = "Register successful. Redirecting... ";
        $user['access'] =  $this->getConfig('basePath');
        $this->renderPartial('auth/regis', $user);
    }


    function logoutHandler($req, $res)
    {
        session_destroy();
        setcookie("user_id", '', time() - 1, "/", "", false, true);

        $this->redirect($this->getConfig('basePath'));
    }
}

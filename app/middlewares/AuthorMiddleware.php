<?php

namespace app\middlewares;

use app\core\db;
use app\core\Controller;
use app\core\AppException;

class AuthorMiddleware
{



    ///
    //1. dang nhạp có token db và session
    ///2 được lưu vào cookie để lần sao kh cần login
    //3

    ///
    public function checktoken($req, $res)
    {

        //kiểm tra có token không 
        if (empty($_SESSION['user_token']) || empty($_SESSION['timer'])) {
            if (isset($_COOKIE['user_token'], $_COOKIE['timer'])) {
                /////////////////////////////////////
            }
        }


        //kiểm tra token có khớp với db không
        db::connect();
        $sqlToken = "SELECT * FROM token WHERE token.token = :userToken;";

        $data = db::getOne($sqlToken, ['userToken' => $_SESSION['user_token']]);
        if (!$data) {
            session_destroy();
            return true;
        }
        //kiêm tra con thơi gian không
        if ($_SESSION['timer'] < time()) {
            db::delete('token', "token.id_token = {$data['id_token']}");
            session_destroy();
            return true;
        }
        //nếu khớp tìm user của token
        $sqlUser = "SELECT discount, email, full_name, user.role from user where user.user_id = :id;";
        $user = db::getOne($sqlUser, ['id' => $data['user_id']]);
        //token không chủ
        if (!$user) {
            db::delete('token', "token.id_token = {$data['id_token']}");
            session_destroy();
            return true;
        }
        if (isset($_SESSION['user_name']) && isset($_SESSION['role']) && isset($_SESSION['user_email']) && isset($_SESSION['level']) && isset($_SESSION['user_id'])) return true;
        // set thông tin user vào token lấy role
        $_SESSION['user_name'] = isset($user['full_name']) ? $user['full_name'] : '';
        $_SESSION['role'] = isset($user['role']) ? $user['role'] : '';
        $_SESSION['user_email'] = isset($user['email']) ? $user['email'] : '';
        $_SESSION['level'] = $user['discount'] >= 5 ? ($user['discount'] > 10 ? "diamond" : "gold") : "silver";
        $_SESSION['user_id'] = $data['user_id'];

        return true;
    }

    public function author($req, $res)
    {
        // Controller::setLayout("Adminlayouts/main");
        // Controller::setcomponent('/admin');
        if (empty($_SESSION['user_room']) && empty($_SESSION['role'])) return true;

        if ($_SESSION['role'] === 'admin') {
            Controller::setLayout("Adminlayouts/main");
            Controller::setcomponent('/admin');
        } else if ($_SESSION['role'] === 'user') {
            Controller::setLayout("layouts/main");
            Controller::setcomponent('/user');
        }

        return true;
    }
    public function checkRoleAdmin($req, $res)
    {
        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] === 'admin') {
                return true;
            } else if ($_SESSION['role'] === 'user') {
                throw new AppException("Forbidden", 403);
            }
        } else {
            throw new AppException("Forbidden", 403);
        }
    }
    public function checkRoleUser($req, $res)
    {


        if (isset($_SESSION['role'])) {
            if ($_SESSION['role'] === 'user') {

                return true;
            } else if ($_SESSION['role'] === 'admin') {
                throw new AppException("Forbidden", 403);
            }
        } else {
            return true;
        }
    }
}

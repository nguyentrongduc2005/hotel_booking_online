<?php

namespace app\middlewares;

use app\core\db;
use app\core\Controller;


class AuthorMiddleware
{
    public function checktoken($req, $res)
    {

        // Controller::setLayout("Adminlayouts/main");
        // Controller::setcomponent('/admin');
        //kiểm tra có token không 
        if (empty($_SESSION['user_token']) || empty($_SESSION['timer'])) return true;

        //kiểm tra token có khớp với db không
        db::connect();
        $sqlToken = "SELECT * FROM token WHERE token.token = :userToken;";

        $data = db::getOne($sqlToken, ['userToken' => $_SESSION['user_token']]);
        if (!$data) {
            session_unset();
            session_destroy();
            return true;
        }
        //kiêm tra con thơi gian không
        if ($_SESSION['timer'] < time()) {
            db::delete('token', "token.id_token = {$data['id_token']}");
            session_unset();
            session_destroy();
            return true;
        }
        //nếu khớp tìm user của token
        $sqlUser = "SELECT discount, email, full_name, role from user where user.user_id = :id;";
        $user = db::getOne($sqlUser, ['id' => $data['user_id']]);
        //token không chủ
        if (!$user) {
            db::delete('token', "token.id_token = {$data['id_token']}");
            session_unset();
            session_destroy();
            return true;
        }
        // set thông tin user vào token lấy role
        $_SESSION['user_name'] = isset($user['full_name']) ? $user['full_name'] : '';
        $_SESSION['role'] = isset($user['role']) ? $user['role'] : '';
        $_SESSION['user_email'] = isset($user['email']) ? $user['email'] : '';
        $_SESSION['level'] = $user['discount'] >= 5 ? ($user['discount'] > 10 ? "diamond" : "gold") : "silver";

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
        }
    }
}

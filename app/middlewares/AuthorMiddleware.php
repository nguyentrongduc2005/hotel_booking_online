<?php

namespace app\middlewares;

use app\core\db;
use app\core\Controller;
use app\core\AppException;
use PSpell\Config;

class AuthorMiddleware extends Controller
{



    ///
    //1. dang nhạp có token db và session
    ///2 được lưu vào cookie để lần sao kh cần login
    //3

    ///
    public function checkSession($req, $res)
    {
        // error_log("Middleware chạy: checktoken");
        db::connect();

        if (!isset($_SESSION['user_id'])) {
            $secret = $this->getConfig("YOUR_SECRET_KEY");

            if (isset($_COOKIE['user_id'])) {
                $decoded = base64_decode($_COOKIE['user_id']);

                // Tách phần user_id và hash ra
                list($user_id, $hash) = explode('|', $decoded);

                // Tạo lại hash từ user_id để so sánh
                $expected_hash = hash_hmac('sha256', $user_id, $secret);

                if (hash_equals($expected_hash, $hash)) {

                    $_SESSION['user_id'] = $user_id;
                } else {
                    throw new AppException('Cookie Forbidden', 403);
                }
            } else {
                return true;
            }
        }

        //nếu khớp tìm user của token
        $sqlUser = "SELECT discount, email, full_name, user.role from user where user.user_id = :id;";
        $user = db::getOne($sqlUser, ['id' => $_SESSION['user_id']]);


        if (isset($_SESSION['user_name']) && isset($_SESSION['role']) && isset($_SESSION['user_email']) && isset($_SESSION['level'])) return true;

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
        if (empty($_SESSION['user_name']) && empty($_SESSION['role'])) return true;

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
            if ($_SESSION['role'] == 'user') {

                return true;
            } else if ($_SESSION['role'] == 'admin') {
                throw new AppException("Forbidden", 403);
            }
        }

        return true;
    }
}

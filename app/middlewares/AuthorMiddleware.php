<?php

namespace app\middlewares;

use app\core\Controller;
use app\core\Registry;


class AuthorMiddleware
{
    public function author($req, $res)
    {
        // Controller::setLayout("Adminlayouts/main");
        // Controller::setcomponent('/admin');
        //kiểm tra token có còn hạn không nếu không thi trang về home
        // if (empty($_SESSION['timer']) && empty($_SESSION['user_token'])) return true;
        // echo '<pre>';
        // print_r($_SESSION);
        // session_destroy();
        // $_SESSION['timer'] -= 1900;

        // if (!$_SESSION['timer'] > time()) {
        //     $res->redirect('http://localhost:8888/hotel_booking_online/public/regis')->send();
        // }

        //kiểm tra token có khớp với db không


        //nếu khớp tìm user của token


        // set thông tin user vào token lấy role



        return true;
    }
}

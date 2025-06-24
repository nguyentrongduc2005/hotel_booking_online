<?php

namespace app\controllers;

use app\core\Controller;
use app\models\PaymentModel;

class PaymentController extends Controller
{

    private  $model;
    function __construct()
    {
        parent::__construct();
        $this->model = new PaymentModel();
    }
    //submit từ trang list room 
    public function show($req, $res)
    {
        $requestData = $req->post();
        $this->render('index', []);
    }

    // public function paymentMethod($req, $res)
    // {
    //     // Hiển thị trang thanh toán
    //     $this->render('paymentMethod', []);
    // }

    //submit từ trang form
    public function formHandler($req, $res)
    {
        $requestData = $req->post(); //gồm từ form người dùng và từ trang list room

        // $this->render('paymentMethod', []);
    }
    //submit từ trang paymentMethod
    public function paymentMethodHandler($req, $res)
    {
        // Xử lý logic thanh toán ở đây
        // Ví dụ: Lấy dữ liệu từ form và lưu vào cơ sở dữ liệu

        // Trả về kết quả hoặc chuyển hướng đến trang khác
        // $this->render('paymentMethod', []);
    }

    public function paymentSuccess($req, $res)
    {
        // Hiển thị trang thành công
        $this->render('paymentSuccess', []);
    }
}

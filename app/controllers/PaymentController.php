<?php

namespace app\controllers;

use app\core\Controller;

class PaymentController extends Controller
{
    public function show($req, $res)
    {
        $this->render('index', []);
    }
} 
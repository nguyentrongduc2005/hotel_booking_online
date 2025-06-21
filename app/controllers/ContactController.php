<?php

namespace app\controllers;

use app\core\Controller;

class ContactController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show($req, $res)
    {
        $this->render('index');
    }
} 
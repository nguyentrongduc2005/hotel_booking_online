<?php

namespace app\controllers;

use app\core\Controller;


class NewsController extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function show($req, $res)
    {
        $this->render('show');
    }

    function index($req, $res)
    {
        return $res->error('user isnt exits')->send();
    }
}

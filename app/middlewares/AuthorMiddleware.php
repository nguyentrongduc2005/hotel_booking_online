<?php

namespace app\middlewares;

use app\core\Controller;
use app\core\Registry;


class AuthorMiddleware
{
    public function author($req, $res)
    {
        Controller::setLayout("Adminlayouts/main");
        Controller::setcomponent('/admin');
        // Registry::getInstance()->config["layoutPath"] =  "Adminlayouts/main";
        // echo  Registry::getInstance()->config["viewpathComponent"];
        return true;
    }

    public function show2() {}
}
  
<?php

namespace app\core;

use \Exception;
use \app\core\Controller;

class AppException extends Exception
{
    // private  $controller = new \app\core\Controller();
    private $next;
    private $controller;
    function __construct($message, $code = null, $next = null)
    {
        $this->controller = new Controller();

        if ($next === null) {
            $next = $this->controller->getConfig("basePath");
            if (Controller::$componentView == '/admin') {
                $next = $next . "/dashboard";
            }
        }

        $this->next = $next;

        set_exception_handler([$this, 'error_handler']);
        parent::__construct($message, $code);
    }

    function error_handler($e)
    {

        // (new Response())->error($e->getMessage(), $e->getCode(), $e->getTraceAsString())->send();
        $this->controller->renderPartial("error/index", ["statusCode" => $e->getCode(), "message" => $e->getMessage(), "next" =>  $this->next, "timeout" => 5]);
    }
}

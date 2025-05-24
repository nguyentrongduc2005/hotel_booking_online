<?php

namespace app\core;

use \Exception;

class AppException extends Exception
{
    function __construct($message, $code = null)
    {
        set_exception_handler([$this, 'error_handler']);
        parent::__construct($message, $code);
    }

    function error_handler($e)
    {
        (new Response())->error($e->getMessage(), $e->getCode(), $e->getTraceAsString())->send();
    }
}

<?php

namespace app\core;

class Registry
{
    private static $instance;
    private $storage;
    private function __construct() {}
    static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    function __set($key, $value)
    {
        if (!isset($this->storage[$key]))
            $this->storage[$key] = $value;
        else
            throw new AppException("cofig is not set", 500);
    }

    function __get($key)
    {
        if (isset($this->storage[$key]))
            return $this->storage[$key];
        return null;
    }
}

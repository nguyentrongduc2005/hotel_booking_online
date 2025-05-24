<?php

use app\core\AppException;

class Autoload
{
    private $rootDir;
    function __construct($rootDir)
    {
        $this->rootDir = $rootDir['rootDir'];
        $this->autoloadFile();
        spl_autoload_register([$this, 'autoLoad']);
    }

    private function Autoload($class)
    {


        $rootPath = $this->rootDir;
        $pathSegment = (explode('\\', $class));
        $className = end($pathSegment);
        $pathName = str_replace($className, '', $class);
        $filePath = $rootPath . '\\' . $pathName . $className . '.php';

        if (file_exists($filePath)) {

            require_once($filePath);
        } else {
            throw new AppException('class isnt exits', 404);
        }
    }

    private function autoloadFile()
    {
        foreach ($this->defaultLoadFile() as $file) {
            require_once($this->rootDir . '/' . $file);
        }
    }

    private function defaultLoadFile()
    {
        return [
            "app/core/Router.php",
            "app/Routers.php"
        ];
    }
}

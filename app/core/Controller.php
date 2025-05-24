<?php

namespace app\core;

class Controller
{
    private $layout = null;
    private $configs;
    function __construct()
    {
        $this->configs = Registry::getInstance();
        $this->layout = $this->configs->config['layoutPath'];
    }

    function setLayout($layout)
    {
        $this->layout = $layout;
    }

    function redirect($url, $isEnd = true, $resPonseCode = 302)
    {
        header("location:$url", true, $resPonseCode);
        if ($isEnd) {
            die();
        }
    }

    function render($view, $data = null)
    {

        $controller = $this->configs->controller;
        // $folderView = strtolower(str_replace('Controller', '', $controller));

        $content = $this->getViewContent($view, $data);
        if ($this->layout !== null) {
            $layoutPath = $this->configs->config['viewPath'] . '/' . $this->layout . '.php';
            if (file_exists($layoutPath)) {
                require($layoutPath);
            } else {
                throw new AppException("$layoutPath isn't exit", 500);
            }
        }

        // $viewPath = \App::getConfig()['viewPath'] . $folderView . '/' . $view . '.php';
        // if (file_exists($viewPath)) {
        //     require($viewPath);
        // }
    }

    function getViewContent($view, $data = null)
    {
        $controller =  $this->configs->controller;
        $folderView = strtolower(str_replace('Controller', '', $controller));

        if (is_array($data)) {
            extract($data, EXTR_PREFIX_SAME, 'data');
        } else {
            $data = $data;
        }
        $viewPath = $this->configs->config['viewPath'] . '/' . $folderView . '/' . $view . '.php';
        if (file_exists($viewPath)) {
            ob_start();
            require($viewPath);
            return  ob_get_clean();
        } else {
            throw new AppException("$viewPath isn't exit", 500);
        }
    }

    function renderPartial($view, $data = null)
    {
        if (is_array($data)) {
            extract($data, EXTR_PREFIX_SAME, 'data');
        } else {
            $data = $data;
        }
        $viewPath = $this->configs->config['viewPath'] . '/' . $view . '.php';
        if (file_exists($viewPath)) {
            require($viewPath);
        } else {
            throw new AppException("$viewPath isn't exit", 500);
        }
    }
}

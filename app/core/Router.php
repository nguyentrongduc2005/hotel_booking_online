<?php

use app\core\AppException;
use app\core\Request;
use app\core\Response;
use app\core\Registry;
// require_once __DIR__ . '../../controllers/UserController.php';


class Router
{

    private static $routes = [];
    function __contrust()
    {

        // Initialize the router
    }

    private static function addRoute($method, $path, $callback)
    {
        self::$routes[$method][$path] = $callback;
    }

    static function get($path, $callback)
    {
        self::addRoute('GET', $path, $callback);
    }

    static function post($path, $callback)
    {
        self::addRoute('POST', $path, $callback);
    }

    static function any($path, $callback)
    {
        self::addRoute('ANY', $path, $callback);
    }

    function callAction($callback, $request, $response)
    {
        if (is_callable($callback)) {
            return call_user_func_array($callback, [$request, $response]);
        } elseif (is_string($callback)) {
            $this->compieRoute($callback, $request, $response);
        }
    }

    private function compieRoute($callback, $request, $response)
    {
        [$controllerName, $method] = explode('@', $callback);
        $controller = "app\\controllers\\" . $controllerName;
        if (class_exists($controller)) {
            Registry::getInstance()->controller = $controllerName;
            $object = new $controller;
            if (method_exists($controller, $method)) {
                Registry::getInstance()->method = $method;
                call_user_func_array([$object, $method], [$request, $response]);
            } else {
                throw new AppException("$method not found", 500);
            }
        } else {
            throw new AppException("$controller not found", 500);
        }
    }
    function map()
    {

        $request = new Request();
        $response = new Response();
        $method = $request->method();
        $path = $request->path();



        $path = '/' . trim($path, '/');

        $pathSegments = explode('/', trim($path, '/'));

        if (isset(self::$routes[$method])) {
            $match = true;
            foreach (self::$routes[$method] as $route => $callback) {
                $route = '/' . trim($route, '/');
                $routeSegments = explode('/', trim($route, '/'));

                if (count($pathSegments) !== count($routeSegments)) {
                    $match = false;
                    continue;
                }


                $params = [];
                for ($i = 0; $i < count($routeSegments); $i++) {
                    $routeSegment = $routeSegments[$i];
                    $pathSegment = $pathSegments[$i];
                    //kiểm tra có tham số động (bắt đầu bằng { và kết thúc bằng })
                    if (preg_match('/^\{([a-zA-Z0-9_]+)\}$/', $routeSegment, $matches)) {
                        $paramName = $matches[1];
                        $params[$paramName] = $pathSegment;
                        continue;
                    } elseif ($routeSegment !== $pathSegment) {
                        // Nếu segment không khớp và không phải tham số động, bỏ qua route này

                        $match = false;
                        break;
                    } else if ($routeSegment === $pathSegment) {
                        $match = true;
                    }
                }
                if ($match) {

                    $request->setParams($params);
                    // Gán params vào Request
                    return  $this->callAction($callback, $request, $response);
                } else {

                    return throw new AppException("Not Found", 404);
                }
            }
            if (!$match) {

                return throw new AppException("Not Found", 404);
            }
        }
    }




    function run()
    {
        $this->map();        // Your routing logic here
    }
}

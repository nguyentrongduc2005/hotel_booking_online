<?php

use app\core\AppException;
use app\core\Request;
use app\core\Response;
use app\core\Registry;
// require_once __DIR__ . '../../controllers/UserController.php';


class Router
{

    public static $routes = [];
    function __contrust()
    {

        // Initialize the router
    }

    private static function addRoute($method, $path, $callback, $middleware = null)
    {
        if ($callback == null) {
            throw new AppException("Callback cannot be null", 500);
        }
        self::$routes[$method][$path] = $middleware ? [$callback, $middleware] : [$callback, null];
    }

    static function get($path, $callback, $middleware = null)
    {
        self::addRoute('GET', $path, $callback, $middleware);
    }

    static function post($path, $callback, $middleware = null)
    {
        self::addRoute('POST', $path, $callback, $middleware);
    }

    static function any($path, $callback, $middleware = null)
    {
        self::addRoute('ANY', $path, $callback, $middleware);
    }

    function callAction($callback, $request, $response)
    {
        if (is_callable($callback)) {
            return call_user_func_array($callback, [$request, $response]);
        } elseif (is_string($callback)) {
            $this->compieRoute($callback, $request, $response);
        }
    }

    private function handlerMiddleware($middleware, $request, $response)
    {
        [$middlewareName, $method] = explode('@', $middleware);
        $middleware = "app\\middlewares\\" . $middlewareName;

        if (class_exists($middleware)) {
            $object = new $middleware;
            if (method_exists($middleware, $method)) {
                return call_user_func_array([$object, $method], [$request, $response]);
            } else {
                throw new AppException("$method not found", 500);
            }
        } else {
            throw new AppException("$middleware not found", 500);
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

            foreach (self::$routes[$method] as $route => [$callback, $middleware]) {
                $match = true;

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
                    if (isset($middleware)) {
                        if (!is_array($middleware)) {
                            if (!$this->handlerMiddleware($middleware, $request, $response)) {
                                throw new AppException("Middleware $middleware faild", 500);
                            }
                        } else {
                            foreach ($middleware as $mid) {
                                if (!$this->handlerMiddleware($mid, $request, $response)) {
                                    throw new AppException("Middleware $mid faild", 500);
                                }
                            }
                        }
                    }
                    $request->setParams($params);
                    // Gán params vào Request
                    return  $this->callAction($callback, $request, $response);
                }
            }

            if (!$match) {

              echo "loi";         //   throw new AppException("Not Found", 404);
            }
        }
    }



    function run()
    {
        $this->map();        // Your routing logic here
    }
}

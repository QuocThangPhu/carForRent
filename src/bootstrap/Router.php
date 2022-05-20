<?php

namespace Thangphu\CarForRent\bootstrap;

use Thangphu\CarForRent\App\View;

class Router
{
    /**
     * @var array
     */
    protected static $routes = [];
    /**
     * @var Request
     */
    public static Request $request;
    /**
     * @var Response
     */
    public static Response $response;

    /**
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        static::$request = $request;
        static::$response = $response;
    }

    /**
     * @param $path
     * @param $callback
     * @return void
     */
    public static function get($path, $callback): void
    {
        static::$routes['GET'][$path] = $callback;
    }

    public static function post($path, $callback): void
    {
        static::$routes['POST'][$path] = $callback;
    }

    /**
     * @return string|string[]
     */
    public static function resolve()
    {
        $path = static::$request->getPath();
        $method = static::$request->method();
        $callback = static::$routes[$method][$path] ?? false;
        if ($callback === false) {
            static::$response->setStatusCode(404);
            return View::renderView('404');
        }
        if (is_string($callback)) {
            return View::renderView($callback);
        }
        return call_user_func($callback);
    }
}

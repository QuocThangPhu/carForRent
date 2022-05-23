<?php

namespace Thangphu\CarForRent\bootstrap;

use Thangphu\CarForRent\App\View;

class Router
{
    /**
     * @var array
     */
    public static $routes = [];
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
}

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

<?php

namespace Thangphu\CarForRent\bootstrap;

use Thangphu\CarForRent\App\View;
use Closure;
use Exception;
use ReflectionClass;
use ReflectionException;

class Application
{
    public static Request $request;
    public static Response $response;
    private static Router $routes;
    public static string $ROOT_DIR;
    public static Application $application;

    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$application = $this;
        static::$request = new Request();
        static::$response = new Response();
        static::$routes = new Router(static::$request, static::$response);
    }

    public function run()
    {
        $container = new Container();
        $path = static::$request->getPath();
        $method = static::$request->method();
        $callback = Router::$routes[$method][$path] ?? false;
        if ($callback === false) {
            static::$response->setStatusCode(404);
            echo View::renderView('_404');
        }
        if (is_string($callback)) {
            echo View::renderView($callback);
        }
        $currentController = $callback[0];
        $action = $callback[1];
        $controller = $container->make($currentController);
        echo $controller->{$action}();
    }
}

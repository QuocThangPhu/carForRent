<?php

namespace Thangphu\CarForRent\bootstrap;

use Thangphu\CarForRent\App\View;
use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Service;
use Closure;
use Exception;
use ReflectionClass;
use ReflectionException;

class Application
{

    public function run($request, $responseView, $porvider)
    {
        $container = $porvider->getContainer();

        $path = $request->getPath();
        $method = $request->method();
        $response = Router::$routes[$method][$path] ?? false;
        if (!$response) {
            $responseView->renderView('404');
            View::display($$responseView);
            return;
        }
        $callback = $response[0];
        if (is_string($callback)) {
            $responseView->renderView($callback);
        }
        if (gettype($callback) == 'object') {
            $callback();
        }
        $currenController = $callback[0];
        $action = $callback[1];
        $controller = $container->make($currenController);
        $response =  $controller->{$action}();
        View::display($response);
    }
}

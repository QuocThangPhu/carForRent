<?php

namespace Thangphu\CarForRent\App;

use Thangphu\CarForRent\bootstrap\Application;

class View
{
    public static function render(string $view, array $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }
    public static function redirect($path)
    {
        header("location: $path");
    }
}
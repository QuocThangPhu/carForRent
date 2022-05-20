<?php

namespace Thangphu\CarForRent\bootstrap;

use Thangphu\CarForRent\App\View;

class Controller
{
    /**
     * @param $view
     * @param $params
     * @return string|string[]
     */
    public function render($view, $params = [])
    {
        return View::renderView($view, $params);
    }
}

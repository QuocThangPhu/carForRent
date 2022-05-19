<?php

namespace Thangphu\CarForRent\bootstrap;

class Service
{
    public string $layout = 'main';

    /**
     * @return void
     */
    public function setLayout($layout): void
    {
        $this->layout = $layout;
    }

    /**
     * @param $view
     * @param $params
     * @return string|string[]
     */
    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

}

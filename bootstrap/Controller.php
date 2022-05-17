<?php

namespace Thangphu\UnLock\core;

class Controller
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

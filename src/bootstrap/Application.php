<?php

namespace Thangphu\CarForRent\bootstrap;

use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Router;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\bootstrap\Controller;

class Application
{
    /**
     * @var string
     */
    public static string $ROOT_DIR;

    /**
     * @var Router
     */
    public Router $router;

    /**
     * @var Request
     */
    public Request $request;

    /**
     * @var Response
     */
    public Response $response;

    /**
     * @var Application
     */
    public static Application $app;

    /**
     * @var Controller
     */
    public Controller $controller;

    /**
     * @param $rootPath
     */
    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        $this->request = new Request();
        $this->response = new Response();
        self::$app = $this;
        $this->router = new Router($this->request, $this->response);
    }

    /**
     * @return void
     */
    public function run(): void
    {
        echo $this->router->resolve();
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    public function setController(Controller $controller): void
    {
        $this->controller = $controller;
    }
}

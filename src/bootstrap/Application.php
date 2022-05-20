<?php

namespace Thangphu\CarForRent\bootstrap;

use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Router;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\bootstrap\Controller;

class Application
{
    public Request $request;
    public Response $response;
    protected Router $route;
    public static string $ROOT_DIR;
    public static Application $application;

    public function __construct($rootPath)
    {
        self::$ROOT_DIR = $rootPath;
        self::$application = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->route = new Router($this->request, $this->response);
    }

    public function run()
    {
        echo Router::resolve();
    }
}

<?php

use Thangphu\CarForRent\Bootstrap\Request;
use Thangphu\CarForRent\Bootstrap\Response;
use Thangphu\CarForRent\Route\RouteManage;

require '../vendor/autoload.php';

use Thangphu\CarForRent\Bootstrap\Application;
use Thangphu\CarForRent\Database\DatabaseConnect;
use Thangphu\CarForRent\Service\ServiceProvider;

session_start();

RouteManage::run();
$app = new Application();
$request = new Request();
$responseView = new Response();
$provider = new ServiceProvider();
$app->run($request, $responseView, $provider);

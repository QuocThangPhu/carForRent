<?php

use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Route\routes;

error_reporting(E_ALL);
ini_set('display_errors', '1');
require '../vendor/autoload.php';

use Thangphu\CarForRent\bootstrap\Application;
use Thangphu\CarForRent\Database\DatabaseConnect;
use Thangphu\CarForRent\Service\ServiceProvider;

session_start();

routes::run();
$app = new Application();
$request = new Request();
$responseView = new Response();
$provider = new ServiceProvider();
$app->run($request, $responseView, $provider);

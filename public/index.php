<?php

require_once __DIR__.'/../vendor/autoload.php';
error_reporting(E_ALL);
ini_set('display_errors', '1');

use Thangphu\CarForRent\Controllers\AuthController;
use Thangphu\CarForRent\bootstrap\Application;
use Thangphu\CarForRent\Controllers\SiteController;
use Thangphu\CarForRent\Database\DatabaseConnect;

$application = new Application( dirname(__DIR__));
DatabaseConnect::getConnection();
$application->router->get('/',[new SiteController(), 'home']);
$application->router->get('/contact',[new SiteController(), 'contact']);
$application->router->post('/contact', [new SiteController(), 'handleContact']);

$application->router->get('/login', [new AuthController(), 'login']);
$application->router->post('/login', [new AuthController(), 'login']);
$application->router->get('/register', [new AuthController(), 'register']);
$application->router->post('/register', [new AuthController(), 'register']);

$application->run();

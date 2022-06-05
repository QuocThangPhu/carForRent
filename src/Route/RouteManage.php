<?php

namespace Thangphu\CarForRent\Route;

use Thangphu\CarForRent\bootstrap\Router;
use Thangphu\CarForRent\Controllers\LoginController;
use Thangphu\CarForRent\Controllers\API\AuthApiController;
use Thangphu\CarForRent\Controllers\CarController;
use Thangphu\CarForRent\Controllers\RegisterController;
use Thangphu\CarForRent\Controllers\SiteController;

class routeManage
{
    public static function run()
    {
        Router::get('/', [SiteController::class, 'home']);

        Router::get('/login', [LoginController::class, 'login']);
        Router::post('/login', [LoginController::class, 'login']);
        Router::get('/register', [RegisterController::class, 'register']);
        Router::post('/register', [RegisterController::class, 'register']);
        Router::post('/api/userCheck', [AuthApiController::class, 'userCheck']);
        Router::post('/api/loginCheck', [AuthApiController::class, 'loginCheck']);
        Router::post('/logout', [LoginController::class, 'logout']);

        Router::get('/createCar', [CarController::class, 'createCarView']);
        Router::post('/storeCar', [CarController::class, 'storeCar']);

        Router::get('/404', '_404');
    }
}

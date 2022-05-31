<?php

namespace Thangphu\CarForRent\Route;

use Thangphu\CarForRent\bootstrap\Router;
use Thangphu\CarForRent\Controllers\API\CarApiController;
use Thangphu\CarForRent\Controllers\AuthController;
use Thangphu\CarForRent\Controllers\API\AuthApiController;
use Thangphu\CarForRent\Controllers\CarController;
use Thangphu\CarForRent\Controllers\SiteController;

class routeManage
{
    public static function run()
    {
        Router::get('/', [SiteController::class, 'home']);

        Router::get('/login', [AuthController::class, 'login']);
        Router::post('/loginCheck', [AuthController::class, 'loginCheck']);
        Router::get('/createUser', [AuthController::class, 'createUser']);
        Router::post('/userCheck', [AuthController::class, 'userCheck']);
        Router::post('/api/userCheck', [AuthApiController::class, 'userCheck']);
        Router::post('/api/loginCheck', [AuthApiController::class, 'loginCheck']);
        Router::post('/logout', [AuthController::class, 'logout']);

        Router::get('/createCar', [CarController::class, 'createCarView']);
        Router::post('/storeCar', [CarController::class, 'storeCar']);
        Router::post('/api/storeCar', [CarApiController::class, 'storeCar']);

        Router::get('/404', '_404');
    }
}

<?php

namespace Thangphu\CarForRent\Route;

use Thangphu\CarForRent\bootstrap\Router;
use Thangphu\CarForRent\Controllers\API\RegisterApiController;
use Thangphu\CarForRent\Controllers\LoginController;
use Thangphu\CarForRent\Controllers\API\LoginApiController;
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
        Router::post('/api/register', [RegisterApiController::class, 'register']);
        Router::post('/api/login', [LoginApiController::class, 'login']);
        Router::post('/logout', [LoginController::class, 'logout']);

        Router::get('/createCar', [CarController::class, 'createNewCar']);
        Router::post('/createCar', [CarController::class, 'createNewCar']);

        Router::get('/404', '_404');
    }
}

<?php

namespace Thangphu\CarForRent\Route;

use Thangphu\CarForRent\bootstrap\Router;
use Thangphu\CarForRent\Controllers\AuthController;
use Thangphu\CarForRent\bootstrap\Application;
use Thangphu\CarForRent\Controllers\SiteController;

class routes
{
    public static function run()
    {
        Router::get('/', [SiteController::class, 'home']);

        Router::get('/login', [AuthController::class, 'login']);
        Router::post('/loginCheck', [AuthController::class, 'loginCheck']);
        Router::get('/register', [AuthController::class, 'registerForm']);
        Router::post('/register', [AuthController::class, 'register']);
        Router::post('/logout', [AuthController::class, 'logout']);

        Router::get('/404', '_404');
    }
}

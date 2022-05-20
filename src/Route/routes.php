<?php

namespace Thangphu\CarForRent\Route;

use Thangphu\CarForRent\bootstrap\Router;
use Thangphu\CarForRent\Controllers\AuthController;
use Thangphu\CarForRent\bootstrap\Application;
use Thangphu\CarForRent\Controllers\SiteController;

Router::get('/', [new SiteController(), 'home']);
Router::get('/contact', [new SiteController(), 'contact']);
Router::post('/contact', [new SiteController(), 'handleContact']);

Router::get('/login', [new AuthController(), 'login']);
Router::post('/loginCheck', [new AuthController(), 'loginCheck']);
Router::get('/register', [new AuthController(), 'registerForm']);
Router::post('/register', [new AuthController(), 'register']);
Router::get('/logout', [new AuthController(), 'logout']);

Router::get('/404', '_404');

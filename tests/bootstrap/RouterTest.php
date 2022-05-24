<?php

namespace Thangphu\Test\bootstrap;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\bootstrap\Router;
use Thangphu\CarForRent\Controllers\AuthController;

class RouterTest extends TestCase
{
    public function testGet()
    {
        Router::get('/login', [AuthController::class, 'index']);
        $routes = Router::$routes;
        $result = $routes['GET']['/login'];
        $expected = [AuthController::class, 'index'];
        $this->assertEquals($expected,$result);
    }

    public function testPost()
    {
        Router::post('/login', [AuthController::class, 'login']);
        $routes = Router::$routes;
        $result = $routes['POST']['/login'];
        $expected = [AuthController::class, 'login'];
        $this->assertEquals($expected,$result);
    }
}
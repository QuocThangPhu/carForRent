<?php

namespace Thangphu\Test\bootstrap;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\bootstrap\Router;
use Thangphu\CarForRent\Controllers\LoginController;

class RouterTest extends TestCase
{
    public function testGet()
    {
        Router::get('/login', [LoginController::class, 'index']);
        $routes = Router::$routes;
        $result = $routes['GET']['/login'];
        $expected = [LoginController::class, 'index'];
        $this->assertEquals($expected,$result);
    }

    public function testPost()
    {
        Router::post('/login', [LoginController::class, 'login']);
        $routes = Router::$routes;
        $result = $routes['POST']['/login'];
        $expected = [LoginController::class, 'login'];
        $this->assertEquals($expected,$result);
    }
}
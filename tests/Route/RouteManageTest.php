<?php

namespace Thangphu\Test\Route;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Router;
use Thangphu\CarForRent\Controllers\LoginController;
use Thangphu\CarForRent\Controllers\SiteController;
use Thangphu\CarForRent\Route\RouteManage;

class RouteManageTest extends TestCase
{

    /**
     * @dataProvider routesProvider
     * @return void
     */
    public function testRuns($param, $expected): void
    {
        RouteManage::run();
        $_SERVER['REQUEST_METHOD'] = $param['method'];
        $_SERVER['REQUEST_URI'] = $param['path'];
        $request = new Request();
        $path = $request->getPath();
        $method = $request->method();

        $response = Router::$routes[$method][$path] ?? false;
        $this->assertEquals($response, $expected);
    }

    public function routesProvider()
    {
        return [
            'route-1' => [
                'param' => [
                    'path' => '/',
                    'method' => 'GET'
                ],
                'expected' => [SiteController::class, 'home']
            ],
            'route-2' => [
                'param' => [
                    'path' => '/login',
                    'method' => 'GET'
                ],
                'expected' => [LoginController::class, 'login']
            ],
            'route-3' => [
                'param' => [
                    'path' => '/login',
                    'method' => 'POST'
                ],
                'expected' => [LoginController::class, 'login']
            ]
        ];
    }
}

<?php

namespace Thangphu\Test\bootstrap;


use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\bootstrap\Request;

class RequestTest extends TestCase
{
    /**
     * @dataProvider getPathProvider
     * @param $param
     * @param $expected
     * @return void
     */
    public function testGetPath($param, $expected)
    {
        $request = new Request();
        $_SERVER['REQUEST_URI'] = $param;
        $this->assertEquals($expected, $request->getPath());
    }

    /**
     * @dataProvider getMethodProvider
     * @param $param
     * @return void
     */
    public function testMethod($param)
    {
        $request = new Request();
        $_SERVER['REQUEST_METHOD'] = $param;
        $this->assertEquals($param, $request->method());
    }

    /**
     * @return void
     */
    public function testIsGet()
    {
        $request = new Request();
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $this->assertEquals(true, $request->isGet());
    }

    /**
     * @return void
     */
    public function testIsPOST()
    {
        $request = new Request();
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $this->assertEquals(true, $request->isPost());
    }

    public function getMethodProvider()
    {
        return [
            ['GET'],
            ['POST'],
            ['PATCH'],
            ['PUT']
        ];
    }

    public function getPathProvider()
    {
        return [
            'get-path-1' =>[
                'param' => '/login?user=1',
                'expected' => '/login'
            ],
            'get-path-2' =>[
                'param' => '/register',
                'expected' => '/register'
            ],
            'get-path-3' =>[
                'param' => '/home?user=1',
                'expected' => '/home'
            ]
        ];
    }
}
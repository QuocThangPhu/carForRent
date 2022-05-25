<?php

namespace Thangphu\Test\bootstrap;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\bootstrap\Response;

class ResponseTest extends TestCase
{
    /**
     * @dataProvider setStatusCodeProvider
     * @return void
     */
    public function testSetStatusCode($param)
    {
        $response = new Response();
        $response->setStatusCode($param);
        $this->assertEquals($param, $response->getStatusCode());
    }

    public function setStatusCodeProvider()
    {
        return [
            [Response::HTTP_OK],
            [Response::HTTP_NOT_FOUND],
            [Response::HTTP_INTERNAL_SERVER_ERROR],
            [Response::HTTP_UNAUTHORIZED],
        ];
    }

    public function testRenderView()
    {
        $result = new Response();
        $result->renderView('index', null);
        $this->assertEquals('index', $result->getTemplate());
        $this->assertEquals(null, $result->getData());
    }

    public function renderViewProvider()
    {
        return [
            'view-render-1' => [
                'param' => [
                    'template' => 'index',
                    'data' => ['']
                ]
            ]
        ];
    }
}

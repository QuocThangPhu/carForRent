<?php

namespace Thangphu\Test\bootstrap;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Model\UserModel;

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

    /**
     * @dataProvider renderViewProvider
     * @return void
     */
    public function testRenderView($param, $expected)
    {
        $result = new Response();
        $result->renderView($param['template'],$param['data']);
        $this->assertEquals($expected[0], $result->getTemplate());
        $this->assertEquals($expected[1], $result->getData());
    }

    public function testGetRedirectUrl()
    {
        $result = new Response();
        $result->setRedirectUrl('home-test');
        $this->assertEquals('home-test', $result->getRedirectUrl());
    }

    public function testGetUser()
    {
        $user = new UserModel();
        $result = new Response();
        $result->setUser($user);
        $this->assertEquals($user, $result->getUser());
    }

    public function testRedirect()
    {
        $result = new Response();
        $result->redirect('index');
        $expected = new Response();
        $expected->setRedirectUrl('index');
        $this->assertEquals($result, $expected);
    }

    public function renderViewProvider()
    {
        return [
            'view-render-1' => [
                'param' => [
                    'template' => 'index',
                    'data' => null
                ],
                'expected' => [
                    'index',
                    null
                ]
            ],
            'view-render-2' =>[
                'param' => [
                    'template' => 'home',
                    'data' => [
                        'username' => 'user1',
                        'password' => '12345678'
                        ]
                ],
                'expected' => [
                    'home',
                    [
                        'username' => 'user1',
                        'password' => '12345678'
                    ]
                ]
            ]
        ];
    }
}

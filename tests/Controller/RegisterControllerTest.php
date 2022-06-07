<?php

namespace Thangphu\Test\Controller;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Bootstrap\Request;
use Thangphu\CarForRent\Bootstrap\Response;
use Thangphu\CarForRent\Controllers\RegisterController;
use Thangphu\CarForRent\Request\RegisterRequest;
use Thangphu\CarForRent\Service\RegisterService;
use Thangphu\CarForRent\Validator\RegisterValidator;

class RegisterControllerTest extends TestCase
{
    public function testRegisterWithWrongMethod()
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $response = new Response();
        $registerRequest = new RegisterRequest();
        $registerValidator = new RegisterValidator();
        $registerService = $this->getMockBuilder(RegisterService::class)->disableOriginalConstructor()->getMock();
        $regiterController = new RegisterController($requestMock, $response, $registerRequest, $registerValidator, $registerService);
        $result = $regiterController->register();
        $this->assertEquals('register', $result->getTemplate());
    }

    public function testRegisterWithFasle()
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $requestMock->expects($this->once())->method('isPost')->willReturn(true);
        $requestMock->expects($this->once())->method('getBody')->willReturn([
            'username' => 'thang121',
            'password' => '12345678',
            'passwordConfirm' => '12345678',

        ]);
        $response = new Response();
        $registerRequest = new RegisterRequest();
        $registerValidator = new RegisterValidator();
        $registerService = $this->getMockBuilder(RegisterService::class)->disableOriginalConstructor()->getMock();
        $registerController = new RegisterController($requestMock, $response, $registerRequest, $registerValidator, $registerService);
        $result = $registerController->register();
        $this->assertEquals('register', $result->getTemplate());
    }

    public function testRegisterWithWrongValidator()
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $requestMock->expects($this->once())->method('isPost')->willReturn(true);
        $requestMock->expects($this->once())->method('getBody')->willReturn([
            'username' => '',
            'password' => '12345678',
            'passwordConfirm' => '12345678',

        ]);
        $response = new Response();
        $registerRequest = new RegisterRequest();
        $registerValidator = new RegisterValidator();
        $registerService = $this->getMockBuilder(RegisterService::class)->disableOriginalConstructor()->getMock();
        $registerController = new RegisterController($requestMock, $response, $registerRequest, $registerValidator, $registerService);
        $result = $registerController->register();
        $this->assertEquals('register', $result->getTemplate());
    }
}
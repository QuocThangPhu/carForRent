<?php

namespace Thangphu\Test\Controller;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Controllers\AuthController;
use Thangphu\CarForRent\Request\LoginRequest;
use Thangphu\CarForRent\Response\UserResponse;
use Thangphu\CarForRent\Service\LoginService;
use Thangphu\CarForRent\varlidator\LoginValidator;

class AuthControllerTest extends TestCase
{

    private $loginService;
    private $loginValidator;
    private $request;
    private $response;
    private $loginRequest;
    private UserResponse $userResponse;

    protected function setUp(): void
    {
        parent::setUp();
        $this->loginService = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $this->loginValidator = $this->getMockBuilder(LoginValidator::class)->getMock();
        $this->request = $this->getMockBuilder(Request::class)->getMock();
        $this->response = $this->getMockBuilder(Response::class)->getMock();
        $this->loginRequest = $this->getMockBuilder(LoginRequest::class)->getMock();
        $this->userResponse = $this->getMockBuilder(UserResponse::class)->getMock();
    }

    public function testLogin()
    {
        $response = new Response();
        $authController = new AuthController($this->loginService, $this->loginValidator, $this->request, $this->loginRequest, $response, $this->userResponse);
        $loginView = $authController->login()->getTemplate();
        $expected = new Response();
        $expected->setTemplate('login');
        $this->assertEquals($expected->getTemplate(),$loginView);
    }
}

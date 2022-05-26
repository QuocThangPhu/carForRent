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

    public function testLoginView()
    {
        $response = new Response();
        $authController = new AuthController($this->loginService, $this->loginValidator, $this->request, $this->loginRequest, $response, $this->userResponse);
        $loginView = $authController->login()->getTemplate();
        $expectedView = new Response();
        $expectedView->setTemplate('login');
        $this->assertEquals($expectedView->getTemplate(),$loginView);
    }

    /**
     *@runInSeparateProcess
     */
    public function testLogoutWithoutSuccess()
    {
        $request = new Request();
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $authController = new AuthController($this->loginService, $this->loginValidator, $request, $this->loginRequest, $this->response, $this->userResponse);
        $result = $authController->logout();
        $this->assertFalse($result);
    }

    /**
     * @runInSeparateProcess
     */
    public function testLogoutWithSuccess()
    {
        $request = new Request();
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SESSION['user_id'] = 1;
        $_SESSION['username'] = 'admin';
        $authController = new AuthController($this->loginService, $this->loginValidator, $request, $this->loginRequest, $this->response, $this->userResponse);
        $result = $authController->logout();
        $this->assertTrue($result);
        $this->assertFalse(isset($_SESSION['user_id']));
        $this->assertFalse(isset($_SESSION['username']));
    }
}

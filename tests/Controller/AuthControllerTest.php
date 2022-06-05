<?php

namespace Thangphu\Test\Controller;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Controllers\LoginController;
use Thangphu\CarForRent\Request\LoginRequest;
use Thangphu\CarForRent\Request\RegisterRequest;
use Thangphu\CarForRent\Response\UserResponse;
use Thangphu\CarForRent\Service\LoginService;
use Thangphu\CarForRent\Service\RegisterService;
use Thangphu\CarForRent\varlidator\LoginValidator;
use Thangphu\CarForRent\varlidator\RegisterValidator;

class AuthControllerTest extends TestCase
{

    private $loginService;
    private $loginValidator;
    private $request;
    private $response;
    private $loginRequest;
    private UserResponse $userResponse;
    private $registerRequest;
    private $registerValidator;
    private $registerService;

    /**
     * @return LoginController
     */
    public function getAuthController(): LoginController
    {
        $request = new Request();
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_SESSION['user_id'] = 1;
        $_SESSION['username'] = 'admin';
        $authController = new LoginController(
            $this->loginService,
            $this->loginValidator,
            $request,
            $this->loginRequest,
            $this->response,
            $this->userResponse,
            $this->registerRequest,
            $this->registerValidator,
            $this->registerService
        );
        return $authController;
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->loginService = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $this->loginValidator = $this->getMockBuilder(LoginValidator::class)->getMock();
        $this->request = $this->getMockBuilder(Request::class)->getMock();
        $this->response = $this->getMockBuilder(Response::class)->getMock();
        $this->loginRequest = $this->getMockBuilder(LoginRequest::class)->getMock();
        $this->userResponse = $this->getMockBuilder(UserResponse::class)->getMock();
        $this->registerRequest = $this->getMockBuilder(RegisterRequest::class)->getMock();
        $this->registerValidator = $this->getMockBuilder(RegisterValidator::class)->getMock();
        $this->registerService = $this->getMockBuilder(RegisterService::class)->disableOriginalConstructor()->getMock();
    }

    public function testLoginView()
    {
        $response = new Response();
        $authController = new LoginController(
            $this->loginService,
            $this->loginValidator,
            $this->request,
            $this->loginRequest,
            $response,
            $this->userResponse,
            $this->registerRequest,
            $this->registerValidator,
            $this->registerService
        );
        $loginView = $authController->login()->getTemplate();
        $expectedView = new Response();
        $expectedView->setTemplate('login');
        $this->assertEquals($expectedView->getTemplate(), $loginView);
    }

    /**
     * @runInSeparateProcess
     */
    public function testLogoutWithoutSuccess()
    {
        $request = new Request();
        $_SERVER['REQUEST_METHOD'] = 'GET';
        $authController = new LoginController(
            $this->loginService,
            $this->loginValidator,
            $request,
            $this->loginRequest,
            $this->response,
            $this->userResponse,
            $this->registerRequest,
            $this->registerValidator,
            $this->registerService
        );
        $result = $authController->logout();
        $this->assertFalse($result);
    }

    /**
     * @runInSeparateProcess
     */
    public function testLogoutWithSuccess()
    {
        $authController = $this->getAuthController();
        $result = $authController->logout();
        $this->assertTrue($result);
        $this->assertFalse(isset($_SESSION['user_id']));
        $this->assertFalse(isset($_SESSION['username']));
    }
}

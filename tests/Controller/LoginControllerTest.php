<?php

namespace Thangphu\Test\Controller;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Controllers\LoginController;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Request\LoginRequest;
use Thangphu\CarForRent\Service\LoginService;
use Thangphu\CarForRent\varlidator\LoginValidator;

class LoginControllerTest extends TestCase
{

    private $loginService;
    private $loginValidator;
    private $loginRequest;
    protected $request;
    protected $response;

    protected function setUp(): void
    {
        $this->loginService = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $this->loginValidator = $this->getMockBuilder(LoginValidator::class)->getMock();
        $this->loginRequest = $this->getMockBuilder(LoginRequest::class)->getMock();
        $this->request = $this->getMockBuilder(Request::class)->getMock();
        $this->response = $this->getMockBuilder(Response::class)->getMock();
    }

    /**
     * @runInSeparateProcess
     */
    public function testLogoutWithoutSuccess()
    {
        $loginController = new LoginController(
            $this->loginService,
            $this->loginValidator,
            $this->request,
            $this->response,
            $this->loginRequest
        );
        $result = $loginController->logout();
        $this->assertTrue($result);
    }


    public function createUser()
    {
        $user = new UserModel();
        $user->setId(1);
        $user->setUsername('thang');
        $user->setPassword('$2a$12$TG.0nLmE8i.KbC3JanS7/.ri0fZ/CO/qHQIs67WLHFnws98GLY0zK');
        $user->setRole('');
        return $user;
    }

    public function testLoginWithOutSuccess()
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $response = new Response();
        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $loginRequest = new LoginRequest();
        $loginValidator = new LoginValidator();
        $loginController = new LoginController($loginServiceMock, $loginValidator, $requestMock, $response,  $loginRequest);
        $login = $loginController->login();
        $this->assertEquals('login', $login->getTemplate());
    }

    public function testLoginWithSuccess()
    {
        $userReturn = new UserModel();
        $userReturn->setId(1);
        $userReturn->setUsername('thang');
        $userReturn->setPassword('$2a$12$TG.0nLmE8i.KbC3JanS7/.ri0fZ/CO/qHQIs67WLHFnws98GLY0zK');
        $userReturn->setRole('');
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $requestMock->expects($this->once())->method('isPost')->willReturn(true);
        $requestMock->expects($this->once())->method('getBody')->willReturn([
            'username' => 'thang',
            'password' => '$2a$12$TG.0nLmE8i.KbC3JanS7/.ri0fZ/CO/qHQIs67WLHFnws98GLY0zK'
        ]);
        $response = new Response();
        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $loginServiceMock->expects($this->once())->method('login')->willReturn($userReturn);
        $loginRequest = new LoginRequest();
        $loginValidator = new LoginValidator();
        $loginController = new LoginController($loginServiceMock, $loginValidator, $requestMock, $response,  $loginRequest);
        $login = $loginController->login();
        $expected = $response->redirect('/');
        $this->assertEquals($expected, $login);
    }

    public function testLoginWithWrongValidate()
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $requestMock->expects($this->once())->method('isPost')->willReturn(true);
        $requestMock->expects($this->once())->method('getBody')->willReturn([
            'username' => 'thang121',
            'password' => '$2a$12$TG.0n2mE8i.KbC3JanS7/.ri0fZ/CO/qHQIs67WLHFnws98GLY0zK'
        ]);
        $response = new Response();
        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $loginRequest = new LoginRequest();
        $loginValidator = new LoginValidator();
        $loginController = new LoginController($loginServiceMock, $loginValidator, $requestMock, $response,  $loginRequest);
        $login = $loginController->login();
        $this->assertEquals('login', $login->getTemplate());
        $this->assertIsArray($login->getData());
    }

    public function testLoginWithEmptyValidate()
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $requestMock->expects($this->once())->method('isPost')->willReturn(true);
        $requestMock->expects($this->once())->method('getBody')->willReturn([
            'username' => '',
            'password' => '$2a$12$TG.0n2mE8i.KbC3JanS7/.ri0fZ/CO/qHQIs67WLHFnws98GLY0zK'
        ]);
        $response = new Response();
        $loginServiceMock = $this->getMockBuilder(LoginService::class)->disableOriginalConstructor()->getMock();
        $loginRequest = new LoginRequest();
        $loginValidator = new LoginValidator();
        $loginController = new LoginController($loginServiceMock, $loginValidator, $requestMock, $response,  $loginRequest);
        $login = $loginController->login();
        $this->assertEquals('login', $login->getTemplate());
        $this->assertIsArray($login->getData());
    }
}

<?php

namespace Thangphu\Test\Controller;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\App\View;
use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\Controllers\AuthController;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Repository\UserRepository;
use Thangphu\CarForRent\Service\LoginService;
use Thangphu\CarForRent\Validation\LoginValidation;

class AuthControllerTest extends TestCase
{
    public function test__construct()
    {

    }

    public function testLogin()
    {
        $loginRequest = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()->getMock();
        $loginService = $this->getMockBuilder(LoginService::class)
            ->disableOriginalConstructor()->getMock();
        $userModel = $this->getMockBuilder(UserModel::class)
            ->disableOriginalConstructor()->getMock();
        $loginValidation = $this->getMockBuilder(LoginValidation::class)
            ->disableOriginalConstructor()->getMock();
        $loginViewTest = new AuthController($loginRequest,$loginService,$userModel,$loginValidation);
        $returnViewLogin = $loginViewTest->login();
        $expectedView = View::renderOnlyView('login', [
            'model' => $loginValidation
        ]);
        $this->assertEquals($returnViewLogin,$expectedView);
    }

}
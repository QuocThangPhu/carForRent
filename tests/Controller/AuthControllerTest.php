<?php

namespace Thangphu\Test\Controller;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\App\View;
use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\Controllers\AuthController;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Repository\UserRepository;
use Thangphu\CarForRent\Service\LoginService;
use Thangphu\CarForRent\Validation\InputLoginValidation;

class AuthControllerTest extends TestCase
{

    public function testLogin()
    {
        $requestMock = $this->getMockBuilder(Request::class)
            ->disableOriginalConstructor()->getMock();
        $loginService = $this->getMockBuilder(LoginService::class)
                ->disableOriginalConstructor()->getMock();
        $userMock = $this->getMockBuilder(UserModel::class)
            ->disableOriginalConstructor()->getMock();
        $loginValidation = $this->getMockBuilder(InputLoginValidation::class)
            ->disableOriginalConstructor()->getMock();

        $loginViewTest = new AuthController($requestMock,$loginService,$userMock,$loginValidation);
        $returnViewLogin = $loginViewTest->login();
        $this->assertFileEquals('/src/views/login.php',$returnViewLogin);
    }

}
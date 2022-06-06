<?php

namespace Thangphu\Test\Service;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Repository\UserRepository;
use Thangphu\CarForRent\Request\RegisterRequest;
use Thangphu\CarForRent\Service\RegisterService;

class RegisterServiceTest extends TestCase
{
    public function testCheckPassword()
    {
        $user = new UserModel();
        $userRepository = new UserRepository($user);
        $registerService = new RegisterService($userRepository);
        $result = $registerService->checkPassword('12345678', '12345678');
        $this->assertTrue($result);
    }

    /**
     * @dataProvider createUserWithWrongDataProvider
     */

    public function testCreateUserFalse($param)
    {
        $user = new UserModel();
        $userRepository = new UserRepository($user);
        $registerService = new RegisterService($userRepository);
        $registerRequest = new RegisterRequest();
        $registerRequest->fromArray($param);
        $result = $registerService->register($registerRequest);
        $this->assertNull($result);
    }


    public function createUserWithWrongDataProvider()
    {
        return [
            'login-request-1' => [
                'param' => [
                    'username' => 'admin',
                    'password' => '12345678',
                    'passwordConfirm' => '1234'
                ]
            ],
            'login-request-2' => [
                'param' => [
                    'username' => 'staff',
                    'password' => '12345678',
                    'passwordConfirm' => '1234'
                ]
            ]
        ];
    }
}

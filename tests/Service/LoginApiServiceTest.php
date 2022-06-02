<?php

namespace Thangphu\Test\Service;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Repository\UserRepository;
use Thangphu\CarForRent\Request\LoginRequest;
use Thangphu\CarForRent\Service\LoginAPIService;

class LoginApiServiceTest extends TestCase
{
    public function testCheckPassword()
    {
        $plainPassword = '12345678';
        $password = '$2a$12$O3Nt96tgUN5iAeF/jVPjEup4tFE468m3jzwFXjZ0Lj5a2d.CeA2WC';
        $userRepository = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $loginApiService = new LoginAPIService($userRepository);
        $expected = $loginApiService->checkPassword($plainPassword, $password);
        $this->assertTrue($expected);
    }

    /**
     * @dataProvider loginRequestApiTrueProvider
     * @param $param
     * @param $expected
     * @return void
     */
    public function testLoginApiWithSuccess($param, $expected)
    {
        $userModel = new UserModel();
        $userModel->setId($param['id']);
        $userModel->setUsername($param['username']);
        $userModel->setPassword($param['password']);
        $userRequest = new LoginRequest();
        $userRequest->fromArray($expected);
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findUserByUserName')->willReturn($userModel);
        $loginApiService = new LoginAPIService($userRepositoryMock);
        $dataExit = $loginApiService->login($userRequest);
        $this->assertEquals($_SESSION['user_id'],$dataExit->getId());
        $this->assertEquals($_SESSION['username'],$dataExit->getUsername());
        $this->assertEquals($userModel,$dataExit);
    }

    /**
     * @dataProvider loginRequestApiFalseProvider
     * @param $param
     * @param $expected
     * @return void
     */
    public function testLoginApiWithoutSuccess($param, $expected)
    {
        $userModel = new UserModel();
        $userModel->setId($param['id']);
        $userModel->setUsername($param['username']);
        $userModel->setPassword($param['password']);
        $userRequest = new LoginRequest();
        $userRequest->fromArray($expected);
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findUserByUserName')->willReturn($userModel);
        $loginApiService = new LoginAPIService($userRepositoryMock);
        $dataExit = $loginApiService->login($userRequest);
        $this->assertNull($dataExit);
    }
    public function loginRequestApiTrueProvider()
    {
        return [
            'login-request-1' => [
                'param' => [
                    'id' => 1,
                    'username' => 'admin',
                    'password' => '$2a$12$O3Nt96tgUN5iAeF/jVPjEup4tFE468m3jzwFXjZ0Lj5a2d.CeA2WC'
                ],
                'expected' => [
                    'username' => 'admin',
                    'password' => '12345678'
                ]
            ],
            'login-request-2' => [
                'param' => [
                    'id' => 2,
                    'username' => 'staff',
                    'password' => '$2a$12$fQPccecny2EtUiwFfGxjieFyjC9bAcYpYJAlXk/TFiOozvII6hoGO'
                ],
                'expected' => [
                    'username' => 'staff',
                    'password' => '123456789'
                ]
            ]
        ];
    }

    public function loginRequestApiFalseProvider()
    {
        return [
            'login-request-1' => [
                'param' => [
                    'id' => 1,
                    'username' => 'admin',
                    'password' => '$2a$12$O3Nt96tgUN5iAeF/jVPjEup4tFE468m3jzwFXjZ02j5a2d.CeA2WC'
                ],
                'expected' => [
                    'username' => 'admin',
                    'password' => '12345678'
                ]
            ],
            'login-request-2' => [
                'param' => [
                    'id' => 2,
                    'username' => 'staff',
                    'password' => '$2a$12$fQPccecny2EtUiwFfGxjieFyjC9bAcYpY1AlXk/TFiOozvII6hoGO'
                ],
                'expected' => [
                    'username' => 'staff',
                    'password' => '123456789'
                ]
            ]
        ];
    }
}

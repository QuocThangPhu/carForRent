<?php

namespace Thangphu\Test\Service;

use Dotenv\Exception\ValidationException;
use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Repository\UserRepository;
use Thangphu\CarForRent\Request\LoginRequest;
use Thangphu\CarForRent\Service\LoginService;

class LoginServiceTest extends TestCase
{
    /**
     * @dataProvider loginRequestTrueProvider
     */
    public function testLoginTrueService($param, $expected)
    {
        $user = new UserModel();
        $user->setId($param['id']);
        $user->setUsername($param['username']);
        $user->setPassword($param['password']);
        $userRequest = new LoginRequest();
        $userRequest->fromArray($expected);
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findUserByUserName')->willReturn($user);
        $loginService = new LoginService($userRepositoryMock);
        $result = $loginService->login($userRequest);
        $this->assertEquals($user,$result);
    }

    /**
     * @dataProvider loginRequestFalseProvider
     */
    public function testLoginFalseService($param, $expected)
    {
        $user = new UserModel();
        $user->setId($param['id']);
        $user->setUsername($param['username']);
        $user->setPassword($param['password']);
        $userRequest = new LoginRequest();
        $userRequest->fromArray($expected);
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findUserByUserName')->willReturn($user);
        $loginService = new LoginService($userRepositoryMock);
        $result = $loginService->login($userRequest);
        $this->assertNull($result);
    }

    public function loginRequestTrueProvider()
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

    public function loginRequestFalseProvider()
    {
        return [
            'login-request-1' => [
                'param' => [
                    'id' => 1,
                    'username' => 'admin',
                    'password' => '$2a$12$O3Nt962gUN5iAeF/jVPjEup4tFE468m3jzwFXjZ0Lj5a2d.CeA2WC'
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
                    'password' => '$2a$12$fQ1ccecny2EtUiwFfGxjieFyjC9bAcYpYJAlXk/TFiOozvII6hoGO'
                ],
                'expected' => [
                    'username' => 'staff',
                    'password' => '123456789'
                ]
            ]
        ];
    }

    /**
     * @dataProvider checkPasswordTrueProvider
     * @param $param
     * @return void
     */
    public function testCheckTruePassword($param)
    {
        $userRepositoryMock =$this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $checkPass = new LoginService($userRepositoryMock);
        $result = $checkPass->checkPassword($param['plainPassword'], $param['password']);
        $this->assertTrue($result);
    }

    /**
     * @dataProvider checkPasswordFalseProvider
     * @param $param
     * @return void
     */
    public function testCheckFalsePassword($param)
    {
        $userRepositoryMock =$this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $checkPass = new LoginService($userRepositoryMock);
        $result = $checkPass->checkPassword($param['plainPassword'], $param['password']);
        $this->assertFalse($result);
    }

    public function checkPasswordFalseProvider()
    {
        return [
            'check-password-1'  => [
                'param' => [
                    'plainPassword' => '12345678',
                    'password' => '$2a$12$O3N196tgUN5iAeF/jVPjEup4tFE468m3jzwFXjZ0Lj5a2d.CeA2WC'
                ],
            ],
            'check-password-2' => [
                'param' => [
                    'plainPassword' => '123456789',
                    'password' => '$2a$12$fQP1cecny2EtUiwFfGxjieFyjC9bAcYpYJAlXk/TFiOozvII6hoGO'
                ],
            ]
        ];
    }

    public function checkPasswordTrueProvider()
    {
        return [
          'check-password-1'  => [
              'param' => [
                  'plainPassword' => '12345678',
                  'password' => '$2a$12$O3Nt96tgUN5iAeF/jVPjEup4tFE468m3jzwFXjZ0Lj5a2d.CeA2WC'
              ],
          ],
          'check-password-2' => [
              'param' => [
                  'plainPassword' => '123456789',
                  'password' => '$2a$12$fQPccecny2EtUiwFfGxjieFyjC9bAcYpYJAlXk/TFiOozvII6hoGO'
              ],
          ]
        ];
    }
}
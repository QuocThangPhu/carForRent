<?php

namespace Thangphu\Test\Service;

use Dotenv\Exception\ValidationException;
use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Repository\UserRepository;
use Thangphu\CarForRent\Service\LoginService;

class LoginServiceTest extends TestCase
{
    /**
     * @dataProvider loginSuccessProvider
     * @param array $params
     * @param array $expected
     * @return void
     */
    public function testLoginSuccess(array $params, array $expected){
        $userModel = $this->getUser($params['id'], $params['username'], $params['password']);
        $userFromRepository = $expected['user'];

        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)
            ->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findUserByName')
            ->willReturn($userFromRepository);
    }

    /**
     * @dataProvider loginSuccessProvider
     * @param array $params
     * @return void
     */
    public function testLoginWithoutExitUser(array $params)
    {
        $userModel = $this->getUser($params['id'], $params['username'], $params['password']);
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)
            ->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findUserByName')
            ->willReturn(null);
        $loginService = new LoginService($userRepositoryMock);
        $this->expectException(ValidationException::class);
        $loginService->login($userModel);
    }

    /**
     * @dataProvider loginWithWrongPaswordProvider
     * @param array $params
     * @param array $expected
     * @return void
     */
    public function testLoginWithWrongPassword(array $params, array $expected)
    {
        $userModel = $this->getUser($params['id'], $params['username'], $params['password']);
        $userFromRepository = $expected['user'];
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)
            ->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findUserByName')
            ->willReturn($userFromRepository);
        $loginService = new LoginService($userRepositoryMock);
        $this->expectException(ValidationException::class);
        $loginService->login($userModel);
    }

    public function loginSuccessProvider()
    {
        return [
          'happy-case-1'=>[
              'params' => [
                  'id' => 1,
                  'username' => 'admin',
                  'password' => '12345678',
                  'userReturn' => $this->getUser(1,'admin',$this->hashPassword('12345678')),
              ],
              'expected' => [
                  'user' => $this->getUser(1,'admin',$this->hashPassword('12345678'))
              ]
          ]
        ];
    }
    public function loginWithWrongPaswordProvider()
    {
        return [
            'happy-case-1'=>[
                'params' => [
                    'id' => 1,
                    'username' => 'admin',
                    'password' => '1234567',
                    'userReturn' => $this->getUser(1,'admin',$this->hashPassword('12345678')),
                ],
                'expected' => [
                    'user' => $this->getUser(1,'admin',$this->hashPassword('12345678'))
                ]
            ]
        ];
    }
    private function hashPassword(string $password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
    private function getUser(int $id, string $username, string $password)
    {
        $user = new UserModel();
        $user->setId($id);
        $user->setUsername($username);
        $user->setPassword($password);
        return $user;
    }
}
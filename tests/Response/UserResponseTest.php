<?php

namespace Thangphu\Test\Response;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Response\UserResponse;

class UserResponseTest extends TestCase
{
    /**
     * @dataProvider userResponseProvider
     * @return void
     */
    public function testUserResponse($param, $expected)
    {
        $response = new UserResponse();
        $user = new UserModel();
        $user->setId($param['id']);
        $user->setUsername($param['username']);
        $user->setPassword($param['password']);
        $result = $response->userResponse($user);
        $this->assertEquals($expected, $result);
    }

    public function userResponseProvider()
    {
        return [
          'user-response-1' => [
              'param' =>[
                  'id' => 1,
                  'username' => 'admin',
                  'password' => '12345678'
              ],
              'expected' => [
                  'id' => 1,
                  'username' => 'admin'
              ]
          ]
        ];
    }
}
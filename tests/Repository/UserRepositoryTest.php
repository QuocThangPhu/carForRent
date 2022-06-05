<?php

namespace Thangphu\Test\Repository;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Database\DatabaseConnect;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Repository\UserRepository;

class UserRepositoryTest extends TestCase
{
    public function testFindUserByUserNameWithSuccess()
    {
        $user = new UserModel();
        $userRepository = new UserRepository($user);
        $userResult = $userRepository->findUserByUserName('thang');
        $userExpected = new UserModel();
        $userExpected->setId(3);
        $userExpected->setUsername('thang');
        $userExpected->setPassword('$2a$12$lTQrfYTTE67g68CsoCN2/OFlGXfQ8iFmbhXZ363/SQsslfbXN58xS');
        $this->assertEquals($userExpected,$userResult);
    }

    public function testFindUserByUserNameWithFalse()
    {
        $user = new UserModel();
        $userRepository = new UserRepository($user);
        $userResult = $userRepository->findUserByUserName('adminname');
        $this->assertNull($userResult);
    }
}
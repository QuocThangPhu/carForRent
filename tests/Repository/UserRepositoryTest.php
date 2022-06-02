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
        $userExpected->setId(1);
        $userExpected->setUsername('thang');
        $userExpected->setPassword('$2a$12$TG.0nLmE8i.KbC3JanS7/.ri0fZ/CO/qHQIs67WLHFnws98GLY0zK');
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
<?php

namespace Thangphu\Test\Repository;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Repository\UserRepository;

class UserRepositoryTest extends TestCase
{
    public function testFindUserByUserNameWithSuccess()
    {
        $userRepository = new UserRepository();
        $userResult = $userRepository->findUserByUserName('thang');
        $userExpected = new UserModel();
        $userExpected->setId(1);
        $userExpected->setUsername('thang');
        $userExpected->setPassword('$2a$12$TG.0nLmE8i.KbC3JanS7/.ri0fZ/CO/qHQIs67WLHFnws98GLY0zK');
        $this->assertEquals($userExpected,$userResult);
    }

    public function testFindUserByUserNameWithFalse()
    {
        $userRepository = new UserRepository();
        $userResult = $userRepository->findUserByUserName('adminname');
        $this->assertNull($userResult);
    }

    public function testFindUserByIdWithSuccess()
    {
        $userRepository = new UserRepository();
        $userResult = $userRepository->findUserById('1');
        $userExpected = new UserModel();
        $userExpected->setId(1);
        $userExpected->setUsername('thang');
        $userExpected->setPassword('$2a$12$TG.0nLmE8i.KbC3JanS7/.ri0fZ/CO/qHQIs67WLHFnws98GLY0zK');
        $userExpected->setRole('');
        $this->assertEquals($userExpected,$userResult);
    }

    public function testFindUserByIdWithFalse()
    {
        $userRepository = new UserRepository();
        $userResult = $userRepository->findUserById('0');
        $this->assertNull($userResult);
    }

    public function testFindUserNameWithSuccess()
    {
        $userRepository = new UserRepository();
        $userResult = $userRepository->findUserName('thang');
        $this->assertTrue($userResult);
    }

    public function testFindUserNameWithFasle()
    {
        $userRepository = new UserRepository();
        $userResult = $userRepository->findUserName('!@thang');
        $this->assertFalse($userResult);
    }
}

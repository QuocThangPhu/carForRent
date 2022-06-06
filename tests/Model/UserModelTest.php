<?php

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Model\UserModel;

class UserModelTest extends TestCase
{
    public function testGetRole()
    {
        $user = new UserModel();
        $user->setRole('admin');
        $this->assertEquals('admin', $user->getRole());
    }
}

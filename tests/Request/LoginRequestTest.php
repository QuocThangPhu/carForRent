<?php

namespace Thangphu\Test\Request;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Request\LoginRequest;

class LoginRequestTest extends TestCase
{
    public function testGetUsername()
    {
        $result = new LoginRequest();
        $result->setUsername('admin');
        $expected = 'admin';
        $this->assertEquals($expected, $result->getUsername());
    }
    public function testGetPassword()
    {
        $result = new LoginRequest();
        $result->setPassword('$2a$12$lTQrfYTTE67g68CsoCN2/OFlGXfQ8iFmbhXZ363/SQsslfbXN58xS');
        $expected = '$2a$12$lTQrfYTTE67g68CsoCN2/OFlGXfQ8iFmbhXZ363/SQsslfbXN58xS';
        $this->assertEquals($expected, $result->getPassword());
    }

    /**
     * @return void
     */
    public function testFromArray()
    {
        $user = new LoginRequest();
        $user->fromArray(['username' => 'admin',
            'password' => '$2a$12$lTQrfYTTE67g68CsoCN2/OFlGXfQ8iFmbhXZ363/SQsslfbXN58xS']
        );
        $this->assertEquals('admin', $user->getUsername());
        $this->assertEquals('$2a$12$lTQrfYTTE67g68CsoCN2/OFlGXfQ8iFmbhXZ363/SQsslfbXN58xS', $user->getPassword());
    }
}

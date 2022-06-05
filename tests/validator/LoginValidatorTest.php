<?php

namespace Thangphu\Test\validator;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Exception\ValidateException;
use Thangphu\CarForRent\Request\LoginRequest;
use Thangphu\CarForRent\varlidator\LoginValidator;

class LoginValidatorTest extends TestCase
{
    /**
     * @dataProvider loginValidatorProvider
     * @return void
     */
    public function testLoginValidatorReturnTrue($param)
    {
        $loginRequest = new LoginRequest();
        $loginRequest->fromArray($param);
        $loginValid = new LoginValidator();
        $result = $loginValid->validateUserLogin($loginRequest);
        $this->assertEquals(true, $result);
    }

    /**
     * @dataProvider loginValidatorFalseProvider
     */
    public function testLoginValidatorWithReturnFalse($param)
    {
        $loginRequest = new LoginRequest();
        $loginRe = $loginRequest->fromArray($param);
        $loginValid = new LoginValidator();
        $this->expectException(ValidateException::class);
        $loginValid->validateUserLogin($loginRe);
    }

    public function loginValidatorProvider()
    {
        return [
            'user-response-1' => [
                'param' =>[
                    'id' => 1,
                    'username' => 'admin',
                    'password' => '12345678'
                ],
            ]
        ];
    }
    public function loginValidatorFalseProvider()
    {
        return [
            'user-response-1' => [
                'param' =>[
                    'id' => 1,
                    'username' => 'admin',
                    'password' => ''
                ],
            ],
            'user-response-2' => [
                'param' =>[
                    'id' => 1,
                    'username' => '',
                    'password' => '2234234'
                ],
            ]
        ];
    }
}

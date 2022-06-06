<?php

namespace Thangphu\Test\validator;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Request\RegisterRequest;
use Thangphu\CarForRent\varlidator\RegisterValidator;

class RegisterValidatorTest extends TestCase
{
    /**
     * @dataProvider RegisterValidatorProvider
     */
    public function testRegisterValidator($param)
    {
        $registerRequest = new RegisterRequest();
        $registerRequest->fromArray($param);
        $registerValidator = new RegisterValidator();
        $result = $registerValidator->validateUser($registerRequest);
        $this->assertTrue($result);
    }

    /**
     * @dataProvider RegisterValidatorFalseProvider
     */
    public function testRegisterValidatorWithFalse($param)
    {
        $registerRequest = new RegisterRequest();
        $registerRequest->fromArray($param);
        $registerValidator = new RegisterValidator();
        $result = $registerValidator->validateUser($registerRequest);
        $this->assertIsArray($result);
    }

    public function RegisterValidatorProvider()
    {
        return [
            'user-response-1' => [
                'param' =>[
                    'username' => 'FordAvG',
                    'password' => '123456',
                    'passwordConfirm' => '123456'
                ],
            ]
        ];
    }

    public function RegisterValidatorFalseProvider()
    {
        return [
            'user-response-1' => [
                'param' =>[
                    'username' => 'Fo',
                    'password' => '12',
                    'passwordConfirm' => '123456'
                ],
            ]
        ];
    }
}
<?php

namespace Thangphu\CarForRent\Validation;

use Thangphu\CarForRent\bootstrap\Validation;

class RegisterValidation extends Validation
{
    public string $username;
    public string $password;
    public string $confirmPassword;

    public function rules(): array
    {
        return [
            'username' => [self::RULE_REQUIRED],
            'password' => [
                [self::RULE_REQUIRED],
                [self::RULE_MIN, 'min' => 8],
                [self::RULE_MAX, 'max' => 30]
            ],
            'confirmPassword' => [
                [self::RULE_REQUIRED],
                [self::RULE_MATCH, 'match' => 'password']
            ],
        ];
    }
}

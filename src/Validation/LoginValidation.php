<?php

namespace Thangphu\CarForRent\Validation;

use Thangphu\CarForRent\bootstrap\Validation;

class LoginValidation extends Validation
{
    public string $username;
    public string $password;

    public function rules(): array
    {
        return [
            'username' => [self::RULE_REQUIRED],
            'password' => [self::RULE_REQUIRED],
        ];
    }
}

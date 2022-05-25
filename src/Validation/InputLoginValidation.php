<?php

namespace Thangphu\CarForRent\Validation;

use Thangphu\CarForRent\bootstrap\Validation;

class InputLoginValidation extends Validation
{
    public string $username;
    public string $password;

    public function rules(): array
    {
        return [
            'username' => [self::RULE_NOT_FOUND],
            'password' => [self::RULE_REQUIRED],
        ];
    }
}

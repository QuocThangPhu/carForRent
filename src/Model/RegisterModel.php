<?php

namespace Thangphu\CarForRent\Model;

use Thangphu\CarForRent\bootstrap\Model;

class RegisterModel extends Model
{
    public string $username;
    public string $password;
    public string $confirmPassword;

    public function register()
    {
        return "Creating new user";
    }

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

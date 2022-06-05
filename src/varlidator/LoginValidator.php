<?php

namespace Thangphu\CarForRent\varlidator;

use Dotenv\Exception\ValidationException;
use Thangphu\CarForRent\Exception\ValidateException;
use Thangphu\CarForRent\Request\LoginRequest;

class LoginValidator
{
    public function validateUserLogin(LoginRequest $user)
    {
        if (empty($user->getUsername()) || empty($user->getPassword())) {
            throw new ValidateException("Username or password can't be empty");
        }
        return true;
    }
}

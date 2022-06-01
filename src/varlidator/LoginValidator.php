<?php

namespace Thangphu\CarForRent\varlidator;

use Thangphu\CarForRent\Exception\ValidateException;
use Thangphu\CarForRent\Request\LoginRequest;

class LoginValidator
{
    public function validateUserLogin(LoginRequest $user)
    {
        $pattern = '/^[a-z\d]$/';
        if (empty($user->getUsername()) || empty($user->getPassword())) {
            throw new ValidateException("Username or password can't be empty");
        }
        if(strlen($user->getUsername()) > 30 ){
            throw new ValidateException("Username is not more than 30 characters");
        }
        if(!preg_match($pattern, $user->getUsername())){
            throw new ValidateException("Username is wrong type");
        }
        return true;
    }
}

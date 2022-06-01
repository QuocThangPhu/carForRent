<?php

namespace Thangphu\CarForRent\varlidator;

use Thangphu\CarForRent\Exception\ValidateException;
use Thangphu\CarForRent\Request\RegisterRequest;

class RegisterValidator
{
    public function validateUser(RegisterRequest $user)
    {
        if (empty($user->getUsername()) || empty($user->getPassword()) || empty($user->getPasswordConfirm())) {
            throw new ValidateException("The filed can't be empty");
        }
        if(strlen($user->getUsername()) > 30 ){
            throw new ValidateException("Username is not more than 30 characters");
        }
        return true;
    }
}
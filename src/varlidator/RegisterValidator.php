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
        return true;
    }
}
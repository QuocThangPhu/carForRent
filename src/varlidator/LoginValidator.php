<?php

namespace Thangphu\CarForRent\varlidator;

use Thangphu\CarForRent\Exception\ValidateException;
use Thangphu\CarForRent\Request\LoginRequest;

class LoginValidator
{
    public function validateUserLogin(LoginRequest $user)
    {
        if (empty($user->getUsername()) || empty($user->getPassword())) {
            return ["error"=>true, "message"=>"Username or password cannot be empty"];
        }
        if (strlen($user->getUsername()) > 30) {
            return ["error"=>true, "message"=>"Username cann't more than 30 character"];
        }
        return [];
    }
}

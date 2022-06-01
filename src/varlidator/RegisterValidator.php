<?php

namespace Thangphu\CarForRent\varlidator;

use Thangphu\CarForRent\Exception\ValidateException;
use Thangphu\CarForRent\Request\RegisterRequest;

class RegisterValidator
{
    public function validateUser(RegisterRequest $user)
    {
        $validator = new Validator();
        $validator->name('username')->value($user->getUsername())->pattern('alphanum')->min(3)->max(50)->required();
        $validator->name('password')->value($user->getPassword())->min(3)->max(255)->required();
        $validator->name('confirmPassword')->value($user->getPasswordConfirm())->equal($user->getPassword())->min(3)->max(255)->required();
        if($validator->isSuccess()){
            return true;
        }else{
            return $validator->getErrors();
        }
    }
}
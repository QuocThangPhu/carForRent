<?php

namespace Thangphu\CarForRent\Service;

use Thangphu\CarForRent\Repository\UserRepository;
use Thangphu\CarForRent\Request\RegisterRequest;

class RegisterService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(RegisterRequest $user)
    {
        $existUser = $this->userRepository->findUserName($user->getUsername());
        if ($existUser == true && $this->checkPassword($user->getPassword(), $user->getPasswordConfirm())) {
            $newUser = $this->userRepository->createUser($user);
            $_SESSION['user_id'] = $newUser->getId();
            $_SESSION['username'] = $newUser->getUsername();
            return true;
        }

        return false;
    }

    public function checkPassword($password, $passwordConfirm)
    {
        return $password == $passwordConfirm ? true: false;
    }
}

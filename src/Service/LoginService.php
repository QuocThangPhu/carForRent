<?php

namespace Thangphu\CarForRent\Service;

use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Repository\UserRepository;
use Thangphu\CarForRent\Request\LoginRequest;

class LoginService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param LoginRequest $userInput
     */
    public function login(LoginRequest $userInput)
    {
        $existUser = $this->userRepository->findUserByUserName($userInput->getUsername());
        if ($existUser && $this->checkPassword($userInput->getPassword(), $existUser->getPassword())) {
            return $existUser;
        }

        return null;
    }

    public function checkPassword($plainPassword, $password)
    {
        return password_verify($plainPassword, $password);
    }
}

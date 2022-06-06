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
     * @param UserModel $userInput
     */
    public function login(LoginRequest $userInput)
    {
        $existUser = $this->userRepository->findUserByUserName($userInput->getUsername());
        if ($existUser && $this->checkPassword($userInput->getPassword(), $existUser->getPassword())) {
            $_SESSION['user_id'] = $existUser->getId();
            $_SESSION['username'] = $existUser->getUsername();
            return $existUser;
        }

        return null;
    }

    public function checkPassword($plainPassword, $password)
    {
        return password_verify($plainPassword, $password);
    }
}

<?php

namespace Thangphu\CarForRent\Service;

use Dotenv\Exception\ValidationException;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\bootstrap\Validation;
use Thangphu\CarForRent\Database\DatabaseConnect;
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
     * @return bool
     */
    public function login(LoginRequest $userInput)
    {
        $existUser = $this->userRepository->findUserByName($userInput->getUsername());
        if($existUser && password_verify($userInput->getPassword(),$existUser->getPassword())) {
            $_SESSION['user_id'] = $existUser->getId();
            $_SESSION['username'] = $existUser->getUsername();
            return true;
        }

        return false;
    }
}

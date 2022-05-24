<?php

namespace Thangphu\CarForRent\Service;

use Dotenv\Exception\ValidationException;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Database\DatabaseConnect;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Repository\UserRepository;

class LoginService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;

    }

    public function login(UserModel $userInput): UserModel
    {
        $response = new Response();
        $response->setUser($userInput->getUsername());
        $existUser = $this->userRepository->findUserByName($userInput->getUsername());
        $errorMessage = [];
        if ($existUser == null) {
            throw new ValidationException("Your account does not exist");
        } else {
            if (password_verify($userInput->getPassword(), $existUser->getPassword())) {
                $response->setUser($existUser);
                array_push($errorMessage, "Login Success");
                return $existUser;
            } else {
                throw new ValidationException("Username or Password is wrong");
            }
        }

    }
}

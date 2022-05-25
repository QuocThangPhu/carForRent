<?php

namespace Thangphu\CarForRent\Service;

use Dotenv\Exception\ValidationException;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\bootstrap\Validation;
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

    /**
     * @param UserModel $userInput
     * @return array|bool
     */
    public function login(UserModel $userInput)
    {
        $response = new Response();
        $response->setUser($userInput);
        $existUser = $this->userRepository->findUserByName($userInput->getUsername());
        if(!$existUser)
        {
            return ['username' => Validation::RULE_NOT_FOUND];
        }
        if(!password_verify($userInput->getPassword(),$existUser->getPassword()))
        {
            return ['password' => Validation::RULE_INCORRECT];
        }
        return [
            'id' => $existUser->getId(),
            'username'=> $existUser->getUsername()
        ];
    }
}

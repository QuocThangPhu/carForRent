<?php

namespace Thangphu\CarForRent\Service;

use Dotenv\Exception\ValidationException;
use Thangphu\CarForRent\App\View;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Database\DatabaseConnect;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Repository\UserRepository;
use Thangphu\CarForRent\Request\LoginRequest;

class LoginService
{
    protected UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository(DatabaseConnect::getConnection());
    }

    public function login(UserModel $userInput)
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
                $response->setMessage($errorMessage);
                return $response;
            } else {
                throw new ValidationException("Username or Password is wrong");
            }
        }
    }

    private function validationLogin($request)
    {
        if(empty($request->username) || empty($request->password))
        {
            echo "Username or password cann't be empty";
        }
    }
}

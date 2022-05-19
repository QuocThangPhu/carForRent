<?php

namespace Thangphu\CarForRent\Service;

use Dotenv\Exception\ValidationException;
use Thangphu\CarForRent\App\View;
use Thangphu\CarForRent\Database\DatabaseConnect;
use Thangphu\CarForRent\Repository\UserRepository;
use Thangphu\CarForRent\Request\LoginRequest;

class LoginService
{
    protected UserRepository $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository(DatabaseConnect::getConnection());
    }

    public function login(LoginRequest $loginRequest)
    {
        $user = $this->userRepository->findUserByName($loginRequest->getUsername());
        if ($user == null) {
            throw new ValidationException("Your account does not exist");
        }
        if (!password_verify($loginRequest->getPassword(), $user->getPassword())) {
            throw new ValidationException("Your password is wrong");
        }
        SessionService::setUserId($user->getId());
        View::redirect('/');
    }
}

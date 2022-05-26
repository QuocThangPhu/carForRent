<?php

namespace Thangphu\CarForRent\Controllers;

use Thangphu\CarForRent\App\View;
use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Request\LoginRequest;
use Thangphu\CarForRent\Response\UserResponse;
use Thangphu\CarForRent\Service\LoginService;
use Thangphu\CarForRent\varlidator\LoginValidator;

class AuthController
{
    private $loginService;
    private $loginValidator;
    private $request;
    private $response;
    private $loginRequest;
    private UserResponse $userResponse;

    public function __construct(
        LoginService $loginService,
        LoginValidator $loginValidator,
        Request $request,
        LoginRequest $loginRequest,
        Response $response,
        UserResponse $userResponse
    ) {
        $this->loginService = $loginService;
        $this->loginValidator = $loginValidator;
        $this->request = $request;
        $this->loginRequest = $loginRequest;
        $this->response = $response;
        $this->userResponse = $userResponse;
    }


    public function login()
    {
        return $this->response->renderView('login');
    }

    public function loginCheck()
    {
        // handle request
        try {
            $errorMessage = '';
            if ($this->request->isPost()) {
                $this->loginRequest->fromArray($this->request->getBody());
                // validation
                $this->loginValidator->validateUserLogin($this->loginRequest);
                // logic
                $isLoginSuccess = $this->loginService->login($this->loginRequest);
                if ($isLoginSuccess) {
                    return $this->response->renderView('home');
                }
                $errorMessage = 'Username or password is invalid!';
            }
        } catch (\Exception $exception) {
            $exception->getMessage();
            $errorMessage = 'Something is error';
        }
        //return view
        return $this->response->renderView('login', [
            'username' => $this->loginRequest->getUsername(),
            'password' => $this->loginRequest->getPassword(),
            'errors' => $errorMessage
        ]);
    }

    public function logout()
    {
        if (!$this->request->isPost()) {
            View::redirect('/');
        }
        unset($_SESSION["user_id"], $_SESSION["username"]);
        View::redirect('/');
    }
}

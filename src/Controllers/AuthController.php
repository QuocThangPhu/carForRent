<?php

namespace Thangphu\CarForRent\Controllers;

use Thangphu\CarForRent\App\View;
use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Request\LoginRequest;
use Thangphu\CarForRent\Request\RegisterRequest;
use Thangphu\CarForRent\Response\UserResponse;
use Thangphu\CarForRent\Service\LoginService;
use Thangphu\CarForRent\Service\RegisterService;
use Thangphu\CarForRent\varlidator\LoginValidator;
use Thangphu\CarForRent\varlidator\RegisterValidator;

class AuthController
{
    private $loginService;
    private $loginValidator;
    private $request;
    private $response;
    private $loginRequest;
    private UserResponse $userResponse;
    private $registerRequest;
    private $registerValidator;
    private $registerService;

    public function __construct(
        LoginService $loginService,
        LoginValidator $loginValidator,
        Request $request,
        LoginRequest $loginRequest,
        Response $response,
        UserResponse $userResponse,
        RegisterRequest $registerRequest,
        RegisterValidator $registerValidator,
        RegisterService $registerService
    ) {
        $this->loginService = $loginService;
        $this->loginValidator = $loginValidator;
        $this->request = $request;
        $this->loginRequest = $loginRequest;
        $this->response = $response;
        $this->userResponse = $userResponse;
        $this->registerRequest = $registerRequest;
        $this->registerValidator = $registerValidator;
        $this->registerService = $registerService;
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
                    return $this->response->redirect('/');
                }
                $errorMessage = 'Username or password is invalid!';
            }
        } catch (\Exception $exception) {
            $errorMessage = $exception->getMessage();
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
            return false;
        }
        unset($_SESSION["user_id"], $_SESSION["username"]);
        View::redirect('/');
        return true;
    }

    public function createUser()
    {
        return $this->response->renderView('register');
    }

    public function userCheck()
    {
        $errorMessage = '';
        try {
            if ($this->request->isPost()) {
                $this->registerRequest->fromArray($this->request->getBody());
                $this->registerValidator->validateUser($this->registerRequest);
                $isSuccess = $this->registerService->register($this->registerRequest);
                if($isSuccess){
                    return $this->response->redirect('/');
                }
                $errorMessage = 'Somethings is wrong';
            }
        } catch (\Exception $exception) {
            $errorMessage = $exception->getMessage();
        }
        //return view
        return $this->response->renderView('register', [
            'errors' => $errorMessage
        ]);
    }
}

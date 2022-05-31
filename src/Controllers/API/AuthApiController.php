<?php

namespace Thangphu\CarForRent\Controllers\API;

use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Request\LoginRequest;
use Thangphu\CarForRent\Request\RegisterRequest;
use Thangphu\CarForRent\Response\UserResponse;
use Thangphu\CarForRent\Service\LoginAPIService;
use Thangphu\CarForRent\Service\RegisterAPIService;
use Thangphu\CarForRent\Service\RegisterService;
use Thangphu\CarForRent\Service\TokenService;
use Thangphu\CarForRent\varlidator\LoginValidator;
use Thangphu\CarForRent\varlidator\RegisterValidator;

class AuthApiController
{
    protected Request $request;
    protected Response $response;
    protected LoginAPIService $loginApiService;
    protected UserResponse $userResponse;
    protected LoginRequest $loginRequest;
    protected LoginValidator $loginValidator;
    protected TokenService $tokenService;
    protected RegisterRequest $registerRequest;
    protected RegisterValidator $registerValidator;
    protected RegisterAPIService $registerApiService;

    public function __construct(
        Request $request,
        Response $response,
        LoginAPIService $loginApiService,
        UserResponse $userResponse,
        LoginRequest $loginRequest,
        LoginValidator $loginValidator,
        TokenService $tokenService,
        RegisterRequest $registerRequest,
        RegisterValidator $registerValidator,
        RegisterAPIService $registerApiService
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->loginApiService = $loginApiService;
        $this->userResponse = $userResponse;
        $this->loginRequest = $loginRequest;
        $this->loginValidator = $loginValidator;
        $this->tokenService = $tokenService;
        $this->registerRequest = $registerRequest;
        $this->registerValidator = $registerValidator;
        $this->registerApiService = $registerApiService;
    }

    public function loginCheck()
    {
        // handle request
        try {
            $errorMessage = '';
            if ($this->request->isPost()) {
                $this->loginRequest->fromArray($this->request->getRequestJsonBody());
                // validation
                $this->loginValidator->validateUserLogin($this->loginRequest);
                // logic
                $existUser = $this->loginApiService->login($this->loginRequest);
                if ($existUser) {
                    $token = $this->tokenService->generate($existUser);
                    return $this->response->toJson([
                        'data' => [
                            ...$this->userResponse->userResponse($existUser),
                            'token' => $token
                        ],
                        'message' => $errorMessage
                    ], Response::HTTP_OK);
                }
                $errorMessage = 'Username or password is invalid!';
            }
        } catch (\Exception $exception) {
            $exception->getMessage();
            $errorMessage = 'Something is error';
        }
        //return view
        return $this->response->toJson([
            'message' => $errorMessage
        ], Response::HTTP_UNAUTHORIZED);
    }

    public function userCheck()
    {
        $errorMessage = '';
        try {
            if ($this->request->isPost()) {
                $this->registerRequest->fromArray($this->request->getRequestJsonBody());
                $this->registerValidator->validateUser($this->registerRequest);
                $isSuccess = $this->registerApiService->register($this->registerRequest);
                if($isSuccess){
                    $token = $this->tokenService->generate($isSuccess);
                    return $this->response->toJson([
                        'data' => [
                            ...$this->userResponse->userResponse($isSuccess),
                            'token' => $token
                        ],
                        'message' => $errorMessage
                    ], Response::HTTP_OK);
                }
                $errorMessage = 'Somethings is wrong';
            }
        } catch (\Exception $exception) {
            $exception->getMessage();
            $errorMessage = 'Something is error';
        }
        //return view
        return $this->response->toJson([
            'message' => $errorMessage
        ], Response::HTTP_UNAUTHORIZED);
    }
}

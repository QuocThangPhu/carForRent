<?php

namespace Thangphu\CarForRent\Controllers\API;

use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Request\LoginRequest;
use Thangphu\CarForRent\Response\UserResponse;
use Thangphu\CarForRent\Service\LoginAPIService;
use Thangphu\CarForRent\Service\TokenService;
use Thangphu\CarForRent\varlidator\LoginValidator;

class AuthApiController
{
    protected Request $request;
    protected Response $response;
    protected LoginAPIService $loginApiService;
    protected UserResponse $userResponse;
    protected LoginRequest $loginRequest;
    protected LoginValidator $loginValidator;
    protected TokenService $tokenService;

    public function __construct(
        Request $request,
        Response $response,
        LoginAPIService $loginApiService,
        UserResponse $userResponse,
        LoginRequest $loginRequest,
        LoginValidator $loginValidator,
        TokenService $tokenService
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->loginApiService = $loginApiService;
        $this->userResponse = $userResponse;
        $this->loginRequest = $loginRequest;
        $this->loginValidator = $loginValidator;
        $this->tokenService = $tokenService;
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
}

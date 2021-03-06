<?php

namespace Thangphu\CarForRent\Controllers\API;

use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Controllers\BaseController;
use Thangphu\CarForRent\Request\LoginRequest;
use Thangphu\CarForRent\Response\UserResponse;
use Thangphu\CarForRent\Service\LoginService;
use Thangphu\CarForRent\Service\TokenService;
use Thangphu\CarForRent\varlidator\LoginValidator;

class LoginApiController extends BaseController
{
    protected Request $request;
    protected Response $response;
    protected LoginService $loginService;
    protected UserResponse $userResponse;
    protected LoginRequest $loginRequest;
    protected LoginValidator $loginValidator;
    protected TokenService $tokenService;

    public function __construct(
        Request $request,
        Response $response,
        LoginService $loginService,
        UserResponse $userResponse,
        LoginRequest $loginRequest,
        LoginValidator $loginValidator,
        TokenService $tokenService,
    ) {
        parent::__construct($request, $response);
        $this->loginService = $loginService;
        $this->userResponse = $userResponse;
        $this->loginRequest = $loginRequest;
        $this->loginValidator = $loginValidator;
        $this->tokenService = $tokenService;
    }

    public function login()
    {
        try {
            $errorMessage = '';
            if ($this->request->isPost()) {
                $this->loginRequest->fromArray($this->request->getRequestJsonBody());
                // validation
                $this->loginValidator->validateUserLogin($this->loginRequest);
                // logic
                $existUser = $this->loginService->login($this->loginRequest);
                if ($existUser) {
                    $token = $this->tokenService->generate($existUser->getId());
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
            $errorMessage = $exception->getMessage();
        }
        return $this->response->toJson([
            'message' => $errorMessage
        ], Response::HTTP_UNAUTHORIZED);
    }
}

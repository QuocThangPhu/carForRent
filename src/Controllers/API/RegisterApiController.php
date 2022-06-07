<?php

namespace Thangphu\CarForRent\Controllers\API;

use Thangphu\CarForRent\Bootstrap\Request;
use Thangphu\CarForRent\Bootstrap\Response;
use Thangphu\CarForRent\Request\RegisterRequest;
use Thangphu\CarForRent\Response\UserResponse;
use Thangphu\CarForRent\Service\RegisterService;
use Thangphu\CarForRent\Service\TokenService;
use Thangphu\CarForRent\Validator\RegisterValidator;

class RegisterApiController extends BaseApiController
{
    const SOME_THING_WRONG = 'Somethings is wrong';
    protected RegisterValidator $registerValidator;
    protected RegisterRequest $registerRequest;
    protected RegisterService $registerService;
    protected TokenService $tokenService;

    public function __construct(
        Request $request,
        Response $response,
        UserResponse $userResponse,
        TokenService $tokenService,
        RegisterRequest $registerRequest,
        RegisterValidator $registerValidator,
        RegisterService $registerService
    ) {
        parent::__construct($request, $response, $userResponse);
        $this->tokenService = $tokenService;
        $this->registerRequest = $registerRequest;
        $this->registerValidator = $registerValidator;
        $this->registerService = $registerService;
    }

    public function register()
    {
        $errorMessage = '';
        try {
            if ($this->request->isPost()) {
                $this->registerRequest->fromArray($this->request->getRequestJsonBody());
                $this->registerValidator->validateUser($this->registerRequest);
                $isSuccess = $this->registerService->register($this->registerRequest);
                if ($isSuccess) {
                    $token = $this->tokenService->generate($isSuccess->getId());
                    return $this->response->toJson([
                        'data' => [
                            ...$this->userResponse->userResponse($isSuccess),
                            'token' => $token
                        ],
                        'message' => $errorMessage
                    ], Response::HTTP_OK);
                }
                $errorMessage = static::SOME_THING_WRONG;
            }
        } catch (\Exception $exception) {
            $errorMessage = $exception->getMessage();
        }
        return $this->response->toJson([
            'message' => $errorMessage
        ], Response::HTTP_UNAUTHORIZED);
    }
}

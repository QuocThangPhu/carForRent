<?php

namespace Thangphu\CarForRent\Controllers\API;

use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Controllers\BaseController;
use Thangphu\CarForRent\Request\RegisterRequest;
use Thangphu\CarForRent\Response\UserResponse;
use Thangphu\CarForRent\Service\RegisterService;
use Thangphu\CarForRent\Service\TokenService;
use Thangphu\CarForRent\varlidator\RegisterValidator;

class RegisterApiController extends BaseController
{
    protected $registerValidator;
    protected $registerRequest;
    protected $registerService;
    protected $tokenService;
    protected $userResponse;

    public function __construct(
        Request $request,
        Response $response,
        UserResponse $userResponse,
        TokenService $tokenService,
        RegisterRequest $registerRequest,
        RegisterValidator $registerValidator,
        RegisterService $registerService
    ) {
        parent::__construct($request, $response);
        $this->userResponse = $userResponse;
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
                $errorMessage = 'Somethings is wrong';
            }
        } catch (\Exception $exception) {
            $errorMessage = $exception->getMessage();
        }
        return $this->response->toJson([
            'message' => $errorMessage
        ], Response::HTTP_UNAUTHORIZED);
    }
}

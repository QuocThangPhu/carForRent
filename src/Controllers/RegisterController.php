<?php

namespace Thangphu\CarForRent\Controllers;

use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Request\RegisterRequest;
use Thangphu\CarForRent\Service\RegisterService;
use Thangphu\CarForRent\varlidator\RegisterValidator;

class RegisterController extends BaseController
{
    private $registerRequest;
    private $registerValidator;
    private $registerService;


    public function __construct(
        Request $request,
        Response $response,
        RegisterRequest $registerRequest,
        RegisterValidator $registerValidator,
        RegisterService $registerService
    ) {
        parent::__construct($request, $response);
        $this->registerRequest = $registerRequest;
        $this->registerValidator = $registerValidator;
        $this->registerService = $registerService;
    }
    public function register()
    {
        if (!$this->request->isPost()) {
            return $this->response->renderView('register');
        }
        $this->registerRequest->fromArray($this->request->getBody());
        $isUserRegisterValid = $this->registerValidator->validateUser($this->registerRequest);
        if (is_array($isUserRegisterValid)) {
            return $this->response->renderView('register', [
                'errors' => $isUserRegisterValid
            ]);
        }
        $isSuccess = $this->registerService->register($this->registerRequest);
        if ($isSuccess) {
            return $this->response->redirect('/');
        }
        $errorMessage = 'Somethings is wrong';
        return $this->response->renderView('register', [
            'errors' => $errorMessage
        ]);
    }
}

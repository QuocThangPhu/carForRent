<?php

namespace Thangphu\CarForRent\Controllers;

use Thangphu\CarForRent\Bootstrap\Request;
use Thangphu\CarForRent\Bootstrap\Response;
use Thangphu\CarForRent\Request\RegisterRequest;
use Thangphu\CarForRent\Service\RegisterService;
use Thangphu\CarForRent\Validator\RegisterValidator;

class RegisterController extends BaseController
{
    const SOMETHINGS_IS_WRONG = 'Somethings is wrong';
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
        $this->checkValidateRegister();
        $this->checkRegisterSuccess();
        $errorMessage = static::SOMETHINGS_IS_WRONG;
        return $this->response->renderView('register', [
            'errors' => $errorMessage
        ]);
    }

    private function checkValidateRegister(): void
    {
        $this->registerRequest->fromArray($this->request->getBody());
        $isUserRegisterValid = $this->registerValidator->validateUser($this->registerRequest);
        if (is_array($isUserRegisterValid)) {
            $this->response->renderView('register', [
                'errors' => $isUserRegisterValid
            ]);
        }
    }

    private function checkRegisterSuccess(): void
    {
        $isSuccess = $this->registerService->register($this->registerRequest);
        if ($isSuccess) {
            $this->response->redirect('/');
        }
    }
}

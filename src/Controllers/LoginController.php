<?php

namespace Thangphu\CarForRent\Controllers;

use Thangphu\CarForRent\App\View;
use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Request\LoginRequest;
use Thangphu\CarForRent\Service\LoginService;
use Thangphu\CarForRent\varlidator\LoginValidator;

class LoginController extends BaseController
{
    const INVALID = 'Username or password is invalid!';
    private $loginService;
    private $loginValidator;
    private $loginRequest;

    public function __construct(
        LoginService $loginService,
        LoginValidator $loginValidator,
        Request $request,
        Response $response,
        LoginRequest $loginRequest,
    ) {
        parent::__construct($request, $response);
        $this->loginService = $loginService;
        $this->loginValidator = $loginValidator;
        $this->loginRequest = $loginRequest;
    }

    public function login(): Response
    {
        if (!$this->request->isPost()) {
            return $this->response->renderView('login');
        }
        $isLoginFormValid = $this->checkValidateLogin();
        $this->checkLoginIsValid($isLoginFormValid);
        $this->checkLoginSuccess();
        $errorMessage = static::INVALID;
        return $this->response->renderView('login', [
            'username' => $this->loginRequest->getUsername(),
            'password' => $this->loginRequest->getPassword(),
            'errors' => $errorMessage
        ]);
    }

    public function logout(): bool
    {
        unset($_SESSION["user_id"], $_SESSION["username"]);
        View::redirect('/');
        return true;
    }

    private function checkLoginIsValid($isLoginFormValid): void
    {
        if (!empty($isLoginFormValid)) {
            $message = [
                'username' => $this->loginRequest->getUsername(),
                'password' => $this->loginRequest->getPassword(),
                'errors' => $isLoginFormValid['message']
            ];
            $this->response->renderView('login', $message);
        }
    }

    private function checkLoginSuccess(): void
    {
        $isLoginSuccess = $this->loginService->login($this->loginRequest);
        if ($isLoginSuccess) {
            $_SESSION['user_id'] = $isLoginSuccess->getId();
            $_SESSION['username'] = $isLoginSuccess->getUsername();
            $this->response->redirect('/');
        }
    }

    private function checkValidateLogin(): array
    {
        $this->loginRequest->fromArray($this->request->getBody());
        return $this->loginValidator->validateUserLogin($this->loginRequest);
    }
}

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
        $this->loginRequest->fromArray($this->request->getBody());
        $isLoginFormValid = $this->loginValidator->validateUserLogin($this->loginRequest);
        if (!empty($isLoginFormValid)) {
            $message = [
                'username' => $this->loginRequest->getUsername(),
                'password' => $this->loginRequest->getPassword(),
                'errors' => $isLoginFormValid['message']
            ];
            return $this->response->renderView('login', $message);
        }
        $isLoginSuccess = $this->loginService->login($this->loginRequest);
        if ($isLoginSuccess) {
            return $this->response->redirect('/');
        }
        $errorMessage = 'Username or password is invalid!';
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
}

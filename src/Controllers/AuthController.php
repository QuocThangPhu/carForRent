<?php

namespace Thangphu\CarForRent\Controllers;

use Dotenv\Exception\ValidationException;
use Thangphu\CarForRent\App\View;
use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\bootstrap\Response;
use Thangphu\CarForRent\Database\DatabaseConnect;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Request\LoginRequest;
use Thangphu\CarForRent\Service\LoginService;
use Thangphu\CarForRent\Service\RegisterService;
use Thangphu\CarForRent\Validation\InputLoginValidation;
use Thangphu\CarForRent\Validation\LoginCheckValidation;

class AuthController
{
    protected Request $request;
    private LoginService $loginService;
    protected Response $response;
    protected InputLoginValidation $loginValidation;

    public function __construct(Request $request, LoginService $loginService, Response $response, InputLoginValidation $loginValidation)
    {
        $this->request = $request;
        $this->loginService = $loginService;
        $this->response = $response;
        $this->loginValidation = $loginValidation;
    }


    public function login()
    {
        return $this->response->renderView('login');
    }

    public function loginCheck()
    {
        // handle request

        // validation

        // logic

        // return view
        $loginValidation = new InputLoginValidation();
        if ($this->request->isPost()) {

            $loginValidation->loadData($this->request->getBody());
            $isValid = $loginValidation->validate();
            if ($isValid) {
                //            $user = new UserModel();
//            $user->setUsername($loginValidation->username);
//            $user->setPassword($loginValidation->password);
                $user = $this->loginService->login($loginValidation);
                if ($user) {
                    $_SESSION["user_id"] = $user->getId();
                    $_SESSION["username"] = $user->getUsername();
                    View::redirect('/');
                }

            }

        }

        return $this->response->renderView('login', [
            'username' => $loginValidation->username,
            'password' => $loginValidation->password,
            'errors' => $loginValidation->getErrors()
        ]);

    }

    public function logout()
    {
        if (!$this->request->isPost()) {
            View::redirect('/');
        }
        unset($_SESSION["user_id"], $_SESSION["username"]);
        View::redirect('/');
    }
}

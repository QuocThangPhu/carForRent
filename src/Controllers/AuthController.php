<?php

namespace Thangphu\CarForRent\Controllers;

use Dotenv\Exception\ValidationException;
use Thangphu\CarForRent\App\View;
use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\Database\DatabaseConnect;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Request\LoginRequest;
use Thangphu\CarForRent\Service\LoginService;
use Thangphu\CarForRent\Service\RegisterService;
use Thangphu\CarForRent\Validation\LoginValidation;

class AuthController
{
    protected Request $request;
    private LoginService $loginService;
    protected UserModel $user;
    protected LoginValidation $loginValidation;

    public function __construct(Request $request,LoginService $loginService, UserModel $userModel, LoginValidation $loginValidation)
    {
        $this->request = $request;
        $this->loginService = $loginService;
        $this->userModel = $userModel;
        $this->loginValidation = $loginValidation;
    }


    public function login()
    {
        $login = $this->loginValidation;
        return View::renderOnlyView('login', [
            'model' => $login
        ]);
    }

    public function loginCheck()
    {

        if (!$this->request->isPost()) {
            return View::renderOnlyView('login', [
                'model' => []
            ]);
        }
        $login = new LoginValidation();
        $login->loadData($this->request->getBody());
        if (!$login->validate()) {
            return View::renderOnlyView('login', [
                'model' => $login
            ]);
        }
        try {
            $this->userModel->setUsername($login->username);
            $this->userModel->setPassword($login->password);
            $user = $this->loginService->login($this->userModel);
            $_SESSION["user_id"] = $user->getId();
            $_SESSION["username"] = $user->getUsername();
            View::redirect('/');
        } catch (ValidationException $e) {
            return View::renderOnlyView('login', [
                'model' => $e->getMessage()
            ]);
        }
    }

    public function logout()
    {
        if (!$this->request->isPost()) {
            View::redirect('/');
        }
        unset($_SESSION["user_id"], $_SESSION["username"]);
        View::redirect('/');
    }

    public function registerForm()
    {

        $registerModel = new LoginValidation();
        return View::renderOnlyView('register', [
            'model' => $registerModel
        ]);
    }

    public function register(Request $request)
    {
        $user = new UserModel();
        $register = new RegisterService();
        $register->register($request);
    }
}

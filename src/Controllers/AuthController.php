<?php

namespace Thangphu\CarForRent\Controllers;

use Dotenv\Exception\ValidationException;
use Thangphu\CarForRent\App\View;
use Thangphu\CarForRent\bootstrap\Controller;
use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\Database\DatabaseConnect;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Request\LoginRequest;
use Thangphu\CarForRent\Service\LoginService;
use Thangphu\CarForRent\Service\RegisterService;
use Thangphu\CarForRent\Validation\LoginValidation;

class AuthController extends Controller
{
    protected Request $request;
    private LoginService $loginService;
    protected UserModel $user;
    protected LoginValidation $loginValidation;

    public function __construct(Request $request,LoginService $loginService, UserModel $user, LoginValidation $loginValidation)
    {
        $this->request = $request;
        $this->loginService = $loginService;
        $this->user = $user;
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
        $login = new LoginValidation();
        if (!$this->request->isPost()) {
            return View::renderOnlyView('login', [
                'model' => $login
            ]);
        }
        $login->loadData($this->request->getBody());
        if (!$login->validate()) {
            return View::renderOnlyView('login', [
                'model' => $login
            ]);
        }
        try {
            $this->user->setUsername($login->username);
            $this->user->setPassword($login->password);
            $userModel = $this->loginService->login($this->user);
            $_SESSION["user_id"] = $userModel->getId();
            $_SESSION["username"] = $userModel->getUsername();
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

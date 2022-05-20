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
    protected $connect;
    protected $request;
    public function __construct()
    {
        $this->connect = DatabaseConnect::getConnection();
        $this->request = new Request();
    }


    public function login()
    {
        $login = new LoginValidation();
        return View::renderOnlyView('login', [
            'model' => $login
        ]);
    }

    public function loginCheck()
    {
        $user = new UserModel();
        $login = new LoginValidation();
        if ($this->request->isPost()) {
            $login->loadData($this->request->getBody());
            if(!$login->validate()){
                return View::renderOnlyView('login', [
                    'model' => $login
                ]);
            }
            try{
                $user->setUsername($login->username);
                $user->setPassword($login->password);
                $loginService = new LoginService();
                $loginService->login($user);
                $_SESSION["user_id"] = $loginService->login($user)->getUser()->getId();
                $_SESSION["username"] = $loginService->login($user)->getUser()->getUsername();
                View::redirect('/');
            }catch (ValidationException $e){
                return View::renderOnlyView('login', [
                    'model' => $e->getMessage()
                ]);
            }
        }

    }

    public function logout()
    {
        unset($_SESSION["user_id"],$_SESSION["username"]);
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

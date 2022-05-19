<?php

namespace Thangphu\CarForRent\Controllers;

use Thangphu\CarForRent\bootstrap\Controller;
use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\Database\DatabaseConnect;
use Thangphu\CarForRent\Repository\UserRepository;
use Thangphu\CarForRent\Request\LoginRequest;
use Thangphu\CarForRent\Service\RegisterService;
use Thangphu\CarForRent\Validation\RegisterValidation;

class AuthController extends Controller
{
    protected $connect;

    public function __construct()
    {
        $this->connect = DatabaseConnect::getConnection();
    }

    public function login(Request  $request)
    {
        $login = new LoginRequest($request);
    }

    public function loginCheck(Request $request)
    {
        return $this->render('login');
    }

    public function register(Request $request)
    {

        $register = new RegisterService();
        $register->register($request);
    }
}

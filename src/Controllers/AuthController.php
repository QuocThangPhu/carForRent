<?php

namespace Thangphu\CarForRent\Controllers;

use Thangphu\CarForRent\bootstrap\Controller;
use Thangphu\CarForRent\bootstrap\Request;
use Thangphu\CarForRent\Model\RegisterModel;

class AuthController extends Controller
{
    public function login()
    {
        return $this->render('login');
    }

    public function register(Request $request)
    {
        $registerModel = new RegisterModel();
        if($request->isPost())
        {

            $registerModel->loadData($request->getBody());
            var_dump($registerModel);
            die();
            if($registerModel->validate() && $registerModel->register())
            {
                return "Success";
            }
            return $this->render('register',[
               'model' => $registerModel
            ]);
        }
        return $this->render('register',[
            'model' => $registerModel
        ]);
    }
}

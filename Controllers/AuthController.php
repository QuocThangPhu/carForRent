<?php

namespace Thangphu\UnLock\Controllers;

use Thangphu\UnLock\core\Controller;
use Thangphu\UnLock\core\Request;
use Thangphu\UnLock\Model\RegisterModel;

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

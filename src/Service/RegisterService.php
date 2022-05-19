<?php

namespace Thangphu\CarForRent\Service;

use PDO;
use Thangphu\CarForRent\bootstrap\Service;
use Thangphu\CarForRent\Database\DatabaseConnect;
use Thangphu\CarForRent\Repository\UserRepository;
use Thangphu\CarForRent\Validation\RegisterValidation;

class RegisterService extends Service
{
    protected UserRepository $userRepository;
    protected PDO $connect;
    public function __construct()
    {
        $this->connect = DatabaseConnect::getConnection();
        $this->userRepository = new UserRepository($this->connect);
    }

    public function register($request)
    {
        $registerModel = new RegisterValidation();
        if ($request->isPost()) {
            $registerModel->loadData($request->getBody());
            if ($registerModel->validate() ) {
                $user = new UserRepository($this->connect);
                $user->createUser($registerModel->username,$registerModel->password);
            }
            $this->setLayout('auth');
            return $this->render('register', [
                'model' => $registerModel
            ]);
        }
        return $this->render('register', [
            'model' => $registerModel
        ]);
    }
}
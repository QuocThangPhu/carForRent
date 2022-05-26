<?php

namespace Thangphu\CarForRent\Repository;

use PDO;
use Thangphu\CarForRent\Database\DatabaseConnect;
use Thangphu\CarForRent\Model\UserModel;

class UserRepository
{
    private PDO $connection;
    private UserModel $user;

    public function __construct(UserModel $user)
    {
        $this->connection = DatabaseConnect::getConnection();
        $this->user = $user;
    }

    public function findUserByUserName($username)
    {
        $userWasFound = $this->connection->prepare("SELECT * FROM USER WHERE username = ? ");
        $userWasFound->execute([$username]);
        if ($row = $userWasFound->fetch()) {
            $this->user->setId($row['idUSER']);
            $this->user->setUsername($row['username']);
            $this->user->setPassword($row['password']);
            return $this->user;
        } else {
            return null;
        }
    }
}

<?php

namespace Thangphu\CarForRent\Repository;

use PDO;
use Thangphu\CarForRent\Model\UserModel;

class UserRepository
{
    private PDO $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function createUser($username, $password)
    {

        $password = hash("haval192,3", $password);
        $newUser = $this->connection->prepare("INSERT INTO USER (username, password) 
        VALUES ('$username','$password')");
        $newUser->execute();

        $user = new UserModel();
        if ($row = $newUser->fetch()) {
            $user->setId($row['id']);
            $user->setUsername($row['username']);
            $user->setPassword($row['password']);
            return $user;
        } else {
            return null;
        }
    }

    public function findUserByName($username)
    {
        $userWasFound = $this->connection->prepare("SELECT * FROM USER WHERE username = '$username' ");
        $userWasFound->execute();
        $user = new UserModel();
        if ($row = $userWasFound->fetch()) {
            $user->setId($row['idUSER']);
            $user->setUsername($row['username']);
            $user->setPassword($row['password']);
            return $user;
        } else {
            return null;
        }
    }
}

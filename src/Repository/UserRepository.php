<?php

namespace Thangphu\CarForRent\Repository;

use PDO;
use Thangphu\CarForRent\Database\DatabaseConnect;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Request\RegisterRequest;

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
        $userWasFound = $this->connection->prepare("SELECT * FROM user WHERE username = ? ");
        $userWasFound->execute([$username]);
        if ($row = $userWasFound->fetch()) {
            $this->user->setId($row['id']);
            $this->user->setUsername($row['username']);
            $this->user->setPassword($row['password']);
            return $this->user;
        } else {
            return null;
        }
    }
    public function findUserById($id)
    {
        $userWasFound = $this->connection->prepare("SELECT * FROM user WHERE id = ? ");
        $userWasFound->execute([$id]);
        if ($row = $userWasFound->fetch()) {
            $this->user->setId($row['id']);
            $this->user->setUsername($row['username']);
            $this->user->setPassword($row['password']);
            $this->user->setRole($row['role']);
            return $this->user;
        } else {
            return null;
        }
    }

    public function findUserName($username)
    {
        $userWasFound = $this->connection->prepare("SELECT * FROM user WHERE username = ? ");
        $userWasFound->execute([$username]);
        if ($userWasFound->fetch()) {
            return true;
        } else {
            return false;
        }
    }

    public function createUser(RegisterRequest $registerRequest): ?UserModel
    {
        $password = password_hash($registerRequest->getPassword(), PASSWORD_BCRYPT);
        $newUser = $this->connection->prepare("INSERT INTO user (username, password, role) VALUES (?, ?, ?)");
        $newUser->execute([$registerRequest->getUsername(),$password, 'custormer']);
        return $this->findUserById($this->connection->lastInsertId());
    }
}

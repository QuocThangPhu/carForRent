<?php

namespace Thangphu\CarForRent\Repository;
use Thangphu\CarForRent\Model\UserModel;
use Thangphu\CarForRent\Request\RegisterRequest;

class UserRepository extends DatabaseRepository
{

    public function findUserByUserName($username)
    {
        $user = new UserModel();
        $userWasFound = $this->connection->prepare("SELECT * FROM user WHERE username = ? ");
        $userWasFound->execute([$username]);
        if ($row = $userWasFound->fetch()) {
            $user->setId($row['id']);
            $user->setUsername($row['username']);
            $user->setPassword($row['password']);
            return $user;
        } else {
            return null;
        }
    }
    public function findUserById($id)
    {
        $user = new UserModel();
        $userWasFound = $this->connection->prepare("SELECT * FROM user WHERE id = ? ");
        $userWasFound->execute([$id]);
        if ($row = $userWasFound->fetch()) {
            $user->setId($row['id']);
            $user->setUsername($row['username']);
            $user->setPassword($row['password']);
            $user->setRole($row['role']);
            return $user;
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

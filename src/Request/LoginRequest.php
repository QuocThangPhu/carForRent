<?php

namespace Thangphu\CarForRent\Request;

use Dotenv\Exception\ValidationException;

class LoginRequest
{
    private string $username;
    private string $password;

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function __construct(array $loginRequest)
    {
        $this->setUsername($loginRequest['username']);
        $this->setPassword($loginRequest['password']);
    }

    public function validate()
    {
        if (empty($this->getUsername()) || empty($this->getPassword())) {
            throw new ValidationException("Your username or password is empty");
        }
        return true;
    }
}

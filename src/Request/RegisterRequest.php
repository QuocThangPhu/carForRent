<?php

namespace Thangphu\CarForRent\Request;

class RegisterRequest
{
    private string $username;
    private string $password;
    private string $passwordConfirm;

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

    /**
     * @return string
     */
    public function getPasswordConfirm(): string
    {
        return $this->passwordConfirm;
    }

    /**
     * @param string $passwordConfirm
     */
    public function setPasswordConfirm(string $passwordConfirm): void
    {
        $this->passwordConfirm = $passwordConfirm;
    }

    public function fromArray(array $requestBody)
    {
        $this->setUsername($requestBody['username']);
        $this->setPassword($requestBody['password']);
        $this->setPasswordConfirm($requestBody['passwordConfirm']);
        return $this;
    }
}

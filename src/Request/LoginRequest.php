<?php

namespace Thangphu\CarForRent\Request;


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

    private function formatRequest($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        return htmlspecialchars($data);
    }

    public function fromArray (array $requestBody)
    {
        $this->setUsername($requestBody['username']);
        $this->setPassword($requestBody['password']);
        return $this;
    }
}

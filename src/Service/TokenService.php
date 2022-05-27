<?php

namespace Thangphu\CarForRent\Service;

use Firebase\JWT\JWT;
use Thangphu\CarForRent\Model\UserModel;

class TokenService
{
    private string $secretToken;
    public function __construct()
    {
        $this->secretToken = getenv('SECRET_TOKEN');
    }

    public function generate(UserModel $user)
    {
        $payload = [
            'sub' => $user->getId(),
            'name' => $user->getUsername(),
            'iat' => time(),
        ];
        return JWT::encode($payload, $this->secretToken, 'HS256');
    }
}

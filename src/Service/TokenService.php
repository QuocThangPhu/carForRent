<?php

namespace Thangphu\CarForRent\Service;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Thangphu\CarForRent\Exception\UnauthenticatedException;

class TokenService
{
    private string $secretToken;
    public function __construct()
    {
        $this->secretToken = getenv('SECRET_TOKEN');
    }

    public function generate($id)
    {
        $payload = [
            'sub' => $id,
            'iat' => time(),
        ];
        return JWT::encode($payload, $this->getSecretToken(), 'HS256');
    }

    public function validateToken($token): array
    {
        try {
            $decoded = JWT::decode($token, new Key($this->getSecretToken(), 'HS256'));
        } catch (\Exception $e) {
            throw new UnauthenticatedException('Token is invalid');
        }
        return (array)$decoded;
    }

    public function getTokenPayload(?string $authorizationToken): array|bool
    {
        if ($authorizationToken === null) {
            return false;
        }
        $token = str_replace('Bearer ', '', $authorizationToken);
        $payload = $this->validateToken($token);
        if ($payload) {
            return $payload;
        }
    }

    /**
     * @return array|false|string
     */
    public function getSecretToken(): bool|array|string
    {
        return $this->secretToken;
    }

    /**
     * @param array|false|string $secretToken
     */
    public function setSecretToken(bool|array|string $secretToken): void
    {
        $this->secretToken = $secretToken;
    }
}

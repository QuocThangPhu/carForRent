<?php

namespace Thangphu\Test\Service;

use Firebase\JWT\JWT;
use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Exception\UnauthenticatedException;
use Thangphu\CarForRent\Service\TokenService;

class TokenServiceTest extends TestCase
{
    public function testGenerateAndValidateToken()
    {
        $tokenService = new TokenService();
        $tokenService->setSecretToken("secret");
        $token = $tokenService->generate(1);
        $expectedToken = $tokenService->validateToken($token);
        $this->assertEquals(1, $expectedToken['sub']);
    }

    public function testGenerateAndValidateTokenFalse()
    {
        $tokenService = new TokenService();
        $tokenService->setSecretToken("secret");
        $token = $tokenService->generate(1);
        $tokenService->setSecretToken("secret1");
        $this->ExpectException(UnauthenticatedException::class);
        $tokenService->validateToken($token);
    }

    public function testGetTokenPayloadFasle()
    {
        $tokenService = new TokenService();
        $payload = $tokenService->getTokenPayload(null);
        $this->assertFalse($payload);
    }

    public function testGetTokenPayloadSuccess()
    {
        $tokenService = new TokenService();
        $tokenService->setSecretToken("secret");
        $token = "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEsImlhdCI6MTY1NDUwMDA5Nn0.OeZ0QBCdiP28u6GIuoMjIEf3fJ4PS-PjA0iB9nnv7pE";
        $payload = $tokenService->getTokenPayload($token);
        $expectedResult = [
            'sub' => 1,
            'iat' => 1654500096
        ];
        $this->assertEquals($expectedResult, $payload);
    }

}
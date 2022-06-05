<?php

namespace Thangphu\CarForRent\Service\Contracts;

use Thangphu\CarForRent\Request\LoginRequest;

interface LoginServiceInterface
{
    public function login(LoginRequest $loginRequest);
}

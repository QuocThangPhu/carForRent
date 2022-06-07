<?php

namespace Thangphu\CarForRent\Service;

use Thangphu\CarForRent\Bootstrap\BaseServiceProvider;
use Thangphu\CarForRent\Service\Contracts\LoginServiceInterface;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->provider->bind(LoginServiceInterface::class, LoginService::class);
    }
}

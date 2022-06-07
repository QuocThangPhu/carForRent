<?php

namespace Thangphu\CarForRent\Bootstrap;

abstract class BaseServiceProvider
{
    protected Container $provider;
    public function __construct()
    {
        $this->provider = new Container();
    }
    abstract public function register();

    public function getContainer(): Container
    {
        $this->register();
        return $this->provider;
    }
}

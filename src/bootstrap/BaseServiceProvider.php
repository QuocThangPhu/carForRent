<?php

namespace Thangphu\CarForRent\bootstrap;

abstract class BaseServiceProvider
{
    protected Container $provider;
    public function __construct()
    {
        $this->provider = new Container();
    }
    abstract public function register();

    public function getContainer()
    {
        $this->register();
        return $this->provider;
    }
}

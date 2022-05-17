<?php

namespace Thangphu\UnLock\Transport;

class Ship implements VehicleIntreface
{
    /**
     * @return string
     */
    public function shippingMethod(): string
    {
        return "Shipping by Ship";
    }
}

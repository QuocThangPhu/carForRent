<?php

namespace Thangphu\UnLock\Transport;

class Bicycle implements VehicleIntreface
{
    /**
     * @return string
     */
    public function shippingMethod(): string
    {
        return "Shipping by Bicycle";
    }
}

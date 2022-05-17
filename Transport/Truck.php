<?php

namespace Thangphu\UnLock\Transport;

class Truck implements VehicleIntreface
{
    /**
     * @return string
     */
    public function shippingMethod(): string
    {
        return "shipping by Truck";
    }
}

<?php

namespace Thangphu\UnLock\Transport;

class Yacht implements VehicleIntreface
{
    /**
     * @return string
     */
    public function shippingMethod(): string
    {
        return "Shipping by Yacht";
    }
}

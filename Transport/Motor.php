<?php

namespace Thangphu\UnLock\Transport;

class Motor implements VehicleIntreface
{
    /**
     * @return string
     */
    public function shippingMethod(): string
    {
        return "Shipping by Motor";
    }
}

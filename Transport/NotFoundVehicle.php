<?php

namespace Thangphu\UnLock\Transport;

class NotFoundVehicle implements VehicleIntreface
{
    /**
     * @return string
     */
    public function shippingMethod(): string
    {
        return "Not Found Vehicle";
    }
}

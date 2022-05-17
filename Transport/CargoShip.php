<?php

namespace Thangphu\UnLock\Transport;

class CargoShip implements VehicleIntreface
{
    /**]
     * @return string
     */
    public function shippingMethod(): string
    {
        return "Shipping by CargoShip";
    }
}

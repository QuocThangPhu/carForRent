<?php

namespace Thangphu\UnLock\Transport;

interface TransportInterface
{
    /**
     * @return VehicleIntreface
     */
    public function deliver(): VehicleIntreface;
}

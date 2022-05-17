<?php

namespace Thangphu\UnLock\Transport;
use Thangphu\UnLock\Transport\Motor;
use Thangphu\UnLock\Transport\TransportInterface;
use Thangphu\UnLock\Transport\Truck;
use Thangphu\UnLock\Transport\Bicycle;
use Thangphu\UnLock\Transport\NotFoundVehicle;
use Thangphu\UnLock\Transport\VehicleIntreface;

class RoadFactory implements TransportInterface
{
    /**
     * @return VehicleIntreface
     */
    public function deliver(): VehicleIntreface
    {
        $ramdom = rand(0,2);
        switch ($ramdom){
            case 0:
                return new Truck();
            case 1:
                return new Motor();
            case 2:
                return new Bicycle();
            default:
                return new NotFoundVehicle();
        }

    }
}

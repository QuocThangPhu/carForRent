<?php

namespace Thangphu\UnLock\Transport;

class SeaFactory implements TransportInterface
{
    /**
     * @return VehicleIntreface
     */
    public function deliver(): VehicleIntreface
    {
        $ramdom = rand(1,3);
        switch ($ramdom){
            case 1:
                return new Ship();
            case 2:
                return new CargoShip();
            case 3:
                return new Yacht();
            default:
                return new NotFoundVehicle();
        }
    }
}

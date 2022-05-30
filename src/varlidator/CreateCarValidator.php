<?php

namespace Thangphu\CarForRent\varlidator;

use Thangphu\CarForRent\Exception\ValidateException;
use Thangphu\CarForRent\Request\CarRequest;

class CreateCarValidator
{
    public function createCarValidator(CarRequest $car)
    {
        if (empty($car->getName()) || empty($car->getPrice()) || empty($car->getBrand()) || empty($car->getPicture())) {
            throw new ValidateException("The field can't be empty");
        }
        return true;
    }
}

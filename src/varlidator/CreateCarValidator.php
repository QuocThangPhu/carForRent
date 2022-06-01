<?php

namespace Thangphu\CarForRent\varlidator;

use Thangphu\CarForRent\Exception\ValidateException;
use Thangphu\CarForRent\Request\CarRequest;

class CreateCarValidator
{
    public function createCarValidator(CarRequest $car)
    {
        $pattern = '/^[a-z\d]$/';
        if (empty($car->getName()) || empty($car->getPrice()) || empty($car->getBrand()) || empty($car->getPicture())) {
            throw new ValidateException("The field can't be empty");
        }
        if(strlen($car->getName()) > 30 || strlen($car->getBrand()) > 30){
        throw new ValidateException("The filed name or brand is not more than 30 characters");
    }
        if(!preg_match($pattern, $car->getName())|| !preg_match($pattern, $car->getBrand())){
            throw new ValidateException("The filed name or brand is wrong format");
        }
        return true;
    }
}

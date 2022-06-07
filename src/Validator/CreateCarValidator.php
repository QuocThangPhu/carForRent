<?php

namespace Thangphu\CarForRent\Validator;

use Thangphu\CarForRent\Exception\ValidateException;
use Thangphu\CarForRent\Request\CarRequest;

class CreateCarValidator
{
    public function createCarValidator(CarRequest $car)
    {
        $validator = new Validator();
        $validator->name('name')->value($car->getName())->min(3)->max(255)->required();
        $validator->name('brand')->value($car->getBrand())->min(3)->max(255)->required();
        $validator->name('price')->value($car->getPrice())->is_int()->max(999999999)->required();
        $validator->name('picture')->value($car->getPicture())->min(3)->max(255)->required();

        if ($validator->isSuccess()) {
            return true;
        } else {
            return $validator->getErrors();
        }
    }
}

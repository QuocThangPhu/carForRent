<?php

namespace Thangphu\CarForRent\Response;

class CarResponse
{
    public function carResponse($carModel)
    {
        return [
            'id' => $carModel->getId(),
            'name' => $carModel->getName(),
            'price' => $carModel->getPrice(),
            'picture' => $carModel->getPicture(),
            'brand' => $carModel->getBrand()
        ];
    }
}

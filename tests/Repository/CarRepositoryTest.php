<?php

namespace Thangphu\Test\Repository;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Repository\CarRepository;

class CarRepositoryTest extends TestCase
{
    public function testSelectCar()
    {
        $carRepository = new CarRepository();
        $listCar = $carRepository->selectCar();
        $this->assertIsArray($listCar);
    }
}
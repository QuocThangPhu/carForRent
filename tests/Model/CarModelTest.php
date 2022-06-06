<?php

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Model\CarModel;

class CarModelTest extends TestCase
{
    public function testCarModel()
    {
        $car = new CarModel();
        $car->setId('1');
        $car->setName('BMW');
        $car->setBrand('BMW');
        $car->setPrice('1500');
        $car->setPicture('bmw.jpg');
        $this->assertEquals('1',  $car->getId());
        $this->assertEquals('BMW',  $car->getName());
        $this->assertEquals('BMW',  $car->getBrand());
        $this->assertEquals('1500',  $car->getPrice());
        $this->assertEquals('bmw.jpg',  $car->getPicture());
    }

}
<?php

namespace Thangphu\CarForRent\Repository;

use PDO;
use Thangphu\CarForRent\Database\DatabaseConnect;
use Thangphu\CarForRent\Model\CarModel;
use Thangphu\CarForRent\Request\CarRequest;
use Thangphu\CarForRent\Response\CarResponse;

class CarRepository
{
    private PDO $connection;
    private CarModel $car;
    private CarResponse $carResponse;

    public function __construct(CarModel $car, CarResponse $carResponse)
    {
        $this->connection = DatabaseConnect::getConnection();
        $this->car = $car;
        $this->carResponse = $carResponse;
    }

    public function selectCar()
    {
        $exitCar = $this->connection->prepare("SELECT * FROM car ");
        $exitCar->execute();
        $rows = $exitCar->fetchAll();
        $cars = [];
        foreach ($rows as $row) {
            $this->car->setId($row['id']);
            $this->car->setName($row['name']);
            $this->car->setPrice($row['price']);
            $this->car->setPicture($row['picture']);
            $this->car->setBrand($row['brand']);
            $carResponse = $this->carResponse->carResponse($this->car);
            array_push($cars, $carResponse);
        }
        return $cars;
    }

    public function createCar(CarRequest $carRequest)
    {
        $newCar = $this->connection->prepare("INSERT INTO car (name, price, picture, brand) VALUES (?, ?, ?, ?)");
            $newCar->execute([$carRequest->getName(), $carRequest->getPrice(), $carRequest->getPicture(), $carRequest->getBrand()]);
        return true;
    }
}

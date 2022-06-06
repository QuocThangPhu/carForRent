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

    public function __construct(CarModel $car, CarResponse $carResponse)
    {
        $this->connection = DatabaseConnect::getConnection();
    }

    public function selectCar(): array
    {
        $exitCar = $this->connection->prepare("SELECT * FROM car ");
        $exitCar->execute();
        $rows = $exitCar->fetchAll();
        $cars = [];
        foreach ($rows as $row) {
            $cars[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'picture' => $row['picture'],
                'brand' => $row['brand'],
                'price' => $row['price']
            ];
        }
        return $cars;
    }

    public function createCar(CarRequest $carRequest): bool
    {
        $newCar = $this->connection->prepare("INSERT INTO car (name, price, picture, brand) VALUES (?, ?, ?, ?)");
            $newCar->execute([$carRequest->getName(), $carRequest->getPrice(), $carRequest->getPicture(), $carRequest->getBrand()]);
        return true;
    }
}

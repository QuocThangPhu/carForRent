<?php

namespace Thangphu\CarForRent\Request;

use Thangphu\CarForRent\Model\CarModel;

class CarRequest extends CarModel
{
    private string $name;
    private int $price;
    private string $picture;
    private string $brand;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getPicture(): string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     */
    public function setPicture(string $picture): void
    {
        $this->picture = $picture;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function fromArray($requestBody)
    {
        $this->setName($requestBody['name']);
        $this->setPrice($requestBody['price']);
        $this->setPicture($requestBody['picture']);
        $this->setBrand($requestBody['brand']);
        return $this;
    }
}

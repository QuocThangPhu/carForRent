<?php

namespace Thangphu\CarForRent\Controllers;

use Thangphu\CarForRent\Bootstrap\Response;
use Thangphu\CarForRent\Repository\CarRepository;

class SiteController
{
    protected Response $response;
    protected CarRepository $carRepository;

    public function __construct(Response $response, CarRepository $carRepository)
    {
        $this->response = $response;
        $this->carRepository = $carRepository;
    }

    public function home()
    {
        $listCar = $this->carRepository->selectCar();
        return $this->response->renderView('home', ['cars' => $listCar]);
    }
}
